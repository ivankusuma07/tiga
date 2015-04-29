<?php

$app = new  Lotus\Framework\App();	

// Preparing on demand instance
$app->share('request',function(){
	return Symfony\Component\HttpFoundation\Request::createFromGlobals();
});

$app->share('view',function(){
	return new Lotus\Framework\View();
});

$app->share('template',function(){
	return new Lotus\Framework\Template\Template();
});

// Preparing mandatory instance
$Router = new Lotus\Framework\Router();
$Routes = new Lotus\Framework\Routes();

$app['router'] = $Router;
$app['routes'] = $Routes;
$app['app'] = $app;

// Facade the instance
$aliasMapper = Lotus\Almari\AliasMapper::getInstance();

$alias['Router'] = 'Lotus\Framework\Facade\RouterFacade';
$alias['Route'] = 'Lotus\Framework\Facade\RoutesFacade';
$alias['Request'] = 'Lotus\Framework\Facade\RequestFacade';
$alias['App'] = 'Lotus\Framework\Facade\ApplicationFacade';
$alias['View'] = 'Lotus\Framework\Facade\ViewFacade';
$alias['Template'] = 'Lotus\Framework\Facade\TemplateFacade';

// @todo Load Whoops only in debug mode 
if(LOTUS_DEBUG==true) {
	// Load Whoops!
}

Lotus\Framework\Facade\Facade::setFacadeContainer($app);

//Register Facade class alias
$aliasMapper->facadeClassAlias($alias);

//Prepare the routes !
include LOTUS_BASE_PATH."/app/routes.php";