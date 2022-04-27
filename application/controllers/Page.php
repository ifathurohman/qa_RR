<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	var $HakAksesID = '';
	public function __construct()
	{
		parent::__construct();
		$this->main->cek_session();
		$this->HakAksesID 	= $this->session->HakAksesID;
	}

	public function icons(){
		$url_modul 	= $this->uri->segment(1); 
        $id_url 	= $this->main->GetMenuID($url_modul);
		$read 		= $this->main->read($id_url);
		if($read == 0): redirect(); endif;
		$data['title']  	= 'Icons';
		$data['modul']		= 'Icons';
		$data['url_modul']	= $url_modul;
		$data['content']	= 'backend/page/icons';
		$this->load->view('backend/index',$data);
	}
}