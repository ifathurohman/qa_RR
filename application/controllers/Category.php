<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	var $HakAksesID = '';
	public function __construct()
	{
		parent::__construct();
		$this->main->cek_session();
		$this->load->model('M_category','category');
		$this->HakAksesID 	= $this->session->HakAksesID;
	}

	public function index(){
		$tambah 	= "";
        $MenuID 	= $this->main->GetMenuID();
		$read 		= $this->main->read($MenuID);
		if($read == 0): redirect(); endif;
		$view_tambah = $this->main->menu_tambah($MenuID);
		if($view_tambah > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="add_data()" >Add New Data</button>';
		endif;
		$data['title']  	= 'Category';
		$data['tambah'] 	= $tambah;
		$data['modul']		= 'Category';
		$data['url_modul']	= '';
		$data['MenuID'] 	= $MenuID;
		$data['modal'] 	 	= 'backend/category/modal';
		$data['content']	= 'backend/category/list';
		$this->load->view('backend/index',$data);
	}

	public function ajax_list()
	{
		$MenuID = $this->input->post("MenuID");
		$list 	= $this->category->get_datatables();
		$data 	= array();
		$no 	= $this->input->post("start");
		$i 		= 1;
		$data_ubah 		= $this->main->menu_ubah($MenuID);
		$data_hapus 	= $this->main->menu_hapus($MenuID);
		foreach ($list as $a) {
			$ubah 	= "";
			$hapus 	= "";
			$active = "";

			$id = $a->CategoryID;
			if($data_ubah > 0):
           		$ubah = $this->main->button_icon("edit",$id);
			endif;
			if($data_hapus > 0):
        		$hapus = $this->main->button_icon("hapus",$id);
        		if($a->Active == 0):
	        		$active = $this->main->button_icon("active",$id);;
	            else:
	        		$active = $this->main->button_icon("nonactive",$id);;
	            endif;
			endif;

			$button 	= '<div class="btn-group btn-group-xs btn-kotak" aria-label="Basic example" role="group">';
				$button .= $ubah;
				$button .= $active;
			$button .= '</div>';

			$Icon = '';
			if($a->Icon): $Icon = '<i class="'.$a->Icon.'"></i> '; endif;

			$no++;
			$row 	= array();
			$row[] 	= $no;
			$row[] 	= $Icon.$a->Name;
			$row[] 	= $a->SeoText;
			$row[] 	= $a->SeoImage;
			$row[] 	= $this->main->label_active($a->Active);	
			$row[] 	= $button;
			$data[] = $row;
		}

		$output = array(
			"draw"  		  => $this->input->post("draw"),
			"recordsTotal" 	  => $this->category->count_all(),
			"recordsFiltered" => $this->category->count_filtered(),
			"data"			  => $data,
		);
		echo json_encode($output);
	}

	public function save(){
		$crud 	 	= $this->input->post('crud');
		$this->validation->category($crud);
		$CategoryID	= $this->input->post('CategoryID');
		$Name		= $this->input->post('Name');
		$Remark		= $this->input->post('Remark');
		$SeoText	= $this->input->post('SeoText');
		$SeoImage	= $this->input->post('SeoImage');
		$Icon	= $this->input->post('Icon');
		$SeoImage 	= $this->main->clean($SeoImage);
		if($SeoImage):
			$last = substr($SeoImage, -1);
			if($last != "-"):
				$SeoImage .= '-';
			endif;
		endif;
		$Link = $this->main->link($Name);
		$data = array(
			"Name"		=> $Name,
			"Link"		=> $Link,
			"SeoImage"	=> $SeoImage,
			"SeoText"	=> $SeoText,
			"Remark"	=> $Remark,
			"Icon"		=> $Icon,
		);
		if($crud == "update"):
			$this->category->update(array("CategoryID" => $CategoryID), $data);
		else:
			$this->category->save($data);
		endif;
		$output = array(
			"status"	=> TRUE,
			"message" 	=> "success",
		);
		$this->main->echoJson($output);
	}
	public function edit($id)
	{
		$a = $this->category->get_by_id($id);
		$output = array(
			"data"			=> $a,
			"status" 		=> TRUE,
			"hakakses"		=> $this->session->HakAkses
		);
		$this->main->echoJson($output);
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
		$this->category->update(array('CategoryID' => $id), $data);
		$output = array(
			"status"	=> TRUE,
			"message" 	=> "success",
		);
		$this->main->echoJson($output);
	}
}