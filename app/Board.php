<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function map()
    {
        return $this->belongsTo('App\Map');
    }

    public function goalCell()
    {
        return $this->belongsTo('App\Cell', 'goal_cell_id');
    }
}
