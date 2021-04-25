<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Session;

class IsLoginAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has("LoggedAuthor")){
                                            // Kontrol Et burayı
            $user = Author::where("id","=",Session::get("LoggedAuthor"))->first();
            if($user->is_two_factor){
                if($user->two_factor_codes){
                    return redirect("/author/two_factor_verify")->with("fail","Önce girişinizi onaylamalısınız...");
                }
            }
            return $next($request);
        }else{
            return redirect("author/login");
        }
    }
}
