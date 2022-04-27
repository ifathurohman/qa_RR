<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_content extends CI_Model {

	var $table 	= 'Content';
	var $column = array('Content.ContentID','Content.Name','Content.Category','Content.Date','Content.Location','Content.Active'); //set column field database for order and search
	var $order 	= array('ContentID' => 'desc'); // default order 
	var $host;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->host = base_url();
	}
	private function _get_datatables_query()
	{
		$modul = $this->input->post("Modul");
		$url = $this->uri->segment(1);
		$this->db->select("
			Content.ContentID,
			Content.Code,
			Content.Date,
			Content.DateAdd,
			Content.Name,
			Content.Link,
			Content.Type,
			Content.Category,
			Content.CategoryStatus,
			Content.Active,
			Content.Location,
			(CASE WHEN Content.Active = '1' THEN 'publish' ELSE 'unpublish' END) as ActiveLabel,
			(CASE WHEN Content.Image IS NOT NULL THEN CONCAT('$this->host/',Content.Image) ELSE  '' END) as Image,
			(case when Content.UserCh is null then Content.UserAdd else Content.UserCh end) as Author,
			(case when Content.DateCh is null then Content.DateAdd else Content.DateCh end) as DateModify,
		");
		$this->db->from($this->table);
		$this->db->where("Type",$modul);
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
		$modul = $this->input->post("Modul");
		$this->db->from($this->table);
		$this->db->where("Type",$modul);
		return $this->db->count_all_results();
	}
	public function get_by_id($id)
	{
		$this->db->select("
			Content.*,
			(CASE WHEN Content.Image IS NOT NULL THEN CONCAT('$this->host/',Content.Image) ELSE  '$this->host/aset/img/noicon.png' END) as Image,
			(case when Content.UserCh is null then Content.UserAdd else Content.UserCh end) as Author,
			(case when Content.DateCh is null then Content.DateAdd else Content.DateCh end) as DateModify,

		");
		$this->db->from($this->table);
		$this->db->where('Content.ContentID',$id);
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
		$this->content->hapus_img($id);

		$this->db->where('ContentID', $id);
		$this->db->delete($this->table);
	}
	public function hapus_img($id){
		error_reporting(0);
        ini_set('display_errors', 0);
        
        $this->db->select("ContentID,Image");
        $this->db->where('ContentID', $id);
        $query = $this->db->get($this->table)->row();
        $Image = site_url("img/content/".$query->Image);
        if(!empty($query->Image)):
	        $root       = explode(base_url(), $Image)[1];
	        $headers = @get_headers($Image);
	        if (preg_match("|200|", $headers[0])) {
	            unlink('./' . $root);
	        } 
        endif;
    }
}
