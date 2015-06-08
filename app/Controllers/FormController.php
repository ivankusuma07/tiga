<?php

class FormController {

	function index() {
		Template::setTitle('Form');

		$postModel = new PostModel();

		// $postModel->r1="radio 1";
		// $postModel->size="M";
		// $postModel->ck1=array('rahasia 0','rahasia 3');

		return Response::template('form/form.php',array('postModel'=>$postModel));
	}

	function process() {
		
		do_action('tiga_check_token');

		echo "Form Testing Old Input";

		return Response::redirect(tiga_url('form'));
	}

	

}