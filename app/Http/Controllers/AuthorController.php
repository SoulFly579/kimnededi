<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\TwoFactorVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Carbon;
use App\Models\Author;
use App\Models\Article;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function login(){
        return view("Author.login");
    }
    public function login_post(Request $request){
        $request->validate([
            'email'=>"required|email",
            'password'=>"required|min:5|max:16",
        ]);

        $user = Author::where("email","=",$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                if($user->is_two_factor){
                    if(!$user->two_factor_codes){
                        $user->two_factor_codes = $user->CreteTwoFactorCode();
                        $user->save();
                        Mail::to($user->email)->send(new TwoFactorVerify($user));
                        return redirect("/author/two_factor_verify")->with("info","E-posta adresine gönderilmiş olan güvenlik kodunu giriniz.");
                    }else{
                        return redirect("/author/two_factor_verify")->with("info","E-posta adresine gönderilmiş olan güvenlik kodunu giriniz.");
                    }
                }else{
                    $request->session()->put("LoggedAuthor",$user->id);
                    return redirect('/author/dashboard');
                }
            }else{
                return back()->with("fail","Girmiş olduğunuz şifre uyumsuzdur...");
            }
        }else{
            return back()->with("fail","Bu e-postaya ait bir hesap bulunamadı...");
        }
    }

    public function logout(Request $request){
        $request->session()->forget("LoggedAuthor");
        return redirect("/author/login");
    }

    public function account_verification($token){
        $VerifyUser = Author::where("email_verified_token","=",$token)->first();
        if($VerifyUser){
            if(!$VerifyUser->email_verified_at){
                $VerifyUser->email_verified_token = null;
                $VerifyUser->email_verified_at = Carbon::now();
                $VerifyUser->save();
                return redirect("/author/login")->with("success","E-posta adresinizi başarılı bir şekilde onaylamış bulunmaktasınız...Lütfen şimdi giriş yapar mısınız ?");
            }else{
                return redirect("/author/login")->with("fail","E-posta adresiniz zaten doğrulanmış durumda. Giriş yapabilirsiniz.");
            }
        }else{
            return redirect("/author/login")->with("fail","Üzgünüz bir şey yanlış gitti...");
        }
    }

    public function two_factor_code_check(){
        return view("Author.TwoFactorCheck");
    }
    public function two_factor_code_check_post(Request $request){
        $user = Author::where("two_factor_codes","=",$request->code)->first();
        if($user){
            $request->session()->put("LoggedAuthor",$user->id);
            $user->two_factor_codes = null;
            $user->save();
            return redirect("/author/dashboard");
        }else{
            return redirect("/account/two_factor_verify")->with("fail","Maalesef girmiş olduğunuz kodu doğrulayamadık...");
        }
    }

    public function dashboard(){
        return view("Author.dashboard");
    }


}
