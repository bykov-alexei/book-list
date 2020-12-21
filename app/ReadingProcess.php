<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReadingProcess extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'book_id',
    ];

    public function book() {
        return $this->belongsTo('App\Book');
    }
}
