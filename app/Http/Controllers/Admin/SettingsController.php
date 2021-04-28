<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        $settings = SiteSetting::where("id","=","1")->first();
        return view("Admin.SiteSettings.index",compact("settings"));
    }
}
