<?php

// Preparing mandatory instance
$Router = new Tiga\Framework\Router();
$Routes = new Tiga\Framework\Routes();

$app['router'] = $Router;
$app['routes'] = $Routes;
$app['app'] = $app;


// Preparing on demand instance
$app->share('request',function(){
	return Tiga\Framework\Request::createFromGlobals();
});

$app->share('view',function(){
	return new Tiga\Framework\View();
});

$app->share('template',function(){
	
	return new Tiga\Framework\Template\Template(TIGA_VIEW_PATH);
});

$app->share('responseFactory',function(){
	return new Tiga\Framework\Response\ResponseFactory();
});

$app->bind('db',function(){

	$connection = new Tiga\Framework\Database\WPDBConnection();

	$queryCompiler = new Tiga\Framework\Database\QueryCompiler($connection);

	return new Tiga\Framework\Database\QueryBuilder($queryCompiler,$connection);

});

$app->share('session',function(){

	$storage = new Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage(array(), new Tiga\Framework\Session\WPSessionHandler());
	$session = new Symfony\Component\HttpFoundation\Session\Session($storage);

	$session->start();

	return $session;
});

$app->share('flash',function(){

	return new Tiga\Framework\Session\Flash();
});

// Configure class alias for easy access
$alias = array();

$alias['Router'] = 'Tiga\Framework\Facade\RouterFacade';
$alias['Route'] = 'Tiga\Framework\Facade\RoutesFacade';
$alias['Request'] = 'Tiga\Framework\Facade\RequestFacade';
$alias['App'] = 'Tiga\Framework\Facade\ApplicationFacade';
$alias['View'] = 'Tiga\Framework\Facade\ViewFacade';
$alias['Template'] = 'Tiga\Framework\Facade\TemplateFacade';
$alias['Response'] = 'Tiga\Framework\Facade\ResponseFactoryFacade';
$alias['DB'] = 'Tiga\Framework\Facade\DatabaseFacade';
$alias['Session'] = 'Tiga\Framework\Facade\SessionFacade';
$alias['Flash'] = 'Tiga\Framework\Facade\FlashFacade';


// Facade the instance
$aliasMapper = Tonjoo\Almari\AliasMapper::getInstance();

//Register Facade class alias
$aliasMapper->facadeClassAlias($alias);