<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	function __construct() {
        parent::__construct();
    }
    public function menu_parent()
    {
        $output = array(
            "ListData"  => $this->api->menu_parent(),
            "HakAkses"  => $this->session->HakAkses,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
    }
	public function login()
	{
		$data = $this->main->login();
		header('Content-Type: application/json');
        echo json_encode($data,JSON_PRETTY_PRINT);  
	}
	public function register()
	{
		$this->api->register();
	}
	public function forgot_password()
	{
		$this->api->forgot_password();
	}
    public function reset_password(){
        $this->validation->forgot_password_reset();

        $UserID = $this->input->post("UserID");
        $Email  = $this->input->post("Email");
        $Token  = $this->input->post("Token");

        $Password = $this->input->post("Password");
        $Password = $this->main->hash($Password);
        $PasswordConfirmation = $this->input->post("PasswordConfirmation");

        $data = array(
            "Password" => $Password
        );


        $this->db->where("UserID",$UserID);
        $this->db->where("Email",$Email);
        $this->db->where("Token",$Token);
        $this->db->update("UT_User",$data);

        $output = array(
            "status"    => TRUE,
            "message"   => "Reset Password Success, Back to Sign in to try new passord"
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);   
    }
    public function forgot_password_email(){
        $this->api->send_email("forgot_password","45","ya");
    }

    public function send_email($page)
    {
        $output = $this->api->send_email($page);
        // $output = $this->api->send_email($page,"","ya");
    }
    public function category_select(){
        $list = $this->api->category_select();

        $data = array(
            "staus" => TRUE,
            "data"  => $list,
            "HakAkses"  => $this->session->HakAkses,
        );

        $this->main->echoJson($data);
    }

    public function province_select(){
        $Datax  = $this->api->province_select();
        $Data   = array();
        foreach($Datax as $key => $a):
            $item = array(
                "ID"        => $a->ID,
                "Name"      => $a->Name,
            );
            $Data[] = $item;
        endforeach;
        $output     = array(
            "Data"      => $Data,
            "HakAkses"  => $this->session->HakAkses,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
    }
    public function city_select($ProvinceID = ""){
        $Datax  = $this->api->city_select($ProvinceID);
        $Data   = array();
        foreach($Datax as $key => $a):
            $item = array(
                "ID"        => $a->ID,
                "Name"      => $a->Name,
            );
            $Data[] = $item;
        endforeach;
        $output     = array(
            "Data"      => $Data,
            "HakAkses"  => $this->session->HakAkses,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
    }
    public function notification($page = ""){
        $UserID           = $this->session->UserID;
        $TotalDataUnread  = $this->db->count_all("UT_Notification where ReadNotif='0' and ToID = '$UserID' ");
        $TotalDataReal    = $this->db->count_all("UT_Notification where ToID = '$UserID' ");
        $ListData         = $this->api->notification();
        $ListDatax        = array();
        foreach($ListData as $a):
            $Direct = site_url("notification.html");
            if($a->Type == "rencana_kirim" || $a->Type == "rencana_kirim_all" || $a->Type == "rencana_kirim_one" || $a->Type == "send_draft_cek" || $a->Type == "send_tolak_cek" || $a->Type == "send_approve_cek"):
                $Title   = "Pengajuan Rencana Kerja Baru";
                $Message = "Anda mendapatkan pengajuan rencana kerja baru untuk project <b>".$a->ProjectName."</b>";
                $Direct  = "url=".site_url("rencana-pekerjaan.html&ID=".$a->ID);
            elseif($a->Type == "rencana_terima"):
                $Title   = "Rencana kerja disetujui";
                $Message = "Rencana kerja untuk project <b>".$a->ProjectName."</b> yang anda kirim sudah disetujui oleh ".$a->FromName;
                $Direct  = "url=".site_url("rencana-pekerjaan.html&ID=".$a->ID);
            elseif($a->Type == "rencana_tolak"):
                $Title   = "Renana kerja ditolak";
                $Message = "Maaf rencana kerja untuk project <b>".$a->ProjectName."</b> yang anda ajukan ditolak oleh ".$a->FromName;
                $Direct  = "url=".site_url("rencana-pekerjaan.html&ID=".$a->ID);
            else:
                $Title   = "Tidak Ada";
                $Message = "Tidak Ada";
            endif;
            $ListDatax[] = array(
                "NotificationID" => $a->NotificationID,
                "ID"             => $a->ID,
                "FromID"         => $a->FromID,
                "FromName"       => $a->FromName,
                "ToID"           => $a->ToID,
                "ToName"         => $a->ToName,
                "Type"           => $a->Type,
                "Read"           => $a->Read,
                "Title"          => $Title,
                "Message"        => $Message,
                "Date"           => $this->main->tanggal("d M Y H:i",$a->Date)." WIB",
                "Direct"         => site_url("notif-direct?").$Direct."&NotificationID=".$a->NotificationID,
            );
        endforeach;
        $output             = array(
            "HakAkses"          => $this->session->HakAkses,
            "TotalDataUnread"   => $TotalDataUnread,
            "TotalDataReal"     => $TotalDataReal,
            "ListData"          => $ListDatax,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
    }
    public function notification_direct(){
        $NotificationID  = $this->input->get("NotificationID");
        $ID  = $this->input->get("ID");
        $url = $this->input->get("url")."?id=".$ID;
        $this->notification_read($NotificationID);
        redirect($url);
    }
    public function notification_read($ID){
        $data = array(
            "ReadNotif" => 1,
            "ReadDate"  => date("Y-m-d H:i:s")
        );
        if($ID == "all"):
            $this->db->where("ToID",$this->session->UserID);
            $this->db->update("UT_Notification",$data);

        else:
            $this->db->where("NotificationID",$ID);
            $this->db->update("UT_Notification",$data);
        endif;
        if($ID == "all"){
            $output = array(
                "HakAkses"  => $this->session->HakAkses,
                 "Status"   => true
            );
            header('Content-Type: application/json');
            echo json_encode($output,JSON_PRETTY_PRINT);  
        }
    }
    public function get_setting($modul = "")
    { 
        $post       = $this->input->post();
        $ListData   = array(); 
        $CodeArray  = array();

        if($modul == "slideshow"):
            $ListData = $this->api->slideshow('list_data');
        else:
            foreach($post as $key => $a):
                $CodeArray[] = $key;
            endforeach;
            foreach($_FILES as $key => $a):
                $CodeArray[] = $key;
            endforeach;
            if(count($CodeArray) > 0):
                $this->db->where_in("Code",$CodeArray);
                $query = $this->db->get("UT_General");
                $Listdatax = $query->result();
                foreach($Listdatax as $a):
                    $ListData[] = array(
                        "Code"  => $a->Code,
                        "Value" => $a->Value,
                    );
                endforeach;
            endif;
        endif;
        $output     = array(
            "HakAkses"  => $this->session->HakAkses,
            "Status"    => TRUE,
            "ListData"  => $ListData
        );
        $this->main->echoJson($output);
    }
    public function save_setting($modul = "")
    {
        $post   	= $this->input->post();
        $postar 	= array();
        $data   	= array();
        // $dataeng    = array();
        $PostName 	= array();
        if($modul == "slideshow"):
            $AttachmentID               = $this->input->post("AttachmentID");
            $AttachmentIDeng            = $this->input->post("AttachmentIDeng");
            $Name                       = $this->input->post("Name");
            $Nameeng                    = $this->input->post("Nameeng");
            $NameColor                  = $this->input->post("NameColor");
            $NameColoreng               = $this->input->post("NameColoreng");
            $Description                = $this->input->post("Description");
            $Descriptioneng             = $this->input->post("Descriptioneng");
            $Position                   = $this->input->post("Position");
            $Positioneng                = $this->input->post("Positioneng");

            $ButtonLink                 = array();
            $BtnID                      = $this->input->post("BtnID");
            $BtnName                    = $this->input->post("BtnName");
            $BtnLink                    = $this->input->post("BtnLink");
            $BtnColor                   = $this->input->post("BtnColor");
            foreach($BtnID as $key => $a):
                $ButtonLink[] = array(
                    "BtnID"     => $BtnID[$key],
                    "BtnName"   => $BtnName[$key],
                    "BtnLink"   => $BtnLink[$key],
                    "BtnColor"  => $BtnColor[$key]
                );
            endforeach;
            $ButtonLink = json_encode($ButtonLink);


            $nmfile                     = 'Rumah singgah ibu hamil-Rumah aman ibu hamil-'.$Name."-".time();
            $config['upload_path']      = './img/slideshow'; //path folder 
            $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|PNG|JPG';
            $config['max_size']         = '99999'; //maksimum besar file 2M 
            $config['max_width']        = '99999'; //lebar maksimum 1288 px 
            $config['max_height']       = '99999'; //tinggi maksimu 768 px 
            $config['file_name']        = $nmfile; //nama yang terupload nantinya 
            $this->upload->initialize($config); 
            $upload = $this->upload->do_upload("Image");
            $gbr    = $this->upload->data();
            #---------------------------------------------------------------------------------------------------------------
            $data   = array(
                "Name"          => $Name,
                "NameColor"     => $NameColor,
                "Description"   => $Description,
                "Position"      => $Position,
                "Type"          => "slideshow",
                "ButtonLink"    => $ButtonLink
            );

            if(!$Nameeng): $Nameeng = null; endif;
            if(!$NameColoreng): $NameColoreng = null; endif;
            if(!$Descriptioneng): $Descriptioneng = null; endif;
            if(!$Positioneng): $Positioneng = null; endif;

            $dataeng   = array(
                "Name"       => $Nameeng,
                "NameColor"  => $NameColoreng,
                "Description"=> $Descriptioneng,
                "Position"   => $Positioneng,
                "Type"          => "slideshow",
                "ButtonLink"    => $ButtonLink,
                "Language"      => 2
            );

            if($upload):        
                $image          = "img/".$modul."/".$gbr['file_name'];
                $data["Patch"]  = $image;
                $dataeng["Patch"]  = $image;
                if($AttachmentID > 0):
                    $this->main->hapus_gambar('UT_Attachment','Patch',array('AttachmentID' => $AttachmentID));
                endif;
            endif;
            if($AttachmentID > 0):
                $this->db->where("AttachmentID",$AttachmentID);
                $this->db->update("UT_Attachment",$data);
            else:
                $data["Sort"] = $this->api->slideshow("last_sort") + 1;
                // $this->db->insert("UT_Attachment",$data);
                $insert = $this->api->save_slideshow($data);
                $dataeng['ParentID'] = $insert;
                $id     = $this->api->save_slideshow($dataeng);
            endif;
            
        elseif($modul == "main-menu"):
            $Value          = array();
            $Code           = "MainMenu";
            $cek            = $this->db->count_all("UT_General where Code='$Code' ");
            $ContentID      = $this->input->post("ContentID");
            $ContentIDFix   = $this->input->post("ContentIDFix");
            $ContentName    = $this->input->post("ContentName");
            $ContentUrl     = $this->input->post("ContentUrl");
            $ContentType    = $this->input->post("ContentType");
            if(count($ContentIDFix) > 0):
                foreach($ContentID as $key => $a):
                    if(in_array($a, $ContentIDFix)):
                        $Value[] = array(
                            "ContentID" => $ContentID[$key],
                            "Name"      => $ContentName[$key],
                            "Url"       => $ContentUrl[$key],
                            "Type"      => $ContentType[$key],
                            "Sub"       => array()
                        );
                    endif;
                endforeach;
                $Value = json_encode($Value);
                $this->save_setting_db($cek,$Code,$Value);
            endif;
        else:
            foreach($post as $key => $a):
            	$PostName[] = $key;
                #$postar[$key] = $this->input->post($key);
                $Code   = $key;
                $Value  = $this->input->post($Code);
                if(in_array($Code, array("ContactUsBandungList","ContactUsJakartaList","ContactUsSemarangList"))):
                    $Value = trim(preg_replace('/\s+/', ' ', $Value));
                endif;
                #data------------------------------------------------------------
                $cek    = $this->db->count_all("UT_General where Code='$Code' ");
                $this->save_setting_db($cek,$Code,$Value);
            endforeach;

            foreach($_FILES as $key => $a):
            	$PostName[] = $key;
                $Code   	= $key;
    	        $cek    	= $this->db->count_all("UT_General where Code='$Code' ");
    	        #data------------------------------------------------------------
    	        if($Code == "Logo" || $Code == "Icon"):
    	        	$nmfile 					= 'Rumah singgah ibu hamil-Rumah aman ibu hamil-'.$Code."_".time();
    				$config['upload_path'] 		= './img/general'; //path folder 
    				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp|PNG|JPG'; //type yang dapat diakses bisa anda sesuaikan 
    				$config['max_size'] 		= '99999'; //maksimum besar file 2M 
    				$config['max_width'] 		= '99999'; //lebar maksimum 1288 px 
    				$config['max_height'] 		= '99999'; //tinggi maksimu 768 px 
    				$config['file_name'] 		= $nmfile; //nama yang terupload nantinya 
    				$this->upload->initialize($config); 
    				$upload	= $this->upload->do_upload($Code);
    				$gbr 	= $this->upload->data();
    				if($upload): 		
    					$image 	= "img/general/".$gbr['file_name'];
    					$Value 	= $image;
    					if($cek > 0):
    						$this->main->hapus_gambar('UT_General','Value',array('Code' => $Code));
    					endif;
    		            $this->save_setting_db($cek,$Code,$Value);
    				endif;
    	        endif;
            endforeach;
        endif;
        $output = array(
            "HakAkses"  => $this->session->HakAkses,
            "Status"    => TRUE,
            "Modul"     => $modul,
            "Post" 		=> $PostName,
            "Data"      => $data
        );
        $this->main->echoJson($output);
    }
    public function save_setting_db($cek,$Code,$Value){
    	$data["Value"]  = $Value;
        if($cek > 0):
            $data["UserCh"] = $this->session->Name;
            $data["DateCh"] = date("Y-m-d H:i:s");
            $this->db->where("Code",$Code);
            $this->db->update("UT_General",$data);
        else:
            $data["Code"]    = $Code;
            $data["UserAdd"] = $this->session->Name;
            $data["DateAdd"] = date("Y-m-d H:i:s");
            $this->db->insert("UT_General",$data);
        endif;
    }
    public function slideshow($page = "",$id = ""){
        $data = array();
        if($page == "ubah_urutan"):
            $ArrayID = $this->input->post("ArrayID");
            $ArrayUrutan = $this->input->post("ArrayUrutan");
            foreach($ArrayID as $key => $a):
                $datax = array(
                    "Sort" => $ArrayUrutan[$key]
                );
                $data[] = $a;
                $this->db->where("Type","slideshow");
                $this->db->where("AttachmentID",$a);
                $this->db->update("UT_Attachment",$datax);
            endforeach;
        elseif($page == "delete"):
            $this->main->hapus_gambar('UT_Attachment','Patch',array('AttachmentID' => $id));

            $this->db->where("AttachmentID",$id);
            $this->db->delete("UT_Attachment");
        elseif($page == "edit"):
            $data = $this->api->slideshow($page,$id);
            $a    = $data;
            $data = array(
                "Active"           => $a->Active,
                "AttachmentID"     => $a->AttachmentID,
                "AttachmentIDeng"  => $a->AttachmentIDeng,
                "ButtonLink"       => json_decode($a->ButtonLink),
                "Description"      => $a->Description,
                "Descriptioneng"   => $a->Descriptioneng,
                "ID"               => $a->AttachmentID,
                "Name"             => $a->Name,
                "Nameeng"          => $a->Nameeng,
                "NameColor"        => $a->NameColor,
                "NameColoreng"     => $a->NameColoreng,
                "Patch"            => $a->Patch,
                "Position"         => $a->Position,
                "Positioneng"      => $a->Positioneng,
                "Sort"             => $a->Sort,
                "Sorteng"          => $a->Sorteng,
                "Type"             => $a->Type,
                "Typeeng"          => $a->Typeeng
            );
        endif;
        $output = array(
            "HakAkses"  => $this->session->HakAkses,
            "Status"    => TRUE,
            "Data"      => $data,
            "Page"      => $page
        );
        $this->main->echoJson($output);
    }
    public function content_list(){
        $page       = $this->input->post("page");
        $pagenum    = $this->input->post("pagenum");
        $total_data = "";
        $data       = array();
        $list_new_news      = array();
        $list_new_event     = array();
        $list_data          = array();
        if($page == "sum"):
            $total_data = $this->api->content_list("total_data");
            $new_news   = $this->api->content_list("new_news");
            $new_event  = $this->api->content_list("new_event");

            foreach($new_news as $a):
                $Link   = $a->ContentID."-".$this->main->link($a->Name);
                $Author = $a->Author." - ".$this->main->time_elapsed_string($a->Date);
                $item   = array(
                    "Link"  => site_url("post/detail/".$Link),
                    "Image" => $a->Image,
                    "Name"  => $a->Name,
                    "Author"=> $Author
                );
                array_push($list_new_news, $item);
            endforeach;
            foreach($new_event as $a):
                $Link   = $a->ContentID."-".$this->main->link($a->Name);
                $Author = $a->Author." - ".$this->main->time_elapsed_string($a->Date);
                $item   = array(
                    "Link"  => site_url("post/detail/".$Link),
                    "Image" => $a->Image,
                    "Name"  => $a->Name,
                    "Author"=> $Author
                );
                array_push($list_new_event, $item);
            endforeach;
        else:
            $data       = $this->api->content_list("news_event");
            $i = 0;
            foreach($data as $a):
                $Link   = $a->ContentID."-".$this->main->link($a->Name);
                $Author = $a->Author." - ".$this->main->time_elapsed_string($a->Date);
                $item   = array(
                    "ID"            => $a->ContentID,
                    "Link"          => site_url("post/detail/".$Link),
                    "Image"         => $a->Image,
                    "Name"          => $a->Name,
                    "CategoryCode"  => $a->CategoryCode,
                    "Category"      => $a->Category,
                    "Summary"       => $a->Summary,
                    "Author"        => $Author
                );
                array_push($list_data, $item);
            endforeach;
        endif;
        $output = array(
            "page"          => $page,
            "hakakses"      => $this->session->HakAkses,
            "total_data"    => $total_data,
            "list_data"     => $list_data,
            "list_new_news" => $list_new_news,
            "list_new_event"=> $list_new_event,
            "pagenum"       => $pagenum

        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);
    }
    public function content_detail($NewsID){
        $list_new_news  = array();
        $list_new_event = array();
        $new_news       = $this->api->content_list("new_news");
        $new_event      = $this->api->content_list("new_event");
        foreach($new_news as $a):
            $Link   = $a->ContentID."-".$this->main->link($a->Name);
            $Author = $a->Author." - ".date("D, d M Y H:i",strtotime($a->DateModify));
            $item   = array(
                "Link"  => site_url("blog-detail/".$Link),
                "Image" => $a->Image,
                "Name"  => $a->Name,
                "Author"=> $Author
            );
            array_push($list_new_news, $item);
        endforeach;
        foreach($new_event as $a):
            $Link   = $a->ContentID."-".$this->main->link($a->Name);
            $Author = $a->Author." - ".date("D, d M Y H:i",strtotime($a->DateModify));
            $item   = array(
                "Link"  => site_url("blog-detail/".$Link),
                "Image" => $a->Image,
                "Name"  => $a->Name,
                "Author"=> $Author
            );
            array_push($list_new_event, $item);
        endforeach;

        $Data       = $this->api->news_detail($NewsID);
        $a          = $Data;
        $Author     = $a->Author." - ".date("D, d M Y H:i",strtotime($a->DateModify));
        $Data       = array(
            "Author"        => $Author,
            "Name"          => $a->Name,
            "Description"   => $a->Description,
            "Image"         => $a->Image,
            "Name"          => $a->Name,
            "CategoryCode"  => $a->CategoryCode,
            "Category"      => $a->Category,
            "Summary"       => $a->Summary,
            "PostDate"      => date("d M Y",strtotime($a->DateAdd))
        );
        $output     = array(
            "list_new_news"     => $list_new_news,
            "list_new_event"    => $list_new_event,
            "Data"              => $Data,
            "HakAkses"          => $this->session->HakAkses,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT); 
    }
    public function product_list($CategoryID = ""){

        $Data       = array();
        $ListData   = array();
        $Status     = FALSE;
        $Message    = "Get data product failed";
        if($CategoryID):
            $ListData = $this->api->ProductList("ByCategory",$CategoryID);
            if(count($ListData) > 0):
                $Status = TRUE;
                $Message = "get data product success";
            endif;
        endif;
        $output     = array(
            "Data"              => $Data,
            "ListData"          => $ListData,
            "HakAkses"          => $this->session->HakAkses,
            "Status"            => $Status,
            "Message"           => $Message,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT); 
    }
    public function article_list($CategoryID = ""){

        $Data       = array();
        $ListData   = array();
        $Status     = FALSE;
        $Message    = "Get data article failed";
        if($CategoryID):
            $ListData = $this->api->ArticleList("ByCategory",$CategoryID);
            if(count($ListData) > 0):
                $Status = TRUE;
                $Message = "get data article success";
            endif;
        endif;
        $output     = array(
            "Data"              => $Data,
            "ListData"          => $ListData,
            "HakAkses"          => $this->session->HakAkses,
            "Status"            => $Status,
            "Message"           => $Message,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT); 
    }
    public function experience_list(){
    	$Start 	 	= 0;
    	$Limit 		= 6;
    	$TotalData  = $this->db->count_all("Content where Type = 'experience' ");
    	if($this->input->post("Start")):
    		$Start = $this->input->post("Start");
    	endif;
    	$Data       = array();
        $ListData   = array();
        $Status     = FALSE;
        $Message    = "Get data product failed";
        $ListData 	= $this->api->ListExperience($Limit,$Start);
        if(count($ListData) > 0):
            $Status = TRUE;
            $Message = "get data product success";
        endif;
        $output     = array(
        	"A" 				=> $this->input->post("Start"),
            "Data"              => $Data,
            "Start" 			=> $Start,
            "Limit" 			=> $Limit,
            "TotalData" 		=> $TotalData,
            "ListData"          => $ListData,
            "HakAkses"          => $this->session->HakAkses,
            "Status"            => $Status,
            "Message"           => $Message,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT); 
    }
    public function member_select(){
        $list = $this->api->member_select();

        $data_list  = array();
        $partner    = array();
        $client     = array();
        $subscriber  = array();
        foreach ($list as $k => $d) {
            if (filter_var($d->Email, FILTER_VALIDATE_EMAIL)):
                if($d->Member_type == 1):
                    array_push($partner, $d);
                elseif($d->Member_type == 2):
                    array_push($client, $d);
                elseif($d->Member_type == 3):
                    array_push($subscriber, $d);
                endif;
                array_push($data_list, $d);
            endif;
        }

        $data = array(
            'list'          => $data_list,
            'partner'       => $partner,
            'client'        => $client,
            'subscriber'    => $subscriber,
        );

        $this->main->echoJson($data);
    }

    public function tes(){
        $insert = 122;
        // $insert = 69;
        // $this->api->send_email("feedback_subscribe",$insert,"ya",array('ilham@rcelectronic.net'),"loop");
        // $this->api->send_email("send_artice",$insert,"ya",array('ilham@rcelectronic.net'),"loop");
        $this->api->send_email("send_artice",$insert,'ilham@rcelectronic.net');
        // $this->api->send_email("feedback_subscribe",$insert,'ilham@rcelectronic.net');
        // $email_member = "ilham@rcelectronic.co.id";
        // $this->api->send_email("send_artice",$insert,"",$email_member,"loop");
    }
    public function tes1(){
        $insert = 131;
        // $this->api->send_email("feedback_subscribe",$insert,'ilham@rcelectronic.net');
        $this->api->send_email("feedback_subscribe",$insert,"ya",array('ilham@rcelectronic.net'),"loop");
    }
    public function subscriber(){
        $this->validation->subscriber();
        $email = $this->input->post('email');
        $member_type = $this->input->post('member_type');
        $data = array(
            'Code'          => $this->main->kode_member("Member","Code",4,intval("1")),
            'Name'          => $this->input->post("Name"),
            'Email'         => $email,
            'member_type'   => 3,
            'Active'        => 1,   
            'DateAdd'       => date('Y-m-d H:i:s'),
        );
        $this->db->insert("Member", $data);

        $res = array(
            'status'    => true,
            'message'   => 'Success Subscriber',
        );

        $this->api->send_email("feedback_subscribe");

        $this->main->echoJson($res);
    }
    public function unsubscribe($text=""){  
        $email = $this->decrypt($text);
        $cek = $this->db->count_all("Member where Email = '$email' and Email != ''");
        if($cek>0):
            $data_member = array(
                'Subscribe'     => 0,
                "DateCh"        => date("Y-m-d H:i:s"),
            );
            $this->db->where("Email", $email);
            $this->db->update("Member",$data_member);
            
            $data["title"]      = "SAP Business Bandung | Hris Payroll ";
            $data["desc"]       = $this->desc;
            $data["image"]      = $this->image;
            $data["keywords"]   = $this->keywords;
            $data['email']      = $email;
            $data['code']       = $text;
            $data["content"]    = 'frontend/page/unsubscribe';
            $data['SeoText']    = $this->SeoText;
            $this->load->view('frontend/index',$data);
        else:
            redirect();
        endif;
    }

    public function save_unsubscribe(){
        $key        = $this->input->post('key');
        $reason     = $this->input->post('reason');
        $email      = $this->api->decrypt($key);
        $cek = $this->db->count_all("Member where Email = '$email' and Email != ''");
        if($cek>0):
            $this->api->send_email("unsubscribe");
            $res = array(
                "status"    => TRUE,
                "message"   => $this->lang->line("subscribe_ok"),
            );
        else:
            $res = array(
                "status"    => FALSE,
                "message"   => $this->lang->line("not_found"),
            );
        endif;

        $this->main->echoJson($res);
    }
    
    public function contact(){
        $this->validation->contact();
        $Name       = $this->input->post('Name');
        $Company    = $this->input->post('Company');
        $Email      = $this->input->post('Email');
        $Contact    = $this->input->post('Contact');
        $Subject    = $this->input->post('Subject');
        $Message    = $this->input->post('Message');
        $data = array(
            'Name'          => $Name,
            'Company'       => $Company,
            'Email'         => $Email,
            'Contact'       => $Contact,
            'Subject'       => $Subject,
            'Message'       => $Message,
        );
        $this->db->set("UserAdd",$this->session->Name);
        $this->db->set("DateAdd",date("Y-m-d H:i:s"));
        $this->db->insert("Contact", $data);

        $res = array(
            'status'    => true,
            'message'   => 'Success',
        );

        $this->api->send_email("contact_us");
        // $this->api->send_email("contact_us1","","non_response");
        // $this->main->echoJson($res);
    }
    
    public function get_slideshow(){
        $list = $this->api->get_slideshow();
        $this->main->echoJson($list);
    }
}