<?php
class PostModel extends Tiga\Framework\Model {

	private $prefix;

	public function __construct() {

		global $wpdb;

		$this->prefix = $wpdb->prefix;
	}

	function getAll() {
		return DB::table("{$this->prefix}posts")->get();
	}

	function insert($post) {
		return wp_insert_post( $post );
	}

}