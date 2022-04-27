<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model {

	var $table 	= 'Product';
	var $column = array('A.ProductID','A.Name','A.Category','A.Date','A.Location','A.Active'); //set column field database for order and search
	var $order 	= array('ProductID' => 'desc'); // default order 
	var $host;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->host = base_url();
	}
	private function _get_datatables_query()
	{
		$noicon = $this->host."aset/img/noicon.png";
		$modul = $this->input->post("Modul");
		$url = $this->uri->segment(1);
		$this->db->select("
			A.ProductID,
			A.Code,
			A.Date,
			A.DateAdd,
			A.Name,
			A.Link,
			A.Type,
			A.Category,
			A.CategoryStatus,
			A.Active,
			A.Location,
			(CASE WHEN A.Active = '1' THEN 'publish' ELSE 'unpublish' END) as ActiveLabel,

			(CASE 
            WHEN (SELECT Z.ImageBase64 FROM ProductImage as Z where Z.ProductID = A.ProductID LIMIT 1) IS NOT NULL 
            THEN (SELECT Z.ImageBase64 FROM ProductImage as Z where Z.ProductID = A.ProductID LIMIT 1)
            WHEN (SELECT Z.ImageBase64 FROM ProductImage as Z where Z.ProductID = A.ProductID LIMIT 1) IS NULL AND A.Image IS NOT NULL 
            THEN CONCAT('$this->host/',A.Image)
            ELSE  '$noicon' END) as Image,


			(case when A.UserCh is null then A.UserAdd else A.UserCh end) as Author,
			(case when A.DateCh is null then A.DateAdd else A.DateCh end) as DateModify,
			B.Name as CategoryName
		");
		$this->db->from($this->table." as A");
		$this->db->join('Category as B','A.CategoryID = B.CategoryID','left');
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
		// $this->db->where("Type",$modul);
		return $this->db->count_all_results();
	}
	public function get_by_id($id,$page = ''){
		if($page == "Category"):
			$this->db->select('B.SeoImage,B.SeoText');
			$this->db->join('Category as B','A.CategoryID = B.CategoryID','left');
		else:
			$this->db->select("
				A.*,
				(CASE WHEN A.Image IS NOT NULL THEN CONCAT('$this->host/',A.Image) ELSE  '$this->host/aset/img/noicon.png' END) as Image,
				(case when A.UserCh is null then A.UserAdd else A.UserCh end) as Author,
				(case when A.DateCh is null then A.DateAdd else A.DateCh end) as DateModify,

			");
		endif;
		$this->db->from($this->table." as A");
		$this->db->where('A.ProductID',$id);
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
		$this->main->hapus_gambar('Product','Image',array('ProductID'=>$id));
		$this->db->where('ProductID', $id);
		$this->db->delete($this->table);
	}
    public function list_product_image($ID){
    	$this->db->where("ProductID",$ID);
    	$query = $this->db->get("ProductImage");
    	return $query->result();
    }
}
