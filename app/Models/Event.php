<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{

    use HasFactory;

    const TYPES = ['matrimonio','promessa','battesimo','cresima','argento','oro','platino','compleanno','rinnovo','baby'];

    protected $fillable = [
        'title',
        'img',
        'description',
        'date',
        'location',
        'type',
        'active'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function directory(){
        return $this->hasOne(Directory::class);
    }

    public static function getEventTypes(){
        return self::TYPES;
    }
}
