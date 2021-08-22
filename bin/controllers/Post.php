<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->__initialize_controller($this->router->fetch_class());
	}

	public function index()
	{
		$this->data['subcategories'] = $this->model->get_all_subcategory_names();

		$this->view('main', $this->data);
	}

	function source($is_deleted = 0)
	{
		$this->_dt_server_post_check();
		echo json_encode($this->model->dt_get_all_posts($is_deleted, $_POST));
	}

	function fetch()
	{
		echo json_encode($this->model->get_single_post($_POST['post_id']));
	}

	function add()
	{
		$upload_file_field_name = 'post_image';
		$upload_result = $this->__upload_file($upload_file_field_name);
		if($upload_result->status) {
			$_POST[$upload_file_field_name] = $upload_result->file_name;
		} else {
			exit($upload_result->error);
		}

		$_POST['timestamp'] = $this->now();
		$insert_id = $this->model->insert_single_post($_POST);
		echo ($insert_id != 0) ? 'success' : 'Failed';
	}

	function update()
	{

		$old_post = $this->model->get_single_post($_POST[$this->data['entity_id_field_name']]);

		if(!$old_post) {
			exit('Invalid ID');
		}

		$upload_file_field_name = 'post_image';

		$upload_result = null;

		if($_FILES[$upload_file_field_name]['error'] == 0) {
			$upload_result = $this->__upload_file($upload_file_field_name);
			if($upload_result->status) {
				$_POST[$upload_file_field_name] = $upload_result->file_name;
			} else {
				exit($upload_result->error);
			}
		}

		$stat = $this->model->update_single_post($_POST['post_id'], $_POST, $this->now);
		if($stat) {
			if($upload_result) {
				unlink($this->image_upload_path . $old_post->$upload_file_field_name);
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
		$stat = $this->model->delete_single_post($_POST['post_id']);
		echo ($stat) ? 'success' : 'Failed';
	}

	function restore()
	{
		$stat = $this->model->restore_single_post($_POST['post_id']);
		echo ($stat) ? 'success' : 'Failed';
	}
}
