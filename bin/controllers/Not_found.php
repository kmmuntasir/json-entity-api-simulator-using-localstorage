<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Not_found extends Admin_Controller
{

	function __construct()
	{
		parent::__construct(false, false);
		$this->data['controller'] .= $this->router->fetch_class();
	}

	public function index()
	{
		$data = $this->data;
		$data['page'] = 'not_found';
		$data['page_title'] .= "Not Found";

		//Loading View
		$this->view('main', $data);
	}
}
