<?php

// Preparing mandatory instance
$Router = new Lotus\Framework\Router();
$Routes = new Lotus\Framework\Routes();

$app['router'] = $Router;
$app['routes'] = $Routes;
$app['app'] = $app;


// Preparing on demand instance
$app->share('request',function(){
	return Lotus\Framework\Request::createFromGlobals();
});

$app->share('view',function(){
	return new Lotus\Framework\View();
});

$app->share('template',function(){
	
	return new Lotus\Framework\Template\Template(LOTUS_VIEW_PATH);
});

$app->share('responseFactory',function(){
	return new Lotus\Framework\Response\ResponseFactory();
});

$app->bind('db',function(){

	$connection = new Lotus\Framework\Database\WPDBConnection();

	$queryCompiler = new Lotus\Framework\Database\QueryCompiler($connection);

	return new Lotus\Framework\Database\QueryBuilder($queryCompiler,$connection);

});

$app->share('session',function(){

	$storage = new Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage(array(), new Lotus\Framework\Session\WPSessionHandler());
	$session = new Symfony\Component\HttpFoundation\Session\Session($storage);

	$session->start();

	return $session;
});

$app->share('flash',function(){

	return new Lotus\Framework\Session\Flash();
});

// Configure class alias for easy access
$alias = array();

$alias['Router'] = 'Lotus\Framework\Facade\RouterFacade';
$alias['Route'] = 'Lotus\Framework\Facade\RoutesFacade';
$alias['Request'] = 'Lotus\Framework\Facade\RequestFacade';
$alias['App'] = 'Lotus\Framework\Facade\ApplicationFacade';
$alias['View'] = 'Lotus\Framework\Facade\ViewFacade';
$alias['Template'] = 'Lotus\Framework\Facade\TemplateFacade';
$alias['Response'] = 'Lotus\Framework\Facade\ResponseFactoryFacade';
$alias['DB'] = 'Lotus\Framework\Facade\DatabaseFacade';
$alias['Session'] = 'Lotus\Framework\Facade\SessionFacade';
$alias['Flash'] = 'Lotus\Framework\Facade\FlashFacade';


// Facade the instance
$aliasMapper = Lotus\Almari\AliasMapper::getInstance();

//Register Facade class alias
$aliasMapper->facadeClassAlias($alias);