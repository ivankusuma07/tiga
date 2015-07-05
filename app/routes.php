<?php


Routes::get("/tiga-framework",function(){
	return Response::content("Welcome to Tiga!");
})->end();