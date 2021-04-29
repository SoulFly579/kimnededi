<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PremiumType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PremiumController extends Controller
{
    public function index(){
        $premiumTypes = PremiumType::all();
        return view("Admin.Premium.index",compact("premiumTypes"));
    }

    public function premiumCreate(Request $request){
        $request->validate([
           "name"=>"required",
           "validityTime"=>"required",
            "validityType"=>"required",
            "content"=>"required",
            "price"=>"required",
        ]);

        $preiumType = new PremiumType;
        $preiumType->name = $request->name;
        $preiumType->price = $request->price;
        $preiumType->the_period_of_validity = $request->validityTime;
        $preiumType->type = $request->validityType;
        $preiumType->features = $request->content;
        $preiumType->save();

        return redirect()->back()->with("success","Paket başarılı bir şekilde oluşturuldu.");
    }

    public function premiumStatus(Request $request){
        PremiumType::where("id","=",$request->change_id)->update(['status'=>!$request->change_status]);
        return redirect()->back()->with("success","Başarıyla güncellendi");
    }

    public function premiumGive(){
        $users = User::whereNotNull("premium_finished_date")->whereNotNull("premium_type")->get();
        $premiumsType = PremiumType::all();
        return view("Admin.Premium.give",compact("users","premiumsType"));
    }

    public function premiumGivePost(Request $request){
        $request->validate([
            "premium_id"=>"required",
            "user"=>"required",
        ]);
        $premiumPackage = PremiumType::where("id","=",$request->premium_id)->first();
        $user = User::where("email","=",$request->user)->first();
        $user-> premium_type = $premiumPackage->id;
        if($premiumPackage->type == "day"){
            $user->premium_finished_date = Carbon::now()->addDays($premiumPackage->the_period_of_validity);
        }elseif($premiumPackage->type == "month"){
            $user->premium_finished_date = Carbon::now()->addMonths($premiumPackage->the_period_of_validity);
        }
        $user->save();
        return redirect()->back()->with("success","Kullanıcıya başarılı bir şekilde premium temin edildi.");
    }

    public function premiumGiveGet(Request $request){
        $search = User::select("email")->groupBy('email')->where("email","LIKE","$request->search%")->get();
        $response = array();
        foreach($search as $search){
            $response[] = $search->email;
        }
        return response()->json($response);
    }

}
