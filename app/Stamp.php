<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    public function scopeOfRarity($query, $rarity)
    {
        return $query->where('rarity', $rarity);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('code', $code);
    }
}
