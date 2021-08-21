<?php

class M_subcategory extends Ci_model
{

	function get_all_category_names() {
		$this->db->select('category_id, category_name');
		return $this->db->where('is_deleted', 0)->get('category')->result();
	}

	function dt_get_all_subcategories($is_deleted = 0, $postdata = NULL)
	{
		if ($postdata) {
			$select = "subcategory_id, subcategory_name, subcategory_icon, category_name, subcategory.timestamp, subcategory_id as cat_id";
			$columns = array(
				'subcategory_id',
				'subcategory_name',
				'subcategory_icon',
				'category_name',
				'subcategory.timestamp',
				'subcategory_id'
			);
			return $this->_dt($this, 'dt_get_all_subcategories', $postdata, $columns, 'subcategory', $select, $is_deleted);
		} else {
			$this->db->where('subcategory.is_deleted', $is_deleted);
			$this->db->join('category', 'category.category_id = subcategory.category_id', 'left');
		}
	}

	function get_single_subcategory($subcategory_id)
	{
		return $this->db->where('subcategory_id', $subcategory_id)->get('subcategory')->row();
	}

	function delete_single_subcategory($subcategory_id)
	{
		$updated_subcategory['timestamp'] = $this->now();
		$updated_subcategory['is_deleted'] = 1;
		return $this->update_single_subcategory($subcategory_id, $updated_subcategory);
	}

	function update_single_subcategory($subcategory_id, $subcategory)
	{
		$this->db->trans_start();
		$this->db->where('subcategory_id', $subcategory_id)->update('subcategory', $subcategory);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function restore_single_subcategory($subcategory_id)
	{
		$updated_subcategory['timestamp'] = $this->now();
		$updated_subcategory['is_deleted'] = 0;
		return $this->update_single_subcategory($subcategory_id, $updated_subcategory);
	}

	function insert_single_subcategory($subcategory)
	{
		$this->db->trans_start();
		$this->db->insert('subcategory', $subcategory);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

}

?>
