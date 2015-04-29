<?php

Route::get('/halo/php/{kamu:@any}', function($kamu){
	
	View::make('eringga.php',array('name'=>$kamu));

});

Route::get('/halo/twig/{kamu:@any}', function($kamu){
	
	View::make('eringga.twig',array('name'=>$kamu));

});

Route::get('/{id:@num}/{name:@any}', 'HomeController@named');

Route::get('/db', 'TestController');

Route::get('/bench',function(){
	View::make('default.php');
});
