<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'code', 'name', 'twitter',
    ];

    public function scopeOfCode($query, $code) {
        return $query->where('code', $code);
    }
}
