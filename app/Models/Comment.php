<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    public function getUser(){
        $this->belongsTo(User::class,"id","writer_id");
    }
    public function getArticle(){
        $this->belongsTo(Article::class,"id","article_id");
    }
    public function getTitleComment(){
        $this->belongsTo(Comment::class,"id","title_comment_id");
    }
    public function getSubComment(){
        $this->hasMany(Comment::class,"title_comment_id","id");
    }
}
