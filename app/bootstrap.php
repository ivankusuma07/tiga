<?php
define( 'TIGA_BASE_PATH', dirname(__FILE__)."/../" );

require TIGA_BASE_PATH."vendor/autoload.php";

require TIGA_BASE_PATH."src/Helper.php";

if(file_exists(TIGA_BASE_PATH.'app/config/app.php'))
	require TIGA_BASE_PATH."app/config/app.php";
else
	require TIGA_BASE_PATH."app/config/app-sample.php";

$app = new Tiga\Framework\App();	

Tiga\Framework\Facade\Facade::setFacadeContainer($app);

$app['version'] = '0.1';

//Load service provider
include TIGA_BASE_PATH."app/config/service-provider.php";



//Prepare the routes !
include TIGA_BASE_PATH."app/routes.php";

return $app;