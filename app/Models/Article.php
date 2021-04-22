<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Article extends Model
{
    use HasFactory;

    public function getCategory(){
        return $this->hasOne(Category::class,"id","category_id");
    }
    public function getComment(){
        return $this->hasMany(Comment::class,"article_id","id");
    }

    public function getAuthor(){
        return $this->belongsTo(Author::class,"id","writter_id");
    }

    public function PercentageRatioCalculation($like,$dislike){
        if($like <= 0){
            return "%0";
        }else if($dislike <= 0){
            return "%100";
        }else{
            $rate = $like+$dislike;
            $percentageRatio = ($like*100)/$rate;
            return "%".(int)$percentageRatio;
        }
    }
}
