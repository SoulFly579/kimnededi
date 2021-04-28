<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PremiumType;
use Illuminate\Http\Request;

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

    public function premiumDelete(Request $request){
        PremiumType::where("id","=",$request->delete_id)->delete();
        return redirect()->back()->with("success","Başarıyla Silindi");
    }

    public function premiumStatus(Request $request){
        PremiumType::where("id","=",$request->change_id)->update(['status'=>!$request->change_status])();
        return redirect()->back()->with("success","Başarıyla güncellendi");
    }
}
