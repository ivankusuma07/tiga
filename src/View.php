<?php

namespace Lotus\Framework;
use Lotus\Framework\Facade\ViewFacade as View;


class View {
	
	protected $run = false;

	function make()	{
		
		if(!$this->run){
			$this->run=true;
			$this->hookWPTemplate();	
		}
		


	}

	function hookWPTemplate() {
		add_filter('template_include', array(View, 'override_template'), 10, 1);
	}

}