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
		$this->data['category_count'] = $this->m_common->get_count('category');
		$this->data['subcategory_count'] = $this->m_common->get_count('subcategory');
		$this->data['post_count'] = $this->m_common->get_count('post');
		$this->data['recent_posts'] = $this->m_common->get_recent_posts();

		$this->data['rebuild_json_url'] = $this->refer('rebuild_json');

		$this->view('main', $this->data);
	}

	public function rebuild_json() {
		ini_set('max_execution_time', 0);
		if(is_dir($this->json_path)) {
			$this->deleteDir($this->json_path);
		}
		mkdir($this->json_path);
		mkdir($this->post_path);
		$this->rebuild_categories();
	}

	public function rebuild_categories() {
		$category_count = $this->m_common->fetch_category(true);
		$category_page = 1;
		$category_total_page = $category_count / $this->page_size;
		if(is_float($category_total_page)) $category_total_page = floor($category_total_page) + 1;

		for($category_page = 1; $category_page <= $category_total_page; ++$category_page) {
			$categories = $this->m_common->fetch_category(false, ($category_page - 1) * $this->page_size, $this->page_size);

//			$this->tabular($categories);

			$file_name = $this->json_path
				. $this->category_file_prefix
				. $category_page
				. $this->json_extension;
			$this->writeJsonFile($file_name, $categories);

			foreach($categories as $category) {
				$this->rebuild_subcategories($category->category_id);
			}
		}
	}

	public function rebuild_subcategories($category_id) {
		$subcategory_count = $this->m_common->fetch_subcategory($category_id, true);
		$subcategory_page = 1;
		$subcategory_total_page = $subcategory_count / $this->page_size;
		if(is_float($subcategory_total_page)) $subcategory_total_page = floor($subcategory_total_page) + 1;

		for($subcategory_page = 1; $subcategory_page <= $subcategory_total_page; ++$subcategory_page) {
			$subcategories = $this->m_common->fetch_subcategory($category_id, false, ($subcategory_page - 1) * $this->page_size, $this->page_size);

//			$this->tabular($subcategories);

			$file_name = $this->json_path
				. $this->subcategory_file_prefix
				. $category_id
				. $this->page_middle_text
				. $subcategory_page
				. $this->json_extension;
			$this->writeJsonFile($file_name, $subcategories);

			foreach($subcategories as $subcategory) {
				$this->rebuild_posts($subcategory->subcategory_id);
			}
		}
	}

	public function rebuild_posts($subcategory_id) {
		$post_count = $this->m_common->fetch_post($subcategory_id, true);
		$post_page = 1;
		$post_total_page = $post_count / $this->page_size;
		if(is_float($post_total_page)) $post_total_page = floor($post_total_page) + 1;

		for($post_page = 1; $post_page <= $post_total_page; ++$post_page) {
			$posts = $this->m_common->fetch_post($subcategory_id, false, ($post_page - 1) * $this->page_size, $this->page_size);

//			$this->tabular($posts);

			foreach ($posts as $post) {
				$file_name = $this->post_path . $post->post_id . '.json';
				$this->writeJsonFile($file_name, $post);
				unset($post->post_content);
			}

			$file_name = $this->json_path
				. $this->post_file_prefix
				. $subcategory_id
				. $this->page_middle_text
				. $post_page
				. $this->json_extension;
			$this->writeJsonFile($file_name, $posts);
		}
	}

	public function test() {
		$this->update_timestamp_for_category(12);
	}
}
