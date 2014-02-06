<?php

class AdminController extends \BaseController {
    
    public function login()
    {
        return View::make('admins.login');
    }
    
    public function auth()
    {
        return Input::all();
    }
    
}