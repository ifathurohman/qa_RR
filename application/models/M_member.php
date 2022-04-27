<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_member extends CI_Model {
	var $table 	= 'Member';
	var $column = array(
		"MemberID",
		"Code",
		"Name",
		"Email",
		"Category",
		"Member_type",
		"Active",
		"Subscribe",
		); //set column field database for order and search
	var $order 	= array('MemberID' => 'desc'); // default order 
	var $host;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->host = base_url();
	}
	private function _get_datatables_query()
	{
		$this->db->select("
			MemberID,
			Name,
			Email,
			Category,
			Code,
			Member_type,
			Subscribe,
			(CASE WHEN Image IS NOT NULL THEN CONCAT('$this->host/img/member/',Image) ELSE  '$this->host/aset/img/noicon.png' END) as Image,
			ImageUrl,
			Remark,
			Active");	
		$this->db->from($this->table);
		
		$column = $this->column;
		if($this->input->post("Search")):
			$Search = $this->input->post("Search");
			$i = 0;
			foreach ($column as $item):
				if($Search):
					if($i===0):
						$this->db->group_start();
						$this->db->like($item, $Search);
					else:
						$this->db->or_like($item, $Search);
					endif;
					if(count($column) - 1 == $i):
						$this->db->group_end(); //close bracket
					endif;
				endif;
				$column[$i] = $item; // set column array variable to order processing
				$i++;
			endforeach;
		else:
			if($this->input->post('Type')):
				$this->db->where('Member_type', $this->input->post('Type'));
			endif;
			if($this->input->post('Status') != "none"):
				$this->db->where("Active", $this->input->post('Status'));
			endif;
		endif;

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
		$this->db->select("
			Member.MemberID,
			Member.Name,
			Member.Category,
			Member.CategoryID,
			Member.Code,
			Member.Email,
			Member.Member_type,
			Member.Subscribe,
			(CASE WHEN Image IS NOT NULL THEN CONCAT('$this->host/img/member/',Image) ELSE  '$this->host/aset/img/noicon.png' END) as Image,
			Member.ImageUrl,
			Member.Remark,
			Member.LinkWebsite,
			Member.Active,
			Category.Name 	as categoryName,
		");
		$this->db->join("Category", "Category.CategoryID = Member.CategoryID", "left");
		$this->db->from($this->table);
		$this->db->where('MemberID',$id);
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
		$this->db->where('MemberID', $id);
		$this->db->delete($this->table);
	}
	public function hapus_gambar($id){
        $this->db->select("MemberID,Image");
        $this->db->where('MemberID', $id);
        $query = $this->db->get($this->table)->row();
        $Image = site_url("img/member/".$query->Image);
        if(!empty($query->Image)):
	        $root       = explode(base_url(), $Image)[1];
	        $headers = @get_headers($Image);
	        if (preg_match("|200|", $headers[0])) {
	            unlink('./' . $root);
	        } 
        endif;
    }
}
