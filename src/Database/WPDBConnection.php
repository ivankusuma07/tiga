<?php
namespace Lotus\Framework\Database;
use Lotus\Framework\Database\Contract\ConnectionInterface as ConnectionInterface;

class WPDBConnection implements ConnectionInterface {

	private $wpdb;

	private $resultType; 

	function __construct() {

		global $wpdb;

		$this->wpdb = $wpdb;

		$this->resultType = OBJECT;
		
	}

	function getRow($query) {
		
		return $this->wpdb->get_row($query,$this->resultType);
	}

	function getResult($query) {
		return $this->wpdb->get_results($query,$this->resultType);
	}

	function quote($string) {
		
		return "'".esc_sql($string)."'";;

	}

	function getPrefix() {
		
		return $this->wpdb->prefix;

	}

	function getInsertId() {
		return $this->wpdb->insert_id;
	}

	function setResultType($resultType) {
		$expected_type = array(ARRAY_A,ARRAY_N,OBJECT);

		if(!in_array($resultType, $expected_type)){
			$this->resultType = OBJECT;
		}

		$this->resultType  = $resultType;
	}

	function getRowsAffected() {
		return $this->wpdb->rows_affected;
	}

}