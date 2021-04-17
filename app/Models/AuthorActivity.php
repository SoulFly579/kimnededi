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
        'user_email',
        'user_activity',
    ];

    public function GettingUser(){
        return $this->belongsTo(Author::class,"id","user_id");
    }
}
