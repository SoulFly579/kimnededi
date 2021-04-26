<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IsLoginAdmin
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
        if($request->session()->has("LoggedAdmin")){
            // Kontrol Et burayı
            $user = Admin::where("id","=",Session::get("LoggedAdmin"))->first();
            if($user->is_two_factor){
                if($user->two_factor_codes){
                    return redirect("/admin/two_factor_verify")->with("fail","Önce girişinizi onaylamalısınız...");
                }
            }
            return $next($request);
        }else{
            return redirect("admin/login");
        }
    }
}
