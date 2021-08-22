<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ST_Controller extends CI_Controller
{
	public $json_path;
	public $post_path;
	public $page_size;
	public $json_extension = '.json';
	public $category_file_prefix = 'category_page_';
	public $subcategory_file_prefix = 'subcategory_by_category_';
	public $post_file_prefix = 'post_by_subcategory_';
	public $page_middle_text = '_page_';

	public $data = array();
	public $viewpath = '';
	public $image_upload_path = 'images/';

	public function __construct()
	{
		parent::__construct();

		$this->page_size = 5;
		$this->json_path = 'jsons/';
		$this->post_path = $this->json_path . 'posts/';

		// Setting Timezone
		date_default_timezone_set("Asia/Dhaka");

		$this->viewpath = $this->template . '/';
		$this->data['fullpath'] = base_url() . VIEW_DIR . '/' . $this->template . '/';
		$this->data['controller'] = site_url('/');
	}

	public function __required($arr, $fieldlist)
	{
		/*
			__required() is a custom function that checks if the provided array (param1) has all the fields in it (param2)
			It is used to check whether a post request has the required fields
			Param1 = An array which is to be checked
			Param2 = A comma separated string containing the field list
		*/

		$field_array = explode(',', $fieldlist);
		foreach ($field_array as $key => $field) {
			$field = trim($field);
			if (!(isset($arr[$field]) && !empty($arr[$field]))) return false;
		}
		return true;
	}

	public function __do_upload($field, $config, $rename = false)
	{
		/*
			__do_upload() is a custom function to avoid the problem of loading the same library multiple times in the same CI controller and keep the code clean. It uses the same $config array format of CI upload library. $field is the name of the input field of the desired file upload form. 
		*/
		$result = array();

		if ($rename) {
			// Generating a unique name using current microtime
			$file_name = substr(md5(microtime(true) . $_FILES[$field]['name']), 1, 12);
			// Extracting the filename extension from the original filename
			$ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
			$file_name .= '.' . $ext;
		} else $file_name = $_FILES[$field]['name'];

		$config['file_name'] = $file_name;

		$this->load->library('upload');

		$this->upload->initialize($config);

		if (!$this->upload->do_upload($field)) {
			$result['error'] = $this->upload->display_errors();
			return $result;
		} else {
			$result['error'] = false;
			$result['success'] = $this->upload->data();
			return $result;
		}
	}

	public function __upload_file($field) {
		$response = new stdClass();
		$response->status = false;
		$response->error = 'File Upload Error<br>';
		$response->file_name = NULL;


		if(count($_FILES) > 0) {

			// Configuration for Image File Upload
			$config['upload_path']          = $this->image_upload_path;
			$config['allowed_types']        = 'jpg|jpeg|png|gif';
			$config['max_size']             = 1024; // 1 Megabytes

			// Uploading File
			if($_FILES[$field]['error'] == 0) {
				$upload = $this->__do_upload($field, $config, true);

				if(!$upload['error']) {
					$response->status = true;
					$response->file_name = $upload['success']['file_name'];
				}
				else {
					$response->error .= $upload['error'];
				}
			}
		} else {
			$response->error .= 'No Image File Found';
		}

		return $response;
	}

	public function _dt_server_post_check($postdata = NULL)
	{
		if (!$postdata) $postdata = $_POST;
		if (!isset($postdata['draw'])) exit('Bad Post Format');
	}

	public function __new_id($table_name, $table_id_fieldname)
	{
		$count = 0;
		$new_id = "";
		do {
			$new_id = $this->__unique_code(8, '0123456789ABCDEFGHJ0123456789KLMNOPQRST0123456789UVWXYZ');
			$this->db->where($table_id_fieldname, $new_id);
			$count = $this->db->count_all_results($table_name);
		} while ($count > 0);
		return $new_id;
	}

	/**
	 * Generate a random string, using a cryptographically secure
	 * pseudorandom number generator (random_int)
	 *
	 * For PHP 7, random_int is a PHP core function
	 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
	 *
	 * @param int $length How many characters do we want?
	 * @param string $keyspace A string of all possible characters
	 *                         to select from
	 * @return string
	 */
	public function __unique_code($length = 8, $keyspace = '0123456789@#$%&abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[random_int(0, $max)];
		}
		return $str;
	}

	public function dump($data, $exit_flag = false)
	{ // for debug purpose
		highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
		if ($exit_flag) exit();
	}

	public function redirect_msg($url, $msg = '', $type = "success", $number = 0)
	{
		/**
		 * This function redirects the client with single/multiple flash message(s)
		 **/
		if ($number == 0) $this->session->set_flashdata(array('msg' => array(0 => array($msg, $type)), 'number' => 1));
		else $this->session->set_flashdata(array('msg' => $msg, 'number' => $number));
		redirect($url);
	}

	public function my_curl($url, $post_index, $data)
	{
		$field_data = $post_index . '=' . json_encode($data);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $field_data);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		return curl_exec($ch);
	}

	public function my_file_get_contents($url, $post_index, $data)
	{
		$data = array("$post_index" => json_encode($data));
		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
			)
		);

		$context = stream_context_create($options);
		return file_get_contents($url, false, $context);
	}

	public function __mail($from, $to, $subject, $message, $cc = NULL, $bcc = NULL)
	{
		$this->load->library('email');

		$this->email->from($from, 'ISP Admin');
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($message);

		if ($cc) $this->email->cc($cc);
		if ($bcc) $this->email->bcc($bcc);

		$this->email->send();
	}

	public function tabular($arr, $exit_flag = false, $display = true, $style = true, $attr = 'cellspacing="0" cellpadding="3" style="background-color: #fff; font-size: 10px; font-family: monaco, consolas"')
	{
		/**
		 * Prints out a two dimensional array in a pretty table for easy debugging purpose
		 **/
		// if(!$style) $attr = '';
		$table = '';
		$css = '';
		if (is_array($arr) || is_object($arr)) {
			$first_row_flag = true;
			$css .= '<style type="text/css">' . "\n";
			$css .= 'tbody > tr > td {border: none; border-right: solid 1px #999;}' . "\n";
			$css .= 'td:first-child {border-left: solid 1px #999;}' . "\n";
			$css .= 'thead > tr {background-color: #fff; color:#000;}' . "\n";
			$css .= 'thead > tr > th {border: solid 1px #999;}' . "\n";
			$css .= 'tr:last-child > td {border-bottom: solid 1px #999;}' . "\n";
			$css .= 'tr {vertical-align: top;}' . "\n";
			$css .= 'table {margin: 10 0; border-collapse: collapse;}' . "\n";
			// $css .= 'th {position: sticky; position: -webkit-sticky; top: 0; z-index: 10;}'."\n";
			$css .= '</style>' . "\n";
			$table .= "<table $attr>";
			$color_flag = true;
			foreach ($arr as $k => $row) {
				if ($first_row_flag) {
					if (is_array($row) || is_object($row)) {
						$table .= '<thead><tr>';
						foreach ($row as $key => $val) {
							$table .= '<th>' . $key . '</th>';
						}
						$table .= '</tr></thead><tbody>';
						$first_row_flag = false;
					} else $table .= '<td>' . $this->printer($row, false, true) . '</td>';
				}

				if (is_array($row) || is_object($row)) {
					$color = '';
					if ($color_flag && $style) $color = 'style="background-color: #eee;"';
					$color_flag = !$color_flag;
					$table .= "<tr $color>";
					foreach ($row as $key => $val) {
						// $table .= '<td>'.$val.'</td>';
						$table .= '<td>';
						// if(is_array($val) || is_object($val)) {
						$table .= $this->printer($val, false, true);
						// }
						$table .= '</td>';
					}
					$table .= '</tr>';
				} else $table .= '<td>' . $this->printer($row, false, true) . '</td>';
			}
			$table .= "</tbody></table>";
		} else $table .= $this->printer($arr, false, true);

		if ($display) {
			if ($style) echo $css;
			echo $table;
		} else return $table;

		if ($exit_flag) exit();
	}

	public function printer($arr, $exit_flag = false, $return_flag = false)
	{ // for debug purpose
		$text = '';
		$text .= '<pre>';
		$text .= print_r($arr, true);
		$text .= '</pre>';

		// $text = nl2br($text);

		if ($return_flag) return $text;
		else echo $text;

		if ($exit_flag) exit();
	}

	public function swap(&$x, &$y)
	{
		$temp = $x;
		$x = $y;
		$y = $temp;
	}

	public function isDate($date)
	{
		$dt = explode("-", $date);
		if (count($dt) == 3) {
			$y = $dt[0] * 1;
			$m = $dt[1] * 1;
			$d = $dt[2] * 1;
			return checkdate($m, $d, $y);
		} else return false;
	}

	public function to_datatable_json_format($data, $json_output = false, $datetimeformat = false, $test_multiplier = 1)
	{
		$json_data = array('data' => array());
		$i = 0;

		for ($m = 0; $m < $test_multiplier; ++$m) {
			foreach ($data as $key => $row) {
				$json_data['data'][$i] = array();
				foreach ($row as $cell_key => $cell) {
					if ($datetimeformat) {
						if ($this->isDateTime($cell)) { // Checking if the value is a date/datetime
							$cell = date('M d, Y h:i a', strtotime($cell));
						}
					}
					array_push($json_data['data'][$i], $cell);
				}
				++$i;
			}
		}
		if ($json_output) return json_encode($json_data);
		else return $json_data;
	}

	public function isDateTime($datetime)
	{
		$parts = explode(" ", $datetime);
		if (count($parts) == 2) {
			$dt = explode("-", $parts[0]);
			if (count($dt) == 3) {
				$y = $dt[0] * 1;
				$m = $dt[1] * 1;
				$d = $dt[2] * 1;
				if (checkdate($m, $d, $y) && $this->isTime($parts[1])) return true;
				else return false;
			} else return false;
		} else return false;
	}

	public function isTime($time)
	{
		$parts = explode(':', $time);
		$h = $parts[0];
		$m = $parts[1];
		$s = $parts[2];

		if (($h >= 0 && $h <= 23) && ($m >= 0 && $m <= 59) && ($s >= 0 && $s <= 59)) return true;
		else return false;
	}

	public function now($dateonly = false, $timeonly = false)
	{
		if ($dateonly) return date('Y-m-d');
		elseif ($timeonly) return date('H:i:s');
		else return date('Y-m-d H:i:s');
	}

	public function fetch_cookie($cookie_name = NULL)
	{
		if ($cookie_name == NULL) return NULL;
		if (!isset($_COOKIE[$cookie_name])) return NULL;
		return $_COOKIE[$cookie_name];
	}

	public function destroy_cookie($cookie_name = NULL)
	{
		if ($cookie_name == NULL) return NULL;
		if (!isset($_COOKIE[$cookie_name])) return NULL;

		$cookie = array(
			'name' => $cookie_name,
			'value' => '',
			'expire' => time() - 3600
		);
		return $this->create_cookie($cookie);
	}

	public function create_cookie($cookie = NULL)
	{
		if ($cookie == NULL) return NULL;
		extract($cookie);
		return setcookie($name, $value, $expire);
	}

	public function view($viewfile, $data = NULL, $return_view = false)
	{
		if (strpos($viewfile, '/') === false) $viewfile = 'v_' . $viewfile;
		$this->load->view($this->viewpath . $viewfile, $data, $return_view);
	}

	public function refer($method_referrer = NULL)
	{
		if (!$method_referrer) return "";
		return $this->data['controller'] . '/' . $method_referrer;
	}

	public function writeJsonFile($filePath, $content) {
		$file = fopen($filePath, "w") or die("Unable to open file!");
		$json = json_encode($content, JSON_PRETTY_PRINT);
		fwrite($file, $json);
		fclose($file);
	}

	public function readJsonFile($filePath) {
		$file = fopen($filePath, "r") or die("Unable to open file!");
		$json = fread($file, filesize($filePath));
		$content = json_decode($json);
		fclose($file);
		return $content;
	}

	public function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				$this->deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}

}


// ============================== Admin Controller =============================== //

class Admin_Controller extends ST_Controller
{

	public $template = 'stockyno';  // Current Template Name
	public $model = NULL;

	function __construct()
	{
		parent::__construct();
		$this->load->model("m_common");
	}

	function __initialize_controller($controller, $load_models = true)
	{
		if ($load_models) $this->load->model("m_$controller", 'model');

		$this->data['page'] = $controller;
		$this->data['page_title'] = 'Json Simulator | ' . ucfirst($controller);
		$this->data['controller'] .= $controller;
		$this->data['entity_id_field_name'] = $controller . '_id';

		// Ajax URL data
		$this->data['data_source'] = $this->refer('source/0');
		$this->data['add_action'] = $this->refer('add');
		$this->data['update_action'] = $this->refer('update');
		$this->data['delete_action'] = $this->refer('delete');
		$this->data['restore_action'] = $this->refer('restore');
		$this->data['fetch_action'] = $this->refer('fetch');
	}

	function update_timestamp_for_category($category_id) {
		$category = $this->m_common->fetch('category', $category_id);
		unset($category->is_deleted);

		$category_serial = $this->m_common->fetch_category(true, 0, 0, $category->category_id) + 1;
		$category_page = $category_serial / $this->page_size;
		if(is_float($category_page)) $category_page = floor($category_page) + 1;
		$category_total_page = $this->m_common->fetch_category(true) / $this->page_size;
		if(is_float($category_total_page)) $category_total_page = floor($category_total_page) + 1;

		$ranged_categories = $this->m_common->fetch_category(false, ($category_page - 1) * $this->page_size, $this->page_size, NULL);

//		$this->tabular($ranged_categories);

		$content = new stdClass();
		$content->hasNextPage = $category_page < $category_total_page;
		$content->data = $ranged_categories;

		$file_name = $this->json_path
			. $this->category_file_prefix
			. $category_page
			. $this->json_extension;
//		$this->printer($file_name);
		$this->writeJsonFile($file_name, $content);
	}

	function update_timestamp_for_subcategory($subcategory_id) {
		$subcategory = $this->m_common->fetch('subcategory', $subcategory_id);
		unset($subcategory->is_deleted);

		$subcategory_serial = $this->m_common->fetch_subcategory($subcategory->category_id, true, 0, 0, $subcategory->subcategory_id) + 1;
		$subcategory_page = $subcategory_serial / $this->page_size;
		if(is_float($subcategory_page)) $subcategory_page = floor($subcategory_page) + 1;
		$subcategory_total_page = $this->m_common->fetch_subcategory($subcategory->category_id, true) / $this->page_size;
		if(is_float($subcategory_total_page)) $subcategory_total_page = floor($subcategory_total_page) + 1;

		$ranged_subcategories = $this->m_common->fetch_subcategory($subcategory->category_id, false, ($subcategory_page - 1) * $this->page_size, $this->page_size, NULL);

//		$this->tabular($ranged_subcategories);

		$content = new stdClass();
		$content->hasNextPage = $subcategory_page < $subcategory_total_page;
		$content->data = $ranged_subcategories;

		$file_name = $this->json_path
			. $this->subcategory_file_prefix
			. $subcategory->category_id
			. $this->page_middle_text
			. $subcategory_page
			. $this->json_extension;
//		$this->printer($file_name);
		$this->writeJsonFile($file_name, $content);

		$this->update_timestamp_for_category($subcategory->category_id);
	}

	function update_timestamp_for_post($post_id) {
		$post = $this->m_common->fetch('post', $post_id);
		unset($post->is_deleted);

		$post_file = $this->post_path . $post->post_id . '.json';
		$this->writeJsonFile($post_file, $post);
		unset($post->post_content);

		$post_serial = $this->m_common->fetch_post($post->subcategory_id, true, 0, 0, $post->post_id) + 1;
		$post_page = $post_serial / $this->page_size;
		if(is_float($post_page)) $post_page = floor($post_page) + 1;
		$post_total_page = $this->m_common->fetch_post($post->subcategory_id, true) / $this->page_size;
		if(is_float($post_total_page)) $post_total_page = floor($post_total_page) + 1;

		$ranged_posts = $this->m_common->fetch_post($post->subcategory_id, false, ($post_page - 1) * $this->page_size, $this->page_size, NULL, false);

//		$this->tabular($ranged_posts);

		$content = new stdClass();
		$content->hasNextPage = $post_page < $post_total_page;
		$content->data = $ranged_posts;

		$file_name = $this->json_path
			. $this->post_file_prefix
			. $post->subcategory_id
			. $this->page_middle_text
			. $post_page
			. $this->json_extension;
//		$this->printer($file_name);
		$this->writeJsonFile($file_name, $content);

		$this->update_timestamp_for_subcategory($post->subcategory_id);
	}

}


?>
