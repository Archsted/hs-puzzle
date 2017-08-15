<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    const TYPE_BLANK = 0;
    const TYPE_WALL = 1;
    const TYPE_GOAL = 2;

    const COLOR_RED = 'red';
    const COLOR_GREEN = 'green';
    const COLOR_BLUE = 'blue';
    const COLOR_YELLOW = 'yellow';
    const COLOR_BLACK = 'black';

    //
}
