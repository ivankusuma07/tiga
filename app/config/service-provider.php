<?php

// Preparing Routes and Router instance
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
	

	$config['path'] = TIGA_VIEW_PATH;
	$config['storage'] = TIGA_STORAGE;


	return new Tiga\Framework\Template\Template($config);
});

$app->share('responseFactory',function(){
	return new Tiga\Framework\Response\ResponseFactory();
});

$app->bind('db',function(){

	$connection = new Tiga\Framework\Database\WPDBConnection();

	$queryCompiler = new Tiga\Framework\Database\QueryCompiler($connection);

	return new Tiga\Framework\Database\QueryBuilder($queryCompiler,$connection);

});

// Validation
$app->bind('validator',function(){

	return new Tiga\Framework\Validator();

});

// Initializing Session
$storage = new Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage(array(), new Tiga\Framework\Session\WPSessionHandler());
$session = new Symfony\Component\HttpFoundation\Session\Session($storage);
$session->start();

$app['session'] = $session;

$flash = new Tiga\Framework\Session\Flash();
$app['flash'] = $session;

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
$alias['Validator'] = 'Tiga\Framework\Facade\ValidatorFacade';


// Facade the instance
$aliasMapper = Tonjoo\Almari\AliasMapper::getInstance();

//Register Facade class alias
$aliasMapper->facadeClassAlias($alias);