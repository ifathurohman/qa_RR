<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	var $main_title;
	var $desc ="Rumah ruth (Yayasan Rumah Tumbuh Harapan) Dimulai dari kerinduan melihat kehidupan orang-orang diubahkan, dan visi yang Tuhan taruh didalam hati dan mimpi.";
    var $image = "";
    var $keywords ="Rumah singgah ibu hamil - Rumah aman ibu hamil";
    var $SeoText = null;
    var $date 	 = "";
	function __construct() {
        parent::__construct();
        $this->main_title = $this->main->set_('SiteTitle');
    }
	public function index()
	{
		if(!$this->session->bahasa):
            $this->session->set_userdata("bahasa","indonesia");
            redirect();
        endif;
        $this->session->set_userdata("index","frontend");
  //       $language 	= $this->session->bahasa;
		// if($language == "indonesia"):
		// 	$x = $this->api->getSlideshow("active");
		// else:
		// 	$x = $this->api->getSlideshoweng("active");
		// endif;
		$page_name		 	= "Home - Rumah Ruth (Yayasan Rumah Tumbuh Harapan)";
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"]	= $page_name;
		$data["content"] 	= "frontend/page/home";
		// $data["data"]    	= $x;
		$this->load->view('frontend/index',$data);
	}
	public function article()
	{
		$language 	= $this->session->bahasa;

		if($language == "indonesia"):
			$d = $this->api->getArticle("active");
		else:
			$d = $this->api->getArticleeng("active");
		endif;
		$page_name 		 	= $this->lang->line('article');
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"]  = $page_name;
		$data["desc"] 		= $this->desc;
		$data["image"] 		= $this->image;
		$data["date"] 		= $this->date;
		$data["keywords"] 	= $this->keywords;
		$data["content"]	= 'frontend/page/article';
		$data["data"]    	= $d;
		// $data['slideshow']	= $ImageUrl;
		// $data['cairo_scaled_font_text_extents(scaledfont, text)t']	= $this->SeoText;
		$this->load->view('frontend/index',$data);
	}

	public function article_detail($id){
		$a 					= $this->api->getDetailArticle($id,"front");
		$name 				= $this->api->get_text($a->Name);
		if($a):
			$meta = '';
			$meta = '<meta property="og:url"           content="'.current_url().'" />';
			$meta .= '<meta property="og:type"          content="website" />';
			$meta .= '<meta property="og:title"         content="'.$a->Name.'" />';
			$meta .= '<meta property="og:description"   content="'.$a->Summary.'" />';
			$meta .= '<meta property="og:keywords"   	content="'.$a->Keywords.'" />';
			$meta .= '<meta property="og:image"         content="'.$a->ImageUrl.'" />';

			$data["title"] 		= $this->main_title." - ".$a->Name;
			$data["meta"]		= $meta;
			$data["content"] 	= "frontend/page/article_detail";
			$data["data"]		= $a;
			$data["name"]		= $name;
		else:
			$data["meta"]		= "";
			$data["title"] 		= "Error 404";
			$data["content"] 	= "frontend/page/error_404";
		endif;
		$this->load->view('frontend/index',$data);	
	}
	public function about_us(){
		$page_name 		 	= $this->lang->line('about_us');
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"]  = $page_name;
		$data["content"] 	= "frontend/page/about_us";
		$this->load->view('frontend/index',$data);
	}
	public function donation(){
		$page_name 		 	= $this->lang->line('donation');
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"]  = $page_name;
		$data["content"] 	= "frontend/page/donation";
		$this->load->view('frontend/index',$data);
	}
	public function history(){
		$page_name 		 	= $this->lang->line('history');
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"]  = $page_name;
		$data["content"] 	= "frontend/page/history";
		$this->load->view('frontend/index',$data);
	}
	public function service(){
		$page_name 		 	= $this->lang->line('service');
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"]  = $page_name;
		$data["content"] 	= "frontend/page/service";
		$this->load->view('frontend/index',$data);
	}
	public function product_list(){
		$page_name 		 	= "Products List";
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"]  = $page_name;
		$data["content"] 	= "frontend/page/products/list";
		$this->load->view('frontend/index',$data);
	}
	public function product_listx($ID){
		$page_name 		 	= "Products List";
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["ID"]  		= $ID;
		$data["page_name"]  = $page_name;
		$data["content"] 	= "frontend/page/products/list_product";
		$this->load->view('frontend/index',$data);
	}
	public function galery(){
		$page_name 		 	= "Galery";
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"] 	= $page_name;
		$data['slideshow']	= $this->api->get_slideshow("Type","Active");
		$data["content"] 	= "frontend/page/galery";
		$this->load->view('frontend/index',$data);
	}	
	public function contact_us(){
		$page_name 		 	= $this->lang->line('contact_us');
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"]  = $page_name;
		$data["content"] 	= "frontend/page/contact_us";
		$this->load->view('frontend/index',$data);
	}
	public function faq(){
		$page_name 			= "FAQ";
		$data["title"]	 	= $this->main_title." - FAQ";
		$data["page_name"] 	= $page_name;
		$data["content"] 	= "frontend/page/faq";
		$this->load->view('frontend/index',$data);
	}
	public function blog(){
		$page_name 			= "BLOG";
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"] 	= $page_name;
		$data["content"] 	= "frontend/page/blog";
		$this->load->view('frontend/index',$data);
	}
	public function news_event(){
		$page_name 			= "News & Events";
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["page_name"] 	= $page_name;
		$data["content"] 	= "frontend/page/news_event";
		$this->load->view('frontend/index',$data);
	}
	public function product_pricing(){
		$page_name 			= "Products & Pricing";
		$data["title"]	 	= $this->main_title." - ".$page_name;
		$data["content"] 	= "frontend/page/product_pricing";
		$this->load->view('frontend/index',$data);
	}
	public function error_404()
	{
		if($this->session->index == "frontend"):
			$data["meta"]		= "";
			$data["title"] 		= "404 Page Not Found";
			$data["content"] 	= "frontend/page/error_404";
			$this->load->view('frontend/index',$data);	
		elseif($this->session->index == "backend"):
			$data["meta"]		= "";
			$data["title"]		= "E404 Page Not Found";
			$data["content"]	= "backend/page/error_404";
			$this->load->view('backend/index',$data);
		else:
			$data["meta"]		= "";
			$data["title"] 		= "404 Page Not Found";
			$data["content"] 	= "frontend/page/error_404";
			$this->load->view('frontend/index',$data);	
		endif;
	}
	#backend
	public function bahasa($bahasa){
		$this->session->set_userdata("bahasa",$bahasa);
		redirect($this->agent->referrer());
	}
	#blank
	public function blank()
	{
		$v["title"]		= "Sales Pro";
		$v["content"]	= "backend/page/blank";
		$this->load->view('backend/index',$v);
	}
	public function login()
	{
        $this->main->cek_session("luar");
		$v["title"]		= "Sales Pro";
		$v["category"]	= "login";
		$this->load->view('backend/page/login',$v);
	}
	public function logout()
    {
        session_destroy();
        redirect(site_url("login"));
    }
	public function register()
	{
		$v["title"]		= "Sales Pro";
		$v["category"]	= "register";
		$this->load->view('backend/page/login',$v);
	}
	public function forgot_password()
	{
		$v["title"]		= "Sales Pro";
		$v["category"]	= "forgot_password";
		$this->load->view('backend/page/login',$v);
	}
	public function forgotpassword_reset()
	{

		$email	= $this->input->get('e');
		$token	= $this->input->get('x');
		if($token):
			$this->db->where("Email",$email);
			$this->db->where("Token",$token);
			$q = $this->db->get("UT_User");
			if($q->num_rows() > 0):
				$a 				= $q->row();
				$UserID 		= $a->UserID;
				$HakAksesID 	= $a->HakAksesID;
				$Email 			= $a->Email;
				$Name 			= $a->Name;
				$Token 			= $a->Token;
				$TokenExpire 	= $a->TokenExpire;
				$sekarang 		= date("Y-m-d H:i:s");
				if($sekarang < $TokenExpire):
					$data["Token"] 			= $Token;
					$data["HakAksesID"] 	= $HakAksesID;
					$data["UserID"]			= $UserID;
					$data["Email"] 			= $Email;
					$data["Name"] 			= $Name;
					$data["title"]			= "Reset Password";
			        $data["page"]			= "frontend/login/reset_password";
			        $data["category"]		= "reset_password";
					$this->load->view('backend/page/login',$data);
				else:
					redirect(site_url());
				endif;
			else:
				redirect(site_url());
			endif;
		else:
			redirect(site_url());
		endif;
	}
	public function pengaturan_umum(){
		$tambah 	= "";
		$url_modul 	= $this->uri->segment(1); 
		$id_url 	= $this->main->GetMenuID($url_modul);
		$read 		= $this->main->read($id_url);
		if($read == 0): redirect("error_403"); endif;
		$v_tambah = $this->main->menu_ubah($id_url);
		#ini untuk session halaman aturan user privileges;
		$list_data = $this->data_pengaturan_umum();
		// $list_data = json_encode($list_data);
		// $list_data = json_decode($list_data);
		$data['title']  		= 'Pengaturan Umum';
		$data['content']		= 'backend/page/pengaturan_umum';
		$data['modul'] 			= 'pengaturan_umum';
		$data['url_modul']  	= $url_modul;
		$data['list_data']		= $list_data;
		$this->load->view('backend/index',$data);
	}
	public function notification(){
		$url_modul 				= $this->uri->segment(1); 
		$id_url 				= $this->main->GetMenuID($url_modul);
		$data['title']  		= 'Notifikasi';
		$data['content']		= 'backend/page/notification';
		$data['modul'] 			= 'notification';
		$data['url_modul']  	= $url_modul;
		$this->load->view('backend/index',$data);
	}
	public function general_setting($page){
		$tambah 	= "";
		$url_modul 	= $this->uri->segment(1); 
		$id_url 	= $this->main->GetMenuID($url_modul);
		$menu_name  = $this->main->GetMenuName('current_url');
		$read 		= $this->main->read($id_url);
		if($read == 0): redirect("dashboard"); endif;
		$admin_tambah = $this->main->menu_tambah($id_url);
		if($admin_tambah > 0):
            $tambah = '<button type="button" class="btn btn-white" onclick="add_data()" >Add New Data</button>';
		endif;
		#ini untuk session halaman aturan user privileges;
		$data['title']  		= $menu_name;
		$data['content']		= 'backend/page/general_setting';
		$data['modul'] 			= $page;
		$data['url_modul']  	= $url_modul;
		$this->load->view('backend/index',$data);
	}
	public function content_detail($ContentID){
		$data_detail = $this->api->content_detail($ContentID);
		if($data_detail):
			$meta = '';
			$meta = '<meta property="og:url"           content="'.current_url().'" />';
			$meta .= '<meta property="og:type"          content="website" />';
			$meta .= '<meta property="og:title"         content="'.$data_detail->Name.'" />';
			$meta .= '<meta property="og:description"   content="'.$data_detail->Summary.'" />';
			$meta .= '<meta property="og:image"         content="'.$data_detail->Image.'" />';

			$data["ContentID"]	= $ContentID;
			$data["title"] 		= $this->main_title." - ".$data_detail->Name;
			$data["meta"]		= $meta;
			$data["content"] 	= "frontend/page/content_detail";
			$data["data"]		= $data_detail;
			$data["template"] 	= $data_detail->Template;
		else:
			$data["meta"]		= "";
			$data["title"] 		= "Error 404";
			$data["content"] 	= "frontend/page/error_404";
		endif;
		$this->load->view('frontend/index',$data);	
	}
	public function subscriber(){
		$this->validation->subscriber();
		$email = $this->input->post('email');
		$member_type = $this->input->post('member_type');
		$data = array(
			'Code'          => $this->main->kode_member("Member","Code",4,intval("1")),
			'Name'			=> $this->input->post("Name"),
			'Email' 		=> $email,
			'member_type' 	=> 3,
			'Active' 		=> 1,	
			'DateAdd'		=> date('Y-m-d H:i:s'),
		);
		$this->db->insert("Member", $data);

		$res = array(
			'status' 	=> true,
			'message'	=> 'Success Subscriber',
		);

		$this->api->send_email("feedback_subscribe");

		$this->main->echoJson($res);
	}
	public function unsubscribe($text=""){	
		$email = $this->api->decrypt($text);
		$cek = $this->db->count_all("Member where Email = '$email' and Email != '' and Subscribe = 1");
		if($cek>0):
			$data_member = array(
				'Subscribe' 	=> 0,
				"DateCh" 		=> date("Y-m-d H:i:s"),
			);
			$this->db->where("Email", $email);
			$this->db->update("Member",$data_member);
			
			$data["title"] 		= "Rumah RUTH Unsubscribe ";
			$data["desc"] 		= $this->desc;
			$data["image"] 		= $this->image;
			$data["keywords"] 	= $this->keywords;
			$data['email'] 		= $email;
			$data['code']		= $text;
			$data["content"]	= 'frontend/page/unsubscribe';
			$data['SeoText']	= $this->SeoText;
			$this->load->view('frontend/index',$data);
		else:
			redirect();
		endif;
	}

	public function save_unsubscribe(){
		$key  		= $this->input->post('key');
		$reason 	= $this->input->post('reason');
		$email 		= $this->api->decrypt($key);
		$cek = $this->db->count_all("Member where Email = '$email' and Email != ''");
		if($cek>0):
			$this->api->send_email("unsubscribe");
			$res = array(
				"status" 	=> TRUE,
				"message" 	=> $this->lang->line("subscribe_ok"),
			);
		else:
			$res = array(
				"status" 	=> FALSE,
				"message" 	=> $this->lang->line("not_found"),
			);
		endif;

		$this->main->echoJson($res);
	}
	
}
