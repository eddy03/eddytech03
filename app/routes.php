<?php
Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@showHomePage'
));

Route::get('tentang', array(
    'as' => 'about',
    'uses' => 'HomeController@showAboutMe'
));

Route::get('projek', array(
    'as' => 'project',
    'uses' => 'HomeController@showProjectList'
));
Route::group(array(), function() {
    
    Route::get('admin', array(
        'as' => 'admin.login',
        'uses' => 'AdminController@login'
    ));
    
    Route::post('auth', array(
        'as' => 'admin.auth',
        'uses' => 'AdminController@auth'
    ));
});