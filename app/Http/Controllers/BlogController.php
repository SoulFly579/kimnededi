<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class BlogController extends Controller
{
    public function articles(){
        $articles = Article::orderBy("updated_at")->get();
        return view("Admin.Blog.articles", compact("articles"));
    }

    public function categories(){
        $categories = Category::all();
        return view("Admin.Blog.categories",compact("categories"));
    }
}
