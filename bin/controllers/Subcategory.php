<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->__initialize_controller($this->router->fetch_class());
	}

	public function index()
	{
		$this->data['categories'] = $this->model->get_all_category_names();

		$this->view('main', $this->data);
	}

	function source($is_deleted = 0)
	{
		$this->_dt_server_post_check();
		echo json_encode($this->model->dt_get_all_subcategories($is_deleted, $_POST));
	}

	function fetch()
	{
		echo json_encode($this->model->get_single_subcategory($_POST['subcategory_id']));
	}

	function add()
	{
		$upload_file_field_name = 'subcategory_icon';
		$upload_result = $this->__upload_file($upload_file_field_name);
		if($upload_result->status) {
			$_POST[$upload_file_field_name] = $upload_result->file_name;
		} else {
			exit($upload_result->error);
		}

		$_POST['timestamp'] = $this->now();
		$insert_id = $this->model->insert_single_subcategory($_POST);
		echo ($insert_id != 0) ? 'success' : 'Failed';
	}

	function update()
	{

		$old_subcategory = $this->model->get_single_subcategory($_POST[$this->data['entity_id_field_name']]);

		if(!$old_subcategory) {
			exit('Invalid ID');
		}

		$upload_file_field_name = 'subcategory_icon';

		$upload_result = null;

		if($_FILES[$upload_file_field_name]['error'] == 0) {
			$upload_result = $this->__upload_file($upload_file_field_name);
			if($upload_result->status) {
				$_POST[$upload_file_field_name] = $upload_result->file_name;
			} else {
				exit($upload_result->error);
			}
		}

		$stat = $this->model->update_single_subcategory($_POST['subcategory_id'], $_POST, $this->now);
		if($stat) {
			if($upload_result) {
				unlink($this->image_upload_path . $old_subcategory->$upload_file_field_name);
			}
			echo 'success';
		} else {
			if($upload_result) {
				unlink($this->image_upload_path . $upload_result->file_name);
			}
			echo 'Failed';
		}
	}

	function delete()
	{
		$stat = $this->model->delete_single_subcategory($_POST['subcategory_id']);
		echo ($stat) ? 'success' : 'Failed';
	}

	function restore()
	{
		$stat = $this->model->restore_single_subcategory($_POST['subcategory_id']);
		echo ($stat) ? 'success' : 'Failed';
	}
}
