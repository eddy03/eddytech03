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
    //read the articles
    Route::get('artikel/{article}', array(
        'as' => 'artikel',
        'uses' => 'HomeController@bacaArtikel'
    ));
    //view the website changelog
    Route::get('changelog', array(
        'as' => 'changelog',
        'uses' => 'HomeController@showChangelog'
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

            //Resourcefull controller to article
            Route::resource('article', 'ArticleController');
            
            //Routes that only avaiable for authenticate user, must be prefix by 'admin', superuser account and also must be call using AJAX
            Route::group(array('before', 'ajax'), function() {
                
                //Preview the articles
                Route::post('preview', array(
                    'as' => 'admin.preview',
                    'uses' => 'AdminController@preview'
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
    
    //Register superadmin in the system
    Route::get('setup', function() {
        $usr = new User();
        //email address
        $usr->email = 'admin@admin.com';
        //passwords
        $usr->password = Hash::make('eddytech03');
        //level superadmin
        $usr->level = 1;
        $usr->save();

        File::makeDirectory(base_path() . DIRECTORY_SEPARATOR . 'markdown');
        
        return 'Semuanya telah siap. <a href="' . route('home') . '">Kembali</a>';
    });
});