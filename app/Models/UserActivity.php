<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'device',
        'platform',
        'browser',
        'ip_address',
        'user_id',
    ];

    public function GettingUser(){
        return $this->belongsTo(User::class,"user_id","id");
    }

}
