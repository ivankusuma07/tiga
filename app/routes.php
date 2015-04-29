<?php

Route::get('/halo/php/{kamu:@any}', function($kamu){
	
	View::make('eringga.php',array('name'=>$kamu));

});

Route::get('/halo/h20/{kamu:@any}', function($kamu){
	
	View::make('eringga.tpl',array('name'=>$kamu));

});

Route::get('/{id:@num}/{name:@any}', 'HomeController@named');

Route::get('/db', 'TestController');

Route::get('/bench',function(){
	View::make('default.php');
});
