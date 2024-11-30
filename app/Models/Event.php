<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{

    use HasFactory;

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
