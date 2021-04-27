<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ArticlesController extends Controller
{
    public function articles(){
        $articles = Article::where("writer_id","=",Session::get("LoggedAuthor"))->get();
        return view("Author.articles.index", compact("articles"));
    }

    public function articlesCreate(){
        $categories = Category::all();
        return view("Author.articles.create",compact("categories"));
    }
    public function articlesCreatePost(Request $request){
        $article = new Article;
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title);
        $article->writer_id = Session::get('LoggedAuthor');
        /*
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image = '/uploads/'.$imageName;
        }*/
        $article->save();
        return redirect('author/articles')->with("success","Makaleniz başarılı bir şekilde oluşturuldu.");
    }

    public function articlesDelete(Request $request){
        $articles = Article::findOrFail($request->delete_id);
        $articles->delete();
        return redirect()->back()->with("success","Makale başarılı bir şekilde silindi.");
    }

    public function articlesEdit($id){
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view("Author.articles.update",compact("article","categories"));
    }

    public function articlesEditPost(Request  $request, $id){
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title);
        /*
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image = '/uploads/'.$imageName;
        }*/
        $article->save();
        return redirect("author/articles")->with("success","Makale başarılı bir şekilde güncellendi.");
    }
    public function articlesEditStatus(Request $request){
        $article = Article::findOrFail($request->id);
        $article->status = $request->statu=='true' ? 1 : 0;
        $article->save();
    }
}
