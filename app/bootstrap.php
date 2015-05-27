<?php

define('TIGA_BASE_PATH', dirname(__FILE__)."/../" );

require TIGA_BASE_PATH."vendor/autoload.php";
require TIGA_BASE_PATH."vendor/tonjoo/tiga/src/Helper.php";

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

if(file_exists(TIGA_BASE_PATH."app/config/.env.php"))
	require TIGA_BASE_PATH."app/config/.env.php";
else
	require TIGA_BASE_PATH."app/config/.env-sample.php";

// Load Tiga Plugin
do_action('tiga_plugin');

// Setting Container for apps
$app = new Tiga\Framework\App();	

// Setup tiga version
$app['version'] = '0.1';

return $app;