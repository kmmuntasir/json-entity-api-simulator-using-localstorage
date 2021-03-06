<?php

class M_common extends Ci_model
{
	function fetch($table, $id) {
		$this->db->where($table.'_id', $id);
		return $this->db->get($table)->row();
	}

	function get_count($table) {
		$this->db->where('is_deleted', 0);
		return $this->db->get($table)->num_rows();
	}

	function get_recent_posts($limit=5) {
		$this->db->select('post_image, post_title, timestamp');
		$this->db->where('is_deleted', 0);
		$this->db->order_by('post_id', 'desc');
		$this->db->limit($limit);
		return $this->db->get('post')->result();
	}

	function fetch_category($count_only=false, $offset=0, $limit=5, $until_id=null) {
		$columns = 'category_id, category_name, category_icon, timestamp';
		$this->db->select($columns);
		$this->db->where('is_deleted', 0);
		if($until_id) {
			$this->db->where('category_id <', $until_id);
		}
		$this->db->order_by('category_id', 'asc');
		if(!$count_only) $this->db->limit($limit, $offset);

		if($count_only) return $this->db->get('category')->num_rows();
		else return $this->db->get('category')->result();
	}

	function fetch_subcategory($category_id, $count_only=false, $offset=0, $limit=5, $until_id=null) {
		$columns = 'subcategory_id, subcategory_name, subcategory_icon, timestamp, category_id';
		$this->db->select($columns);
		$this->db->where('is_deleted', 0)->where('category_id', $category_id);
		if($until_id) {
			$this->db->where('subcategory_id <', $until_id);
		}
		$this->db->order_by('subcategory_id', 'asc');
		if(!$count_only) $this->db->limit($limit, $offset);

		if($count_only) return $this->db->get('subcategory')->num_rows();
		else return $this->db->get('subcategory')->result();
	}

	function fetch_post($subcategory_id, $count_only=false, $offset=0, $limit=5, $until_id=null, $with_content=true) {
		$columns = 'post_id, post_title, post_subtitle, post_image, timestamp, subcategory_id, category_id';
		if($with_content) $columns .= ', post_content';
		$this->db->select($columns);
		$this->db->where('is_deleted', 0)->where('subcategory_id', $subcategory_id);
		if($until_id) {
			$this->db->where('post_id <', $until_id);
		}
		$this->db->order_by('post_id', 'asc');
		if(!$count_only) $this->db->limit($limit, $offset);

		if($count_only) return $this->db->get('post')->num_rows();
		else return $this->db->get('post')->result();
	}
}

?>
