<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view("Home.home");
    }

    public function page($page){
        $page = Page::findOrFail($page);
        return "$page";
    }

    public function contact(){
        return "Contact Page";
    }
    public function contactPost(Request $request){
        //
    }
}
