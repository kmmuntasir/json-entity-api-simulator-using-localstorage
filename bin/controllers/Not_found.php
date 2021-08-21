<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Not_found extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->__initialize_controller('not_found', false);
	}

	public function index()
	{
		$this->view('main', $this->data);
	}
}
