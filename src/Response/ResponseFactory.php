<?php

namespace Lotus\Framework\Response;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\RedirectResponse as RedirectResponse;
use Lotus\Framework\Facade\TemplateFacade as Template;

class ResponseFactory {

	public function make($content,$status,$headers) {
	
		return new Response($content,$status,$headers);	
	}

	public function template($template,$parameter=array(),$status=200,$headers=array()) {

		$content = Template::render($template,$parameter);

		return new Response($content,$status,$headers);

	}

	public function json($data,$status=200,$headers=array()) {

		$jsonHeader = array('Content-Type' =>'application/json');

		$content = json_encode($data);

		$response =  new RedirectResponse($content,200,$jsonHeader);

		$response->send();

		die();
	}

	public function redirect($url,$status=302,$headers=array()) {

		$response =  new RedirectResponse($url,$status,$headers);

		$response->send();

		die();
	}

	public function download($file,$status=200,$headers=array()) {

		require_once ABSPATH."wp-admin/includes/file.php";

		WP_Filesystem();

   		global $wp_filesystem;

    	$fileData = $wp_filesystem->get_contents( $file );

		$downloadHeader["Content-Description"]= "File Transfer";
    	$downloadHeader["Content-Type"]= "application/octet-stream";
    	$downloadHeader["Content-Disposition"]= "attachment; filename=".basename($file);
    	$downloadHeader["Content-Transfer-Encoding"]= "binary";
    	$downloadHeader["Expires"]= "0";
    	$downloadHeader["Cache-Control"]= "must-revalidate";
    	$downloadHeader["Pragma"]= "public";
    	$downloadHeader["Content-Length"]= filesize($file);

		$response =  new Response($file_data,200,$downloadHeader);

		$response->send();

		die();
	}

}