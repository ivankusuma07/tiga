<?php
/*
Plugin Name: Lotus Framework
Plugin URI: https://github.com/tonjoo/lotus-framework
Description: WordPress Faux MVC
Author: todiadiyatmo
Author URI: http://todiadiyatmo.com/
Version: 0.9
*/

add_action('init','lotus_bootstrap');

function lotus_bootstrap() {

	define( 'LOTUS_BASE_PATH', dirname(__FILE__) );
	define( 'LOTUS_BUFFER_CALLBACK','lotus_ob_end' );
	
	require "vendor/autoload.php";

	
	require "app/config/app.php";
	require "app/bootstrap.php";

	Router::init();

}

