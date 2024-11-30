<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'active'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function directory(){
        return $this->hasOne(Directory::class);
    }
}
