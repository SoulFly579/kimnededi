<?php

namespace App\Models;

use App\Models\UserActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Comment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'is_premium',
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
        return Str::random(6);
    }

    public function GettingActivity(){
        return $this->hasMany(UserActivity::class,"user_id","id");
    }

    public function getComment(){
        $this->hasMany(Comment::class,"writer_id","id");
    }
}
