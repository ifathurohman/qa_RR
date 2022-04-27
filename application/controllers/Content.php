<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("M_content",'content');
		$this->main->cek_session();
	}
	public function index()
	{
	    #echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" style="display: none">';
		$tambah 	= "";
		$MenuID 	= $this->main->GetMenuID();
		$read 		= $this->main->read($MenuID);
		if($read == 0): redirect("dashboard"); endif;
		$MenuAdd = $this->main->menu_tambah($MenuID);
		if($MenuAdd > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="add_data()" >Add New Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'Post';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/content/modal';
		$data['form'] 			= 'backend/content/form';
		$data['content']		= 'backend/content/list';
		$data['modul'] 			= 'content';
		$data['url_modul']  	= $this->main->URLModul();
		$data['MenuID'] 		= $MenuID;
		$this->load->view('backend/index',$data);
	}
	public function page()
	{
		$tambah 	= "";
		$MenuID 	= $this->main->GetMenuID();
		$read 		= $this->main->read($MenuID);
		if($read == 0): redirect("dashboard"); endif;
		$MenuAdd = $this->main->menu_tambah($MenuID);
		if($MenuAdd > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="add_data()" >Add New Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'Page';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/content/modal';
		$data['form'] 			= 'backend/content/form';
		$data['content']		= 'backend/content/list';
		$data['modul'] 			= 'page';
		$data['url_modul']  	= $this->main->URLModul();
		$data['MenuID'] 		= $MenuID;
		$this->load->view('backend/index',$data);
	}
	public function faq()
	{
		$tambah 	= "";
		$MenuID 	= $this->main->GetMenuID();
		$read 		= $this->main->read($MenuID);
		if($read == 0): redirect("dashboard"); endif;
		$MenuAdd = $this->main->menu_tambah($MenuID);
		if($MenuAdd > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="add_data()" >Add New Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'FAQ';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/content/modal';
		$data['form'] 			= 'backend/content/form';
		$data['content']		= 'backend/content/list';
		$data['modul'] 			= 'faq';
		$data['url_modul']  	= $this->main->URLModul();
		$data['MenuID'] 		= $MenuID;
		$this->load->view('backend/index',$data);
	}
	public function experience()
	{
		$tambah 	= "";
		$MenuID 	= $this->main->GetMenuID();
		$read 		= $this->main->read($MenuID);
		if($read == 0): redirect("dashboard"); endif;
		$MenuAdd = $this->main->menu_tambah($MenuID);
		if($MenuAdd > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="add_data()" >Add New Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'Experience';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/content/modal';
		$data['form'] 			= 'backend/content/form';
		$data['content']		= 'backend/content/list';
		$data['modul'] 			= 'experience';
		$data['url_modul']  	= $this->main->URLModul();
		$data['MenuID'] 		= $MenuID;
		$this->load->view('backend/index',$data);
	}
	public function ajax_list()
	{
		$MenuID = $this->input->post("MenuID");
		$list 	= $this->content->get_datatables();
		$data 	= array();
		$no 	= $this->input->post("start");
		$i 		= 1;
		$Content_ubah 	= $this->main->menu_ubah($MenuID);
		$Content_hapus 	= $this->main->menu_hapus($MenuID);
		foreach ($list as $a) {
			if($Content_ubah > 0):
           		$ubah = '<li><a href="javascript:;" onclick="edit_data('.$a->ContentID.')"><i class="fa fa-pencil p-r-10"></i> Edit</a></li>';
			else:
				$ubah = ""; 
			endif;
			if($Content_hapus > 0):
           		$hapus = '<li><a  href="javascript:;" onclick="delete_data('.$a->ContentID.')"><i class="fa fa-trash p-r-10"></i> Delete</a></li>';
			else: 
				$hapus = ""; 
			endif;
			$Category = $a->Category;
			if($Category == "mobile_transport"):
				$Category = "mobile-transport";
			endif;
			$url_page 	= $a->ContentID." ".$a->Name;
			$url_page 	= str_replace(" ", "-", $url_page);
			$url_page 	= site_url($Category."/".$url_page);
            $Link   	= $a->ContentID."-".$this->main->link($a->Name);
            $Link 		= site_url("blog/detail/".$Link);
            if($a->Type == "content"):
            	$Link 	= $Link;
            elseif($a->Type == "experience"):
            	$Link 	= site_url("experience/".$a->Link);
            elseif($a->Type == "page"):
            	if($a->Link == ""):
            		$Link = $this->main->link($a->Name);
            	else:
            		$Link = $a->Link;
            	endif;
				$Link = site_url($Link); 
            else:
            	$Link 	= "#";
            endif;
			$view 	 	= '<a href="'.$url_page.'" class="btn btn-white" target="_blank">view</a>';
			

            $btn = '<div class="btn-group">';
			$btn .= '<button type="link" class="btn btn-white dropdown-toggle waves-effect no-border" data-toggle="dropdown" aria-expanded="true"> <i class="i-edit fas fa-ellipsis-h font-15"></i></button>';
			$btn .= '<ul class="dropdown-menu">';
			$btn .= $ubah;
			$btn .= '<li><a href="'.$Link.'" target="_blank"><i class="fa fa-eye p-r-10"></i> View</a></li>';
			$btn .= $hapus;
			$btn .= '</ul>';
			$btn .= '</div>';
            $div  = '<div class="item">';
            if($a->Image):
	            $div .= '<div class="header"><img src="'.$a->Image.'" ></div>';
	        endif;
	        $Category = "";
	        if($a->Type != "page"):
	        	$Category = $this->main->category_label($a->Category);
	        endif;

	        $div .= '<div class="body">';
            $div .= '<div class="content">';
            $div .= '<div class="title">'.nonscript($a->Name).'</div>';
            $div .= '<div class="date">'.$a->Author." - ".$this->main->time_elapsed_string($a->DateModify).'</div>';
            $div .= '<div class="status">'.$this->main->publish_label($a->ActiveLabel).$Category.'</div>';
            $div .= '</div>';
            $div .= '<div class="action">';
            $div .= $btn;
            $div .= '</div>';
            $div .= '</div>';
            $div .= '</div>';
			$no++;
			$row 	= array();
			$row[] 	= '';
			// $row[] 	= "";
			$row[] 	= $div;
			// $row[] 	= $a->Category;
			// $row[] 	= $a->Date;
			// $row[] 	= $this->main->publish_label($a->ActiveLabel);
			// $row[] 	= $button;		
			$data[] = $row;
		}
		$output = array(
			"draw"  		  => $this->input->post("draw"),
			"recordsTotal" 	  => $this->content->count_all(),
			"recordsFiltered" => $this->content->count_filtered(),
			"data"			  => $data,
		);
		echo json_encode($output);
	}

	public function edit($id)
	{
		$data = $this->content->get_by_id($id);
		echo $this->main->echoJson($data);
	}
	public function save()
	{
		$this->validation->content();
		$nama 						= $this->input->post("Name");
		$Link 						= $this->input->post("Link");
		if($Link == ""){
			$Link = $this->main->link($nama);
		}
		$nmfile 					= 'idiot_image_'.$nama."_".time();
		$config['upload_path'] 		= './img/content'; //path folder 
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
		$config['max_size'] 		= '2000';
		$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
		$this->upload->initialize($config); 
		$upload 					= $this->upload->do_upload('Image');
		$gbr 						= $this->upload->data();
		$data = array(
			'UserID'				=> $this->session->UserID,
			'Code'					=> $this->input->post('Code'),
			'Type'					=> $this->input->post('Type'),
			'Category'				=> $this->input->post('Category'),
			'CategoryStatus'		=> $this->input->post('CategoryStatus'),
			'Name' 					=> $this->input->post('Name'),
			'Link'					=> $Link,
			'NameColor' 			=> $this->input->post('NameColor'),
			'Summary'				=> $this->input->post("Summary"),
			'Description' 			=> $this->input->post("Description"),
			'Template'				=> $this->input->post("Template"),
			'Permission'			=> json_encode($this->input->post('Permission')),
			'Date'					=> date("Y-m-d",strtotime($this->input->post("Date"))),
			'Active' 				=> $this->input->post('Active'),	
		);
		if($upload): 		
			$image 				= "img/content/".$gbr['file_name'];
			$data['Image']		= $image;
			$data['ImageUrl']	= $image;
			$image 				= site_url($image);
		endif;
		$insert = $this->content->save($data);
		header('Content-Type: application/json');
		$output = array("status" 	=> TRUE, "message"	=> "" );
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	public function update()
	{
		$this->validation->content();
		$nama 						= $this->input->post("Name");
		$Link 						= $this->input->post("Link");
		if($Link == ""){
			$Link = $this->main->link($nama);
		}
		$nmfile 					= 'idiot_image_'.$nama."_".time();
		$config['upload_path'] 		= './img/content'; //path folder 
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
		$config['max_size'] 		= '99999'; //maksimum besar file 2M 
		$config['max_width'] 		= '99999'; //lebar maksimum 1288 px 
		$config['max_height'] 		= '99999'; //tinggi maksimu 768 px 
		$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
		$this->upload->initialize($config); 
		$upload 					= $this->upload->do_upload('Image');
		$gbr 						= $this->upload->data();
		$id 	= $this->input->post('ContentID');
		$data 	= array(
			'Type'					=> $this->input->post('Type'),
			'Category'				=> $this->input->post('Category'),
			'CategoryStatus'		=> $this->input->post('CategoryStatus'),
			'Name' 					=> $this->input->post('Name'),
			'Link'					=> $Link,
			'NameColor' 			=> $this->input->post('NameColor'),
			'Summary'				=> $this->input->post("Summary"),
			'Description' 			=> $this->input->post("Description"),
			'Template'				=> $this->input->post("Template"),
			'Permission'			=> json_encode($this->input->post('Permission')),
			'Date'					=> date("Y-m-d",strtotime($this->input->post("Date"))),
			'Active' 				=> $this->input->post('Active'),			
		);
		if($this->input->post('Category')):
			$data['Category'] = $this->input->post('Category');
		endif;
		if($upload): 		
			$image 				= "img/content/".$gbr['file_name'];
			$data['Image']		= $image;
			$data['ImageUrl']	= $image;
			$image 				= site_url($image);
			$this->content->hapus_img($id);
		endif;
		$this->content->update(array('ContentID' => $this->input->post('ContentID')), $data);
		header('Content-Type: application/json');
		$output = array("status" 	=> TRUE, "message"	=> "" );
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	public function delete($id)
	{
		$this->content->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
}
