<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Directory extends Model
{
    use HasFactory;

    protected $fillable = ['event_id','name'];


    public function event(){
        return $this->belongTo(Event::class);
    }

}