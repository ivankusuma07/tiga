<?php

$app = new  Lotus\Framework\App();	

//Load service provider
include LOTUS_BASE_PATH."app/config/service-provider.php";

// Load Whoops Only in Debug Mode
if(LOTUS_DEBUG==true) {
	// @todo Load Whoops only in debug mode 
	$whoops = new Whoops\Run();
	$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
	 
	// Set Whoops as the default error and exception handler used by PHP:
	$whoops->register();  
}

Lotus\Framework\Facade\Facade::setFacadeContainer($app);

//Prepare the routes !
include LOTUS_BASE_PATH."app/routes.php";