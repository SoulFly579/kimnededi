<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Mail\TwoFactorVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function login(){
        return view("User.login");
    }
    public function login_post(Request $request){
        $request->validate([
            'email'=>"required|email",
            'password'=>"required|min:5|max:16",
        ]);

        $user = User::where("email","=",$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                if($user->email_verified_at){
                    if($user->is_two_factor){
                        if(!$user->two_factor_codes){
                            $user->two_factor_codes = $user->CreteTwoFactorCode();
                            $user->save();
                            Mail::to($user->email)->send(new TwoFactorVerify($user));
                            return redirect("/account/two_factor_verify")->with("info","E-posta adresine gönderilmiş olan güvenlik kodunu giriniz.");
                        }else{
                            return redirect("/account/two_factor_verify")->with("info","E-posta adresine gönderilmiş olan güvenlik kodunu giriniz.");
                        }
                    }else{
                        $request->session()->put("LoggedUser",$user->id);
                        GettingDevicesInformation($user->id,"User");
                        return redirect('/');
                    }
                }else{
                    return back()->with("fail","Lütfen e-posta adresinize gelen doğrulama linkine tıklayınız.");
                }
            }else{
                return back()->with("fail","Girmiş olduğunuz şifre uyumsuzdur...");
            }
        }else{
            return back()->with("fail","Bu e-postaya ait bir hesap bulunamadı...");
        }
    }

    public function register(){
        return view("User.register");
    }

    public function register_post(Request $request){
        $request->validate([
            'email'=>"required|unique:users",
            'password'=>"required|min:5|max:16",
            'username'=>"required",
            'name'=>"required",
            'surname'=>"required",
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_premium = false;
        $user->email_verified_token = Str::random(60);
        $user->email_verified_at = null;
        $user->is_two_factor = false;
        $query = $user->save();

        if($query){
            Mail::to($user->email)->send(new VerifyEmail($user));
            return redirect("login")->with("success","Başarıyla kayıt oldunuz. E-posta adresinizi doğruladıktan sonra giriş yapabilirsiniz.");
        }else{
            return redirect("login")->with("fail","Beklenmeyen bir hata ile karşılaştık.Bunun için üzgünüz. Lütfen tekrar deneyiniz.");
        }
    }

    public function logout(Request $request){
        $request->session()->forget("LoggedUser");
        return redirect("login");
    }

    public function account_verification($token){
        $VerifyUser = User::where("email_verified_token","=",$token)->first();
        if($VerifyUser){
            if(!$VerifyUser->email_verified_at){
                $VerifyUser->email_verified_token = null;
                $VerifyUser->email_verified_at = Carbon::now();
                $VerifyUser->save();
                return redirect("login")->with("success","E-posta adresinizi başarılı bir şekilde onaylamış bulunmaktasınız...Lütfen şimdi giriş yapar mısınız ?");
            }else{
                return redirect("login")->with("fail","E-posta adresiniz zaten doğrulanmış durumda. Giriş yapabilirsiniz.");
            }
        }else{
            return redirect("login")->with("fail","Üzgünüz bir şey yanlış gitti...");
        }
    }

    public function two_factor_code_check(){
        return view("User.TwoFactorCheck");
    }
    public function two_factor_code_check_post(Request $request){
        $user = User::where("two_factor_codes","=",$request->code)->first();
        if($user){
            $request->session()->put("LoggedUser",$user->id);
            $user->two_factor_codes = null;
            $user->save();
            return redirect("/");
        }else{
            return redirect("/account/two_factor_verify")->with("fail","Maalesef girmiş olduğunuz kodu doğrulayamadık...");
        }
    }
}
