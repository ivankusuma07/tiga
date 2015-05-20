<?php 
namespace Tiga\Framework\Template;

include "h2o.php";

use Tiga\Framework\Facade\ApplicationFacade as App;

class Template 
{
	private $path;

	private $engine=false;

	function __construct($path) {
		// Base path location for H20 template
		$this->path = $path;		
	}

	private function initH2o() {

		// Do nothing if h2o engine is already iniziated
		if($this->engine)
			return;

		// Configure H20 cache folder
		$storage = TIGA_STORAGE;

		if(!file_exists($storage))
			throw new \Exception("Storage folder on {$storage} does not exist");

		if(!is_writable($storage))
		{
			if(!chmod($storage,0777))
				throw new \Exception("Storage folder on $storage is not writable");
		}

		// Create ready to use H20 Engine
		$this->engine = new \H2o(null, array(
		    'cache_dir' => $storage,
		    'searchpath' => $this->path
		));


	}

	private function renderH20($template,$parameter=array()) {

		$this->initH2o();

		//Final Path
		$finalPath = $this->path.$template;
		
		$this->engine->loadTemplate($finalPath);

		return $this->engine->render($parameter);
	}

	private function renderPhp($template,$parameter=array()) {
		//Final Path
		$finalPath = $this->path.$template;

		foreach ($parameter as $key => $value) {
			${$key} = $value;
		}

		include $finalPath;		
	}

	public function render($template,$parameter=array()) {



		if(stripos($template,".tpl"))
			return $this->renderH20($template,$parameter);
		
		return $this->renderPhp($template,$parameter);
	}


	// @todo : hook bagian lain dari page
	// add_action('pre_get_posts', array($this, 'edit_query'), 10, 1);
	// add_action('the_post', array($this, 'set_post_contents'), 10, 1);
	// add_filter('the_title', array($this, 'get_title'), 10, 2);
	// add_filter('single_post_title', array($this, 'get_single_post_title'), 10, 2);
	// add_filter('redirect_canonical', array($this, 'override_redirect'), 10, 2);
	// add_filter('get_post_metadata', array($this, 'set_post_meta'), 10, 4);
	// add_filter('post_type_link', array($this, 'override_permalink'), 10, 4);
	// if ( $this->template ) {
	//     add_filter('template_include', array($this, 'override_template'), 10, 1);
	// }


}