<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_member",'member');
	}
	public function index()
	{
		$tambah 	= "";
		$url_modul 	= $this->uri->segment(1); 
		$id_url 	= $this->main->GetMenuID($url_modul);
		$read 		= $this->main->read($id_url);
		if($read == 0): redirect(); endif;
		$admin_tambah = $this->main->menu_tambah($id_url);
		if($admin_tambah > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="tambah()" >Add New Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'Member';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/member/modal';
		$data['content']		= 'backend/member/list';
		$data['filter']			= 'backend/member/filter';
		$data['modul'] 			= 'Member';
		$data['url_modul']  	= $url_modul;
		$this->load->view('backend/index',$data);
	}
	public function ajax_list($url_modul = "")
	{
		$id_url = $this->main->GetMenuID($url_modul);
		$list 	= $this->member->get_datatables();
		$data 	= array();
		$no 	= $this->input->post("start");
		$i 		= 1;
		foreach ($list as $a) {
            $hapus 		= "";
            $ubah 		= "";
            $active 	= "";
            $Position 	= "";

			$member_ubah 	= $this->main->menu_ubah($id_url);
			$member_hapus 	= $this->main->menu_hapus($id_url);
			$id = $a->MemberID;
			if($member_ubah > 0):
           		$ubah = $this->main->button_icon("edit",$id);
			endif;
			if($member_hapus > 0):
        		$hapus = $this->main->button_icon("hapus",$id);
			endif;
            if($a->Active == 0):
            	$active = '<i class="icon  md-block pull-right" aria-hidden="true"></i>';
        		$btn_active = $this->main->button_icon("active",$id);;
            else:
        		$btn_active = $this->main->button_icon("nonactive",$id);;
            endif;
			$button  = '<div class="btn-group btn-group-xs" aria-label="Basic example" role="group">';
            $button .= $ubah;
            // $button .= $hapus;
            $button .= $btn_active;
            $button .= '</div>';

            // if($a->Position):
            // 	$Position = '<br/><span class="info-green">'.$a->Position.'</span>';
            // endif;

			$no++;
			$row 	= array();
			$row[] 	= $i++;
			$row[] 	= $a->Code;
			// $row[]	= '<img src="'.$a->Image.'"width=80px">';
			$row[] 	= $a->Name;
			$row[] 	= $a->Email;
			$row[] 	= $this->main->label_member($a->Member_type);
			$row[] 	= $a->Category;
			$row[] 	= $this->main->label_active($a->Active);
			$row[] 	= $this->main->label_subscribe($a->Subscribe);
			$row[] 	= $button;		
			$data[] = $row;
		}
		$output = array(
			"draw"  		  => $this->input->post("draw"),
			"recordsTotal" 	  => $this->member->count_all(),
			"recordsFiltered" => $this->member->count_filtered(),
			"data"			  => $data,
		);
		echo json_encode($output);
	}

	public function edit($id)
	{
		$a = $this->member->get_by_id($id);
		$output = array(
			"data"			=> $a,
			"status" 		=> TRUE,
			"hakakses"		=> $this->session->HakAkses
		);
		header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}

	public function save(){
		$this->validation->member();
		$crud 						= $this->input->post('crud');
		$MemberID 					= $this->input->post('MemberID');
		$Name 						= $this->input->post("Name");
		$Email 						= $this->input->post("Email");
		$nama 						= $this->input->post("Name");
		$nmfile 					= $this->main->penamaan_file($nama."-".time());
		$config['upload_path'] 		= './img/member'; //path folder 
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
		$config['max_size'] 		= '99999'; //maksimum besar file 2M 
		$config['max_width'] 		= '99999'; //lebar maksimum 1288 px 
		$config['max_height'] 		= '99999'; //tinggi maksimu 768 px 
		$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
		$this->upload->initialize($config); 
		$upload 					= $this->upload->do_upload('Image');
		$gbr 						= $this->upload->data();

		$CategoryID = $this->main->checkvalue($this->input->post("CategoryID"));

		$data 		= array(
			"Code"          => $this->main->kode_member("Member","Code",4,intval("1")),
			"Name"			=> $this->input->post("Name"),
			"Category"		=> $this->input->post("Category"),
			"Email"			=> $this->input->post("Email"),
			"Member_type"	=> $this->input->post("Member_type"),
			"Remark"		=> $this->input->post("Remark"),
			"LinkWebsite"	=> $this->input->post('LinkWebsite'),
			"Subscribe"		=> $this->input->post('Subscribe'),
			'CategoryID'	=> $CategoryID,
			"Active"		=> 1,
		);
		
		if($upload): 		
			$image 				= "img/member/".$gbr['file_name'];
			$data['Image']		= $gbr['file_name'];
			$data['ImageUrl']	= $image;
			$image 				= site_url($image);
		endif;
		// if($crud == "insert"):
		// 	// $data["CompanyID"]		= $this->session->CompanyID;
		// 	// $data["HakAksesID"]		= 3; #pegawai
		// 	$data["Active"] 		= 1;
		// 	$data["Name"]			= $Name;	
		// 	$data["Email"]			= $Email;	
		// 	$this->member->insert($data);
		// elseif($crud == "update"):
		// 	$this->Member->update(array("MemberID" => $MemberID), $data);

		// 	$a = $this->Member->get_by_id($MemberID);
		// endif;
		$insert = $this->member->save($data);
		echo json_encode(array("status" => TRUE,"pesan" => "yoi"));
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
		$this->member->update(array('MemberID' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$nama 						= $this->input->post("Name");
		$nmfile 					= $this->main->penamaan_file($nama."-".time());
		$config['upload_path'] 		= './img/member'; //path folder 
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
		$config['max_size'] 		= '99999'; //maksimum besar file 2M 
		$config['max_width'] 		= '99999'; //lebar maksimum 1288 px 
		$config['max_height'] 		= '99999'; //tinggi maksimu 768 px 
		$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
		$this->upload->initialize($config); 
		$upload 					= $this->upload->do_upload('Image');
		$gbr 						= $this->upload->data();

		$CategoryID = $this->main->checkvalue($this->input->post("CategoryID"));

		$data 		= array(
		    // "Code"          => $this->main->kode_member("Member","Code",4,intval("1")),
			"Name"			=> $this->input->post("Name"),
			"Category"		=> $this->input->post("Category"),
			'CategoryID'	=> $CategoryID,
			"Email"			=> $this->input->post("Email"),
			"Member_type"	=> $this->input->post("Member_type"),
			"Remark"		=> $this->input->post("Remark"),
			"LinkWebsite"	=> $this->input->post('LinkWebsite'),
			"Subscribe"		=> $this->input->post('Subscribe'),
			// 'Active' 				=> $this->input->post('Active'),	
		);

		if($upload): 		
			$id 				= $this->input->post('MemberID');
			$image 				= "img/member/".$gbr['file_name'];
			$data['Image']		= $gbr['file_name'];
			$data['ImageUrl']	= $image;
			$image 				= site_url($image);
			$this->member->hapus_gambar($id);

		endif;

		$this->member->update(array('MemberID' => $this->input->post('MemberID')), $data);
		echo json_encode(array("status" => TRUE,"pesan" => $this->input->post("status"), "error_upload" => $this->upload->display_errors()));
	}
	public function delete($id)
	{
		$this->member->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
