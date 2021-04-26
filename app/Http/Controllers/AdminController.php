<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorVerify;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function login(){
        return view("Admin.login");
    }
    public function login_post(Request $request){
        $request->validate([
            'email'=>"required|email",
            'password'=>"required|min:5|max:16",
        ]);

        $user = Admin::where("email","=",$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                if($user->is_two_factor){
                    if(!$user->two_factor_codes){
                        $user->two_factor_codes = $user->CreteTwoFactorCode();
                        $user->save();
                        Mail::to($user->email)->send(new TwoFactorVerify($user));
                        return redirect("/admin/two_factor_verify")->with("info","E-posta adresine gönderilmiş olan güvenlik kodunu giriniz.");
                    }else{
                        return redirect("/admin/two_factor_verify")->with("info","E-posta adresine gönderilmiş olan güvenlik kodunu giriniz.");
                    }
                }else{
                    $request->session()->put("LoggedAdmin",$user->id);
                    return redirect('/admin/dashboard');
                }
            }else{
                return back()->with("fail","Girmiş olduğunuz şifre uyumsuzdur...");
            }
        }else{
            return back()->with("fail","Bu e-postaya ait bir hesap bulunamadı...");
        }
    }

    public function logout(Request $request){
        $request->session()->forget("LoggedAdmin");
        return redirect("/admin/login");
    }

    public function account_verification($token){
        $VerifyUser = Admin::where("email_verified_token","=",$token)->first();
        if($VerifyUser){
            if(!$VerifyUser->email_verified_at){
                $VerifyUser->email_verified_token = null;
                $VerifyUser->email_verified_at = Carbon::now();
                $VerifyUser->save();
                return redirect("/admin/login")->with("success","E-posta adresinizi başarılı bir şekilde onaylamış bulunmaktasınız...Lütfen şimdi giriş yapar mısınız ?");
            }else{
                return redirect("/admin/login")->with("fail","E-posta adresiniz zaten doğrulanmış durumda. Giriş yapabilirsiniz.");
            }
        }else{
            return redirect("/admin/login")->with("fail","Üzgünüz bir şey yanlış gitti...");
        }
    }

    public function two_factor_code_check(){
        return view("Admin.TwoFactorCheck");
    }
    public function two_factor_code_check_post(Request $request){
        $user = Admin::where("two_factor_codes","=",$request->code)->first();
        if($user){
            $request->session()->put("LoggedAdmin",$user->id);
            $user->two_factor_codes = null;
            $user->save();
            return redirect("/admin/dashboard");
        }else{
            return redirect("/admin/two_factor_verify")->with("fail","Maalesef girmiş olduğunuz kodu doğrulayamadık...");
        }
    }

    public function dashboard(){
        return view("Admin.dashboard");
    }

}
