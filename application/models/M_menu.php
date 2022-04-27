<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu extends CI_Model {
	var $table = 'UT_Menu';
	var $column = array("UT_Menu.MenuID","UT_Menu.Name","UT_Menu.Modul","UT_Menu.Type","UT_Menu.ParentID","UT_Menu.Url","UT_Menu.Root","UT_Menu.Category"); //set column field database for order and search
	var $order = array('UT_Menu.MenuID' => 'desc'); // default order 
	public function __construct()
	{
		parent::__construct();
	}
	private function _get_datatables_query()
	{
		$this->db->select("
			UT_Menu.MenuID,
			UT_Menu.Url,
			UT_Menu.Root,
			UT_Menu.Category,
			UT_Menu.Name,
			(case when UT_Menu.Modul = 1 then 'Akuntansi' when UT_Menu.Modul = 2 then 'Listing' else '' end) as Modul,
			(case when UT_Menu.Type = 1 then 'main' when UT_Menu.Type = 2 then 'sub' else '' end) as Type,
			UT_Menu.ParentID,
			UT_Menu2.Name as ParentName
		");	
		$this->db->join("UT_Menu as UT_Menu2","UT_Menu.ParentID = UT_Menu2.MenuID","left");
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column as $item) // loop column 
		{
			if($this->input->post("search")) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		
		if($this->input->post('order')) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($this->input->post('length') != -1)
		$this->db->limit($this->input->post('length'), $this->input->post('start'));
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

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('MenuID',$id);
		$query = $this->db->get();

		return $query->row();
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

	public function delete_by_id($id)
	{
		$this->db->where('MenuID', $id);
		$this->db->delete($this->table);
	}
	public function select_UT_Menu()
	{
		$this->db->select("MenuID,Name");
		$this->db->where("Category !=","page");
		$query = $this->db->get("UT_Menu");
		return $query->result();
	}
}
