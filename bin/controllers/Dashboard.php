<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->__initialize_controller($this->router->fetch_class());
	}

	public function index()
	{
		$this->data['category_count'] = $this->model->get_count('category');
		$this->data['subcategory_count'] = $this->model->get_count('subcategory');
		$this->data['post_count'] = $this->model->get_count('post');
		$this->data['recent_posts'] = $this->model->get_recent_posts();

		$this->data['rebuild_json_url'] = $this->refer('rebuild_json');

		$this->view('main', $this->data);
	}

	public function rebuild_json() {
		$this->rebuild_categories();



		// Initialize category_page_1.json file

		// Fetch Categories by limit
			// Fetch Subcategories by limit
				// Fetch Posts by limit
	}

	public function rebuild_categories() {
		ini_set('max_execution_time', 0);
		$this->deleteDir($this->json_path);
		mkdir($this->json_path);
		mkdir($this->post_path);
		$category_count = $this->model->fetch_category(true);
		$category_page = 1;
		$category_total_page = $category_count / $this->page_size;
		if(is_float($category_total_page)) $category_total_page = floor($category_total_page) + 1;

		for($category_page = 1; $category_page <= $category_total_page; ++$category_page) {
			$categories = $this->model->fetch_category(false, ($category_page - 1) * $this->page_size, $this->page_size);

//			$this->tabular($categories);

			$file_name = $this->json_path . 'category_page_' . $category_page . '.json';
			$this->writeJsonFile($file_name, $categories);

			foreach($categories as $category) {
				$this->rebuild_subcategories($category->category_id);
			}
		}
	}

	public function rebuild_subcategories($category_id) {
		$subcategory_count = $this->model->fetch_subcategory($category_id, true);
		$subcategory_page = 1;
		$subcategory_total_page = $subcategory_count / $this->page_size;
		if(is_float($subcategory_total_page)) $subcategory_total_page = floor($subcategory_total_page) + 1;

		for($subcategory_page = 1; $subcategory_page <= $subcategory_total_page; ++$subcategory_page) {
			$subcategories = $this->model->fetch_subcategory($category_id, false, ($subcategory_page - 1) * $this->page_size, $this->page_size);

//			$this->tabular($subcategories);

			$file_name = $this->json_path . 'subcategory_by_category_'.$category_id.'_page_' . $subcategory_page . '.json';
			$this->writeJsonFile($file_name, $subcategories);

			foreach($subcategories as $subcategory) {
				$this->rebuild_posts($subcategory->subcategory_id);
			}
		}
	}

	public function rebuild_posts($subcategory_id) {
		$post_count = $this->model->fetch_post($subcategory_id, true);
		$post_page = 1;
		$post_total_page = $post_count / $this->page_size;
		if(is_float($post_total_page)) $post_total_page = floor($post_total_page) + 1;

		for($post_page = 1; $post_page <= $post_total_page; ++$post_page) {
			$posts = $this->model->fetch_post($subcategory_id, false, ($post_page - 1) * $this->page_size, $this->page_size);

//			$this->tabular($posts);

			$file_name = $this->json_path . 'post_by_subcategory_'.$subcategory_id.'_page_' . $post_page . '.json';
			$this->writeJsonFile($file_name, $posts);

			$posts = $this->model->fetch_post($subcategory_id, false, ($post_page - 1) * $this->page_size, $this->page_size, true);
			foreach ($posts as $post) {
				$file_name = $this->post_path . $post->post_id . '.json';
				$this->writeJsonFile($file_name, $post);
			}
		}
	}
}
