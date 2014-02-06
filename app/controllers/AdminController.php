<?php

class AdminController extends \BaseController {
    
    public function login()
    {
        return View::make('admins.login');
    }
    
    public function auth()
    {
        $validate = Validator::make(Input::all(), array(
            'email' => 'required|email',
            'password' => 'required'
        ));
        
        if ($validate->fails())
            return Redirect::route('admin.login')->with('flash_errors', 'Maklumat yang dimasukkan tidak lengkap!');
        
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
            return Redirect::route('admin.dashboard');
        }
        
        return Redirect::route('admin.login')->with('flash_errors', 'Maklumat yang dimasukkan tidak tepat!');
    }
    
    public function dashboard()
    {
        return View::make('admins.dashboard');
    }
    
    public function logout()
    {
        Auth::logout();
        return Redirect::route('home');
    }
    
}