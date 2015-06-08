<?php

class FormController {

	function index() {

		Template::setTitle('Form');

		$postModel = new PostModel();

		// $postModel->r1="radio 1";
		// $postModel->size="M";
		// $postModel->ck1=array('rahasia 0','rahasia 3');

		// var_dump(Flash::has('_old_input'));die();

		// var_dump(Request::oldInput());

		return Response::template('form/form.php',array('postModel'=>$postModel));
	}

	function process() {
			
		Request::flash();

		return Response::redirect(tiga_url('form'));
	}

	

}