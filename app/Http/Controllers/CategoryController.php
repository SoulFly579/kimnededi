<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categories(){
        $categories = Category::all();
        return view("Author.categories.index",compact("categories"));
    }

    public function categoriesCreate(Request $request){
        $isExists = Category::where('slug', Str::slug($request->category))->first();
        if($isExists){
            return redirect()->back()->with("error",$request->category.' adında bir kategoryi zaten mevcut!');
        }
        $category = new Category;
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);
        $category->save();
        return redirect()->back()->with("success","Kategori başarıyla oluşturuldu.");
    }
    public function categoriesEdit(Request $request){
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }
    public function categoriesEditPost(Request $request){
        $isExists = Category::where('slug', Str::slug($request->category))->whereNotIn('id',[$request->id])->first();
        if($isExists){
            return redirect()->back()->with("error",$request->category.' adında bir kategoryi zaten mevcut!');
        }
        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);
        $category->save();
        return redirect()->back()->with("success",'Kategori başarıyla güncellendi.');
    }
    public function categoriesDelete(Request $request){
        $category = Category::findOrFail($request->delete_id);
        if($category->id == 1 ){
            return redirect()->back()->with("error",'Bu kategori silinemez.');
        }
        $count = $category->getPost->count();
        $name = $category->name;
        if($count>0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $successText = 'Kategori başarıyla silindi. '.$name.' kategorisine ait makaleler GENEl kategorisine aktarıldı';
        }else{
            $successText = "Kategori başarıyla silindi.";
        }
        $category->delete();
        return redirect()->back()->with("success",$successText);
    }
    public function categoriesEditStatus(Request $request){
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu=="true" ? 1:0;
        $category->save();
    }
}
