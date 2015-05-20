<?php

namespace Tiga\Framework;
use Tiga\Framework\Facade\TemplateFacade as Template;


class View {
	
	protected $buffer;

	protected $title;


	function __construct() {
	
		add_filter('template_include', array($this,'overrideTemplate'),10,1);	
	
	}

	function hookTitle( $title,$sep ) {

		return $this->title;;
		
	}
	
	function setTitle($title) {

		$this->title = $title;

		add_filter( 'wp_title', array($this,'hookTitle'), 10, 2 );
	}

	function setBuffer($buffer) {
		$this->buffer = $buffer;
	}

	function getBuffer() {
		
		return $this->buffer;
	}

	public function overrideTemplate() {

		//Disable rewrite, lighter access for LF

		global $wp_rewrite;

		$wp_rewrite->rules = array();

		return TIGA_BASE_PATH.'/src/ViewGenerator.php';
	}
}

