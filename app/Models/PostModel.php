<?php
class PostModel extends Tiga\Framework\Model {

	private $prefix;

	public function __construct() {

		global $wpdb;

		$this->prefix = $wpdb->prefix;
	}

	function get($id) 
	{
		return DB::table("{$this->prefix}posts")
				->where('ID',"=",$id)
				->row();
	}

	function getAll($offset=0) {
		return DB::table("{$this->prefix}posts")
				->where('post_type',"=",'post')
				->offset($offset)
				->limit(4)
				->get();
	}

	function count() {
		return DB::table("{$this->prefix}posts")
				->where('post_type',"=",'post')
				->count();
	}

	function insert($post) {
		return wp_insert_post( $post );
	}

	function delete($id) {
		return DB::table("{$this->prefix}posts")
				->where('ID',"=",$id)
				->delete();
	}

	function update($id,$data) {
		return DB::table("{$this->prefix}posts")
				->where('ID',"=",$id)
				->update($data);
	}

}