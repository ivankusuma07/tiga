<?php
class WelcomeController {

	function index()
	{
		return Response::template('Welcome.php');
	}

}