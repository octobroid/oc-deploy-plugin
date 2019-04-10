<?php

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

Route::post('deploy', function(Request $request) {

    $root_path = base_path();
    $process = new Process('cd ' . $root_path . '; ./deploy.sh');
    $process->run(function ($type, $buffer) {
        echo $buffer;
    });
});