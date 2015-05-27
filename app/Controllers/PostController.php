<?php
class PostController {
	
	public function __construct() 
	{
		$this->validatorRule = array(
		    'post_title' => 'required|min_len,10',
		    'post_content' => 'required|min_len,20'
		);
	}
 
	public function index($pageNum=0)
	{
		//Helper to set the page title
		Template::setTitle('All Posts');

		$postModel = new PostModel();
		

		Paginate::init(array(
				'per_page'=>4,
				'rows'=> $postModel->count(),
				'current_page'=>$pageNum,
				'base_url'=>tiga_url('/dashboard/posts/$paginate')
			));

		$posts = $postModel->getAll(Paginate::offsett());

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
				'post'=>$postModel,
				'errorMessage'=> new Tiga\Framework\MessageBag()
			);

		//Load the template file
		return Response::template("post/template.php",$data);

	}

	function create() 
	{
		Flash::clear();

		$postModel = new PostModel();

		$validator = Validator::validationRules($this->validatorRule);		

		$cleanData = $validator->run(Request::all());

		if($validator->hasError()){

			Template::setTitle('Edit Posts');

			Flash::set('type','alert-danger');
			Flash::set('message','Validation Error');

			$data = array(
				'template'=>'add.php',
				'post'=>$postModel,
				'errorMessage'=>$this->errorMessage($cleanData,$validator)
			);

			//Load the template file
			return Response::template("post/template.php",$data);
		}

		$cleanData['post_status'] = 'publish';

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

	function edit($id) 
	{

		$postModel = new PostModel();

		$postModel = $postModel->get($id);

		if(!$postModel) 
		{
			Flash::set('type','alert-danger');
			Flash::set('message','Post not found.');
			
			return Response::redirect(tiga_url('/dashboard/posts'));
		}

		Template::setTitle('Edit Posts');

		$data = array(
				'id'=>$id,
				'template'=>'edit.php',
				'post'=>$postModel,
				'errorMessage'=> new Tiga\Framework\MessageBag()
			);

		//Load the template file
		return Response::template("post/template.php",$data);

	}

	function update($id) 
	{
		Flash::clear();
		
		$postModel = new PostModel();

		$validator = Validator::validationRules($this->validatorRule);		

		$cleanData = $validator->run(Request::all());

		if($validator->hasError()){

			Template::setTitle('Edit Posts');

			Flash::set('type','alert-danger');
			Flash::set('message','Validation Error');			

			$data = array(
				'id',$id,
				'template'=>'edit.php',
				'post'=>$postModel,
				'errorMessage'=>$this->errorMessage($cleanData,$validator)
			);

			//Load the template file
			return Response::template("post/template.php",$data);
		}

		if($postModel->update($id,$cleanData))
		{

			Flash::set('type','alert-success');
			Flash::set('message','Post updated.');

			return Response::redirect(tiga_url('/dashboard/posts'));
		}
		
		Flash::set('type','alert-danger');
		Flash::set('message','Post update failed.');
		
		return Response::redirect(tiga_url('/dashboard/posts'));
	}

	function delete($id) 
	{

		$postModel = new PostModel();

		if($postModel->delete($id))
		{
			Flash::set('type','alert-success');
			Flash::set('message','Post deleted.');

			return Response::redirect(tiga_url('/dashboard/posts'));
		}

		Flash::set('type','alert-danger');
		Flash::set('message','Failed to delete post.');

		return Response::redirect(tiga_url('/dashboard/posts'));
	}
 

 	private function errorMessage($cleanData,$validator)
 	{
 		$message = new Tiga\Framework\MessageBag();

		foreach ($cleanData as $key => $value) {
		
			if($validator->hasError($key)) {
				
				$message[$key]->hasError =  'has-error';
				$errorMessage = '<div class="alert alert-danger" role="alert"><ul>';

				foreach ($validator->getError($key) as $error) {
					$errorMessage .= "<li>{$error}</li>";
				}

				$errorMessage .= '</ul></div>';
				$message[$key]->errorMessage = $errorMessage;

				continue;
			}

		}

 		return $message;
 	}
}