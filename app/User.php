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

    public function stamps()
    {
        return $this->belongsToMany('App\Stamp')->withTimestamps();
    }

    public function histories()
    {
        return $this->hasMany('App\History');
    }
}
