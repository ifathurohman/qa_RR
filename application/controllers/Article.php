<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("M_article",'article');
		$this->main->cek_session();
	}
	public function index()
	{
		$tambah 	= "";
		$url_modul 	= $this->uri->segment(1); 
		$id_url 	= $this->main->GetMenuID();
		$read 		= $this->main->read($id_url);
		if($read == 0): redirect(); endif;
		$admin_tambah = $this->main->menu_tambah($id_url);
		if($admin_tambah > 0):
            // $tambah = '<button type="button" class="btn btn-default" onclick="tambah()" >Add New Data</button>';
            $tambah = '<button type="button" class="btn btn-white" onclick="tambah()" >Add New Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= 'Our Article';
		$data['tambah'] 		= $tambah;
		$data['modal'] 			= 'backend/article/modal';
		$data['content']		= 'backend/article/list';
		$data['modul'] 			= 'article';
		$data['url_modul']  	= $url_modul;
		$data["data"]    		= $this->article->getArticle();
		$this->load->view('backend/index',$data);
	}
	public function ajax_list()
	{
		$url 	= $this->uri->segment(1); 
		$id_url = $this->main->GetMenuID($url);
		$list 	= $this->article->get_datatables();
		$data 	= array();
		$no 	= $this->input->post("start");
		$i 		= 1;
		foreach ($list as $a) {
			$Article_ubah 		= $this->main->menu_ubah($id_url);
			$Article_hapus 		= $this->main->menu_hapus($id_url);
			if($Article_ubah > 0):
           	$ubah = '<a href="javascript:void(0)" type="button" class="btn btn-white btn-edit" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$a->ArticleID."'".')">edit</a>';
			else:
				$ubah = ""; 
			endif;
			if($Article_hapus > 0):
           	$hapus = '<a href="javascript:void(0)" type="button" class="btn btn-white btn-delete" title="Hapus" onclick="hapus('."'".$a->ArticleID."'".')">delete</a>';
			else: 
				$hapus = ""; 
			endif;

			$Category = $a->Category;
			if($Category == "mobile_transport"):
				$Category = "mobile-transport";
			endif;

			$url_page = $a->ArticleID." ".$a->Name;
			$url_page = str_replace(" ", "-", $url_page);
			$url_page = site_url($Category."/".$url_page);

			$view 	 = '<a href="'.$url_page.'" class="btn btn-white" target="_blank">view</a>';

			if($a->Category == "page"):
				$hapus = "";
			endif;

			$button  = '<div class="btn-group btn-group-xs" aria-label="Basic example" role="group">';
            // $button .= $view;
            $button .= $ubah;
            $button .= $hapus;
            $button .= '</div>';

            $Image = '';
           	if($a->Image):
           		$Image = '<img src="'.$a->Image.'" style="width:120px;height:120px;object-fit:cover;background-position: center;"/>';
           	else:
           		$Image = '<img src="'.base_url('/aset/img/default.png').'" style="width:120px;height:120px;object-fit:cover;background-position: center;"/>';
           	endif;

			$no++;
			$row 	= array();
			$row[] 	= $i++;
			$row[] 	= $a->Name;
			// $row[] 	= $a->Category;
			$row[] 	= $a->Date;
			$row[] 	= $a->Keywords;
			$row[] 	= $Image;
			$row[] 	= $this->main->publish_label($a->ActiveLabel);
			$row[] 	= $button;		
			$data[] = $row;
		}
		$output = array(
			"draw"  		  => $this->input->post("draw"),
			"recordsTotal" 	  => $this->article->count_all(),
			"recordsFiltered" => $this->article->count_filtered(),
			"data"			  => $data,
		);
		echo json_encode($output);
	}

	public function edit($id)
	{
		$data = $this->article->get_by_id($id);
		echo json_encode($data);
	}
	public function save()
	{
		$this->validation->article();
		$nama 						= $this->input->post("Name");
		$nmfile 					= 'Rumah singgah ibu hamil - Rumah aman ibu hamil'."_".$nama."_".time();
		$config['upload_path'] 		= './img/article'; //path folder 
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
		$config['max_size'] 		= '99999'; //maksimum besar file 2M 
		$config['max_width'] 		= '99999'; //lebar maksimum 1288 px 
		$config['max_height'] 		= '99999'; //tinggi maksimu 768 px 
		$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
		$this->upload->initialize($config); 
		$upload 					= $this->upload->do_upload('Image');
		$gbr 						= $this->upload->data();

		$CategoryID 	= $this->main->checkvalue($this->input->post("CategoryID"));
		$keywords 		= $this->input->post('Keywords');

		if(!$keywords): // ini buat inputannya yg tidak diisi
			$keywords   = 'Rumah singgah ibu hamil - Rumah aman ibu hamil'; // auto generate
		endif;

		$data = array(
			'UserID'				=> $this->session->UserID,
			"Code"					=> $this->main->code_article("PS_Module","Code",0,"10"),
			'Category'				=> $this->input->post('Category'),
			"CategoryID"			=> $CategoryID,
			'Name' 					=> $this->input->post('Name'),
			'Summary'				=> $this->input->post("Summary"),
			'Description' 			=> $this->input->post("Description"),
			'keywords' 				=> $keywords,
			'Date'					=> date("Y-m-d",strtotime($this->input->post("Date"))),
			'Active' 				=> $this->input->post('Active'),	
		);

		$Nameeng 		= $this->input->post('Nameeng');
		$Summaryeng 	= $this->input->post('Summaryeng');
		$descritioneng 	= $this->input->post('descritioneng');
		$Keywordseng 	= $this->input->post('Keywordseng');

		if(!$Keywordseng): // ini buat inputannya yg tidak diisi
			$Keywordseng   = 'Rumah singgah ibu hamil - Rumah aman ibu hamil'; // auto generate
		endif;

		if(!$Nameeng): $Nameeng = null; endif;
		if(!$Summaryeng): $Summaryeng = null; endif;
		if(!$descritioneng): $descritioneng = null; endif;
		if(!$Keywordseng): $Keywordseng = null; endif;

		$data_eng = array(
			'UserID'				=> $this->session->UserID,
			'Category'				=> $this->input->post('Category'),
			'CategoryID'			=> $CategoryID,
			'Name' 					=> $Nameeng,
			'Summary'				=> $Summaryeng,
			'Description' 			=> $descritioneng,
			'keywords' 				=> $Keywordseng,
			'Date'					=> date("Y-m-d",strtotime($this->input->post("Date"))),
			'Active' 				=> $this->input->post('Active'),
			"Language"	 			=> 2,
		);

		if($upload): 		
			$image 				= "img/article/".$gbr['file_name'];
			$data['Image']		= $gbr['file_name'];
			$data['ImageUrl']	= $image;
			$data_eng['Image']		= $gbr['file_name'];
			$data_eng['ImageUrl']	= $image;
			$image 				= site_url($image);
		endif;
		$insert = $this->article->save($data);
		$data_eng['Code'] 	  = $this->main->code_article("PS_Module","Code",0,"10");
		$data_eng['ParentID'] = $insert;
		$id 	= $this->article->save($data_eng);

		$email_member = $this->api->email_member();
		$this->api->send_email("send_artice",$insert,"",$email_member,"loop");
		header('Article-Type: application/json');
		$output = array(
			"status" 	=> TRUE,
			"message"	=> "success"
		);
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	public function test(){
		$email_member = $this->api->email_member();
		// $email_member = $this->api->email_member();
		$this->api->send_email("send_artice",131,"",$email_member,"loop");
	}
	public function show_article(){
		$insert = 131;
		$email_member = $this->api->email_member();
		$this->main->echoJson($email_member);
		// $this->main->send_email("send_artice",$insert,"",$email_member,"loop");
	}
	public function update()
	{
		$this->validation->article();
		$nama 						= $this->input->post("Name");
		$nmfile 					= 'Rumah singgah ibu hamil - Rumah aman ibu hamil'."_".$nama."_".time();
		$config['upload_path'] 		= './img/article'; //path folder 
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
		$config['max_size'] 		= '99999'; //maksimum besar file 2M 
		$config['max_width'] 		= '99999'; //lebar maksimum 1288 px 
		$config['max_height'] 		= '99999'; //tinggi maksimu 768 px 
		$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
		$this->upload->initialize($config); 
		$upload 					= $this->upload->do_upload('Image');
		$gbr 						= $this->upload->data();
		$id 						= $this->input->post('ArticleID');

		$CategoryID = $this->main->checkvalue($this->input->post("CategoryID"));
		$keywords 		= $this->input->post('Keywords');

		if(!$keywords): // ini buat inputannya yg tidak diisi
			$keywords   = 'Rumah singgah ibu hamil - Rumah aman ibu hamil'; // auto generate
		endif;

		$data 	= array(
			// "Code"					=> $this->main->code_product("PS_Module","Code",0,"10"),
			'Name' 					=> $this->input->post('Name'),
			'CategoryID'			=> $CategoryID,
			'Summary'				=> $this->input->post("Summary"),
			'Description' 			=> $this->input->post("Description"),
			'keywords' 				=> $keywords,
			'Date'					=> date("Y-m-d",strtotime($this->input->post("Date"))),
			'Active' 				=> $this->input->post('Active'),			
		);

		$Nameeng 		= $this->input->post('Nameeng');
		$Summaryeng 	= $this->input->post('Summaryeng');
		$descritioneng 	= $this->input->post('descritioneng');
		$Keywordseng 	= $this->input->post('Keywordseng');

		if(!$Keywordseng): // ini buat inputannya yg tidak diisi
			$Keywordseng   = 'Rumah singgah ibu hamil - Rumah aman ibu hamil'; // auto generate
		endif;

		if(!$Nameeng): $Nameeng = null; endif;
		if(!$Summaryeng): $Summaryeng = null; endif;
		if(!$descritioneng): $descritioneng = null; endif;
		if(!$Keywordseng): $Keywordseng = null; endif;

		$data_eng = array(
			'Category'				=> $this->input->post('Category'),
			'CategoryID'			=> $CategoryID,
			'Name' 					=> $Nameeng,
			'Summary'				=> $Summaryeng,
			'Description' 			=> $descritioneng,
			'keywords' 				=> $Keywordseng,
			'Date'					=> date("Y-m-d",strtotime($this->input->post("Date"))),
			'Active' 				=> $this->input->post('Active'),
			"Language"	 			=> 2,
		);

		if($this->input->post('Category')):
			$data['Category'] = $this->input->post('Category');
		endif;
		if($upload): 		
			$image 				= "img/article/".$gbr['file_name'];
			$data['Image']		= $gbr['file_name'];
			$data['ImageUrl']	= $image;
			$data_eng['Image']		= $gbr['file_name'];
			$data_eng['ImageUrl']	= $image;
			$image 				= site_url($image);
			$this->article->hapus_img($id);
		endif;
		$this->article->update(array('ArticleID' => $this->input->post('ArticleID')), $data);

		$ArticleIDeng = $this->input->post("ArticleIDeng");
		if($ArticleIDeng):
			$this->article->update(array('ParentID' => $this->input->post('ArticleID')), $data_eng);
		else:
			$data_eng['UserID']   = $this->session->UserID;
			$data_eng['Code'] 	  = $this->main->code_article("PS_Module","Code",0,"10");
			$data_eng['ParentID'] = $id;
			$insert = $this->article->save($data_eng);
		endif;

		header('Article-Type: application/json');
		$output = array(
			"status" 	=> TRUE,
			"message"	=> ""
		);
        echo json_encode($output,JSON_PRETTY_PRINT);  
	}
	public function delete($id)
	{
		$this->article->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
	 public function getArticle(){
        $query = $this->article->getArticle_active();
        if($query->num_rows()>0):
            $res["success"] = 1;
            $res["data"]    = $query->result();
        else:
            $res["success"] = 0;
        endif;

        echo json_encode($res);
    }
        public function getDetail_article($id){
        $this->db->select('ArticleID,Name,Description,Active,Image,ImageUrl');
        $this->db->where('ArticleID', $ArticleID);
        $query = $this->db->get("Article");
        return $query->row();
    }
}
