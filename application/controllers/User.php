<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_user",'user');
		$this->load->helper(array('form', 'url'));
		$this->main->cek_session();
	}
	public function index()
	{
		$tambah = "";
        $MenuID 	= $this->main->GetMenuID();
		$read 		= $this->main->read($MenuID);
		if($read == 0): redirect(); endif;
		$branch_tambah = $this->main->menu_tambah($MenuID);
		if($branch_tambah > 0):
           // $tambah = '<button type="button" class="btn btn-white" onclick="tambah()" >Tambah Data</button>';
			$tambah = '<button type="button" class="btn btn-white" onclick="tambah();">Add Data  </button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'User';
		$data['tambah'] 		= $tambah;
		$data['modal'] 	 		= 'backend/user/modal';
		$data['content']		= 'backend/user/list';
		$data['modul'] 			= 'User';
		$data['url_modul']  	= '';
		$data['MenuID'] 		= $MenuID;
		$data['hak_akses']		= $this->api->hak_akses_select();
		$this->load->view('backend/index',$data);
	}

	public function ajax_list()
	{
		$MenuID = $this->input->post("MenuID");
		$list 	= $this->user->get_datatables();
		$data 	= array();
		$no 	= $this->input->post("start");
		$i 		= 1;
		$view_ubah 	= $this->main->menu_ubah($MenuID);
		$view_hapus = $this->main->menu_hapus($MenuID);
		foreach ($list as $a) {
			$token 	= "";
			$device = "";
            $store 	= "";
            $hapus 	= "";
            $ubah 	= "";
            $active = "";
            $unlink = "";
            $btn_active = "";

			$id = $a->UserID;
			if($view_ubah > 0):
           		$ubah = $this->main->button_icon("edit",$id);
			endif;
			if($view_hapus > 0):
        		$hapus = $this->main->button_icon("hapus",$id);
	            if($a->Active == 0):
	            	$active = '<i class="icon  md-block pull-right" aria-hidden="true"></i>';
	        		$btn_active = $this->main->button_icon("active",$id);;
	            else:
	        		$btn_active = $this->main->button_icon("nonactive",$id);;
	            endif;
			endif;
			$no++;

			$button  = '<div class="btn-group btn-group-xs" aria-label="Basic example" role="group">';
            $button .= $ubah;
            // $button .= $hapus;
            $button .= $btn_active;
            $button .= '</div>';
			$row 	= array();
			$row[] 	= $i++;
			$row[] 	= $a->Name;
			$row[] 	= $a->Email;
			$row[] 	= $a->hakaksesName;
			$row[] 	= $this->main->label_active($a->Active);
			$row[] 	= $button;		
			$data[] = $row;
		}
		$output = array(
			"draw"  		  => $this->input->post("draw"),
			"recordsTotal" 	  => $this->user->count_all(),
			"recordsFiltered" => $this->user->count_filtered(),
			"data"			  => $data,
		);
		echo json_encode($output);
	}

	public function save()
	{
		$this->validation->user('save');

		$crud 		= $this->input->post('crud');
		$UserID 	= $this->input->post('UserID');
		$Name 		= $this->input->post("Name");
		$Email 		= $this->input->post("Email");
		$Password 	= $this->input->post("password");
		$role 		= $this->input->post("role");
		$page 		= $this->input->post("page");
		$d_hak_akses= $this->api->hak_akses_detail($role);
		$Password 	= $this->main->hash($Password);
		$nmfile 					= "user_".time();
		$config['upload_path'] 		= './img/user'; //path folder 
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
		$config['max_size'] 		= '99999'; //maksimum besar file 2M 
		$config['max_width'] 		= '99999'; //lebar maksimum 1288 px 
		$config['max_height'] 		= '99999'; //tinggi maksimu 768 px 
		$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
		$this->upload->initialize($config); 
		$upload 					= $this->upload->do_upload('gambar');
		$gbr 						= $this->upload->data();
		$data 	= array(
			"CompanyID"		=> $this->session->CompanyID,
			"Name"			=> $Name,
			"Email"			=> $Email,
		);
		$data_session = array(
			'Name'	=> $Name,
		);
		if($page != 'user_edit'):
			$data["HakAksesID"]	= $role;
			$data["HakAkses"]	= $d_hak_akses->HakAkses;
		endif;
		if($this->input->post("password") != '********'):
			$data["Password"] = $Password;
		endif;
		$image = "";
		if($upload): 		
			$image 				= "img/user/".$gbr['file_name'];
			$data["Image"] 	= $image;
			if($crud == "update"):
				$this->main->hapus_gambar("UT_User","Image",array("UserID"=>$UserID));		
			endif;
			if($page == "user_edit"):
				$data_session['Image'] = $image;
				if(in_array($role,array(1,2))){
					$data_session["CompanyImage"] = $image;
				}
			endif;
		endif;
		$this->session->set_userdata($data_session);
		if($crud == "insert"):
			$data["Active"] 	= 1;
			$this->user->insert($data);
		elseif($crud == "update"):
			$this->user->update(array("UserID" => $UserID), $data);

			$a = $this->user->get_by_id($UserID);
		endif;

		$res["page"] 	= $page;
		$res["role"] 	= $role;
		$res["status"] 	= true;
		$res["image"]	= $image;
		$res["data_session"]	= $data_session;

		$this->main->echoJson($res);
	}

	public function edit($id)
	{
		$a = $this->user->get_by_id($id);
		$output = array(
			"data"			=> $a,
			"status" 		=> TRUE,
			"hakakses"		=> $this->session->HakAkses
			// "Skill"			=> json_decode($a->Skill),
		);
		header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	public function active($id,$status="")
	{	
		if($status == "active"){
			$status = 1;
		} else {
			$status = 0;
		}
		$data = array(
			"Active" => $status
		);
		$this->user->update(array('UserID' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function edit_user()
	{
		$url_modul 	= $this->uri->segment(1); 

		$data['title']  		= 'Master Users ' ;
		$data['content']		= 'backend/user/edit_user';
		$data['modul'] 			= 'User';
		$data['url_modul']  	= $url_modul;
		$data['hak_akses']		= $this->api->hak_akses_select();
		$data['id']				= $this->session->UserID;
		$this->load->view('backend/index',$data);
	}
}
