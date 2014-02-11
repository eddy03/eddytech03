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

//Any routes that required to be authenticate user
Route::group(array('before' => 'auth'), function() {
    
    //Logout the authenticate user
    Route::get('logout', array(
        'as' => 'admin.logout',
        'uses' => 'AdminController@logout'
    ));
    
    //Show user account details
    Route::get('akaun', array(
        'as' => 'admin.akaun',
        'uses' => 'AdminController@akaun'
    ));
    
    //Process the user account details for updating it
    Route::post('akaun', array(
        'as' => 'admin.akaun.cipta',
        'uses' => 'AdminController@ciptaAkaun'
    ));
    
    //Routes that required to be prefix with 'admin'
    Route::group(array('prefix' => 'admin'), function() {
        
        //Route that only available for SuperUser (eddy)
        Route::group(array('before' => 'isEddy'), function() {

            //Dashboard
            Route::get('dashboard', array(
                'as' => 'admin.dashboard',
                'uses' => 'AdminController@dashboard'
            ));
            
            //Article details
            Route::get('detail/{article}', array(
                'as' => 'admin.detailartikel',
                'uses' => 'MarkdownController@bacaArtikel'
            ));

            //Resourcefull controller to article
            Route::resource('article', 'ArticleController');
            
            //Routes that only avaiable for authenticate user, must be prefix by 'admin', superuser account and also must be call using AJAX
            Route::group(array('before', 'ajax'), function() {
                
                //Preview the articles
                Route::post('preview', array(
                    'as' => 'admin.preview',
                    'uses' => 'MarkdownController@preview'
                ));
            });
        });
    });
    
    //Routes that required to be prefix with 'ssh'
    Route::group(array('prefix' => 'ssh'), function() {
    
        //SSH dashboard
        Route::get('/', array(
            'as' => 'admin.ssh.dashboard',
            'uses' => 'SSHController@dashboard'
        ));

        //Routes that need to be authenticate user, mush be prefix with admin and call using AJAX
        Route::group(array('before' => 'ajax'), function() {
            
            //Execute the ssh command given
            Route::get('cmd', array(
                'as' => 'admin.ssh.cmd',
                'uses' => 'SSHController@cmd'
            ));
        });
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