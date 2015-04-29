<?php

namespace Lotus\Framework;
use Lotus\Framework\Facade\TemplateFacade as Template;


class View {
	
	protected $run;

	protected $viewQueues;

	protected $buffer;


	function __construct() {
		
		// Initilize template system
		Template::init(LOTUS_VIEW_PATH);

		add_filter('template_include', array($this,'overrideTemplate'),10,1);	
	}

	function setBuffer($buffer) {
		$this->buffer = $buffer;
	}

	function getBuffer() {
		
		return $this->buffer;
	}
	
	function make($template,$parameter=array())	{

		// $viewQueue = new ViewQueue($template,$parameter);

		// if(!$this->run) {
		// 	// add to array;
		// 	array_push($this->viewQueues,$viewQueue);	
		// }
		// else{
		// echo Template::render($viewQueue->getTemplate(),$viewQueue->getParameter());
		// }
		
		echo Template::render($template,$parameter);
				
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

	function overrideTemplate() {
		return LOTUS_BASE_PATH.'/src/ViewGenerator.php';
	}
}