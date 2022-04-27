<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("M_product",'product');
		$this->main->cek_session();
	}
	public function index()
	{
	    #echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" style="display: none">';
		$tambah 	= "";
		$MenuID 	= $this->main->GetMenuID();
		$read 		= $this->main->read($MenuID);
		if($read == 0): redirect("dashboard"); endif;
		$admin_tambah = $this->main->menu_tambah($MenuID);
		if($admin_tambah > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="add_data()" >Add New Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'Product';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/product/modal';
		$data['form'] 			= 'backend/product/form';
		$data['content']		= 'backend/product/list';
		$data['modul'] 			= 'product';
		$data['url_modul']  	= '';
		$data['MenuID']  		= $MenuID;
		$this->load->view('backend/index',$data);
	}
	public function ajax_list()
	{
		$MenuID = $this->input->post("MenuID");
		$list 	= $this->product->get_datatables();
		$data 	= array();
		$no 	= $this->input->post("start");
		$i 		= 1;
		$Content_ubah 	= $this->main->menu_ubah($MenuID);
		$Content_hapus 	= $this->main->menu_hapus($MenuID);
		foreach ($list as $a) {
			if($Content_ubah > 0):
           		$ubah = '<li><a href="javascript:;" onclick="edit_data('.$a->ProductID.')"><i class="fa fa-pencil p-r-10"></i> Edit</a></li>';
			else:
				$ubah = ""; 
			endif;
			if($Content_hapus > 0):
           		$hapus = '<li><a  href="javascript:;" onclick="delete_data('.$a->ProductID.')"><i class="fa fa-trash p-r-10"></i> Delete</a></li>';
			else: 
				$hapus = ""; 
			endif;
			$Category = $a->Category;
			if($Category == "mobile_transport"):
				$Category = "mobile-transport";
			endif;
			$url_page 	= $a->ProductID." ".$a->Name;
			$url_page 	= str_replace(" ", "-", $url_page);
			$url_page 	= site_url($Category."/".$url_page);

            $Link   	= $this->main->link($a->Name);
            $Link 		= site_url("product/detail/".$Link);
    
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
        	$Category = $this->main->category_label($a->CategoryName);

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
			"recordsTotal" 	  => $this->product->count_all(),
			"recordsFiltered" => $this->product->count_filtered(),
			"data"			  => $data,
		);
		echo json_encode($output);
	}

	public function edit($id)
	{
		$a = $this->product->get_by_id($id);

		$data = array(
		    "ProductID"=> $a->ProductID,
		    "UserID"=> $a->UserID,
		    "Code"=> $a->Code,
		    "Link"=> $a->Link,
		    "Name"=> $a->Name,
		    "NameColor"=> $a->NameColor,
		    "Image"=> $a->Image,
		    "ImageUrl"=> $a->ImageUrl,
		    "ImageStatus"=> $a->ImageStatus,
		    "Type"=> $a->Type,
		    "Category"=> $a->Category,
		    "CategoryID"=> $a->CategoryID,
		    "CategoryStatus"=> $a->CategoryStatus,
		    "Date"=> $a->Date,
		    "Location"=> $a->Location,
		    "Summary"=> $a->Summary,
		    "Description"=> $a->Description,
		    "Permission"=> $a->Permission,
		    "Template"=> $a->Template,
		    "Active"=> $a->Active,
		    "UserAdd"=> $a->UserAdd,
		    "UserCh"=> $a->UserCh,
		    "DateAdd"=> $a->DateAdd,
		    "DateCh"=> $a->DateCh,
		    "Author"=> $a->Author,
		    "DateModify"=> $a->DateModify,
		    "ListImage" => $this->product->list_product_image($id),
		);

		echo $this->main->echoJson($data);
	}
	public function save()
	{
		$this->validation->product("save");
		$ImageB64 					= $this->input->post("ImageB64");
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
			'Category'				=> 'product',
			'CategoryID'			=> $this->input->post('CategoryID'),
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
			'ImageStatus' 			=> $this->input->post('ImageStatus'),			
		);
		if($upload): 		
			$image 				= "img/content/".$gbr['file_name'];
			$data['Image']		= $image;
			$data['ImageUrl']	= $image;
			$image 				= site_url($image);
		endif;
		$ProductID = $this->product->save($data);

		if(count($ImageB64) > 0):
			foreach($ImageB64 as $key => $a):
				$data_image = array(
					"Key" 			=> $key,
					"ProductID" 	=> $ProductID,
					"ImageBase64" 	=> $a,
				);
				$this->ProductImageSave($data_image);
			endforeach;
		endif;
		header('Content-Type: application/json');
		$output = array("status" 	=> TRUE, "message"	=> "" );
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	private function ProductImageSave($a){
		$filename  = 'id iot image'.date('Ymdhis').$a['Key'];
		$SeoImage  = '';
		$SeoText   = '';
		$ProductID = $a['ProductID'];
		$b = $this->product->get_by_id($ProductID,'Category');
		if($b):
			$SeoImage = $b->SeoImage;
			$SeoText  = $b->SeoText;
			$FileName = $SeoText." ".$filename;
		endif;
		$img 	  	 	= $a['ImageBase64'];
		$image_parts 	= explode(";base64,", $img);
	    $image_type_aux = explode("image/", $image_parts[0]);
	    $image_type 	= $image_type_aux[1];
	    $image_base64 	= base64_decode($image_parts[1]);
		$filename = $this->main->clean($filename);
		$filename = $SeoImage.$filename;
		$filename = 'img/product/'.$filename.'.jpg';
		$file  	  = APPPATH . '../'.$filename;
	    file_put_contents($file, $image_base64);

		$data['Name'] 		 = $FileName;
		$data['Image'] 		 = $filename;
		$data['ProductID'] 	 = $ProductID;
		$data['ImageBase64'] = $a['ImageBase64'];
		$data['UserAdd'] 	 = $this->session->Name;
		$data['DateAdd'] 	 = date("Y-m-d H:i:s");
		$this->db->insert("ProductImage",$data);
	}
	public function update()
	{
		$this->validation->product("update");
		$ImageB64 					= $this->input->post("ImageB64");
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
		$id 	= $this->input->post('ProductID');
		$data 	= array(
			'Type'					=> $this->input->post('Type'),
			'Category'				=> 'product',
			'CategoryID'			=> $this->input->post('CategoryID'),
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
			'ImageStatus' 			=> $this->input->post('ImageStatus'),			
		);
		if($this->input->post('Category')):
			$data['Category'] = $this->input->post('Category');
		endif;
		if($upload): 		
			$image 				= "img/content/".$gbr['file_name'];
			$data['Image']		= $image;
			$data['ImageUrl']	= $image;
			$image 				= site_url($image);
			$this->main->hapus_gambar('Product','Image',array('ProductID'=>$id));
		endif;
		$ProductID = $this->input->post('ProductID');
		$this->product->update(array('ProductID' => $ProductID), $data);
		if(count($ImageB64) > 0):
			foreach ($ImageB64 as $key => $a):
				$data_image = array(
					"Key" 			=> $key,
					"ProductID" 	=> $ProductID,
					"ImageBase64" 	=> $a,
				);
				$this->ProductImageSave($data_image);
			endforeach;
		endif;
		header('Content-Type: application/json');
		$output = array("status" 	=> TRUE, "message"	=> "" );
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	public function delete($id)
	{
		$this->remove_attachment($id,'all');
		$this->product->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function remove_attachment($id = "",$modul = ""){
		$status 	= FALSE;
		$message 	= 'Delete product image failed';
		if($id):
			if($modul == "all"):
				$list = $this->product->list_product_image($id);
				foreach($list as $a):
					$this->main->hapus_gambar('ProductImage','Image',array('ProductImageID'=>$a->ProductImageID));
					$this->db->where("ProductImageID",$a->ProductImageID);
					$this->db->delete("ProductImage");
				endforeach;
			else:
				$this->main->hapus_gambar('ProductImage','Image',array('ProductImageID'=>$id));
				$this->db->where("ProductImageID",$id);
				$this->db->delete("ProductImage");
			endif;
			$status 	= TRUE;
			$message 	= 'Delete product image success';
		endif;
		if($modul == "all"):
			
		else:
			$output = array(
				"Status" => $status,
				"Message" => $message,
			);
			echo json_encode($output);

		endif;
	}
	
}
