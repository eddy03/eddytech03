<?php
/**
 * eddytech03.com website
 * 
 * @category Administrator module
 * @author Edi Abdul Rahman <eddytech03@gmail.com>
 * 
 * This is the SSH controller. Use to control SSH web config
 * 
 */

class SSHController extends \BaseController {
    
    /**
     * System directory collection
     * 
     * @var array
     */
    private $dir;
    
    /**
     * Construct the class attribute
     * 
     */
    public function __construct()
    {
        // /var/www/vhosts/websites
        $master = DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'www' . DIRECTORY_SEPARATOR . 'vhosts' . DIRECTORY_SEPARATOR;
        $this->dir['website'] = $master . 'eddytech03';
        $this->dir['spaghetti'] = $master . 'spaghetti-system';
        $this->dir['ewakaf'] = $master . 'ewakaf';
        $this->dir['vespa'] = $master . 'vespa_azwan';
    }
    
    /**
     * Show the ssh dashboard
     * 
     * @return Responses
     */
    public function dashboard()
    {
        if(Auth::user()->email == 'azwanICT@gmail.com')
            return View::make('ssh.vespa');
        else
            return View::make('ssh.eddy');
    }
    
    /**
     * Execute the command from the web view
     * 
     * @return Responses
     */
    public function cmd()
    {
        if(Input::get('cmd') == 'git pull') {
            $commands = $this->pull(Input::get('system'));
        }
        
        //Grab the output from ssh command
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
    
    /**
     * Pull command syntax
     * 
     * @param string $sys
     * @return array
     */
    private function pull( $sys ) {
        return array(
            'cd ' . $this->dir[$sys],
            'git pull'
        );
    }
}