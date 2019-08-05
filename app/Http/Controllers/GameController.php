<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    private $axis = [
        0 => [
            'axis' => 1,
            'dir' => -1,
        ],
        1 => [
            'axis' => 0,
            'dir' => -1,
        ],
        2 => [
            'axis' => 1,
            'dir' => 1,
        ],
        3 => [
            'axis' => 0,
            'dir' => 1,
        ],
    ];

    public function index()
    {
        return view('game.index');
    }

    public function load(Request $request)
    {
        if (!$request->w || !intval($request->w)) $w = 3;
        else $w = intval($request->w);
        if (!$request->h || !intval($request->h)) $h = 3;
        else $h = intval($request->h);
        if (!$request->time || !intval($request->time)) $time = 15;
        else $time = intval($request->time);

        if ($time < 0) $time = 0;
        if ($w < 2) $w = 2;
        if ($h < 2) $h = 2;

        if (!$w) $w = 3;
        if (!$h) $h = 3;

        $steps = $w * $h + 1;

        $borders = [
            'y' => [
                'min' => 1,
                'max' => $h,
            ],
            'x' => [
                'min' => 1,
                'max' => $w,
            ],
        ];

        for ($i = 0; $i < $steps; $i++) {
            $direction = rand(0, 3);
        }

        $grid = $this->generate_grid($w, $h);
        $motion = $this->motion($grid, $borders, $steps);

        return view('game.load', [
            'grid' => $grid,
            'motion' => $motion,
            'time' => $time,
        ]);
    }

    public function settings()
    {
        return view('game.settings');
    }

    private function motion(array $grid, array $borders, int $steps)
    {
        $cell = $this->active($grid);

        $dirs = [
            0 => -1,
            1 => -1,
            2 => 1,
            3 => 1,
        ];
        $hdirs = [
            0 => 'arrow_upward',
            1 => 'arrow_back',
            2 => 'arrow_downward',
            3 => 'arrow_forward',
        ];
        $i = 0;
        while ($i < $steps) {
            $dir = rand(0, 3);
            $last[] = $dir;
            $last_4[] = $dir;

            if (count($last) > 3) array_shift($last);
            if (count($last_4) > 4) array_shift($last_4);

            if (count($last) > 2 && $this->check_difficult($last)) continue;
            if (count($last_4) > 3 && $this->check_last_4($last_4)) continue;

            $temp = $cell;
            if ($dir == 0 || $dir == 2) $temp['y'] += $dirs[$dir];
            elseif ($dir == 1 || $dir == 3) $temp['x'] += $dirs[$dir];

            if ($this->in_grid($temp, $borders)) {
                $res[] = $hdirs[$dir];
                $cell = $temp;
                $i++;
            }
        }
        return $res;
    }

    private function in_grid(array $cell, array $borders)
    {
        foreach ($borders as $k => $v) {
            $res = $cell[$k] >= $v['min'] && $cell[$k] <= $v['max'];
            if (!$res) break;
        }
        return $res;
    }

    private function active(array $grid)
    {
        foreach ($grid as $row) {
            foreach ($row as $cell) {
                if ($cell['active']) return $cell;
            }
        }
    }

    private function check_last_4($last)
    {
        foreach ($last as $k => $dir) {
            $last[$k] = $this->axis[$dir];
        }

        return $last[0]['axis'] == $last[1]['axis'] &&
            $last[0]['axis'] == $last[2]['axis'] &&
            $last[0]['axis'] == $last[3]['axis'] &&
            $last[2]['axis'] == $last[1]['axis'] &&
            $last[1]['axis'] == $last[3]['axis'] &&
            $last[2]['axis'] == $last[3]['axis'];
    }

    private function check_difficult($last)
    {
        foreach ($last as $k => $dir) {
            $last[$k] = $this->axis[$dir];
        }

        $one_axis = $last[0]['axis'] == $last[1]['axis'] && $last[0]['axis'] == $last[2]['axis'] && $last[2]['axis'] == $last[1]['axis'];

        $res = $one_axis && $last[0]['dir'] == $last[2]['dir'];

        return $res;
    }

    private function generate_grid(int $w, int $h)
    {
        $spoint = rand(1, $w * $h);
        $cc = 1;
        for ($i = 1; $i <= $h; $i++) {
            unset($row);
            for ($j = 1; $j <= $w; $j++) {
                $cell = [
                    'x' => $j,
                    'y' => $i,
                    'active' => $cc == $spoint? true: false,
                    'id' => $cc,
                ];
                $cc++;
                $row[] = $cell;
            }
            $grid[] = $row;
        }
        return $grid;
    }
}
