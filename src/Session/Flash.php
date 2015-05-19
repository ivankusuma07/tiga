<?php

namespace Lotus\Framework\Session;
use Lotus\Framework\Facade\SessionFacade as Session;

class Flash {

	function add($key,$value) {
		return Session::getFlashBag()->add($key,$value);
	}

	function set($key,$value) {
		return Session::getFlashBag()->set($key,$value);
	}

	function get($key,$defaultValue = array()) {
		return Session::getFlashBag()->get($key,$defaultValue);
	}

	function setAll($attributes) {
		return Session::getFlashBag()->setAll($attributes);
	}

	function all() {
		return Session::getFlashBag()->all();
	}

	function has($key) {
		return Session::getFlashBag()->has($key);
	}

	function peek($key,$defaultValue = array()) {
		return Session::getFlashBag()->peek($key,$defaultValue);
	}

	function peekAll() {
		return Session::getFlashBag()->peekAll();
	}

	function keys() {
		return Session::getFlashBag()->keys();
	}

}