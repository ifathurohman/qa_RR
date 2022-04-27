<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_email extends CI_Model {

	var $table 	= 'EmailBroadcast';
	var $column = array(
		'EmailBroadcast.EmailID',
		'EmailBroadcast.EmailSubject',
		'EmailBroadcast.EmailSender',
		'EmailBroadcast.EmailTo',
		'EmailBroadcast.EmailDate',
		'EmailBroadcast.Type',
		'EmailBroadcast.Status'

		); //set column field database for order and search
	var $order 	= array('EmailBroadcast.EmailID' => 'desc'); // default order 
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
			EmailBroadcast.EmailID,
			EmailBroadcast.EmailDate,
			EmailBroadcast.EmailTo,
			EmailBroadcast.EmailSender,
			EmailBroadcast.EmailSubject,
			EmailBroadcast.Status,
			EmailBroadcast.Type,

			user.Name as userName,
		");
		$this->db->join("UT_User as user", "EmailBroadcast.EmailSender = user.UserID", "left");
		$this->db->from($this->table);
		
		$urlFilter = $this->session->urlFilter;
		if($urlFilter == 1):
			$this->db->where("EmailBroadcast.MemberID",$this->session->MemberID);
		elseif($urlFilter == 2):
			$this->db->where("EmailBroadcast.EmailSender",$this->session->UserID);
		endif;
		
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
			if($this->input->post("StartDate")):
				$StartDate = $this->main->convertDate($this->input->post("StartDate"));
				$this->db->where("EmailBroadcast.EmailDate >=", $StartDate);
			endif;
			if($this->input->post("EndDate")):
				$EndDate = $this->main->convertDate($this->input->post("EndDate"));
				$this->db->where("EmailBroadcast.EmailDate <=", $EndDate);
			endif;
			if($this->input->post('Type')):
				$this->db->where('EmailBroadcast.Type', $this->input->post('Type'));
			endif;
		endif;

		if(isset($_POST['order'])){
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}	}
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

	public function get_by_id($id){
		$this->db->select("
			EmailBroadcast.EmailID,
			EmailBroadcast.EmailDate,
			IFNULL(EmailBroadcast.EmailTo, '[]') as EmailTo,
			IFNULL(EmailBroadcast.EmailTo2, '[]') as EmailTo2,
			EmailBroadcast.EmailSender,
			EmailBroadcast.EmailSubject,
			EmailBroadcast.EmailContent,
			EmailBroadcast.Type,
			EmailBroadcast.Status,

			user.Name as userName,
		");
		$this->db->where("EmailID", $id);
		$this->db->join("UT_User as user", "EmailBroadcast.EmailSender = user.UserID", "left");
		$query = $this->db->get($this->table);


		return $query->row();
	}

	public function get_detail_by_id($id){
		$this->db->select("
			EmailBroadcast.EmailID,
			EmailBroadcast.EmailDate,
			IFNULL(EmailBroadcast.EmailTo, '[]') as EmailTo,
			EmailBroadcast.EmailSender,
			EmailBroadcast.EmailSubject,
			EmailBroadcast.EmailContent,
			EmailBroadcast.Type,
			EmailBroadcast.Status,

			detail.EmailDetailID,
			detail.EmailTo 	as detailEmailTo,
			detail.Status 	as detailStatus,

			user.Name as userName,
		");
		$this->db->where("EmailBroadcast.EmailID", $id);
		$this->db->join("EmailBroadcastDetail as detail", "EmailBroadcast.EmailID = detail.EmailID", "left");
		$this->db->join("UT_User as user", "EmailBroadcast.EmailSender = user.UserID", "left");
		$query = $this->db->get($this->table);


		return $query->result();
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

	public function save_detail($data)
	{
		$this->db->set("UserAdd",$this->session->Name);
		$this->db->set("DateAdd",date("Y-m-d H:i:s"));
		$this->db->insert("EmailBroadcastDetail", $data);
		return $this->db->insert_id();
	}

	public function update_detail($where, $data)
	{
		$this->db->set("UserCh",$this->session->Name);
		$this->db->set("DateCh",date("Y-m-d H:i:s"));
		$this->db->update("EmailBroadcastDetail", $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('EmailID', $id);
		$this->db->delete($this->table);
	}

	public function send_email($bcc="",$list="",$cek_page = ""){
  		
  		$attach       		= $this->api->get_attach_broadcast($list->EmailID);
  		$lampiran           = FALSE;

		$page_email         = "email/index";
        $data['name']		= '';
        $data['message']	= '';
        $data['unsubscribe']= '';
        $data["page"]       = "email/broadcast_email";

        if($cek_page == "ya"):
            $this->load->view($page_email,$data);
        else:
        	$email_to 	= 'info@rumahruth.or.id';
            $protocol   = "smtp";
            $smtp_host  = "mail.rumahruth.or.id";
            $smtp_port  = "587";
            $smtp_user  = "info@rumahruth.or.id";
            $smtp_pass  = "12345!";
            
            $config = Array(
                'useragent'     => "Codeigniter",
                'protocol'      => $protocol,
                'smtp_host'     => $smtp_host,
                'smtp_port'     => $smtp_port,
                'smtp_user'     => $smtp_user,
                'smtp_pass'     => $smtp_pass,
                'mailtype'      => 'html',
                'charset'       => 'iso-8859-1',
                'wordwrap'      => TRUE,
                'newline'       => "\r\n"
            );
            

         //    $this->email->to("luna@rcelectronic.net");
         //    $this->email->bcc($bcc);
         //    $this->email->message($this->load->view($page_email, $data, TRUE));
        	// $send = $this->email->send();
        	$this->load->library('email');
	        $this->email->initialize($config);
	        $this->email->set_newline("\r\n");
	        $this->email->set_mailtype("html");
        	foreach ($bcc as $k => $v) {
        		$this->email->subject("Rumah RUTH Newsletter " .$list->EmailSubject .date("Y-m-d"));
		        $this->email->from("info@rumahruth.or.id","Rumah RUTH");

            	$data['name'] 		= $v;
            	$data['message'] 	= $list->EmailContent;
            	$data['unsubscribe']= site_url()."unsubscribe/".$this->api->encrypt($v);
            	$this->email->to($v);
            	$this->email->message($this->load->view($page_email, $data, TRUE));
            	foreach ($attach as $key => $value) {
                    $this->email->attach($value->File);
                }
	            $send = $this->email->send();
            }
        endif;
    }
}