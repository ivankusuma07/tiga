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

	$app = require __DIR__."/app/bootstrap.php";

	$app->routerInit();

}

