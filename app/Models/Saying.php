<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Speaker;

class Saying extends Model
{
    use HasFactory;

    public function getSpeaker(){
        return $this->belongsTo(Speaker::class,"speakers","id");
    }

    public function getAdded(){
        return $this->belongsTo(Author::class,"id","writer_id");
    }
}
