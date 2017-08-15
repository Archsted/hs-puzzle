<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 8)->unique();
            $table->unsignedInteger('map_id');
            $table->unsignedInteger('goal_cell_id');
            $table->integer('red_y');
            $table->integer('red_x');
            $table->integer('green_y');
            $table->integer('green_x');
            $table->integer('blue_y');
            $table->integer('blue_x');
            $table->integer('yellow_y');
            $table->integer('yellow_x');
            $table->integer('step_count');
            $table->boolean('reserved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
