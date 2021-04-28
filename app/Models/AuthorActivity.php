<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;

class AuthorActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'device',
        'platform',
        'browser',
        'ip_address',
        'user_id',
    ];

    public function GettingUser(){
        return $this->belongsTo(Author::class,"user_id","id");
    }
}
