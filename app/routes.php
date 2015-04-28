<?php

Route::get('/halo/{kamu:@any}', function($kamu){
	echo "hai $kamu";
});

Route::get('/{id:@num}/{name:@any}', 'HomeController@named');