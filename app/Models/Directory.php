<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    protected $fillable = ['event_id','name'];


    public function event(){
        return $this->belongTo(Event::class);
    }

}