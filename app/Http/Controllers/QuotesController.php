<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saying;
use App\Models\Speaker;

class QuotesController extends Controller
{
    public function index(){
        $quotes = Saying::orderBy("id","DESC")->get();
        $speakers = Speaker::all();
        return view("Front.Quotes.index",compact("quotes","speakers"));
    }

    public function quotesSearch($slug){
        $speakers = Speaker::all();
        $speaker = Saying::where("slug","=",$slug)->first() ?? abort(404);
        if ($category){
            $quotes = Saying::where("speakers","=",$speaker->id)->get() ?? abort(404);
            if($quotes){
                $mostReaded = Saying::orderBy("hit")->limit(5)->get();
                return view("Front.Blog.index",compact("quotes","speakers","mostReaded"));
            }
        }
    }
}
