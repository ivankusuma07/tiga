<?php
namespace Lotus\Framework;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

Class Response extends SymfonyResponse{
	

	public __construct($content = '', $status = 200, $headers = array()) {

		return parent::__construct($content,$status,$headers);

	}

	public
}