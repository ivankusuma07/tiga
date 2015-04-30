<?php

Route::get('/halo/php/{kamu:@any}', function($kamu){
	
	View::render('eringga.php',array('name'=>$kamu));

});

Route::get('/halo/h2o/{kamu:@any}', function($kamu){


	View::render('page.tpl',array(
    'users' => array(
        array(
            'username' =>           'peter',
            'tasks' => array('school', 'writing'),
            'user_id' =>            1,
        ),
        array(
            'username' =>           'anton',
            'tasks' => array('go shopping'),
            'user_id' =>            2,
        ),
        array(
            'username' =>           'john doe',
            'tasks' => array('write report', 'call tony', 'meeting with arron'),
            'user_id' =>            3
        ),
        array(
            'username' =>           'foobar',
            'tasks' => array(),
            'user_id' =>            4
        )
    )
));

});

Route::get('/{id:@num}/{name:@any}', 'HomeController@named');

Route::get('/db', 'TestController');

Route::get('/bench',function(){
	View::render('default.php');
});

Route::get('/haris',function(){
    echo "haris";
});