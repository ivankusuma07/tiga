#!/usr/bin/env php
<?php

/**
 * Bootstrap $app 
 */


// Setting Container for apps
$app = new Tiga\Framework\App();	

$console = $app->getConsole();

$console->registerCommand(new Tiga\Framework\Console\ControllerCommand());    
$console->registerCommand(new Tiga\Framework\Console\ModelCommand());    

return $console;