<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'author', 'user_id', 'note',
    ];

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function reading_processes() {
        return $this->hasMany('App\ReadingProcess');
    }
}
