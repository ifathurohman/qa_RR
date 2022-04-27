<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	var $table='UT_User';
	var $column = array("UT_User.UserID","UT_User.Name","UT_User.Email","UT_User.Active"); //set column field database for order and search
    var $order = array('UT_User.UserID' => 'desc'); // default order 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->host = base_url();
	}

    private function _get_datatables_query()
    {
        $this->db->select("
            UT_User.UserID,
            UT_User.Name,
            UT_User.Email,
            UT_User.Active,
            UT_HakAkses.Name as hakaksesName,
        "); 
        $this->db->join("UT_HakAkses", "UT_User.HakAksesID = UT_HakAkses.HakAksesID", "left");
        $this->db->where("UT_User.CompanyID",$this->session->CompanyID);
        $this->db->where("UT_User.HakAksesID >",2);
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
        $this->db->where("UT_User.CompanyID",$this->session->CompanyID);
        $this->db->where("UT_User.HakAksesID >",2);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_by_id($id){
        $this->db->select("
            UT_User.UserID,
            UT_User.Name,
            UT_User.Email,
            UT_User.Password,
            UT_User.Active,
            UT_User.HakAksesID,
            UT_User.Image as ImageUser,
            UT_HakAkses.Name as hakaksesName,
        ");
        $this->db->where("UT_User.UserID", $id);
        $this->db->join("UT_HakAkses", "UT_User.HakAksesID = UT_HakAkses.HakAksesID", "left");
        $query = $this->db->get($this->table);

        return $query->row();
    }

    function  insert($data){
        $this->db->set("UserAdd",$this->session->Name);
        $this->db->set("DateAdd",date("Y-m-d H:i:s"));
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    function update($where,$data)
    {
        $this->db->set("UserCh",$this->session->Name);
        $this->db->set("DateCh",date("Y-m-d H:i:s"));
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }

    function update_marketing($where,$data){
        $this->db->set("UserCh",$this->session->Name);
        $this->db->set("DateCh",date("Y-m-d H:i:s"));
        $this->db->update("PS_Marketing",$data,$where);
        return $this->db->affected_rows();
    }


    function user_browse(){ 
        $qry="SELECT * from UT_User   LEFT JOIN PS_Branch ON UT_User.BranchID=PS_Branch.BranchID";
        return $this->db->query($qry);
    }

    function delete_by_id($id)
    {
    	$this->db->where('id_user',$id);
    	$this->db->delete($this->table);


    }

}
