<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link    https://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Libraries
 * @author        EllisLab Dev Team
 * @link        https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model
{

	/**
	 * Class constructor
	 *
	 * @link    https://github.com/bcit-ci/CodeIgniter/issues/5332
	 * @return    void
	 */
	public function __construct()
	{
	}

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param string $key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}

	public function now($dateonly = false, $timeonly = false)
	{
		if ($dateonly) return date('Y-m-d');
		elseif ($timeonly) return date('H:i:s');
		else return date('Y-m-d H:i:s');
	}

	public function _dt($instance, $builder, $postData, $columns, $table, $select, $params = NULL, $datetime_formatter = NULL)
	{
		// Generating Result Data
		$this->db->select($select);
		$this->_build_dt_query($postData, $columns, true);
		$instance->$builder($params);
		$query_result = $this->db->get($table);
		if($this->db->error()['code'] != 0) {
			$this->printer($this->db->error()['message'], true);
		}
		$result = $this->to_datatable_json_format($query_result->result(), $datetime_formatter);

		// Counting Total Items
		$instance->$builder($params);
		$recordsTotal = $this->db->count_all_results($table);

		// Counting Filtered Items
		$this->_build_dt_query($postData, $columns);
		$instance->$builder($params);
		$recordsFiltered = $this->db->count_all_results($table);

		return array(           // Returning the output
			"draw" => $postData['draw'],
			"recordsTotal" => $recordsTotal,
			"recordsFiltered" => $recordsFiltered,
			"data" => $result,
		);
	}

	public function _build_dt_query($postData, $columns, $limit_flag = false)
	{
		$bracket_flag = false;
		if ($postData['search']['value']) { // loop searchable columns if datatable sends POST for search
			$postData['search']['value'] = trim($postData['search']['value']);
			$search_items = explode(" ", $postData['search']['value']);
			foreach ($search_items as $key => $search_item) {
				foreach ($columns as $item) {
					if (!$bracket_flag) { // first loop
						$bracket_flag = true; // open bracket
						$this->db->group_start()->like($item, $search_item);
					} else $this->db->or_like($item, $search_item);
				}
				if ($bracket_flag) {
					$this->db->group_end(); // close bracket
					$bracket_flag = false;  // reset bracket for another like query
				}
			}
		}

		foreach ($postData['columns'] as $key => $col)
			if ($col['search']['value']) $this->db->like($columns[$key], $col['search']['value']);
		if (isset($postData['order']))
			$this->db->order_by($columns[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		else $this->db->order_by($columns[0], 'asc');
		if ($limit_flag && $postData['length'] != -1)
			$this->db->limit($postData['length'], $postData['start']);
	}

	public function to_datatable_json_format($data, $datetime_formatter = NULL)
	{
		$json_data = array();
		$i = 0;
		foreach ($data as $key => $row) {
			$json_data[$i] = array();
			foreach ($row as $cell_key => $cell) {
				if ($datetime_formatter != NULL) {
					if ($this->isDateTime($cell)) { // Checking if the value is a datetime
						$cell = date($datetime_formatter, strtotime($cell));
					} else if ($this->isDate($cell)) { // Checking if the value is a date
						$cell = date($datetime_formatter, strtotime($cell));
					}
				}
				array_push($json_data[$i], $cell);
			}
			++$i;
		}
		return $json_data;
	}

	public function isDateTime($datetime)
	{
		$parts = explode(" ", $datetime);
		if (count($parts) == 2) return ($this->isDate($parts[0]) && $this->isTime($parts[1])) ? true : false;
		else return false;
	}

//=============== Datatable Server Side Scripting Functions ========================================

	public function isDate($date)
	{
		$dt = explode("-", $date);
		return (count($dt) == 3) ? checkdate((int)$dt[1], (int)$dt[2], (int)$dt[0]) : false;
	}

	/*
	 * Perform the SQL queries needed for an server-side processing requested
	 * @param $postData     post data sent from datatables, usually $_POST
	 * @param $columns      DB table columns in search order
	 * @param $limit_flag   Indicates whether this function should apply limit
	 */

	public function isTime($time)
	{
		$parts = explode(':', $time);
		$h = $parts[0];
		$m = $parts[1];
		$s = $parts[2];

		if (($h >= 0 && $h <= 23) && ($m >= 0 && $m <= 59) && ($s >= 0 && $s <= 59)) return true;
		else return false;
	}

	/*
	 * Performs the necessary tasks to prepare the result and counts
	 * according to dt_query and builder rules.
	 * @param $instance the instance of the model class which this function
	 *                  was called from (usually '$this')
	 * @param $builder  the model method which should build the query
	 * @param $postData post data sent from datatables, usually $_POST
	 * @param $columns  DB table columns in search order
	 * @param $table    the DB table used for this query
	 * @param $select   the fields of the table(s) as string, comma separated
	 * @param $params   params for the builder class (when necessary)
	 */

	public function _dbError()
	{
		$this->printer($this->db->error()['message']);
	}

	/************** Custom Methods *****************/

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

}
