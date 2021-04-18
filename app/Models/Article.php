<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Article extends Model
{
    use HasFactory;

    public function getCategory(){
        $this->hasOne(Category::class,"id","category_id");
    }
    public function getComment(){
        $this->hasMany(Comment::class,"article_id","id");
    }

    public function getAuthor(){
        $this->belongsTo(Author::class,"id","writter_id");
    }
}
