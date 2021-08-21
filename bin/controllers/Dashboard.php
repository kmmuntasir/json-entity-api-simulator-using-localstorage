<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->data['controller'] .= $this->router->fetch_class();
	}

	public function index()
	{
		$data = $this->data;
		$data['page'] = 'dashboard';
		$data['page_title'] .= ucfirst($this->router->fetch_class());
		$this->view('main', $data);
	}
}
