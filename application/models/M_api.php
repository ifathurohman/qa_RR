<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#tanggal 2017-08-30
#author m iqbal ramadhan
class M_api extends CI_Model {
    var $host;

    public function __construct()
    {
        parent::__construct();
        $this->host = site_url();     
    }
    #hak akses select 
    public function hak_akses_select(){
        $HakAksesID = $this->session->HakAksesID;
        $this->db->select("
            HakAksesID,
            HakAkses,
            Name,
            ");
        if($HakAksesID != 1):
            $this->db->where("HakAksesID != ", 1);
        endif;
        $query = $this->db->get("UT_HakAkses");

        return $query->result();
    }
    public function hak_akses_detail($id){
        $this->db->select("
            HakAksesID,
            HakAkses,
            Name,
            ");
        $this->db->where("HakAksesID", $id);
        $query = $this->db->get("UT_User");

        return $query->row();
    }

    public function pilih_tabel($modul){
        $tabel = "tidak ada";
        if($modul == "modal_panel"){
            $tabel = "PS_Module as modul";
        } else if($modul == "modal_panel_detail"){
            $tabel = "PS_ModuleDetail as moduldetail";
        } else if($modul == "modal_pegawai"){
            $tabel = "UT_User as user";
        }
        return $tabel;
    }
    public function category_select(){
        $select = $this->input->post("select");
        
        $this->db->select("
            CategoryID,
            Name,
        ");
        if($select == "active"):
            $this->db->where("Active", 1);
        endif;
        $this->db->from("Category");
        $query = $this->db->get();

        return $query->result();
    }
    private function _get_datatables_query($page = "")
    {

        if($page == "modal_panel"){
            $ModuleType = $this->input->post("Type");
            $column     = array("ModuleID","CompanyID","Code","Name","Point","Type","Remarks","Active");
            $order      = array('ModuleID' => 'desc'); // default order 
            $this->db->select("ModuleID,CompanyID,Code,Name,Point,Type");
            $this->db->where("modul.CompanyID",$this->session->CompanyID);
            $this->db->where("modul.Active",1);
            if($ModuleType != "none"){
                $this->db->where("Type",$ModuleType);
            }

        } else if($page == "modal_panel_detail"){
            $ModuleID   = $this->input->post("ModuleID");
            $column     = array("modul.ModuleID","modul.CompanyID","modul.Code","modul.Name","modul.Point","modul.Type","Remarks","Active");
            $order      = array('modul.ModuleID' => 'desc'); // default order 
            $this->db->select("modul.ModuleID,modul.CompanyID,modul.Code,modul.Name,modul.Point,modul.Type");
            $this->db->where("modul.CompanyID",$this->session->CompanyID);
            $this->db->where("modul.Active",1);
            $this->db->join("PS_Module as modul","moduldetail.ModuleID = modul.ModuleID");
            $this->db->where("moduldetail.ModuleIDParent",$ModuleID);
        } else if($page == "modal_pegawai"){
            $ModuleID   = $this->input->post("ModuleID");
            $column     = array("user.UserID","user.Name");
            $order      = array('user.UserID' => 'desc'); // default order 
            $this->db->select("user.UserID as ID, user.Name as Name");
            $this->db->where("user.CompanyID",$this->session->CompanyID);
            $this->db->where("user.Active",1);
        }
        $table = $this->pilih_tabel($page);
        $this->db->from($table);
        $i = 0;
    
        foreach ($column as $item){
            if($this->input->post("search")){
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
        
        if($this->input->post('order')){
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order)){
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function get_datatables($page = "")
    {
        $this->_get_datatables_query($page);
        if($this->input->post("length") != -1)
        $this->db->limit($this->input->post("length"), $this->input->post("start"));
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered($page = "")
    {
        $this->_get_datatables_query($page);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all($page = "")
    {
        $table      = $this->pilih_tabel($page);
        if($page == "modal_panel"):
            $ModuleType = $this->input->post("Type");
            $this->db->where("CompanyID",$this->session->CompanyID);
            if($ModuleType != "none"):
                $this->db->where("Type",$ModuleType);
            endif;
        elseif($page == "modal_panel_detail"):
            $ModuleID   = $this->input->post("ModuleID");
            $this->db->join("PS_Module as modul","moduldetail.ModuleID = modul.ModuleID");
            $this->db->where("moduldetail.ModuleIDParent",$ModuleID);
            $this->db->where("moduldetail.CompanyID",$this->session->CompanyID);
        elseif($page == "modal_pegawai"):
            $this->db->where("user.Active",1);
            $this->db->where("user.CompanyID",$this->session->CompanyID);
        endif;

        $this->db->from($table);
        return $this->db->count_all_results();
    }
    public function user($Email = "", $BranchID="",$UserID = ""){
        $this->db->select("
            UserID,
            Name,
            Email,
            ");
        if($Email != ""):
            $this->db->where("Email", $Email);
        endif;
        if($BranchID != ""):
            $this->db->where("BranchID", $BranchID);
        endif;
        $query = $this->db->get("UT_User");

        return $query;
    }
    public function user_detail($page = "", $where = ""){
        if($page == "select_email"):
            $this->db->where("Email",$where);
        else:
            $this->db->where("UserID",$page);
        endif;
        $query = $this->db->get("UT_User");
        return $query->row();
    }
    public function forgot_password(){
        $this->validation->forgot_password();
        $this->send_email("forgot_password");
    }
    public function send_email($page,$code="",$cek_page = "",$bcc="",$page2=""){
        $non_response = array('send_artice','feedback_subscribe','unsubscribe');
        $attach       = array();
        $bcc          = array();
        $lampiran           = FALSE;
        $nama               = "";
        $NameTo             = "";
        $ProjectName        = "";
        $ProjectAddress     = "";
        $Link               = "";
        $email_to           = "";
        $email_from         = "";

        $email              = $this->input->post("Email");
        $email_from         = $email;
        $nama               = $this->input->post("Name");
        $company            = $this->input->post("Company");
        $phone              = $this->input->post("Contact");
        $subject            = $this->input->post("Subject");
        $message            = $this->input->post("Message");
        $MarketingID        = $this->input->post("MarketingID");
        $BranchID           = $this->input->post("BranchID");
        $ProjectID          = $this->input->post("ProjectID");
        $ProductID          = $this->input->post("ProductID");


        if($page == "forgot_password"):
            $a                  = $this->user_detail("select_email",$email);
            $nama               = $a->Name;
            $email              = $a->Email;
            $token              = $a->Token;
            $email_to           = $email;
            $token              = sha1($nama.date("ymdhis"));
            $token_expire       = date("Y-m-d H:i:s",strtotime('+1 hour'));
            $data_token         = array("Token" => $token, "TokenExpire" => $token_expire,"DateCh" => date("Y-m-d H:i:s"));
            
            $this->db->where("Email",$email);
            $this->db->update("UT_User",$data_token);

            $subject            = "Konfirmasi Reset Password";
            $message            = "Reset password request has been sent, Please check your email";
            $page_email         = "email/index";
            $data["email"]      = $email;
            $data["nama"]       = $nama;
            $data["token"]      = $token;
            $data["message"]    = "to reset the password, please <a href='".site_url("reset-password?t=".$token."&#reset")."' target='_blank'>Click Here</a> ";
            $data["page"]       = "email/forgot_password"; 
        elseif($page == "feedback_subscribe"):
            $nama               = $this->input->post("Name");
            $email              = $this->input->post('email');
            $email_to           = $email;
            $subject            = "Feedback";
            $page_email         = "email/index";
            $data["page"]       = "email/feedback";
            $data['unsubscribe']= '';
            $data["message"]    = "";
        elseif($page == "register"):
            $a                  = $this->user_detail("select_code",$code);
            $nama               = $a->nama;
            $email              = $a->email;
            $token              = $a->token;
            $email_to           = $email;
            $subject            = "Konfirmasi Akun";
            $page_email         = "email/index";
            $data["message"]    = "untuk mengaktifkan akun Anda, silakan <a href='".site_url("konfirmasi-akun?t=".$token)."' target='_blank'>Klik Disini</a> ";
            $data["page"]       = "email/register"; 
        #ini untuk send message
        elseif($page == "contact_us"):
            // $email_to               = 'iqbal@rcelectronic.net';
            $email_to               = 'info@rumahruth.or.id';
            $data["NameTo"]         = 'Rumah RUTH';
            $data["email"]          = $email;
            $data["nama"]           = $nama;
            $data["company"]        = $company;
            $data["phone"]          = $phone;
            $data["subject"]        = $subject;
            $data["message"]        = $message;
            $page_email             = "email/index";
            $data["temp"]           = $page;
            $data["page"]           = "email/send_message";

        elseif($page == 'birthday'):
            $email_to               = $code->Email;
            $subject                = "Ulang Tahun ".$code->Name;
            $page_email             = "email/index";
            $data["page"]           = "email/birthday";
            $data["title"]          = $subject;
            $data['nama']           = $code->Name;
        elseif($page == "send_artice"):
            $artice = $this->api->getDetailArticle($code);
            $list   = $this->getArticle();
            $nama                = $artice->Name;
            $gambar              = $artice->ImageUrl;
            $deskripsi_singkat   = $artice->Summary;
    
            $subject                      = $this->input->post("Subject");
            $message                      = $this->input->post("Message");
            $email_to                     = $this->api->email_member($email);
            $data["nama"]                 = $artice->Name;
            $data["gambar"]               = $artice->ImageUrl;
            $data["deskripsi_singkat"]    = $artice->Summary;
            $data['data']                 = $list;
            $data['link']                 = site_url().$this->get_link_article($artice->Name,"name");
            $subject                      = $artice->Name .date("Y-m-d H:i:s");
            $message                      = $artice->Summary;
            $page_email                   = "email/index";
            $data["page"]                 = "email/article_send";
            $data['unsubscribe']          = '';
        elseif($page == "unsubscribe"):
          $key      = $this->input->post('key');
          $email    = $this->api->decrypt($key);
          $subject  = "Reason Unsubscribe ".time();
          $message  = $this->input->post("reason");

          $data["email"]      = $email;
          $data["message"]    = $message;
          $page_email         = "email/index";
          $data["page"]       = "email/unsubscribe";
        endif;
        if($cek_page == "ya"):
            $this->load->view($page_email,$data);
        else:
            // $data_email = $this->db->query("SELECT * FROM UT_Smtp");
            // if ($data_email->num_rows() > 0 || $page != "tes"):
            //     $hasil      = $data_email->row(1);
            //     $protocol   = $hasil->protocol;
            //     $smtp_host  = $hasil->smtp_host;
            //     $smtp_port  = $hasil->smtp_port;
            //     $smtp_user  = $hasil->smtp_user;
            //     $smtp_pass  = $hasil->smtp_pass;
            // else:
            // $email_to       = "wildan@rcelectronic.net";

            $data_notif = array(
                "Type"      => $page,
                "FromEmail" => $email_from,
                "ToEmail"   => $email_to,
                "Subject"   => $subject,
                "Message"   => $message,
            );
            // $this->insert_notification($data_notif);

            $protocol   = "smtp";
            $smtp_host  = "mail.rumahruth.or.id";
            $smtp_port  = "587";
            $smtp_user  = "info@rumahruth.or.id";
            $smtp_pass  = "12345!";
            // endif;
            $config = Array(
                'useragent'     => "Codeigniter",
                'protocol'      => $protocol,
                'smtp_host'     => $smtp_host,
                'smtp_port'     => $smtp_port,
                'smtp_user'     => $smtp_user,
                'smtp_pass'     => $smtp_pass,
                'mailtype'      => 'html',
                'charset'       => 'iso-8859-1',
                'wordwrap'      => TRUE,
                'newline'       => "\r\n"
            );
            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->subject("Rumah RUTH - ".$subject);
            $this->email->from("info@rumahruth.or.id","Rumah RUTH");
            $this->email->to($email_to);
            $this->email->message($this->load->view($page_email, $data, TRUE));
            if($lampiran):
                foreach ($attach as $key => $value) {
                    $this->email->attach($value);
                }
                if($delete_lampiran):
                    foreach ($attach as $key => $value) {
                        if(file_exists('./' . $value)){
                            unlink('./' . $value);
                        }
                    }
                endif;
            endif;
            if($page == "send_file"):
                $File           = $this->input->post("File");
                $FileName       = $this->input->post("FileName");
                $this->email->attach(base64_decode($File),'attachment',$FileName,'application/xls');
            endif;
            if($page == "contact_us"):
                $this->email->to($email);
            endif;
            if($bcc != "" and $page2 != "loop"):
              $this->email->bcc($bcc);
            endif;
            if($page2 == "loop"):
              foreach ($bcc as $k => $v) {
                $this->email->from("info@rumahruth.or.id","Rumah RUTH");
                $this->email->to($v);
                $data['unsubscribe']= site_url()."unsubscribe/".$this->encrypt($v);
                $this->email->message($this->load->view($page_email, $data, TRUE));
                $send = $this->email->send();
              }
            else:
              $this->email->from("info@rumahruth.or.id","Rumah RUTH");
              // $this->email->to("boill.mortal@gmail.com");
              // $this->email->to("boill.mortal@gmail.com");
              $this->email->message($this->load->view($page_email, $data, TRUE));
              $send = $this->email->send();
              if($send):
                  // echo json_encode(array("status" => TRUE,"pesan" => "Permintaan reset password telah terkirim silakan <br>periksa email anda","berhasil" => 1,"email"=>$email,"data" => $data));
              else:
                  // echo json_encode(array("status" => TRUE,"pesan" => "Gagal mengirim email silahkan coba lagi","berhasil" => 0));
                  // show_error($this->email->print_debugger());
              endif;
            endif;
            $send = $this->email->send();
            if($page == "new_marketing" || $page == "new_marketing_principle"):
                
            else:
                if(!in_array($page, $non_response)):
                    if($send):
                        $output = array(
                            "data"      => "",
                            "message"   => $message,
                            "status"    => TRUE
                        );
                        header('Content-Type: application/json');
                        echo json_encode($output,JSON_PRETTY_PRINT);
                    else:
                        $output = array(
                            "data"      => "",
                            "status"    => FALSE
                        );
                        header('Content-Type: application/json');
                        echo json_encode($output,JSON_PRETTY_PRINT);
                        // show_error($this->email->print_debugger());
                    endif;
                endif;
            endif;
        endif;
    }
    public function province_select(){
        $active = $this->input->post("Active");
        $this->db->select("ID,Name");
        $this->db->where("Name !=","");
        $this->db->order_by("Name","ASC");
        $query = $this->db->get("PS_Provinces");   
        return $query->result();
    }
    public function city_select($ProvinceID = ""){
        $active = $this->input->post("Active");
        $this->db->select("ID,Name");
        $this->db->where("Name !=","");
        if($ProvinceID):
            $this->db->where("Province_ID",$ProvinceID);
        endif;
        $this->db->order_by("Name","ASC");
        $query = $this->db->get("PS_Regencies");   
        return $query->result();
    }
    public function HakAkses_select($page = ""){
        $active = $this->input->post("Active");
        $this->db->select("HakAksesID,Name");
        if($page == "pegawai"):
            $this->db->where_in("LOWER(Name)",array("pegawai","analis"));
        endif;
        $this->db->order_by("HakAksesID","ASC");
        $query = $this->db->get("UT_HakAkses");   
        return $query->result();
    }
    public function insert_notification($data){
        $data["Date"]    = date("Y-m-d H:i:s"); 
        $data["UserAdd"] = $this->session->Name; 
        $data["DateAdd"] = date("Y-m-d H:i:s"); 
        $this->db->insert("UT_Notification",$data);
    }
    public function notification(){

        $filter = $this->input->post("filter");
        $length = $this->input->post("length");
        $start  = $this->input->post("start");
        $this->db->select("
            N.NotificationID as NotificationID,
            N.ID             as ID,
            N.TypeID         as TypeID,
            FromID           as FromID,
            F.Name           as FromName,
            ToID             as ToID,
            T.Name           as ToName,
            N.Type           as Type,
            N.Message        as Message,
            N.Date           as Date,
            N.ReadNotif      as Read,
            TL.Name          as ProjectName
        ");
        $this->db->join("UT_User as U","N.UserID = U.UserID","left");
        $this->db->join("UT_User as F","N.FromID = F.UserID","left");
        $this->db->join("UT_User as T","N.ToID   = T.UserID","left");
        $this->db->join("SP_TransactionList as TL","N.ID = TL.TransactionListID and N.TypeID ='TransactionListID' ","left");
        $this->db->where("N.ToID",$this->session->UserID);
        if($filter == "read"):
            $this->db->where("N.ReadNotif",1);
        elseif($filter == "unread"):
            $this->db->where("N.ReadNotif",0);
        endif;

        // $this->db->where("N.ToID",100);
        $this->db->order_by("N.DateAdd","DESC");
        $this->db->order_by("N.ReadNotif","ASC");
        $this->db->limit($length, $start);
        $query = $this->db->get("UT_Notification as N");
        return $query->result();
    }
    public function hitung_hari($StartDate,$EndDate){
        $StartDate  = date("Y-m-d",strtotime($StartDate));
        $EndDate    = date("Y-m-d",strtotime($EndDate));
        $tglAwal    = strtotime($StartDate);
        $tglAkhir   = strtotime($EndDate);
        $jeda       = abs($tglAkhir - $tglAwal);
        return floor($jeda /(60*60*24)) + 1;
    }
    
    #custom-----------------------------------------------------------------------------------------------------------------
    public function faq(){
        $this->db->select("ContentID,Name,Description");
        $this->db->where("Type","faq");
        $this->db->where("Active",1);
        $this->db->order_by("ContentID","asc");
        $query = $this->db->get("Content");
        return $query->result();
    }
    public function content_list($page = "",$ID="")
    {
        $default    = site_url("aset/img/default.png");
        $category   = $this->input->post("category"); 
        $pagenum    = $this->input->post("pagenum");
        $Search     = $this->input->post("Search");
        $Status     = $this->input->post("Status");
        if(empty($pagenum)):
          $pagenum = 1;
        endif;
        if($page == "blog_main"):
            $pagestart = $this->main->set_("FeaturePostLimit");
        elseif($page == "news_main"):
            $pagestart = $this->main->set_("FeatureNewsLimit");
        else:
            if($category == "news"):
                $pagestart = $this->main->set_("PostLimitNews");
            else:
                $pagestart = $this->main->set_("PostLimitBlog");
            endif;
        endif;

        $pagenum = $pagenum - 1;
        $pagenum = $pagenum * $pagestart;
        $this->db->select("
            content.ContentID,
            content.Name        as Name,
            content.DateAdd     as Date,
            content.Active,
            case 
            when content.Category = 'news' then 'Berita' 
            when content.Category = 'event' then 'Event' 
            when content.Category = 'motivation' then 'Motivasi' 
            else 'Tanpa Kategori' end   as Category,
            content.Category            as CategoryCode,
            content.CategoryStatus      as CategoryStatus,
            (case when content.Summary = '' or content.Summary is null then '' else content.Summary end) as Summary,
            content.Description         as Description,
            content.Image               as Img,
            '$default'                  as DefaultImage,
            (CASE 
            WHEN content.Image IS NOT NULL THEN CONCAT('$this->host/',content.Image) 
            WHEN content.Image = '/' THEN '$default' 
            ELSE  '$this->host/aset/img/default.png' END) as Image,
            (case when content.UserCh is null then content.UserAdd else content.UserCh end) as Author,
            (case when content.DateCh is null then content.DateAdd else content.DateCh end) as DateModify,
        ");
        $this->db->join("UT_User as user","content.UserID = user.UserID","left");
        $this->db->where("content.Active",1);
        if($category):
            if($category == "news"):
                $this->db->where_in("content.Category",array("news","event"));
            else:
                $this->db->where("content.Category",$category);
            endif;
        endif;
        if($Search):
            $this->db->group_start();
            $this->db->like("content.Name",$Search);
            $this->db->or_like("content.Category",$Search);
            $this->db->or_like("content.Summary",$Search);
            $this->db->or_like("user.Name",$Search);
            $this->db->group_end();
        endif;
        $this->db->where("content.Type","content");
        $this->db->order_by("content.ContentID","DESC");
        if($page == "all"):
            $this->db->limit($pagestart,$pagenum);
        elseif($page == "news_event"):
            $this->db->limit($pagestart,$pagenum);
        elseif($page == "news_main" || $page == "blog_main"):

            if($page == "news_main"):
                $this->db->where_in("content.Category",array("news","event"));
            else:
                $this->db->where("content.Category","post");
            endif;

            $this->db->where("content.CategoryStatus","main");
            $this->db->limit($pagestart);
        endif;
        $this->db->order_by("content.DateAdd","desc");
        $query = $this->db->get("Content as content");
        if($page == "total_data"):
            return $query->num_rows();
        else:
            return $query->result();
        endif;
    }

    public function content_detail($ID){
        $default = site_url("aset/img/default.png");
        $this->db->select("
            content.ContentID,
            content.Name        as Name,
            content.NameColor   as NameColor,
            content.DateAdd     as Date,
            content.Summary     as Summary,
            content.Description as Description,
            content.Image       as Img,
            '$default'          as DefaultImage,
            content.Template    as Template,
            case 
            when content.Category = 'news' then 'Berita' 
            when content.Category = 'event' then 'Event' 
            when content.Category = 'motivation' then 'Motivasi' 
            else 'Tanpa Kategori' end   as Category,
            content.Category            as CategoryCode,
            content.Type        as Type,
            (CASE 
            WHEN content.Image IS NOT NULL THEN CONCAT('$this->host/',content.Image) 
            WHEN content.Image = '/' THEN '$default' 
            ELSE  '$this->host/aset/img/default.png' END) as Image,
            user.Name           as UserName,
        ");
        $this->db->join("UT_User as user","content.UserID = user.UserID","left");
        $this->db->where("Link",$ID);
        $query = $this->db->get("Content as content");
        return $query->row();
    }
    public function page($page = ""){
        $data = array();
        if($page == "list_data" || $page == "list_data_menu"):
            $this->db->select("ContentID,Name,Link");
            $this->db->where("Type","page");
            if($page == "list_data_menu"):
                $this->db->where("Active",1);
            endif;
            $query  = $this->db->get("Content");
            $data   = $query->result();
        endif;
        return $data;
    }
    public function footer_content(){
        $this->db->select("ContentID,Name");
        $this->db->where("Type","content");
        $this->db->order_by("ContentID","desc");
        $this->db->limit(5);
        $query = $this->db->get("Content");
        return $query->result();
    }
    public function save_slideshow($data)
    {
        $this->db->set("UserAdd",$this->session->Name);
        $this->db->set("DateAdd",date("Y-m-d H:i:s"));
        $this->db->insert('UT_Attachment', $data);
        return $this->db->insert_id();
    }
    public function slideshow($modul = "",$id = "",$language=""){
        $table      = "UT_Attachment";
        $default    = site_url("aset/img/default.png");
        $data       = array();
        if($modul == "list_data"):
            $this->db->select("
                UT_Attachment.AttachmentID,
                UT_Attachment.ParentID,
                UT_Attachment.AttachmentID as ID,
                UT_Attachment.Name,
                UT_Attachment.NameColor,
                UT_Attachment.Description,
                UT_Attachment.Type,
                UT_Attachment.Sort,
                UT_Attachment.Active,
                (CASE 
                WHEN UT_Attachment.Patch IS NOT NULL THEN CONCAT('$this->host/',UT_Attachment.Patch) 
                WHEN UT_Attachment.Patch = '/' THEN '$default' 
                ELSE  '$this->host/aset/img/default.png' END) as Patch,
                UT_Attachment.Position,
                UT_Attachment.ButtonLink,
                UT_Attachment.Language,

                eng.AttachmentID as AttachmentIDeng,
                eng.ParentID,
                eng.AttachmentID as ID,
                eng.Name as Nameeng,
                eng.NameColor as NameColoreng,
                eng.Description as Descriptioneng,
                eng.Type as Typeeng,
                eng.Sort as Sorteng,
                eng.Active as Activeeng,
                eng.Position as Positioneng,
                eng.ButtonLink as ButtonLinkeng,
                eng.Language
            ");
            $this->db->join("UT_Attachment as eng", "UT_Attachment.AttachmentID = eng.ParentID", "left");
            $language   = $this->session->bahasa;
            if($language == "indonesia"):
                $this->db->where("UT_Attachment.Language", 1);
            else:
                $this->db->where("UT_Attachment.Language", 2);
            endif;
            $this->db->where("UT_Attachment.Type","slideshow");
            $this->db->order_by("UT_Attachment.Sort","asc");
            $query = $this->db->get("UT_Attachment");
            $data  = $query->result();
        elseif($modul == "last_sort"):
            $this->db->select("Sort");
            $this->db->where("Type","slideshow");
            $this->db->order_by("Sort","desc");
            $this->db->limit(1);
            $query = $this->db->get("UT_Attachment");
            $query = $query->row();
            if($query):
                $data = $query->Sort;
            else:
                $data = 1;
            endif;
        elseif($modul == "edit"):
            $this->db->select("
                UT_Attachment.AttachmentID,
                UT_Attachment.AttachmentID as ID,
                UT_Attachment.Name,
                UT_Attachment.NameColor,
                UT_Attachment.Description,
                UT_Attachment.Type,
                UT_Attachment.Sort,
                UT_Attachment.Active,
                (CASE 
                WHEN UT_Attachment.Patch IS NOT NULL THEN CONCAT('$this->host/',UT_Attachment.Patch) 
                WHEN UT_Attachment.Patch = '/' THEN '$default' 
                ELSE  '$this->host/aset/img/default.png' END) as Patch,
                UT_Attachment.Position,
                UT_Attachment.ButtonLink,

                eng.AttachmentID as AttachmentIDeng,
                eng.ParentID,
                eng.AttachmentID as ID,
                eng.Name as Nameeng,
                eng.NameColor as NameColoreng,
                eng.Description as Descriptioneng,
                eng.Type as Typeeng,
                eng.Sort as Sorteng,
                eng.Active as Activeeng,
                (CASE 
                WHEN eng.Patch IS NOT NULL THEN CONCAT('$this->host/',eng.Patch) 
                WHEN eng.Patch = '/' THEN '$default' 
                ELSE  '$this->host/aset/img/default.png' END) as Patch,
                eng.Position as Positioneng,
                eng.ButtonLink as ButtonLinkeng,
                eng.Language as Languageeng
            ");
            $this->db->join("UT_Attachment as eng", "UT_Attachment.AttachmentID = eng.ParentID", "left");
            $this->db->where("UT_Attachment.AttachmentID",$id);
            $query = $this->db->get("UT_Attachment");
            $data  = $query->row();
        endif;
        return $data;
    }
    public function ProductList($Modul = "",$ID = ""){
        $noicon = $this->host."aset/img/noicon.png";
            // (CASE WHEN A.Image IS NOT NULL THEN CONCAT('$this->host/',A.Image) ELSE  '$noicon' END) as Image,
        $this->db->select("
            A.ProductID,
            A.Code,
            A.Date,
            A.DateAdd,
            A.Name,
            CONCAT('$this->host','product/detail/',A.Link) as Link,
            A.Type,
            A.Category,
            A.CategoryStatus,
            A.Active,
            A.Location,
            ifnull(A.Summary,'') as Summary,
            (CASE WHEN A.Active = '1' THEN 'publish' ELSE 'unpublish' END) as ActiveLabel,
            (CASE 
            WHEN (SELECT Z.Image FROM ProductImage as Z where Z.ProductID = A.ProductID LIMIT 1) IS NOT NULL 
            THEN (SELECT concat('$this->host',Z.Image) FROM ProductImage as Z where Z.ProductID = A.ProductID LIMIT 1) 
            ELSE  '$noicon' END) as Image,
            (case when A.UserCh is null then A.UserAdd else A.UserCh end) as Author,
            (case when A.DateCh is null then A.DateAdd else A.DateCh end) as DateModify,
            B.Name as CategoryName
        ");
        $this->db->from("Product as A");
        $this->db->join('Category as B','A.CategoryID = B.CategoryID','left');
        if($Modul == "ByCategory"):
            $this->db->where("A.Active",1);
            $this->db->where("B.Link",$ID);
            $this->db->order_by("ProductID","desc");
        endif;
        $query = $this->db->get();
        return $query->result();
    }
    public function ProductDetail($ID){
        $noicon = $this->host."aset/img/noicon.png";
        $this->db->select("
            A.ProductID,
            A.Code      as Code,
            A.DateAdd   as Date,
            A.Name      as Name,
            A.NameColor as NameColor,
            CONCAT('$this->host','product/detail/',A.Link) as Link,
            A.Type      as Type,
            A.Category  as Category,
            A.ImageStatus  as ImageStatus,
            A.CategoryStatus,
            A.Active,
            A.Location,
            ifnull(A.Summary,'') as Summary,
            ifnull(A.Description,'') as Description,
            A.Image       as Img,
            (CASE WHEN A.Active = '1' THEN 'publish' ELSE 'unpublish' END) as ActiveLabel,
            (CASE WHEN A.Image IS NOT NULL THEN CONCAT('$this->host',A.Image) ELSE  '' END) as Image,
            (case when A.UserCh is null then A.UserAdd else A.UserCh end) as Author,
            (case when A.DateCh is null then A.DateAdd else A.DateCh end) as DateModify,
            A.Template,
            B.Link      as CategoryLink,
            B.Name      as CategoryName,
            B.Icon      as CategoryIcon,
            B.SeoText   as SeoText
        ");
        $this->db->from("Product as A");
        $this->db->join('Category as B','A.CategoryID = B.CategoryID','left');
        $this->db->where("A.ProductID",$ID);
        $this->db->or_where("A.Link",$ID);
        $this->db->order_by("ProductID","asc");
        $query = $this->db->get();
        return $query->row();
    }
    public function ProductDetailImage($ID){
        $this->db->select("A.Image, A.Name");
        $this->db->join("Product as B","A.ProductID = B.ProductID","left");
        $this->db->where("B.Link",$ID);
        $query = $this->db->get("ProductImage as A");
        return $query->result();
    }

    public function ArticleList($Modul = "",$ID = ""){
        $noicon = $this->host."aset/img/noicon.png";
            // (CASE WHEN A.Image IS NOT NULL THEN CONCAT('$this->host/',A.Image) ELSE  '$noicon' END) as Image,
        $this->db->select("
            A.ArticleID,
            A.Code,
            A.Date,
            A.DateAdd,
            A.Name,
            CONCAT('$this->host','article/detail/',A.Link) as Link,
            A.Type,
            A.Category,
            A.CategoryStatus,
            A.Active,
            A.Location,
            ifnull(A.Summary,'') as Summary,
            (CASE WHEN A.Active = '1' THEN 'publish' ELSE 'unpublish' END) as ActiveLabel,
            (CASE 
            WHEN (SELECT Z.Image FROM ArticleImage as Z where Z.ArticleID = A.ArticleID LIMIT 1) IS NOT NULL 
            THEN (SELECT concat('$this->host',Z.Image) FROM ArticleImage as Z where Z.ArticleID = A.ArticleID LIMIT 1) 
            ELSE  '$noicon' END) as Image,
            (case when A.UserCh is null then A.UserAdd else A.UserCh end) as Author,
            (case when A.DateCh is null then A.DateAdd else A.DateCh end) as DateModify,
            B.Name as CategoryName
        ");
        $this->db->from("Article as A");
        $this->db->join('Category as B','A.CategoryID = B.CategoryID','left');
        if($Modul == "ByCategory"):
            $this->db->where("A.Active",1);
            $this->db->where("B.Link",$ID);
            $this->db->order_by("ArticleID","desc");
        endif;
        $query = $this->db->get();
        return $query->result();
    }
    public function ArticleDetail($ID){
        $noicon = $this->host."aset/img/noicon.png";
        $this->db->select("
            A.ArticleID,
            A.Code      as Code,
            A.DateAdd   as Date,
            A.Name      as Name,
            A.NameColor as NameColor,
            CONCAT('$this->host','article/detail/',A.Link) as Link,
            A.Type      as Type,
            A.Category  as Category,
            A.ImageStatus  as ImageStatus,
            A.CategoryStatus,
            A.Active,
            A.Location,
            ifnull(A.Summary,'') as Summary,
            ifnull(A.Description,'') as Description,
            A.Image       as Img,
            (CASE WHEN A.Active = '1' THEN 'publish' ELSE 'unpublish' END) as ActiveLabel,
            (CASE WHEN A.Image IS NOT NULL THEN CONCAT('$this->host',A.Image) ELSE  '' END) as Image,
            (case when A.UserCh is null then A.UserAdd else A.UserCh end) as Author,
            (case when A.DateCh is null then A.DateAdd else A.DateCh end) as DateModify,
            A.Template,
            B.Link      as CategoryLink,
            B.Name      as CategoryName,
            B.Icon      as CategoryIcon,
            B.SeoText   as SeoText
        ");
        $this->db->from("Article as A");
        $this->db->join('Category as B','A.CategoryID = B.CategoryID','left');
        $this->db->where("A.ArticleID",$ID);
        $this->db->or_where("A.Link",$ID);
        $this->db->order_by("ArticleID","asc");
        $query = $this->db->get();
        return $query->row();
    }
    public function ArticleDetailImage($ID){
        $this->db->select("A.Image, A.Name");
        $this->db->join("Article as B","A.ArticleID = B.ArticleID","left");
        $this->db->where("B.Link",$ID);
        $query = $this->db->get("ArticleImage as A");
        return $query->result();
    }
    public function ListExperience($Limit,$Start){
        $this->db->select("
            A.Name      as Name,
            CONCAT('$this->host','experience/',A.Link) as Link,
            (CASE WHEN A.Image IS NOT NULL THEN CONCAT('$this->host',A.Image) ELSE  '' END) as Image,
        ");
        $this->db->where("Type","experience");
        $this->db->limit($Limit,$Start); 
        $query = $this->db->get("Content as A");
        return $query->result();
    }
     public function member_select($active=""){
        $select     = $this->input->post("select");
        $type       = $this->input->post('type');
        $email      = $this->input->post('email');
        $subscribe = $this->input->post('subscribe');

        $this->db->select("
            MemberID,
            Name,
            Email,
            Member_type,
        ");
        if($active != ""):
            $this->db->where("Active", 1);
        endif;

        if($select == "active"):
            $this->db->where("Active", 1);
        endif;
        if($email == "active"):
            $this->db->group_start();
            $this->db->or_where("Email !=", "");
            $this->db->group_end();
        endif;
        if($subscribe == "active"):
            $this->db->where("Subscribe", 1);
        endif;

        $query = $this->db->get("Member");

        return $query->result();
    }
    public function member($page = "",$id = "",$membertype="",$active="",$email="",$subscribe=""){
        $this->db->select("
           MemberID,
           Name,
           Email,
           Member_type,
           Active,
           Image,
           ImageUrl,
           Remark
        ");
        $this->db->order_by("Name","ASC");
        
        if($active == "active"):
            $this->db->where("Active", 1);
        endif;
        
        if($email == "active"):
            $this->db->group_start();
            $this->db->or_where("Email !=", "");
            $this->db->group_end();
        endif;

        if($membertype != ""):
            $this->db->where("Member_type", $membertype);
        endif;

        if($subscribe == "active"):
            $this->db->where("Subscribe", 1);
        endif;

        if($page == "detail"):
            $this->db->where("MemberID",$id);
        elseif($page == "detail_array"):
            $this->db->where_in("MemberID", $id);
        endif;

        $query = $this->db->get("Member");
        
        if($page == "detail"):
            return $query->row();
        else:
            return $query->result();
        endif;
    }

    public function email_member(){
        $list = $this->member("","","","active","active","active");
        $email = array();
        foreach ($list as $k => $v) {
            if (filter_var($v->Email, FILTER_VALIDATE_EMAIL)):
                array_push($email, $v->Email);
            endif;
        }
        return $email;
    }

    public function getDetailArticle($id,$page=""){
        $language = $this->session->bahasa;
        if($language == "english" and $page == "front"):
            $this->db->select("
                ifnull(eng.ArticleID, article.ArticleID) as ArticleID,
                ifnull(eng.Name, article.Name) as Name,
                ifnull(eng.Description, article.Description) as Description,
                ifnull(eng.Active, article.Active) as Active,
                ifnull(eng.Summary, article.Summary) as Summary,
                ifnull(eng.Keywords, article.Keywords) as Keywords,

                article.Name as Namelink,

                (CASE WHEN article.Image IS NOT NULL THEN article.ImageUrl ELSE  'aset/img/background/background-article.jpg' END) as ImageUrl
            ");
            $this->db->join("Article as eng", "article.ArticleID = eng.ParentID", "left");
        else:
            $this->db->select("
                article.ArticleID,
                article.Name,
                article.Description,
                article.Active,
                article.Summary,
                article.Keywords,

                article.Name as Namelink,

                (CASE WHEN article.Image IS NOT NULL THEN article.ImageUrl ELSE  'aset/img/background/background-article.jpg' END) as ImageUrl
            ");
        endif;
        $this->db->select("
            Category.SeoText,
        ");
        $this->db->join("Category", "Category.CategoryID = article.CategoryID", "left");
        if($page == "front"):
            $name = str_replace('-', " ", $id);
            $this->db->where("article.Name", $name);
        else:
            $this->db->where('article.ArticleID', $id);
        endif;
        $query = $this->db->get("Article as article");
        return $query->row();
    }

    public function getSlideshow($Active=""){
        $this->db->select("
                UT_Attachment.AttachmentID,
                UT_Attachment.AttachmentID as ID,
                UT_Attachment.Name,
                UT_Attachment.NameColor,
                UT_Attachment.Description,
                UT_Attachment.Type,
                UT_Attachment.Sort,
                UT_Attachment.Active,
                UT_Attachment.Position,
                UT_Attachment.ButtonLink
            ");
        $this->db->join("UT_Attachment as eng", "UT_Attachment.AttachmentID = eng.ParentID", "left");
        $this->db->order_by("UT_Attachment.AttachmentID", "desc");
        if($Active == "active"):
            $this->db->where("UT_Attachment.Active", 1);
        endif;
        $this->db->where("UT_Attachment.Language", 1);
        $query = $this->db->get("UT_Attachment");
        return $query->result();
    }
    public function getSlideshoweng($Active=""){
        $this->db->select("
                ifnull(eng.AttachmentID, UT_Attachment.AttachmentID)        as AttachmentID,
                ifnull(eng.AttachmentID, UT_Attachment.AttachmentID)        as ID,
                ifnull(eng.Name, UT_Attachment.Name)                        as Name,
                ifnull(eng.NameColor, UT_Attachment.NameColor)              as NameColor,
                ifnull(eng.Description, UT_Attachment.Description)          as Description,
                ifnull(eng.Type, UT_Attachment.Type)                        as Type,
                ifnull(eng.Sort, UT_Attachment.Sort)                        as Sort,
                ifnull(eng.Active, UT_Attachment.Active)                    as Active,
                ifnull(eng.Position, UT_Attachment.Position)                as Position,
                ifnull(eng.ButtonLink, UT_Attachment.ButtonLink)            as ButtonLink
            ");
        $this->db->join("UT_Attachment as eng", "UT_Attachment.AttachmentID = eng.ParentID", "left");
        $this->db->order_by("UT_Attachment.AttachmentID", "desc");
        if($Active == "active"):
            $this->db->where("UT_Attachment.Active", 1);
        endif;
        $this->db->where("UT_Attachment.Language", 1);
        $query = $this->db->get("UT_Attachment");
        return $query->result();
    }
    public function getArticle($Active=""){
        $this->db->select("
            Article.ArticleID,
            Article.Name,
            Article.Active,
            Article.ImageUrl,
            Article.Image,
            Article.Date,
            Article.Description,
            Article.Summary,
            Article.Keywords,
            Article.Name as Namelink,
            ");
        $this->db->join("Article as eng", "Article.ArticleID = eng.ParentID", "left");
        $this->db->order_by("Article.ArticleID", "desc");
        if($Active == "active"):
            $this->db->where("Article.Active", 1);
        endif;
        $this->db->where("Article.Language", 1);
        $query = $this->db->get("Article");
        return $query->result();
    }

     public function getArticleeng($Active=""){
        $this->db->select("
            ifnull(eng.ArticleID, Article.ArticleID)        as ArticleID,
            ifnull(eng.Name, Article.Name)                  as Name,
            ifnull(eng.Active, Article.Active)              as Active,
            ifnull(Article.ImageUrl, Article.ImageUrl)      as ImageUrl,
            ifnull(Article.Date, Article.Date)              as Date,
            ifnull(eng.Description, Article.Description)    as Description,
            ifnull(eng.Summary, Article.Summary)            as Summary,
            ifnull(eng.Keywords, Article.Keywords)          as Keywords,
            Article.Name as Namelink,
            ");
        $this->db->join("Article as eng", "Article.ArticleID = eng.ParentID", "left");
        if($Active == "active"):
            $this->db->where("Article.Active", 1);
        endif;
        $this->db->order_by("Article.ArticleID", "desc");
        $this->db->where("Article.Language", 1);
        $query = $this->db->get("Article");
        return $query->result();
    }

    public function get_text($string = ""){
        $v = explode(" ", $string);

        $awal = '<b>'.$v[0].'</b>';
        $text = '';
        foreach ($v as $k => $v) {
            if($k != 0):
                $text .= $v." ";
            endif;
        }
        return array($awal,$text);
    }

    public function get_link_article($id,$page=""){
        $link = '';
        if($page == "name"):
            $link = strtolower($id);
            $replace = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]",".");
            $link = str_replace($replace, '', $link);
            $link = str_replace(' ', '-', $link);
        endif;

        return $link;
    }
    public function get_slideshow($Active="",$Type="",$Type2="",$page=""){
        $this->db->select("
            SliderID,
            ImageUrl,
            ifnull(ImageUrlCrop, ImageUrl) as ImageUrlCrop,
            Cek,
            Type,
            Type2,
            Active,
            ");
        if($Type2):
            $this->db->where("Type2", $Type2);
        endif;
        if($Type):
            $this->db->where("Type",1);
        endif;
        if($Active):
            $this->db->where("Active",1);
        endif;
        $query = $this->db->get("Slider");
        if($page == "detail"):
            return $query->row();
        else:
            return $query->result();
        endif;
    }
    public function link_whatsapp($text = ""){
        $url        = "";
        $iphone     = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android    = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre    = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry      = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod       = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        // check if is a mobile
        if ($iphone || $android || $palmpre || $ipod || $berry == true){
            $url = 'https://api.whatsapp.com/send?'.$text;
        } else {
            $url = 'https://web.whatsapp.com/send?'.$text;
        }
        return $url;
    }

    public function save_attachment($a){
        if($a['EmailID']):
            $filename      = $a['Type'].'-'.date('Ymdhis').$a['Key'];
            $SeoFile       = '';
            $Type          = $a['Type'];
            $EmailID       = $a['EmailID'];
            $FormatFile    = $a['FormatFileB64'];
            $FormatFile    = $this->format_attachment($FormatFile);
            $File          = $a['FileB64'];
            $image_parts   = explode(";base64,", $File);
            // $image_type_aux = explode("image/", $image_parts[0]);
            // $image_type  = $image_type_aux[1];
            $image_base64   = base64_decode($image_parts[1]);
            $filename = $this->clean($filename);
            $filename = $SeoFile.$filename;
            $filename = 'file/'.$filename.".".$FormatFile;
            $file     = APPPATH . '../'.$filename;
            file_put_contents($file, $image_base64);
            // $data['CompanyID']   = $CompanyID;
            $data['EmailID']     = $EmailID;
            $data['Type']        = $Type;
            $data['Name']        = $filename;
            $data['File']        = $filename;
            $data['FileBase64']  = $a['FileB64'];
            $data['FormatFile']  = $FormatFile;
            $data['UserAdd']     = $this->session->Name;
            $data['DateAdd']     = date("Y-m-d H:i:s");
            $this->db->insert("SP_EmailAttachment",$data);
        endif;
    }
    public function format_attachment($format){
        if($format == 'pdf'){
            $format = 'pdf'; 
        } else if($format == "vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
            $format = 'xlsx'; 
        } else if($format == "vnd.ms-excel"){
            $format = 'xls'; 
        } else if($format == "vnd.openxmlformats-officedocument.wordprocessingml.document"){
            $format = 'docx'; 
        } else if($format == "msword"){
            $format = 'doc'; 
        } else if($format == "plain"){
            $format = 'txt';
        } else {
            $format = 'jpg';
        }
        return $format;
    }
    public function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    public function remove_attachment($id = "",$modul = ""){
        $Status  = false;
        $Message = "Terjadi kesalahan, gagal menghapus file";
        if($id):
            if($modul == "all"):
                $list = $this->rencana_pekerjaan->list_attachment($id);
                foreach($list as $a):
                    $this->main->hapus_gambar('SP_EmailAttachment','File',array('AttachmentID'=>$a->AttachmentID));
                    $this->db->where("AttachmentID",$a->AttachmentID);
                    $this->db->delete("SP_EmailAttachment");
                endforeach;
            else:
                $this->main->hapus_gambar('SP_EmailAttachment','File',array('AttachmentID'=>$id));
                $this->db->where("AttachmentID",$id);
                $this->db->delete("SP_EmailAttachment");
            endif;
            $Status  = true;
            $Message = "Berhasil menghapus data";
        endif;
        if($modul == "all"):
            
        else:
            $output              = array(
                "HakAkses"       => $this->session->HakAkses,
                "Status"         => $Status,
                "Message"        => $Message,
            );
            header('Content-Type: application/json');
            echo json_encode($output,JSON_PRETTY_PRINT);
        endif;
    }
    public function list_attachment($id,$type){
        $this->db->select("AttachmentID,EmailID,File,FormatFile,Name");
        $this->db->where("CompanyID",$this->session->CompanyID);
        $this->db->where("Type",$type);
        $this->db->where("EmailID",$id);
        $query = $this->db->get("SP_EmailAttachment");
        return $query->result();
    }
    function encrypt($str) {
      $kunci = 'rc158';
      $hasil = '';
      for ($i = 0; $i < strlen($str); $i++) {
          $karakter = substr($str, $i, 1);
          $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
          $karakter = chr(ord($karakter)+ord($kuncikarakter));
          $hasil .= $karakter;
      }
      return urlencode(base64_encode($hasil));
    }

    function decrypt($str) {
      $str = base64_decode(urldecode($str));
      $hasil = '';
      $kunci = 'rc158';
      for ($i = 0; $i < strlen($str); $i++) {
          $karakter = substr($str, $i, 1);
          $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
          $karakter = chr(ord($karakter)-ord($kuncikarakter));
          $hasil .= $karakter;
          
      }
      return $hasil;
    }

    public function get_attach_broadcast($id){
        $this->db->select("
            AttachmentID,
            EmailID,
            Name,
            File,
        ");

        $this->db->where("EmailID", $id);
        $this->db->from("SP_EmailAttachment");
        $query = $this->db->get();

        return $query->result();
    }
}