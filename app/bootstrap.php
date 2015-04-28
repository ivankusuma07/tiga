<?php

$app = new  Lotus\Framework\App();	

$Router = new Lotus\Framework\Router();
$Routes = new Lotus\Framework\Routes();
$TwigLoader = new Lotus\Framework\TwigLoader();
$app->share('twig',function(){
	return Symfony\Component\HttpFoundation\Request::createFromGlobals();
})

// Or using array access
$app['router'] = $Router;
$app['routes'] = $Routes;
$app['request'] = $Request;
$app['app'] = $app;

// Facading $foo to FooFacade
$aliasMapper = Lotus\Almari\AliasMapper::getInstance();

$alias['Router'] = 'Lotus\Framework\Facade\RouterFacade';
$alias['Route'] = 'Lotus\Framework\Facade\RoutesFacade';
$alias['Request'] = 'Lotus\Framework\Facade\RequestFacade';
$alias['Twig'] = 'Lotus\Framework\Facade\TwigFacade';
$alias['App'] = 'Lotus\Framework\Facade\AppFacade';

Lotus\Framework\Facade\Facade::setFacadeContainer($app);

//Register container to facade
$aliasMapper->facadeClassAlias($alias);

//Prepare the routes !
include LOTUS_BASE_PATH."/app/routes.php";