<?php

namespace Lotus\Framework\Database\Contract;

interface ConnectionInterface {

	function getRow($query); 

	function getResult($query);

	function quote($query);

	function getPrefix();

	function getInsertId();

	function getRowsAffected();
	
}