<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'user_id', 'board_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'cleared_at'
    ];
}
