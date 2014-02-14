<?php
/**
 * eddytech03.com website
 * 
 * @category Administrator module
 * @author Edi Abdul Rahman <eddytech03@gmail.com>
 * 
 * This is the administrator controller. 
 * 
 */

class AdminController extends \BaseController {
    
    /**
     * Display the login page view
     * 
     * @return Responses
     */
    public function login()
    {
        return View::make('admins.login');
    }
    
    /**
     * Authenticate the user, validate it also. If success, then redirect to dashboard. else, redirect back to login page
     * 
     * @return Responses
     */
    public function auth()
    {
        $validate = Validator::make(Input::all(), array(
            'email' => 'required|email',
            'password' => 'required'
        ));
        
        if ($validate->fails()) {
            return Redirect::route('admin.login')->with('flash_errors', 'Maklumat yang dimasukkan tidak lengkap!');
        }
        
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
            return Redirect::route('admin.dashboard');
        }
                
        return Redirect::route('admin.login')->with('flash_errors', 'Maklumat yang dimasukkan tidak tepat!');
    }
    
    /**
     * Display the dashboard view
     * 
     * @return Responses
     */
    public function dashboard()
    {
        return View::make('admins.dashboard');
    }
    
    /**
     * Display the account details view
     * 
     * @return Responses
     */
    public function akaun()
    {
        return View::make('account.maklumat');
    }
    
    public function preview()
    {
        $markdown = new Markdown();
        return $markdown->defaultTransform(Input::get('markdown'));
    }
    
    /**
     * Save the modified user account and auto deauthorize the user from the system
     * 
     * @return Responses
     */
    public function ciptaAkaun()
    {
        $requiredChanges = false;
        $rules = array(
            'email' => 'required',
            'katalaluan' => 'min:6'
        );
        
        $validate = Validator::make( Input::all(), $rules, array(
            'min' => 'Panjang :attribute mestilah sekurang-kurangnya :min aksara'
        ));
        
        if($validate->fails())
            return Redirect::back()->withErrors($validate);
        
        $acc = User::find(Auth::user()->id);
        
        //We will clear this part later
        if(count($acc) == 0)
            return 'Error!';
        
        //If email was same as previous, then ignore it
        if($acc->email != Auth::user()->email) {
            $requiredChanges = true;
            $acc->email = Input::get('email');
        }
        
        //If the new password was not define, then ignore it
        if(strlen(Input::get('katalaluan')) > 0) {
            $requiredChanges = true;
            $acc->password = Hash::make(Input::get('katalaluan'));
        }
        
        //If any changes happen (according 2 condition above), then update the account details
        if($requiredChanges)
            $acc->save();
        
        //Deauthorize the user
        Auth::logout();
        
        return Redirect::route('admin.login');
    }
    
    /**
     * Deauthorize the user from the system
     * 
     * @return Responses
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::route('home');
    }
    
}