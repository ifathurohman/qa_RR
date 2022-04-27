<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hakakses extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->main->cek_session();
		$this->load->helper('url');
		$this->load->model("M_hakakses",'hakakses');
	}
	public function index()
	{
		$url 						= $this->uri->segment(1); 
		$id_url 					= $this->main->GetMenuID($url);
		$read 						= $this->main->read($id_url);
		// if($read == 0){ redirect(); }
		$hak_akses_tambah 			= $this->main->menu_tambah($id_url);
		if($hak_akses_tambah > 0):
           $tambah = '<button type="button" class="btn btn-white" onclick="tambah()">Add Data</button>';
		else: 
			$tambah = ""; 
		endif;
		#ini untuk session halaman aturan user privileges
		$modul = array("akuntansi");

		$array = array(
			// array('management','Management'),
			// array('page_backend','Menu Backend'),
			// array('master',"Master"),
			// array('transaction',"Transaksi"),
			// array('report',"Laporan"),
			array('page_backend',"Menu Backend"),
			array('setting',"Setting"),
		);
		$data['modul']			= $modul;
		$data['array']			= $array;
		$data['url'] 			= 'user-privileges';
		$data['title']  		= 'User Privileges';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/hakakses/modal';
		$data['content']		= 'backend/hakakses/list';
		$this->load->view('backend/index',$data);
	}
	//---------------------------------------------------------------------------------------
	public function ajax_list()
	{
		$url 	= $this->uri->segment(1); 
		$id_url = $this->main->GetMenuID($url);
		$list 	= $this->hakakses->get_datatables();
		$data 	= array();
		$no 	= $this->input->post("start");
		$i 		= 1;
		foreach ($list as $a) {
			$hak_akses_ubah 	= $this->main->menu_ubah($id_url);
			$hak_akses_hapus 	= $this->main->menu_hapus($id_url);
			$ubah = '<a href="javascript:void(0)" type="button" class="btn btn-white" title="Edit" onclick="edit('."'".$a->HakAksesID."'".','."'".$a->Name."'".')"><i class="ti-pencil"><i></a>';
			$button = '<div class="btn-group btn-group-xs" aria-label="Basic example" role="group">';
            $button .= $ubah;
            $button .= '</div>';

            if(strtolower($a->Name) == "rc" && strtolower($this->session->HakAkses) != "rc"):
            	$button = "";
            endif;
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = $a->Name;
			$row[] = $button;		
			$data[] = $row;
		}

		$output = array(
						"draw"  		  => $this->input->post("draw"),
						"recordsTotal" 	  => $this->hakakses->count_all(),
						"recordsFiltered" => $this->hakakses->count_filtered(),
						"data"			  => $data,
				);
		echo json_encode($output);
	}

	public function edit($id)
	{
		$a 		= $this->hakakses->get_by_id($id);
		$output = array(
			"HakAksesID" 	=> $a->HakAksesID,
			"Hakakses"		=> $a->HakAkses,
			"Name"			=> $a->Name,
			"Menu"			=> json_decode($a->Menu),
			"Tambah"		=> json_decode($a->Tambah),
			"Ubah"			=> json_decode($a->Ubah),
			"Hapus"			=> json_decode($a->Hapus),
			"Approve"		=> json_decode($a->Approve),
			"Filter"		=> json_decode($a->Filter),
		);
		header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}

	public function save()
	{
		// in_array(needle, haystack)
		$data_filter 	= array();
		$cekbox 	 	= $this->input->post('menu');
		$cekboxID 	 	= $this->input->post('cekboxID');
		$menu 			= $this->input->post('menu');
		$filter 		= $this->input->post('filter');
		#hitung total  po dan PPN
		foreach ($cekboxID as $key => $v):
			if(in_array($cekboxID[$key], $cekbox)):
				$item = array(
					"ID" 		=> $v,
					"Filter" 	=> $filter[$key]
				);
				array_push($data_filter, $item);
			endif;
		endforeach;

		$Menu 		= array();
		$Tambah 	= array();
		$Ubah 		= array();
		$Hapus 		= array();
		$Approve 	= array();
		
		$menu 		= $this->input->post("menu");
		$tambah 	= $this->input->post("tambah");
		$ubah 		= $this->input->post("ubah");
		$hapus 		= $this->input->post("hapus");
		$approve 	= $this->input->post("approve");
		if($menu):
			$Menu = $menu;
		endif;
		if($tambah):
			$Tambah = $tambah;
		endif;
		if($ubah):
			$Ubah = $ubah;
		endif;
		if($hapus):
			$Hapus = $hapus;
		endif;
		if($approve):
			$Approve = $approve;
		endif;
		$Menu 		= json_encode($Menu);
		$Tambah 	= json_encode($Tambah);
		$Ubah 		= json_encode($Ubah);
		$Hapus 		= json_encode($Hapus);
		$Approve 	= json_encode($Approve);
		$data 		= array(
			'Name' 				=> $this->input->post("Name"),
			'HakAkses' 			=> str_replace(" ", "_", strtolower($this->input->post("Name"))),
			'Menu' 				=> $Menu,
			'Tambah' 	 		=> $Tambah,
			'Ubah' 	 			=> $Ubah,
			'Hapus' 	 		=> $Hapus,
			'Approve' 	 		=> $Approve,
			'Filter' 	 		=> json_encode($data_filter),
		);
		$insert = $this->hakakses->save($data);
		echo json_encode(array("status" => TRUE,"pesan" => "yoi"));
	}
	public function update()
	{
		// in_array(needle, haystack)
		$data_filter 	= array();
		$cekbox 	 	= $this->input->post('menu');
		$cekboxID 	 	= $this->input->post('cekboxID');
		$menu 			= $this->input->post('menu');
		$filter 		= $this->input->post('filter');
		#hitung total  po dan PPN
		foreach ($cekboxID as $key => $v):
			if(in_array($cekboxID[$key], $cekbox)):
				$item = array(
					"ID" 		=> $v,
					"Filter" 	=> $filter[$key]
				);
				array_push($data_filter, $item);
			endif;
		endforeach;
		$Menu 		= array();
		$Tambah 	= array();
		$Ubah 		= array();
		$Hapus 		= array();
		$Approve 	= array();
		
		$menu 		= $this->input->post("menu");
		$tambah 	= $this->input->post("tambah");
		$ubah 		= $this->input->post("ubah");
		$hapus 		= $this->input->post("hapus");
		$approve 	= $this->input->post("approve");
		if($menu):
			$Menu = $menu;
		endif;
		if($tambah):
			$Tambah = $tambah;
		endif;
		if($ubah):
			$Ubah = $ubah;
		endif;
		if($hapus):
			$Hapus = $hapus;
		endif;
		if($approve):
			$Approve = $approve;
		endif;
		$Menu 		= json_encode($Menu);
		$Tambah 	= json_encode($Tambah);
		$Ubah 		= json_encode($Ubah);
		$Hapus 		= json_encode($Hapus);
		$Approve 	= json_encode($Approve);
		$data 		= array(
			'Name' 				=> $this->input->post("Name"),
			'HakAkses' 			=> str_replace(" ", "_", strtolower($this->input->post("Name"))),
			'Menu' 				=> $Menu,
			'Tambah' 	 		=> $Tambah,
			'Ubah' 	 			=> $Ubah,
			'Hapus' 	 		=> $Hapus,
			'Approve' 	 		=> $Approve,
			'Filter' 	 		=> json_encode($data_filter),
		);
		$this->hakakses->update(array('HakAksesID' => $this->input->post('HakAksesID')), $data);
		echo json_encode(array("status" => TRUE,"menu" => $menu, "cekboxID" => $cekboxID));

	}

	public function delete($id)
	{
		$this->hakakses->delete_by_id($id);
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
			$data['error_string'][] = 'Maaf nama hak_akses wajib di isi';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
