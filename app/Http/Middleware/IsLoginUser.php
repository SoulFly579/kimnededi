<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isLoginUser
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
        if($request->session()->has("LoggedUser")){
            $user = User::where("id","=",$request->session("LoggedUser"))->first();
            if($user->is_two_factor){
                if($user->two_factor_codes){
                    return redirect("/account/two_factor_verify")->with("fail","Önce girişinizi onaylamalısınız...");
                }
            }
            return $next($request);
        }else{
            return redirect("login");
        }
    }
}
