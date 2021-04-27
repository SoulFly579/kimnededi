<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'password',
        'address',
        'phone',
        'location',
        'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'is_two_factor',
        'two_factor_codes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function CreteTwoFactorCode(){
        return rand(1000,9999);
    }

    public function getPost(){
        return $this->hasMany(Article::class,"writer_id","id");
    }

    public function GettingActivity(){
        return $this->hasMany(AuthorActivity::class,"user_id","id");
    }

}
