<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];

    public function book() {
        return $this->belongsToMany('App\Book');
    }

    public function validate() {
        return strlen($this->title) > 0 and strlen($this->title) < 255;
    }
}
