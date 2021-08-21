<?php

class M_post extends Ci_model
{

	function get_all_subcategory_names() {
		$this->db->select('subcategory_id, subcategory_name');
		return $this->db->where('is_deleted', 0)->get('subcategory')->result();
	}

	function dt_get_all_posts($is_deleted = 0, $postdata = NULL)
	{
		if ($postdata) {
			$select = "post_id, post_title, post_image, subcategory_name, post.timestamp, post_id as cat_id";
			$columns = array(
				'post_id',
				'post_title',
				'post_image',
				'subcategory_name',
				'post.timestamp',
				'post_id'
			);
			return $this->_dt($this, 'dt_get_all_posts', $postdata, $columns, 'post', $select, $is_deleted);
		} else {
			$this->db->where('post.is_deleted', $is_deleted);
			$this->db->join('subcategory', 'subcategory.subcategory_id = post.subcategory_id', 'left');
		}
	}

	function get_single_post($post_id)
	{
		return $this->db->where('post_id', $post_id)->get('post')->row();
	}

	function delete_single_post($post_id)
	{
		$updated_post['timestamp'] = $this->now();
		$updated_post['is_deleted'] = 1;
		return $this->update_single_post($post_id, $updated_post);
	}

	function update_single_post($post_id, $post)
	{
		$this->db->trans_start();
		$this->db->where('post_id', $post_id)->update('post', $post);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function restore_single_post($post_id)
	{
		$updated_post['timestamp'] = $this->now();
		$updated_post['is_deleted'] = 0;
		return $this->update_single_post($post_id, $updated_post);
	}

	function insert_single_post($post)
	{
		$this->db->trans_start();
		$this->db->insert('post', $post);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

}

?>
