<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    const NOT_RESERVED = 0;

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
     * 特定のBoardCodeのものを取得する
     *
     * @param Builder $query
     * @param $code
     * @return Builder
     */
    public function scopeOfCode(Builder $query, $code)
    {
        return $query->where('code', $code);
    }

    /**
     * 予約済みで無いものだけを取得する
     *
     * @param Builder $query
     * @return $this
     */
    public function scopeNotReserved(Builder $query)
    {
        return $query->where('reserved', self::NOT_RESERVED);
    }
}
