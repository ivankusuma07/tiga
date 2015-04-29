<?php 
namespace Lotus\Framework\Template;

include "h2o.php";

use Lotus\Framework\Facade\ApplicationFacade as App;

class Template 
{
	private $path;

	private $engine=false;

	function init($path) {
		// Base path location for H20 template
		$this->path = $path;		
	}

	function initH2o() {

		// Do nothing if h2o engine is already iniziated
		if($this->engine)
			return;



		// Configure H20 cache folder
		$storage = LOTUS_STORAGE;

		if(!file_exists($storage))
			throw new \Exception("Storage folder on {$storage} does not exist");

		if(!is_writable($storage))
		{
			if(!chmod($storage,0777))
				throw new \Exception("Storage folder on $storage is not writable");
		}

		// Create ready to use H20 Engine
		$this->engine = new \H2o(null, array(
		    'cache_dir' => LOTUS_STORAGE
		));


	}

	public function renderH20($template,$parameter) {

		$this->initH2o();

		//Final Path
		$finalPath = $this->path."/".$template;

		$this->engine->loadTemplate($finalPath);


		return $this->engine->render($parameter);
	}

	public function renderPhp($template,$parameter) {
		//Final Path
		$finalPath = $this->path."/".$template;

		foreach ($parameter as $key => $value) {
			${$key} = $value;
		}

		include $finalPath;		
	}

	public function render($template,$parameter) {
		if(stripos($template,".tpl"))

			return $this->renderH20($template,$parameter);

		else{

			return $this->renderPhp($template,$parameter);

		}
	}


}