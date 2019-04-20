<?php

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

Route::post('deploy', function(Request $request) {

    $provider = env('GIT_DEPLOY_PROVIDER'); // github, bitbucket, gitlab
    $branch   = env('GIT_DEPLOY_BRANCH', 'master');
    $key      = env('GIT_DEPLOY_KEY', '');
    
    $payload = $request->input();

    switch ($provider) {
        case 'github':
            // @todo
            break;
        case 'bitbucket':
            if (get('key') != $key) return 'Invalid key.';
            
            try {
                if (isset($payload['push'])) {
                    $lastChange = $payload['push']['changes'][count($payload['push']['changes']) - 1]['new'];
                    $onBranch   = isset($lastChange['name']) && ! empty( $lastChange['name']) ? $lastChange['name'] : '';
                    
                    if ($branch != $onBranch) return 'Wrong branch.';
                }
            }
            catch (Exception $e) {
                return $e->getMessage();
            }
            break;
        case 'gitlab':
            // @todo
            break;
        default:
            return 'Repository provider not defined.';
    }
        
    $root_path = base_path();
    $process = new Process('cd ' . $root_path . '; chmod +x deploy.sh; ./deploy.sh');
    $process->run(function ($type, $buffer) {
        echo $buffer;
    });
});