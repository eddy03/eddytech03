<?php
/*
|--------------------------------------------------------------------------
| eddytech03.com routes structure definition and mapping
|--------------------------------------------------------------------------
*/


//Public user route definition
Route::group(array(), function() {
    //Landing route
    Route::get('/', array(
        'as' => 'home',
        'uses' => 'HomeController@showHomePage'
    ));
    //about me route
    Route::get('tentang', array(
        'as' => 'about',
        'uses' => 'HomeController@showAboutMe'
    ));
    //portfolio route
    Route::get('projek', array(
        'as' => 'project',
        'uses' => 'HomeController@showProjectList'
    ));
    Route::get('artikel/{article}', array(
        'as' => 'artikel',
        'uses' => 'HomeController@bacaArtikel'
    ));
});

//Administrator route authentication routes
Route::group(array('before' => 'check'), function() {
    //Administrator login route
    Route::get('admin', array(
        'as' => 'admin.login',
        'uses' => 'AdminController@login'
    ));
    //Validate administrator login route
    Route::post('auth', array(
        'as' => 'admin.auth',
        'uses' => 'AdminController@auth'
    ));
});

//Authenticate administrator routes
Route::group(array('before' => 'auth', 'prefix' => 'admin'), function() {
    
    //Logout
    Route::get('logout', array(
        'as' => 'admin.logout',
        'uses' => 'AdminController@logout'
    ));
    
    Route::group(array('before' => 'isEddy'), function() {
        
        //Dashboard
        Route::get('dashboard', array(
            'as' => 'admin.dashboard',
            'uses' => 'AdminController@dashboard'
        ));

        Route::post('preview', array(
            'as' => 'admin.preview',
            'uses' => 'MarkdownController@preview'
        ));

        Route::get('detail/{article}', array(
            'as' => 'admin.detailartikel',
            'uses' => 'MarkdownController@bacaArtikel'
        ));

        Route::resource('article', 'ArticleController');
    });
});

Route::group(array('before' => 'auth', 'prefix' => 'ssh'), function() {
    
    Route::get('/', array(
        'as' => 'admin.ssh.dashboard',
        'uses' => 'SSHController@dashboard'
    ));
    
    Route::group(array('before' => 'ajax'), function() {
        
        Route::get('cmd', array(
            'as' => 'admin.ssh.cmd',
            'uses' => 'SSHController@cmd'
        ));
    });
});

////////////////////////////////////////
//Test or development route
////////////////////////////////////////
Route::group(array(), function() {
    Route::get('saveuser', function() {
        $usr = new User();

        $usr->email = 'eddytech03@gmail.com';
        $usr->password = Hash::make('eddy03');
        $usr->level = 1;
        $usr->save();

    });
    
    Route::get('savevespa', function() {
        $usr = new User();

        $usr->email = 'azwanICT@gmail.com';
        $usr->password = Hash::make('vespa123');
        $usr->level = 2;
        $usr->save();

    });
    
    Route::get('testpath', function() {
        return base_path();
    });
});