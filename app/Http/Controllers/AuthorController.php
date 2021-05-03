<?php

namespace App\Http\Controllers;

use App\Models\AuthorActivity;
use App\Models\Category;
use App\Models\Saying;
use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Mail\TwoFactorVerify;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Carbon;
use App\Models\Author;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

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
                    GettingDevicesInformation($user->id,"Author");
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
        $getBlog = Article::where("writer_id","=",Session::get("LoggedAuthor"))->get();
        $articles = Article::all();
        $anwser = PrecentageRatioCalculationForArticles($articles,$getBlog);
        /*
        $like = [];
        $allLikes = Article::select("like")->where("writer_id","=",Session::get("LoggedAuthor"))->get();
        foreach ($allLikes as $allLike) {
            array_push($like, $allLike);
        }*/
        return view("Author.dashboard",compact("anwser"));
    }

    public function saying(){
        $sayings = Saying::where("writer_id","=",Session::get("LoggedAuthor"))->get();
        return view("Author.Saying.index",compact("sayings"));
    }

    public function sayingCreatePost(Request $request){
        $request->validate([
            "sayings"=>"required",
            "speaker"=>"required",
            "description"=>"required|min:25",
            "keywords"=>"required|min:25",
        ]);
        $speakers = Speaker::where("name","=",$request->speaker)->first();
        if($speakers){
            $sayings = new Saying;
            $sayings->sentence = $request->sayings;
            $sayings->slug = Str::slug($request->sayings);
            $sayings->speakers = $speakers->id;
            $sayings->writer_id = Session::get("LoggedAuthor");
            $sayings->description = $request->description;
            $sayings->keywords = $request->keywords;

            $sayings->save();
            return redirect()->back()->with("success","Başarılı bir şekilde yayınlanmıştır.");
        }
        return redirect()->back()->with("fail","Bir şeyler ters gitti lütfen söyleyini seçtikten sonra herhangi bir oynama yapmayınız.");
    }

    public function sayingDelete(Request $request){
        Saying::where("id","=",$request->delete_id)->delete();
        return redirect()->back()->with("success","Söz başarılı bir şekilde silindi.");
    }

    public function speakers(){
        $speakers = Speaker::all();
        return view("Author.Speakers.index",compact("speakers"));
    }

    public function speakersGet(Request $request){
        $search = Speaker::where("name","LIKE","$request->search%")->get();
        return response()->json($search);
    }

    public function speakersCreatePost(Request $request){
        $request->validate([
           "name"=>"required",
        ]);
        $isExits = Speaker::where("slug","=",Str::slug($request->name))->first();
        if($isExits){
            return back()->with("fail","Zaten böyle bir söyleyen mevcut.");
        }else{
            $speakers = new Speaker;
            $speakers->name = $request->name;
            $speakers->slug = Str::slug($request->name);
            $speakers->save();
            return redirect("/author/speakers")->with("success","Söyleyen başarılı bir şekilde kayıt edilmiştir.");
        }
    }

    public function speakersDelete(Request $request){
        $speakers = Speaker::where("id","=",$request->delete_id)->first();
        if($speakers->id == 1){
            return redirect()->back()->with("fail","Bu söyleyen silinemez");
        }
        if($speakers->getSaying->count() > 0) {
            Saying::where('speakers',$speakers->id)->update(['speakers'=>1]);
            $successText = 'Kategori başarıyla silindi. mevcut söyelyene ait makaleler başka bir söyleyen kısmına aktarıldı';
        }else{
            $successText = "Söyleyen başarıyla silindi.";
        }
        $speakers->delete();
        return redirect()->back()->with("success",$successText);

    }

    public function activity(){
        $activity = AuthorActivity::where("id","=",Session::get("LoggedAuthor"))->get();
        return view("Author.activity",compact("activity"));
    }

}
