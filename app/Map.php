<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $cellArray = null;

    protected $appends = ['cell_array'];

    protected $hidden = ['cells'];

    public function getCellArrayAttribute()
    {
        if (is_null($this->cellArray)) {
            $cells = $this->cells;

            $cellList = [];
            foreach ($cells as $cell) {
                $cellList[$cell->y][$cell->x] = $cell->type === 1 ? 1 : 0;
            }
            $this->cellArray = $cellList;
        }

        return $this->cellArray;
    }

    public function cells()
    {
        return $this->hasMany('App\Cell');
    }
}
