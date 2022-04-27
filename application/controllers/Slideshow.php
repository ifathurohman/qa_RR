
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slideshow extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->main->cek_session();
		$this->load->library('upload');
		$this->load->model('M_slideshow', 'slideshow');
	}
	public function index()
	{
		$url_modul 	= $this->uri->segment(1); 
		$id_url 	= $this->main->GetMenuID($url_modul);
		$read 		= $this->main->read($id_url);
		if($read == 0): redirect(); endif;

		$attachment  = $this->main->label_attachment();
		$format 	 = $attachment["format"];

		#ini untuk session halaman aturan user privileges;
		$data["ID"] 			= 0; 
		$data["Type"] 			= 1;
		$data["format"]			= $format;
		$data["from"]			= $this->label_from();
		$data['title']  		= 'Gallery & Header';
		$data['content']		= 'backend/slideshow/list';
		$this->load->view('backend/index',$data);
	}

	private function label_from($ID=""){
		$label = $this->input->get("type");
		$title = '';
		if($label == "selling"):
			$label 		= '<a href="'.site_url()."selling".'">Selling</a>';
			$title 		= "Attachment Selling Transaction No ".$ID;
		else:
			$label = '<a href="#">Master</a>';
			$title = 'Attachment';
		endif;
		$data = array($label,$title);
		return $data;
	}

	public function save(){
		$ID 	= $this->input->post("ID");
		$Type 	= $this->input->post("Type");

		if($Type == "selling"):
			$config['allowed_types'] 	= '*';
		else:
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan
		endif;
		$config['upload_path'] 		= 'img/gallery/'; //path folder 
		$config['max_size'] 		= '9999'; //maksimum besar file 2M 
		$config['max_width'] 		= '9999'; //lebar maksimum 1288 px 
		$config['max_height'] 		= '9999'; //tinggi maksimu 768 px 

		$files = $_FILES;
		$data_res = array();
	    for($i=0; $i< count($_FILES['photo']['name']); $i++)
	    {           
	        $_FILES['userfile']['name']= $files['photo']['name'][$i];
	        $_FILES['userfile']['type']= $files['photo']['type'][$i];
	        $_FILES['userfile']['tmp_name']= $files['photo']['tmp_name'][$i];
	        $_FILES['userfile']['error']= $files['photo']['error'][$i];
	        $_FILES['userfile']['size']= $files['photo']['size'][$i];

	       	$nmfile 					= 'Rumah singgah ibu hamil - Rumah aman ibu hamil'."_".time();
	        $config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
	        $this->upload->initialize($config);
	        $upload =  $this->upload->do_upload();
	        $resizeImage = '';
	    	$gbr 	= $this->upload->data();
	    	if($files['photo']['size'][$i]>2000000):
	        	$info = getimagesize($_FILES["photo"]["tmp_name"][$i]);
	        	// $resizeImage = $this->main->resizeImage2($gbr['file_name'],'./img/slider/',$info);
	        endif;
			$querycek 	= "";
			
			$cek 		= $this->db->count_all("Slider where Type='$Type' $querycek ");
			
			if($cek == 0):
				$cek = 1;
			else:
				$cek = 0;
			endif;
			$data = array(
				"Cek" 				=> $cek,
				"Type"				=> $Type,
				"UserAdd" 			=> $this->session->Name,
				"DateAdd" 			=> date("Y-m-d H:i:s"),
				"Active"			=> 1,
			);
			if($upload): 		
				$image 				= "img/gallery/".$gbr['file_name'];
				$data['ImageUrl']	= $image;
				$this->db->insert("Slider",$data);
				$SlideID = $this->db->insert_id();
				
				$fileType 	= $this->main->type_file($image);
				$url 		= $image;
				$url_file 	= site_url($image);
				if($fileType != "image"):
				 	$url = $this->main->icon_file($fileType);
			   	endif;

				$res = array(
					"status" 		=> TRUE,
					"pesan" 		=> "Saving data success",
					"SliderID" 		=> $SlideID,
					'ID'			=> $ID,
					"url_photo" 	=> site_url($url),
					"url_file" 		=> $url_file,
					"caption" 		=> "",
					"Active"		=> 1,
					"cek"			=> $cek,
				);
				array_push($data_res, $res);
			else:
				$res = array(
					"status" => FALSE,
					"pesan"  => "Error upload file",
					"error"  => $this->upload->display_errors()
					);
				array_push($data_res, $res);
			endif;
	    }

		$res = array(
			'status'	=> true,
			'ID' 		=> $ID,
			'Type' 		=> $Type,
		);

		$this->main->echoJson($data_res);
	}

	public function ajax_update(){
		$SliderID 					= $this->input->post("SliderID");
		$Type 						= $this->input->post("Type");
		$Type2 						= $this->input->post("Type2");
		$cek 						= 1;


 		$nmfile 					= 'Rumah singgah ibu hamil - Rumah aman ibu hamil'."_".time();
		$config['upload_path'] 		= 'img/gallery'; //path folder 
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
		$config['max_size'] 		= '99999'; //maksimum besar file 2M 
		$config['max_width'] 		= '99999'; //lebar maksimum 1288 px 
		$config['max_height'] 		= '99999'; //tinggi maksimu 768 px 
		$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
		$this->upload->initialize($config); 
		$upload 					= $this->upload->do_upload('photo2');
		$gbr 						= $this->upload->data();

		$data = array(
			"Type"				=> $Type,
			"Type2"				=> $Type2,
			"UserAdd" 			=> $this->session->Name,
			"DateAdd" 			=> date("Y-m-d H:i:s")
		);
		if($upload): 		
			$image 				= "img/gallery".$gbr['file_name'];
			$data['ImageUrl']	= $image;
			$image 				= site_url($image);
			$crud 				= "update";
			$this->slideshow->delete_file($SliderID);
			$this->db->where("SliderID",$SliderID);
			$this->db->update("Slider",$data);
			echo json_encode(
				array(
					"status" 	=> TRUE,
					"pesan"	 	=> "Saving data success",
					"berhasil" 	=> 1,
					"id" 		=> $SliderID,
					"url" 		=> $image,
					"caption" 	=> "",
					"cek" 		=> $cek,
					'crud' 		=> $crud,
					'type'		=> $Type,
					'type2' 	=> $Type2
				));
		else:
			echo json_encode(array("status" => FALSE,"pesan" => "tes aja"));
		endif;
	}

	public function list($Type,$ID){
		$list = $this->slideshow->get_slideshow($Type);
		$data  = array();
		foreach($list as $a):
			$fileType	= $this->main->type_file($a->ImageUrl);
			$url 		= $a->ImageUrl;
			$url_file 	= $a->ImageUrl;
			if($fileType != "image"):
			 	$url = $this->main->icon_file($fileType);
		   	endif;

			$b["SliderID"]	= $a->SliderID;
			$b["url_photo"] 	= site_url($url);
			$b["url_file"] 		= site_url($url_file);
			$b["Active"]		= $a->Active;
			$b["cek"] 			= $a->Cek;
			$b["caption"] 		= "";
			array_push($data, $b);
		endforeach;
		$this->main->echoJson($data);
	}

	public function header_list(){
		$list = $this->slideshow->get_slideshow(2);
		$data  = array();
		foreach($list as $a):
			$fileType		 = $this->main->type_file($a->ImageUrl);
			$url 		= $a->ImageUrl;
			$url_file 	= $a->ImageUrl;
			if($fileType != "image"):
			 	$url  		= '/aset/img/default.png';
			 	$url_file 	= '/aset/img/default.png';
		   	endif;

			$b["SliderID"]		= $a->SliderID;
			$b["url_photo"] 	= site_url($url);
			$b["url_file"] 		= site_url($url_file);
			$b["Active"]		= $a->Active;
			$b['Type2'] 		= $a->Type2;
			$b["cek"] 			= $a->Cek;
			$b["caption"] 		= "";
			array_push($data, $b);
		endforeach;
		$this->main->echoJson($data);
	}

	public function ajax_edit($id){
		$list = $this->slideshow->get_by_id($id);

		$output = array(
			'data'	=> $list,
		);

		$this->main->echoJson($output);
	}

	public function active(){
        $Type           = $this->input->post("Type");
        $cek            = $this->input->post("cek");
        $caption        = $this->input->post("caption");
        $Active         = $this->input->post("Active");
        $SliderID   	= $this->input->post("SliderID");
        
        if($Active == 1):
        	$Active = 0;
        else:
        	$Active = 1;
        endif;

        $this->db->set("Active",$Active); 
        $this->db->where("SliderID",$SliderID);
        $this->db->update("Slider");
        echo json_encode(array("status" => TRUE));
    }

    public function delete($SliderID){
        $this->slideshow->delete_file($SliderID);
        $this->slideshow->delete_file($SliderID,"ImageUrlCrop");
        $this->db->where("SliderID",$SliderID);
        $this->db->delete("Slider");
        echo json_encode(array("status" => TRUE));
    }

    public function save_crop(){
    	$SliderID 	= $this->input->post('id');
    	$img 		= $this->input->post('img');
    	$img 		= str_replace('data:image/png;base64,', '', $img);

    	$nmfile 	= $this->main->penamaan_file("slider-crop"."-".time().".png");
    	$nmfile  	= 'img/gallery/crop/'.$nmfile;
    	$decoded 	= base64_decode($img);
		file_put_contents($nmfile,$decoded);

		$this->slideshow->delete_file($SliderID,"ImageUrlCrop");

		$data = array(
			"ImageUrlCrop"	=> $nmfile,
		);
		$this->db->where("SliderID",$SliderID);
		$this->db->update("Slider",$data);

    	$res = array(
    		'status' 	=> true,
    		'message'	=> 'crop data success',
    	);

    	$this->main->echoJson($res);
    }

    public function delete_crop($id){
    	$this->slideshow->delete_file($id,"ImageUrlCrop");
    	$data = array(
    		"ImageUrlCrop"	=> null,
    	);
    	$this->db->where("SliderID", $id);
    	$this->db->update("Slider",$data);

    	$res = array(
    		'status' 	=> true,
    	);

    	$this->main->echoJson($res);

    }
}
