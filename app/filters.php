<?php

App::before(function($request)
{
});


App::after(function($request, $response)
{
});

/*
|--------------------------------------------------------------------------
| eddytech03.com filter definition
|--------------------------------------------------------------------------
*/

//Authenticate rules
Route::filter('auth', function() {
    if(Auth::guest())
        return Redirect::route('home');
});

//Check if user is authenticate, then redirect back to the dashboard. (prevent seeing login page after login)
Route::filter('check', function() {
    if(!Auth::guest())
        return Redirect::route('admin.dashboard');
});

//Check if user was superadmin. if not, then redirect to SSH dashboard
Route::filter('isEddy', function() {
    if(Auth::user()->level != 1)
        return Redirect::route('admin.ssh.dashboard');
});

//Check the route must be call using AJAX
Route::filter('ajax', function() {
    if (!Request::ajax()) {
        return Redirect::route('admin.ssh.dashboard');
    }
});


/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
*/

Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});