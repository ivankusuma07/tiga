<?php
/*
Plugin Name: Tiga
Plugin URI: http://tiga.io
Description: WordPress Faux MVC
Author: todiadiyatmo
Author URI: http://todiadiyatmo.com/
Version: 0.9
*/

add_action('init','tiga_bootstrap');

function tiga_bootstrap() {

	define( 'TIGA_BASE_PATH', dirname(__FILE__)."/" );
	define( 'TIGA_BUFFER_CALLBACK','tiga_ob_end' );
	
	require "vendor/autoload.php";

	require "src/Helper.php";

	if(file_exists(TIGA_BASE_PATH.'app/config/app.php'))
		require "app/config/app.php";
	else
		require "app/config/app-sample.php";

	require "app/bootstrap.php";

	Router::init();

}

