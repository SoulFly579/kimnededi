<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Saying;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function home(){
        return view("Front.index");
    }

    public function blog(){
        $articles = Article::all();
        $categories = Category::all();

        return view("Front.Blog.index",compact("articles","categories"));
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

    public function singleArticle($slug,$articleSlug,$id){
        $category = Category::where("slug","=",$slug)->first();
        if($category){
            $article = Article::findOrFail($id);
            if($article->slug == $articleSlug){
                return view("Front.Blog.single",compact("article"));
            }
        }else{
            return redirect()->back()->with("fail","Aradığınız yazı bulunamadı");
        }
    }

    public function categorySearch($slug){
        $categories = Category::all();
        $category = Category::where("slug","=",$slug)->first() ?? abort(404);
        if ($category){
            $articles = Article::where("category_id","=",$category->id)->get() ?? abort(404);
            if($articles){
                return view("Front.Blog.index",compact("categories","articles"));
            }
        }
    }

    public function quotes(){
        $articles = Saying::all();
        $categories = Speaker::all();
        return view("Front.Blog.index",compact("articles","categories"));
    }
}
