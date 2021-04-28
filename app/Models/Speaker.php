<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Saying;

class Speaker extends Model
{
    use HasFactory;

    public function getSaying(){
        return $this->hasMany(Saying::class,"speakers","id");
    }
}
