<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin;

class Announcements extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'from',
    ];

    public function getFrom(){
        $this->hasMany(Admin::class,"id","from");
    }
}
