<?php

$app = new  Tiga\Framework\App();	

//Load service provider
include TIGA_BASE_PATH."app/config/service-provider.php";

// Load Whoops Only in Debug Mode
if(TIGA_DEBUG==true) {
	// @todo Load Whoops only in debug mode 
	$whoops = new Whoops\Run();
	$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
	 
	// Set Whoops as the default error and exception handler used by PHP:
	$whoops->register();  
}

Tiga\Framework\Facade\Facade::setFacadeContainer($app);

//Prepare the routes !
include TIGA_BASE_PATH."app/routes.php";