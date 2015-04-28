<?php 
namespace Lotus\Framework;

use Lotus\Framework\Facade\ApplicationFacade as App;

class TwigLoader 
{

	public function getTwig($path){

		// Require twig autoload
		require_once LOTUS_BASE_PATH.'/vendor/twig/twig/lib/Twig/Autoloader.php';

		\Twig_Autoloader::register();

		$loader = new \Twig_Loader_Filesystem($path);

		// Configure twig cache folder
		$storage = LOTUS_STORAGE;

		if(!file_exists($storage))
			throw new \Exception("Storage folder on {$storage} does not exist");

		if(!is_writable($storage))
		{
			if(!chmod($storage,0777))
				throw new \Exception("Storage folder on $storage is not writable");
		}

		$twig = new \Twig_Environment($loader, array(
		    'cache' => $storage,
		    'debug' => LOTUS_DEBUG,
		    'auto_reload' => true
		));

		return $twig;
	}

}