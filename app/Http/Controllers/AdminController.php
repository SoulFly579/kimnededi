<?php

namespace App\Http\Controllers;

use App\Mail\SendAnnouncements;
use App\Mail\SendPassword;
use App\Mail\TwoFactorVerify;
use App\Models\Admin;
use App\Models\Announcements;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

    public function authors(){
        $authors = Author::all();
        return view("Admin.Author.index",compact("authors"));
    }

    public function authorsCreate(){
        return view("Admin.Author.create");
    }

    public function authorsCreatePost(Request $request){
        $request->validate([
            'name'=>"required",
            'surname'=>"required",
            'username'=>"required|unique:authors",
            'email'=>"required|email|unique:authors",
            'location'=>"required",
            'phone'=>"required",
        ]);
        $password = Str::random(12);
        $user = new Author;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->slug = Str::slug($request->username);
        $user->phone = $request->phone;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->is_two_factor = 0;
        $query = $user->save();

        if($query){
            Mail::to($user->email)->send(new SendPassword($user,$password));
            return redirect("/admin/authors")->with("success","Kayıt başarılı bir şekilde yapıldı.");
        }else{
            return redirect("/admin/authors/create")->with("fail","Bir hata meydana geldi.");
        }

    }

    public function authorsDelete(Request $request){
        Author::findOrFail($request->authorId)->delete();
        return redirect("/admin/authors")->with("success","Başarıyla yazar silindi.");
    }

    public function announcements(){
        $announcements = Announcements::all();
        return view("Admin.Announcements.index",compact("announcements"));
    }

    public function announcementsCreate(){
        return view("Admin.Announcements.create");
    }
    public function announcementsCreatePost(Request $request){
        $request->validate([
            "title"=>"required",
            "content"=>"required",
        ]);

        $announcements = new Announcements;
        $announcements->title = $request->title;
        $announcements->content = $request->content;
        $announcements->from = Session::get("LoggedAdmin");
        $announcements->save();

        $authors = Author::all();
        foreach($authors as $author){
            Mail::to($author->email)->send(new SendAnnouncements($author,$announcements));
        }

        return redirect("admin/announcements")->with("success","Duyuru yazarlara ulaştırıldı.");

    }




}
