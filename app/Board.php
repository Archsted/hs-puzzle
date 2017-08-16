<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $casts = [
        'reserved' => 'boolean',
    ];

    public function map()
    {
        return $this->belongsTo('App\Map');
    }

    public function goalCell()
    {
        return $this->belongsTo('App\Cell', 'goal_cell_id');
    }

    /**
     * @param Builder $query
     * @param $code
     * @return Builder
     */
    public function scopeOfCode(Builder $query, $code)
    {
        return $query->where('code', $code);
    }
}
