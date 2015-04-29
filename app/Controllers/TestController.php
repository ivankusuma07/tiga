<?php
use Aura\SqlQuery\QueryFactory;

class TestController {

	function index() {

		$query_factory = new QueryFactory('mysql');

		$select = $query_factory->newSelect();
		$insert = $query_factory->newInsert();
		$update = $query_factory->newUpdate();
		$delete = $query_factory->newDelete();

		$select->cols(array('foo', 'bar AS barbar'))
       ->from('table1')
       ->from('table2')
       ->where('table2.zim = 99');

       echo $select->__toString();

	}

	
}