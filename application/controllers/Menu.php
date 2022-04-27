<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_menu","menu");
		// $this->main->cek_session();
	}
	public function index()
	{
		$tambah 	= "";
		$url_modul 	= $this->uri->segment(1); 
		$id_url 	= $this->main->GetMenuID($url_modul);
		$read 		= $this->main->read($id_url);
		if($read == 0): redirect(); endif;
		$coa_tambah = $this->main->menu_tambah($id_url);
		if($coa_tambah > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="tambah()" >Add Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'Menu / Route';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/menu/modal';
		$data['content']		= 'backend/menu/list';
		$data['modul'] 			= 'menu';
		$data['url_modul']  	= $url_modul;
		$this->load->view('backend/index',$data);
	}
	public function list_data()
	{	
		$Url 						= $this->uri->segment(1); 
		$id_Url 					= $this->main->GetMenuID($Url);
		#ini aturan untuk CRUD
		$list 	= $this->menu->get_datatables();
		$data 	= array();
		$no 	= $this->input->post('start');
		$i 		= 1;
		foreach ($list as $a):
			$hapus = "";
			$ubah  = "";
           	$hapus = '<a href="javascript:void(0)" type="button" class="btn btn-white" title="Hapus" onclick="hapus('."'".$a->MenuID."'".')">delete</a>';
           	$ubah  = '<a href="javascript:void(0)" type="button" class="btn btn-white" title="Edit" onclick="edit('."'".$a->MenuID."'".')">edit</a>';
			
			$menu_ubah 				= $this->main->menu_ubah($id_Url);
			$menu_hapus 			= $this->main->menu_hapus($id_Url);
			if($menu_ubah > 0):
           	$ubah = '<a href="javascript:void(0)" type="button" class="btn btn-white" title="Edit" onclick="edit('."'".$a->MenuID."'".')">edit</a>';
			endif;
			if($menu_hapus > 0):
           	$hapus = '<a href="javascript:void(0)" type="button" class="btn btn-white" title="Hapus" onclick="hapus('."'".$a->MenuID."'".')">delete</a>';
			endif;
			#ini aturan untuk crud
		
			$button = '<div class="btn-group btn-group-xs" aria-label="Basic example" role="group">';
            $button .= $ubah;
            $button .= $hapus;
            $button .= '</div>';
			$no++;
			$row = array();
			$row[] 	= $i++;
			$row[] 	= "<a href='".site_Url($a->Url)."'>".$a->Name."</a>";
			// $row[] 	= $a->Modul;
			// $row[] 	= $a->Type;
			// $row[] 	= $a->ParentName;
			$row[] 	= $a->Url;
			$row[] 	= $a->Root;
			$row[] 	= $a->Category;
			$row[] 	= $button;
			$data[] = $row;
		endforeach;
		$output = array(
			"draw" 				=> $this->input->post('draw'),
			"recordsTotal" 		=> $this->menu->count_all(),
			"recordsFiltered" 	=> $this->menu->count_filtered(),
			"data" 				=> $data,
		);
		
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	public function edit($id)
	{
		$output = $this->menu->get_by_id($id);
		header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	public function save()
	{
		$this->_validate();
		$data = array(
				'Name' 		=> $this->input->post('Name'),
				'Modul'		=> 1,#$this->input->post("Modul"),
				'Type' 		=> $this->input->post('Type'),
				'Url' 		=> $this->input->post('Url'),
				'Category' 	=> $this->input->post('Category'),
				'Root' 		=> $this->input->post('Root'),
				'Icon' 		=> $this->input->post('Icon')
		);
		if($this->input->post("Type") == 2): #type 2 itu sub menu
			$data["ParentID"] = $this->input->post("ParentID");
		endif;
		$insert = $this->menu->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function update()
	{
		$this->_validate();
		$data = array(
				'Name' 		=> $this->input->post('Name'),
				// 'Modul'		=> $this->input->post("Modul"),
				'Type' 		=> $this->input->post('Type'),
				'Url' 		=> $this->input->post('Url'),
				'Category' 	=> $this->input->post('Category'),
				'Root' 		=> $this->input->post('Root'),
				'Icon' 		=> $this->input->post('Icon')
		);
		if($this->input->post("Type") == 2): #type 2 itu sub menu
			$data["ParentID"] = $this->input->post("ParentID");
		endif;
		$this->menu->update(array('MenuID' => $this->input->post('MenuID')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function delete($id)
	{
		$this->menu->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('Name') == '')
		{
			$data['inputerror'][] = 'Name';
			$data['error_string'][] = 'Name cannot be null';
			$data['status'] = FALSE;
		}

		if($this->input->post('Url') == '')
		{
			$data['inputerror'][] = 'Url';
			$data['error_string'][] = 'Url cannot be null';
			$data['status'] = FALSE;
		}
		if($this->input->post('Root') == '')
		{
			$data['inputerror'][] = 'Root';
			$data['error_string'][] = 'Root cannot be null';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
