<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                        //sending mail
                    }else{
                        $request->session()->put("LoggedUser",$user->id);
                        return redirect('home');
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
        return view("User.login");
    }

    public function register_post(Request $request){
        $request->validate([
            'email'=>"required|unique:users",
            'password'=>"required|email|min:5|max:16",
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
        $user->is_preium = false;
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
}
