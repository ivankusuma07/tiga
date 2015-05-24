<?php
class PostController {
	
	public function __construct() 
	{
		
	}
 
	public function index()
	{
		//Helper to set the page title
		Template::setTitle('All Posts');

		$postModel = new PostModel();
		$posts = $postModel->getAll();

		$data = array(
				'template'=>'index.php',
				'posts'=>$posts
			);

		//Load the template file
		return Response::template("post/template.php",$data);
	}

	function add() 
	{
		
		Template::setTitle('Add Posts');

		$postModel = new PostModel();

		$data = array(
				'template'=>'add.php',
				'post'=>$postModel
			);

		//Load the template file
		return Response::template("post/template.php",$data);

	}

	function create() 
	{
		Flash::clear();
		
		$postModel = new PostModel();
		$validatorRule = array(
		    'post_title' => 'required|min_len,10',
		    'post_content' => 'required|min_len,20'
		);

		$validator = Validator::validationRules($validatorRule);

		$cleanData = $validator->run(Request::all());

		if($validator->hasError()){

			
			Flash::set('type','alert-danger');
			Flash::set('message','Validation Error');

			$data = array(
				'template'=>'add.php',
				'post'=>$postModel
			);

			//Load the template file
			return Response::template("post/template.php",$data);
		}

		if($postModel->insert($cleanData))
		{

			Flash::set('type','alert-success');
			Flash::set('message','New post created.');

			return Response::redirect(tiga_url('/dashboard/posts'));
		}
		
		Flash::set('type','alert-danger');
		Flash::set('message','Post creation failed.');
		
		return Response::redirect(tiga_url('/dashboard/posts'));
	}

	function edit($id) {

		var_dump($id);

	}

	function update() {

	}

	function delete() {

	}
 
}