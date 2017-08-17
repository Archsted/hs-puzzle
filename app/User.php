<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'code', 'name', 'twitter',
    ];

    public function scopeOfCode($query, $code) {
        return $query->where('code', $code);
    }
}
