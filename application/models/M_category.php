<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_category extends CI_Model {

	var $table 	= 'Category';
	var $column = array('Category.CategoryID','Category.Name','Category.SeoImage','Category.SeoText','Category.Remark','Category.Active'); //set column field database for order and search
	var $order 	= array('CategoryID' => 'desc'); // default order 
	var $host;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->host = base_url();
	}
	private function _get_datatables_query()
	{
		$url = $this->uri->segment(1);
		$this->db->select("
			Category.CategoryID,
			Category.Icon,
			Category.Name,
			Category.SeoImage,
			Category.SeoText,
			Category.Remark,
			Category.Active,
		");
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column as $item):
			if($_POST['search']['value']):
				if($i===0):
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				else:
					$this->db->or_like($item, $_POST['search']['value']);
				endif;
				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			endif;
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		endforeach;
		if(isset($_POST['order'])):
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']); 
		elseif(isset($this->order)):
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		endif;
	}
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($this->input->post("length") != -1)
		$this->db->limit($this->input->post("length"), $this->input->post("start"));
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function save($data)
	{
		$this->db->set("UserAdd",$this->session->Name);
		$this->db->set("DateAdd",date("Y-m-d H:i:s"));
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function update($where, $data)
	{
		$this->db->set("UserCh",$this->session->Name);
		$this->db->set("DateCh",date("Y-m-d H:i:s"));
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function get_by_id($id){
		$this->db->select("
			Category.CategoryID,
			Category.Name,
			Category.SeoImage,
			Category.SeoText,
			Category.Remark,
			Category.Active,
			Category.Icon,
			Category.Link,
		");
		$this->db->where("CategoryID", $id);
		$query = $this->db->get($this->table);

		return $query->row();
	}
}