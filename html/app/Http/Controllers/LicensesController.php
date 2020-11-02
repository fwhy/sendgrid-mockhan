<?php

namespace App\Http\Controllers;

class LicensesController extends Controller
{
    public function __invoke()
    {
        $cd = 'cd ' . base_path();
        $phpCmd = 'composer licenses';
        $jsCmd = 'yarn --ignore-platform licenses list';
        exec("{$cd}; {$phpCmd}", $php);
        exec("{$cd}; {$jsCmd}", $js);

        return view('licenses')->with([
            'php' => "$ > {$phpCmd}" . PHP_EOL . implode(PHP_EOL, $php),
            'js' => "$ > {$jsCmd}" . PHP_EOL . implode(PHP_EOL, $js),
        ]);
    }
}
