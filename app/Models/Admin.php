<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Announcements;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
    ];

    protected $hidden = [
        'password',
        'is_two_factor',
        'two_factor_codes',
    ];

    public function getAnnouncements(){
        $this->belongsTo(Announcements::class,"from","id");
    }
}
