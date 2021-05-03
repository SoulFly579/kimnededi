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
}
