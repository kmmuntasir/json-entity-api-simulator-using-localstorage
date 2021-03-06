<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->__initialize_controller($this->router->fetch_class());
	}

	public function index()
	{
		$this->view('main', $this->data);
	}

	function source($is_deleted = 0)
	{
		$this->_dt_server_post_check();
		echo json_encode($this->model->dt_get_all_categories($is_deleted, $_POST));
	}

	function fetch()
	{
		echo json_encode($this->model->get_single_category($_POST['category_id']));
	}

	function add()
	{
		$upload_file_field_name = 'category_icon';
		$upload_result = $this->__upload_file($upload_file_field_name);
		if($upload_result->status) {
			$_POST[$upload_file_field_name] = $upload_result->file_name;
		} else {
			exit($upload_result->error);
		}

		$_POST['timestamp'] = $this->now();
		$insert_id = $this->model->insert_single_category($_POST);
		if($insert_id != 0) {
			echo 'success';
			$this->update_timestamp_for_category($insert_id);
		} else {
			echo 'Failed';
		}
	}

	function update()
	{

		$old_category = $this->model->get_single_category($_POST[$this->data['entity_id_field_name']]);

		if(!$old_category) {
			exit('Invalid ID');
		}

		$upload_file_field_name = 'category_icon';

		$upload_result = null;

		if($_FILES[$upload_file_field_name]['error'] == 0) {
			$upload_result = $this->__upload_file($upload_file_field_name);
			if($upload_result->status) {
				$_POST[$upload_file_field_name] = $upload_result->file_name;
			} else {
				exit($upload_result->error);
			}
		}

		$_POST['timestamp'] = $this->now();
		$stat = $this->model->update_single_category($_POST['category_id'], $_POST);
		if($stat) {
			if($upload_result) {
				unlink($this->image_upload_path . $old_category->$upload_file_field_name);
			}
			echo 'success';
			$this->update_timestamp_for_category($_POST['category_id']);
		} else {
			if($upload_result) {
				unlink($this->image_upload_path . $upload_result->file_name);
			}
			echo 'Failed';
		}
	}

	function delete()
	{
		$stat = $this->model->delete_single_category($_POST['category_id']);
		if($stat) {
			echo 'success';
			$this->update_timestamp_for_category($_POST['category_id']);
		} else {
			echo 'Failed';
		}
	}

	function restore()
	{
		$stat = $this->model->restore_single_category($_POST['category_id']);
		if($stat) {
			echo 'success';
			$this->update_timestamp_for_category($_POST['category_id']);
		} else {
			echo 'Failed';
		}
	}
}
