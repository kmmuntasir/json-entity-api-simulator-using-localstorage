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
		$data = $this->data;
		//Loading View
		$this->view('main', $data);
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
		$_POST['timestamp'] = $this->now();
		$insert_id = $this->model->insert_single_category($_POST);
		echo ($insert_id != 0) ? 'success' : 'Failed';
	}

	function update()
	{
		$_POST['timestamp'] = $this->now();
		$stat = $this->model->update_single_category($_POST['category_id'], $_POST);
		echo ($stat) ? 'success' : 'Failed';
	}

	function delete()
	{
		$stat = $this->model->delete_single_category($_POST['category_id']);
		echo ($stat) ? 'success' : 'Failed';
	}

	function restore()
	{
		$stat = $this->model->restore_single_category($_POST['category_id']);
		echo ($stat) ? 'success' : 'Failed';
	}
}
