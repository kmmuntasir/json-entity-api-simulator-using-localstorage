<?php

class M_category extends Ci_model
{

	function dt_get_all_categories($is_deleted = 0, $postdata = NULL)
	{
		if ($postdata) {
			$select = "category_id, category_name, category_icon, timestamp, category_id as cat_id";
			$columns = array(
				'category_id',
				'category_name',
				'category_icon',
				'timestamp',
				'category_id'
			);
			return $this->_dt($this, 'dt_get_all_categories', $postdata, $columns, 'category', $select, $is_deleted);
		} else {
			$this->db->where('category.is_deleted', $is_deleted);
		}
	}

	function get_single_category($category_id)
	{
		return $this->db->where('category_id', $category_id)->get('category')->row();
	}

	function delete_single_category($category_id)
	{
		$updated_category['timestamp'] = $this->now();
		$updated_category['is_deleted'] = 1;
		return $this->update_single_category($category_id, $updated_category);
	}

	function update_single_category($category_id, $category)
	{
		$this->db->trans_start();
		$this->db->where('category_id', $category_id)->update('category', $category);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function restore_single_category($category_id)
	{
		$updated_category['timestamp'] = $this->now();
		$updated_category['is_deleted'] = 0;
		return $this->update_single_category($category_id, $updated_category);
	}

	function insert_single_category($category)
	{
		$this->db->trans_start();
		$this->db->insert('category', $category);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

}

?>
