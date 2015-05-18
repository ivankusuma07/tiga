<?php

namespace Lotus\Framework\Session;

use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Lotus\Framework\Session\WPSessionHandler;

class Session {

	function __construct() {

		$storage = new NativeSessionStorage(array(), new WPSessionHandler());
		$session = new SymfonySession($storage);

	}
}