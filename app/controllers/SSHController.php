<?php

class SSHController extends \BaseController {
    
    private $dir;
    
    public function __construct()
    {
        ///var/www/vhosts/websites
        $master = DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'www' . DIRECTORY_SEPARATOR . 'vhosts' . DIRECTORY_SEPARATOR;
        $this->dir['website'] = $master . 'eddytech03';
        $this->dir['spaghetti'] = $master . 'spaghetti-system';
        $this->dir['ewakaf'] = $master . 'ewakaf';
        $this->dir['vespa'] = $master . 'vespa_azwan';
    }
    
    public function dashboard()
    {
        if(Auth::user()->email == 'azwanICT@gmail.com')
            return View::make('ssh.vespa');
        else
            return View::make('ssh.eddy');
    }
    
    public function cmd()
    {
        if(Input::get('cmd') == 'git pull') {
            $commands = $this->pull(Input::get('system'));
        }
        
        ob_start();
        SSH::run( $commands, function($line) {
            echo $line.PHP_EOL;
        });
        $responses = ob_get_contents();
        ob_end_clean();
        return Response::json(array(
            'status' => '200',
            'messages' => $responses,
        ));
    }
    
    private function pull( $sys ) {
        return array(
            'cd ' . $this->dir[$sys],
            'git pull'
        );
    }
}