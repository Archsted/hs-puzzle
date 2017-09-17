<?php

namespace App\Console\Commands;

use App\Board;
use App\Cell;
use App\Map;
use Illuminate\Console\Command;

class CreateBoard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:create {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Boardデータを新規作成します。';

    /**
     * @var Board
     */
    protected $board;

    /**
     * @var Map
     */
    protected $map;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Board $board, Map $map)
    {
        parent::__construct();

        $this->board = $board;
        $this->map = $map;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->argument('count');

        $bar = $this->output->createProgressBar($count);

        for ($i = 0; $i < $count; $i++) {

            $board = $this->board->newInstance();

            while (true) {
                $board->code = str_random(8);
                if ($this->board->where('code', $board->code)->count() === 0) {
                    break;
                }
            }

            $mapIds = [1, 2, 3, 4];
            shuffle($mapIds);
            $mapCode = implode('', $mapIds);

            /** @var Map $map */
            $map = $this->map->query()->where('code', $mapCode)->with('cells')->firstOrFail();

            $board->map_id = $map->id;

            // ゴール地点を抽出し、ランダムに１つ選択
            $goalCell = array_random($map->cells->where('type', Cell::TYPE_GOAL)->toArray());

            $board->goal_cell_id = $goalCell['id'];

            // スタート地点となる場所を空白マス（但し座標は奇数に限る）からランダムに４つ抽出
            // 本来ならばゴールマスも初期位置になりうるが、見やすさ重視で初期値から除外することにした
            $startCells = array_random($map->cells
                ->filter(function ($value, $key) { return $value->y % 2 === 1; })
                ->filter(function ($value, $key) { return $value->x % 2 === 1; })
                ->where('type', Cell::TYPE_BLANK)
                ->toArray(), 4);

            foreach (['red', 'green', 'blue', 'yellow'] as $color) {
                $startCell = array_shift($startCells);
                $board->{$color . '_y'} = $startCell['y'];
                $board->{$color . '_x'} = $startCell['x'];
            }

            // minstep

            $command = sprintf('%s %s %s %d %d %s %d %d %d %d %d %d %d %d',
                env('RUBY_PATH'),
                resource_path('hs_resolver.rb'),
                implode(',', $mapIds),
                $goalCell['y'],
                $goalCell['x'],
                $goalCell['color'],
                $board->red_y,
                $board->red_x,
                $board->green_y,
                $board->green_x,
                $board->blue_y,
                $board->blue_x,
                $board->yellow_y,
                $board->yellow_x
            );

            $output = [];
            $return = 0;

            exec($command, $output, $return);

            $minStep = $output[0];

            if (!ctype_digit($minStep)) {
                echo "error" . PHP_EOL;
                exit;
            }

            $board->step_count = intval($minStep);

            if ($board->step_count > 2) {
                $board->save();
            }

            $bar->advance();
        }

        $bar->finish();

        echo PHP_EOL;
    }
}
