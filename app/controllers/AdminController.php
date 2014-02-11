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
    
    public function akaun()
    {
        return View::make('account.maklumat');
    }
    
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
        if($acc->email != Auth::user()->email) {
            $requiredChanges = true;
            $acc->email = Input::get('email');
        }
        if(strlen(Input::get('katalaluan')) > 0) {
            $requiredChanges = true;
            $acc->password = Hash::make(Input::get('katalaluan'));
        }
        if($requiredChanges)
            $acc->save();
        
        Auth::logout();
        return Redirect::route('admin.login');
    }
    
    public function logout()
    {
        Auth::logout();
        return Redirect::route('home');
    }
    
}