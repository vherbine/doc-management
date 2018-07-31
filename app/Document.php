<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['content', 'meta'];

    // Cast attributes JSON to array
    protected $casts = [
        'meta' => 'array',
        'content' => 'array'
    ];
}
