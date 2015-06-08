<?php

define('TIGA_BASE_PATH', dirname(__FILE__)."/../" );

require TIGA_BASE_PATH."vendor/autoload.php";

// Check if function exist

if(!function_exists('add_action'))
	require TIGA_BASE_PATH."../../../wp-includes/plugin.php";

// Add default route 
add_action('tiga_routes',function()
{
	include TIGA_BASE_PATH."app/routes.php";

});

// Add default config
add_filter('tiga_config',function($configs)
{
	$config = include TIGA_BASE_PATH."app/config/app.php";

	return array_merge_recursive($configs,$config);
});

do_action('tiga_plugin');

if(file_exists(TIGA_BASE_PATH."app/config/.env.php"))
	require TIGA_BASE_PATH."app/config/.env.php";
else
	require TIGA_BASE_PATH."app/config/.env-sample.php";

