<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#tanggal 2017-08-30
#author m iqbal ramadhan
class M_main extends CI_Model {
    var $SiteTitle = 'Rumah Ruth';
    var $Logo      = 'aset/img/newlogo.png';
    var $Icon      = 'aset/img/favicon.ico';
    var $TimeZone  = 'Asia/Jakarta';
    public function __construct()
    {
        parent::__construct();
        $this->set_('TimeZone');
        $this->Logo = site_url($this->Logo);
        $this->Icon = site_url($this->Icon);
        $this->load->language('bahasa',$this->session->bahasa);
    }
    public function bahasa($bahasa){
        $this->session->set_userdata("bahasa",$bahasa);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function set_($set){
        $data_set   = '';
        if(in_array($set, array("SiteTitle","Logo","Icon","TimeZone"))):
            $data_set   = $this->{$set};
        endif;
        $data       = $this->get_setting_val($set,"Code");
        if($data):
            if($data->Value != ''):
                if(in_array($set,array("Logo","Icon"))):
                    $data_set = site_url($data->Value);
                else:
                    $data_set = $data->Value;
                endif;
            endif;
        endif;
        if($set == "TimeZone"):
            date_default_timezone_set($data_set);
        endif;
        return $data_set;
    }
    public function get_setting_val($Search,$Type = ""){
        if($Type == "Code"):
            $this->db->where("Code",$Search);
        else:
            $this->db->where("GeneralID",$Search);
        endif;
        $query = $this->db->get("UT_General");
        return $query->row();
    }
    public function generate_timezone_list()
    {
        static $regions = array(
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        );

        $timezones = array();
        foreach( $regions as $region )
        {
            $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
        }

        $timezone_offsets = array();
        foreach( $timezones as $timezone )
        {
            $tz = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($timezone_offsets);

        $timezone_list = array();
        foreach( $timezone_offsets as $timezone => $offset )
        {
            $offset_prefix              = $offset < 0 ? '-' : '+';
            $offset_formatted           = gmdate( 'H:i', abs($offset) );
            $pretty_offset              = "UTC${offset_prefix}${offset_formatted}";
            // $timezone_list[$timezone]   = "(${pretty_offset}) $timezone";
            $timezone_list[] = array(
                'Name'  =>  "(${pretty_offset}) $timezone",
                'Value' => $timezone
            );
        }
        $timezone_list = json_encode($timezone_list);
        $timezone_list = json_decode($timezone_list);
        return $timezone_list;
    }
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    public function number_to_alphabet($number) {
        $number = intval($number);
        if ($number <= 0) {
            return '';
        }
        $alphabet = '';
        while($number != 0) {
            $p = ($number - 1) % 26;
            $number = intval(($number - $p) / 26);
            $alphabet = chr(65 + $p) . $alphabet;
        }
        return $alphabet;
    }
    public function cek_session($page = "")
    {
        if($page == "luar"):
            if($this->session->login):
                redirect("dashboard");
            endif;
        else:
            if(!$this->session->login):
                redirect("login");
            endif;
        endif;
        if($this->session->position || $this->session->position == "frontend"):
            $this->session->set_userdata("position","backend");
        endif;

    }
    public function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    public function echoJson($data){
        header('Content-Type: application/json');
        echo json_encode($data,JSON_PRETTY_PRINT);
    }
    public function hash($password){
        $password   = "kimochi".$password."ikeh";
        $hash       = sha1($password);
        return $hash;
    }
    public function login($page = "",$Email = "")
    {
        if($page == "konfirmasi_akun"):
            $Email    = $Email;
        else:
            $this->validation->login();
            $Email    = $this->input->post("Email");
            $Password = $this->input->post("Password");
            $Password = $this->hash($Password);
        endif;
        $this->db->select("
            UT_User.UserID,
            UT_User.CompanyID,
            UT_User.Email,
            UT_User.Name,
            UT_User.HakAksesID,
            UT_User.Image as ImageUser,
            UT_User.Image,
            UT_HakAkses.HakAkses,
            company.Image as CompanyImage,
            company.Name  as CompanyName
        ");
        $this->db->join("UT_HakAkses","UT_User.HakAksesID = UT_HakAkses.HakAksesID","left");
        $this->db->join("UT_User as company","UT_User.CompanyID = company.UserID","left");
        $this->db->where("UT_User.Active",1);
        $this->db->where("UT_User.Email",$Email);
        if($page == "konfirmasi_akun"):

        else:
           $this->db->where("UT_User.Password",$Password);
        endif;
        // $this->db->where_in("HakAkses",array("developer"));
        $query = $this->db->get("UT_User");
        $a     = $query->row();
        $row   = $query->num_rows();
        if($row > 0):
            $CompanyID      = 0;
            $CompanyImage   = '';
            $CompanyName    = '';
            if(!in_array($a->HakAksesID, array(1,2))){
                $CompanyID      = $a->CompanyID;
                $CompanyImage   = $a->CompanyImage;
                $CompanyName    = $a->CompanyName;
            } else {
                $CompanyID      = $a->UserID;
                $CompanyImage   = $a->Image;
                $CompanyName    = $a->Name; 
            }

            if(!$CompanyImage):
                $CompanyImage = 'aset/img/header.jpg';
            endif;
            $data = array(
                'login'         => TRUE,
                'UserID'        => $a->UserID,
                'Email'         => $a->Email,
                'Name'          => $a->Name,
                'HakAkses'      => $a->HakAkses,
                'HakAksesID'    => $a->HakAksesID,
                'Image'         => $a->ImageUser,
                'CompanyID'     => $CompanyID,
                "CompanyName"   => $CompanyName,
                "CompanyImage"  => $CompanyImage
            );
            $this->session->set_userdata($data);
            $data["success"]  = TRUE;
            $data["status"]   = TRUE;
            $data["message"]  = "Login Success";
            $data["redirect"] = site_url("dashboard");
        else:
            $data["popup"]    = TRUE;
            $data["status"]   = FALSE;
            $data["message"]  = "Login Failed";
        endif;
        return $data;
    }
    public function URLModul(){
        $current_url = current_url();
        $base_url    = base_url();
        $url         = str_replace($base_url, "", $current_url);
        return $url;
    }
    public function GetMenuID($url = "")
    {

        if($url == ""):
            $current_url = current_url();
            $base_url    = base_url();
            $url         = str_replace($base_url, "", $current_url);
        endif;

        $urlFilter  = 0;
        $MenuID     = 0;
        $this->db->select('MenuID');
        $this->db->from('UT_Menu');
        if($url == "current_url"):
            $url = current_url();
            $url = str_replace(base_url(), "", $url);
            $this->db->where('Url',$url);
        else:
            $this->db->like('Url',$url);
            $this->db->or_like('Root',$url);
        endif;
        $data = $this->db->get()->row();
        if($data):
            $MenuID = $data->MenuID;
        endif;
        $urlFilter = $this->MenuFilter($MenuID);
        $this->session->set_userdata("urlFilter",$urlFilter);
        return $MenuID;
    }
    public function GetMenuName($url)
    {
        $Value = 'Nothing';
        $this->db->select('Name');
        $this->db->from('UT_Menu');
        if($url == "current_url"):
            $url = current_url();
            $url = str_replace(base_url(), "", $url);
            $this->db->where('Url',$url);
        else:
            $this->db->like('Url',$url);
            $this->db->or_like('Root',$url);
        endif;
        $data = $this->db->get()->row();
        if($data):
            $Value = $data->Name;
        endif;
        return $Value;
    }
    public function MenuFilter($MenuID){
        $value          = 0; //perbranch
        $this->db->select("Filter");
        $this->db->where("HakAksesID",$this->session->HakAksesID);
        $q              = $this->db->get("UT_HakAkses");
        $data           = $q->row();
        $arrayID        = array();
        $arrayFilter    = array();
        $data_filter    = json_decode($data->Filter);
        if(count($data_filter) > 0):
            foreach($data_filter as $a):
                if($a->ID == $MenuID):
                    $value  = $a->Filter;
                endif;
            endforeach;
        endif;
        return $value;
    }
    public function menu($kategori="")
    {
        $kategori = "'".$kategori."'";
        $hk     = $this->hak_akses();
        $data   = json_decode($hk);
        $query  = $this->db->query('SELECT MenuID,Name,Url,Icon FROM UT_Menu WHERE Category='.$kategori.' AND MenuID IN (' . implode(',', array_map('intval', $data)) . ') order by Name ASC' );
        return $query->result();
    }
    public function hak_akses()
    {
        $HakAksesID = $this->session->HakAksesID;
        $this->db->select('Menu');
        $this->db->from('UT_HakAkses');
        $this->db->where('HakAksesID',$HakAksesID);
       return $this->db->get()->row()->Menu;
    }

    public function read($MenuID)
    {
        $ihk = $this->session->HakAksesID;
        $query = $this->db->query("SELECT Menu FROM UT_HakAkses WHERE HakAksesID='$ihk' ");
        foreach($query->result() as $b){
            $array = json_decode($b->Menu);
            $count = count(array_keys($array, $MenuID ));
            if($count):
                return $count;
            else:
                return 0;
            endif;
        }
    }
    public function menu_tambah($MenuID)
    {
        $ihk = $this->session->HakAksesID;
        $query = $this->db->query("SELECT Tambah FROM UT_HakAkses WHERE HakAksesID ='$ihk' ");
        foreach($query->result() as $b){
            $array = json_decode($b->Tambah);
            $count = count( array_keys( $array, $MenuID ));
            if($count):
                return $count;
            else:
                return 0;
            endif;
        }
    }
    public function menu_hapus($MenuID)
    {
        $ihk = $this->session->HakAksesID;
        $query = $this->db->query("SELECT Hapus FROM UT_HakAkses WHERE HakAksesID ='$ihk' ");
        foreach($query->result() as $b){
            $array = json_decode($b->Hapus);
            $count = count( array_keys( $array, $MenuID ));
            if($count):
                return $count;
            else:
                return 0;
            endif;
        }
    }
    public function menu_ubah($MenuID)
    {
        $ihk = $this->session->HakAksesID;
        $query = $this->db->query("SELECT Ubah FROM UT_HakAkses WHERE HakAksesID ='$ihk' ");
        foreach($query->result() as $b){
            $array = json_decode($b->Ubah);
            $count = count( array_keys( $array, $MenuID ));
            if($count):
                return $count;
            else:
                return 0;
            endif;
        }
    }
    public function menu_approve($MenuID)
    {
        $ihk = $this->session->HakAksesID;
        $query = $this->db->query("SELECT Approve FROM UT_HakAkses WHERE HakAksesID ='$ihk' ");
        foreach($query->result() as $b){
            $array = json_decode($b->Approve);
            $count = count( array_keys( $array, $MenuID ));
            if($count):
                return $count;
            else:
                return 0;
            endif;
        }
    }
    public function penamaan_file($text)
    {
        $text = str_replace(".", "", $text);
        $text = str_replace("-", "", $text);
        $text = str_replace(",", "", $text);
        return $text;
    }
    public function approve_status_label($status,$name)
    {
        $label = '<span class="label label-danger">tidak diketahui</span>';
        if($status == 0):
            $label = '<span class="label label-abu">'.$name.'</span>';
        elseif($status == 1):
            $label = '<span class="label label-primary">'.$name.'</span>';
        elseif($status == 2):
            $label = '<span class="label label-success">'.$name.'</span>';
        elseif($status == 3):
            $label = '<span class="label label-danger">'.$name.'</span>';
        endif;
        return $label;
    }
    public function publish_label($publish)
    {
        if($publish == 1 || $publish == "publish"):
            $publish = '<span class="label label-success" title="Status">'.$publish.'</span>';
        else:
            $publish = '<span class="label label-danger" title="Status">'.$publish.'</span>';
        endif;
        return $publish; 
    }
    public function category_label($label){
        $label = str_replace("_", " ", $label);
        if($label == "post"):
            $label = "post";
        elseif($label == "news"):
            $label = "news and event";
        endif;


        $label = '<span class="label label-primary" title="Category">'.$label.'</span>';
        return $label;
    }
    public function angka_romawi($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
    public function hex2rgba($color, $opacity = false) {
        $default = 'rgb(0,0,0)';
        if(empty($color))
            return $default; 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }
        $rgb =  array_map('hexdec', $hex);
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }
        return $output;
    }

    public function autoNumber1($modul, $kolom, $lebar=0, $awalan, $belakang = "") {
        $format = "default";

        $this->db->select("$kolom");
        if($modul == "vendor_pembeli"):
            $tabel  = "PS_Vendor";
            $format = "tipe1";
            $this->db->where("Type",3);
        else:
            $tabel = $modul;
        endif;

        $this->db->order_by($kolom, "desc");
        $this->db->limit(1);
        $this->db->from($tabel);
        $query      = $this->db->get();
        $rslt       = $query->result_array();
        $total_rec  = $query->num_rows();

        if($format == "tipe1"):
            if ($total_rec == 0) {
                $nomor = 1;
            } else {

                $dataterakhir = $rslt[0][$kolom];
                if(count(explode(".",$dataterakhir)) == 1){
                    $nomor = 0 + 1;
                } else {
                    $nomor = explode(".",$dataterakhir)[1] + 1;
                    $nomor = substr($nomor,4);
                }
            }
            
            if($lebar > 0) {
                $nomor = str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
                $angka = $awalan.".".date("ym").$nomor.".".$belakang;
            } else {
                $angka = $awalan.".".date("ym").$nomor.".".$belakang;
            }
        else:
            if ($total_rec == 0) {
                $nomor = 1;
            } else {
                $nomor = intval(substr($rslt[0][$kolom],strlen($awalan))) + 1;
            }
            if($lebar > 0) {
                $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT).$belakang;
            } else {
                $angka = $awalan.$nomor.$belakang;
            }

        endif;

        return $angka;
    }
    public function autoNumber2($modul, $kolom, $lebar=0, $awalan, $belakang = "") {
        $BranchID   = $this->session->BranchID;
        $BranchCode = $this->get_branch_code($BranchID);
        $this->db->select("$kolom");
        if($modul == "koreksi_piutang"):
            $tabel = "AC_BalancePayable";
            $this->db->where("Type",1);
        
        elseif($modul == "koreksi_hutang"):
            $tabel = "AC_BalancePayable";
            $this->db->where("Type",2);

        elseif($modul == "klaim_kpr"):
            $tabel = "PS_Invoice";
            $this->db->where("Type",1);
            $this->db->where("InvoiceType",1);
        
        elseif($modul == "invoice_ar"):
            $tabel = "PS_Invoice";
            $this->db->where("Type >",1);
            $this->db->where("InvoiceType",1);
        
        elseif($modul == "invoice_ap"):
            $tabel = "PS_Invoice";
            $this->db->where("InvoiceType",2);
        
        elseif($modul == "pembayaran_komisi"):
            $tabel = "PS_Payment";
            $this->db->where("CorrectionType",1);
        
        elseif($modul == "pembayaran_hutang"):
            $tabel = "PS_Payment";
            $this->db->where("CorrectionType",2);
        elseif($modul == "pengambilan_komisi"):
            $tabel = "PS_Invoice";
            $this->db->where("InvoiceType",2);
            $this->db->where("Type",5); #ini untuk pembagian komisi
        elseif($modul == "kas_bank"):
            $tabel = "AC_KasBank";
            $this->db->where_in("Type",array(1,2));
        elseif ($modul == "jurnal"):
            $tabel = "AC_KasBank";
            $this->db->where("Type",3);
        else:
            $tabel = $modul;
        endif;
        $this->db->where("BranchID",$BranchID);
        $this->db->order_by("DateAdd", "desc");
        $this->db->limit(1);
        $this->db->from($tabel);
        $query      = $this->db->get();
        $rslt       = $query->result_array();
        $total_rec  = $query->num_rows();
       
        if ($total_rec == 0) {
            $nomor = 1;
        } else {
            if(count(explode("/",$rslt[0][$kolom])) == 1){
                $nomor = 0 + 1;
            } else {
                $nomor = explode("/",$rslt[0][$kolom])[2] + 1;
            }
        }
        if($lebar > 0) {
            $nomor = str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
            $angka = $awalan."/".$nomor."/".$this->angka_romawi(date("m"))."/".date("Y");
        } else {
            $angka = $awalan."/".$nomor."/".$this->angka_romawi(date("m"))."/".date("Y");
        }
        return $BranchCode."/".$angka;
    }
    public function button_icon($method,$id,$tambahan=""){
        $edit       = "ubah";
        $delete     = "hapus";
        $active     = "aktif";
        $nonactive  = "nonaktif";
        $batal      = "batal";
        $view       = "lihat";

        $edit       = '<i class="ti-pencil"></i>';
        $delete     = '<i class="ti-trash"></i>';
        $active     = '<i class="ti-check"></i>';
        $nonactive  = '<i class="ti-close"></i>';
        $batal      = '<i class="ti-close"></i>';
        $view       = '<i class="ti-search"></i>';

        // kontrak kerja
        $send_approve   = '<i class="ti-send"></i>';

        $btn = "";
        if($method == "edit"):
            $btn = '<button class="btn btn-white" title="Edit Data" onclick="edit('."'".$id."'".')" '.$tambahan.'>'.$edit.'</button>';
        elseif($method == "delete" || $method == "hapus"):
            $btn = '<button class="btn btn-white" title="Delete Data" onclick="hapus('."'".$id."'".')" '.$tambahan.'>'.$delete.'</button>';
        elseif($method == "active"):
            $btn = '<button class="btn btn-white" title="Activate Data" onclick="active_data('."'".$id."'".','."'active'".')" '.$tambahan.'>'.$active.'</button>';
        elseif($method == "nonactive"):
            $btn = '<button class="btn btn-white" title="Non Activate data Data" onclick="active_data('."'".$id."'".','."'nonactive'".')" '.$tambahan.'>'.$nonactive.'</button>';
        elseif($method == "batal"):
            $btn = '<button class="btn btn-white" title="Batalkan Data" onclick="active_data('."'".$id."'".','."'nonactive'".')" '.$tambahan.'>'.$batal.'</button>';
        elseif($method == "view"):
            $btn = '<button class="btn btn-white" title="View Detail" onclick="view_print('."'".$id."'".','."'nonactive'".')">'.$view.'</button>';
        elseif($method == "send_approve"):
            $btn = '<button title="Send" class="btn" 
                        onclick="approval_data('."'".$id."'".','."'send'".');" '.$tambahan.'> 
                        <i class="ti-share"></i>
                    </button>';
        elseif($method == "approve"):
            $btn = '<button title="Terima" class="btn" 
                        onclick="approval_data('."'".$id."'".','."'approve'".');" '.$tambahan.'>
                        <i class="ti-settings"></i>
                    </button>';
        elseif($method == "reject"):
            $btn = '<button title="Tolak" class="btn" 
                        onclick="approval_data('."'".$id."'".','."'reject'".');" '.$tambahan.'>
                        <i class="ti-settings"></i>
                    </button>';
        elseif($method == "approve_setting"):
            $btn = '<button title="Penerimaan" class="btn" 
                        onclick="edit('."'".$id."'".','."'approve'".');" '.$tambahan.'>
                        <i class="ti-settings"></i>
                    </button>';
        endif;

        return $btn;
    }
    public function label_active($Active){
        if($Active == 1):
            $label = '<span class="label label-success" style="font-size:8pt;">Active</span>';
        else:
            $label = '<span class="label label-danger" style="font-size:8pt;">Non Aktif</span>';
        endif;
        return $label;
    }
    public function label_approve_status($ApproveStatus){
        if($ApproveStatus == 0):
            $label = "Draft";
        elseif($ApproveStatus == 1):
            $label = "Kirim";
        elseif($ApproveStatus == 2):
            $label = "Setuju";
        elseif($ApproveStatus == 3):
            $label = "Tolak";
        endif;

        return $label;
    }
    public function type_file($fileName){
        $type   = substr($fileName, strpos($fileName,".")+1);
        $type   = strtolower($type);
        if($type == "png" || $type == "jpg" || $type == "jpeg"):
            $type = "image";
        endif;

        return $type;
    }

    public function convertDate($date,$format = "Y-m-d"){
        if($date != ''):
            $date = date($format, strtotime($date));
        else:
            $date = null;
        endif;
        return $date;
    }
    public function convertToMonth($date1,$date2){
        $tanggal1 = new DateTime($date1);
        $tanggal2 = new DateTime($date2);
         
        $perbedaan = $tanggal2->diff($tanggal1);

        return $perbedaan->m;
    }
    public function convertToRp($input){
        $data = '';
        if($input != ''):
            $rp = (float) $input;
            $rp = "RP ". number_format($rp,0,',',',');
            $data = $rp;
        endif;

        return $data;
    }
    public function label_hari($tanggal){
        $day = date('D', strtotime($tanggal));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );

        $day    = $dayList[$day];

        return $day;
    }
    public function label_bulan($bulan){
        $bulanList = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
        );

        return $bulanList[$bulan];
    }
    public function label_gender($Gender){
        if($Gender == 1):
            $label = "Laki-laki";
        else:
            $label = "Perempuan";
        endif;

        return $label;
    }
    public function checkLength($text){
        $length = strlen($text);
        if($length<1):
            $text = "-";
        endif;
        return $text;
    }
    public function hapus_gambar($table,$column,$where){
        error_reporting(0);
        ini_set('display_errors', 0);
        
        $this->db->select($column);
        $this->db->where($where);
        $query = $this->db->get($table)->row();
        $Image = site_url($query->$column);
        if(!empty($query->$column)):
            $root       = explode(base_url(), $Image)[1];
            $headers    = @get_headers($Image);
            if (preg_match("|200|", $headers[0])) {
                unlink('./' . $root);
            } 
        endif;
    }
    public static function link($text){
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      $text = preg_replace('~[^-\w]+~', '', $text);
      $text = trim($text, '-');
      $text = preg_replace('~-+~', '-', $text);
      $text = strtolower($text);
      if (empty($text)) {
        return 'n-a';
      }
      return $text.".html";
    }
    public function telp($text,$add = ""){
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '', $text);
        $text = strtolower($text);
        return $text;
    }
    public function tanggal($format, $tanggal="now", $bahasa="id"){
     $en = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb",
     "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
     $id = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
     "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September",
     "Oktober","November","Desember");
     // tambahan untuk bahasa prancis
     $eng = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","January","February",
        "March","April","May","June","July","August","September","October","November","December");
     // sumber http://w.blankon.in/6V
     $fr = array("dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi",
     "janvier","février","mars","avril","Mei","mai","juillet","aoùt","septembre",
     "octobre","novembre","décembre");
     // mengganti kata yang berada pada array en dengan array id, fr (default id)
     // if($this->session->bahasa != "indonesia"):
     //    $bahasa = "eng";
     // endif;
     return str_replace($en,$$bahasa,date($format,strtotime($tanggal)));
    }
    public function set_header_image($type2){
        $this->db->select("AttachmentID, Image, Name");
        $this->db->where("Type2",$type2);
        $query = $this->db->get("PS_Attachment");
        $data = $query->row(); 
        if($data){
            $Image = base_url($data->Image);
        } else {
            $Image = base_url("aset/img/default-slide.png");
        }
        return $Image;
    }
    public function get_image_profile(){
        $img = $this->session->Image;
        if($img == null):
            $img = "assets/images/users/avatar-1.jpg";
        endif;

        return $img;
    }
    public function Category($Modul = ""){
        if($Modul == "list" || $Modul == "list_active"):
            $this->db->select("CategoryID,Link,Name,Icon");
            if($Modul == "list_active"):
                $this->db->where("Active",1);
            endif;
            $query = $this->db->get("Category");
            $data = $query->result();
        endif;
        return $data;
    }
    function character_limiter($str, $n = 500, $end_char = '&#8230;')
    {
        if (strlen($str) < $n)
        {
            return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n)
        {
            return $str;
        }

        $out = "";
        foreach (explode(' ', trim($str)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $n)
            {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
            }
        }
     }

    #custom
    public function list_link($page){
    	$links = array();
    	if($page == "bahasa"):
            $links[] = array('icon' => 'flag-icon flag-icon-id','link' => site_url('main/bahasa/indonesia'), "name" => "Indonesia");        
            $links[] = array('icon' => 'flag-icon flag-icon-us','link' => site_url('main/bahasa/english'), "name" => "English"); 
		elseif($page == "main_menu"):
            $links[] = array('type' => '','link' => site_url(), "name" => $this->lang->line('home'));
            $links[] = array('type' => '','link' => site_url('about-us'), "name" => $this->lang->line('about_us'));
            $links[] = array('type' => '','link' => site_url('service'), "name" => $this->lang->line('service'));
            $links[] = array('type' => '','link' => site_url('article'), "name" => $this->lang->line('article'));
            $links[] = array('type' => '','link' => site_url('contact-us'), "name" => $this->lang->line('contact_us'));
        elseif($page == "social_media"):
            $links[] = array(
                'link' => $this->main->set_('SocialFacebook'), 
                'name' => 'Facebook', 
                'icon' => 'fab fa-facebook-f');
            $links[] = array(
                'link' => $this->main->set_('SocialInstagram'), 
                'name' => 'Instagram', 
                'icon' => 'fab fa-instagram');
            $links[] = array(
                'link' => $this->main->set_('SocialLinkedIn'), 
                'name' => 'LinkedIn', 
                'icon' => 'fab fa-linkedin-in');
    	endif;
    	$links = json_encode($links);
    	$links = json_decode($links);
    	return $links;
    }

    public function code_article(){
      $this->db->select('RIGHT(Article.Code,3) as Code', FALSE);
      $this->db->order_by('Code','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('Article');  //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){      
           //cek kode jika telah tersedia    
           $data = $query->row();      
           // echo $data->Code;
           $kode = intval($data->Code) + 1; 
      }
      else{      
           $kode = 1;  //cek jika kode belum terdapat pada table
      } 
          $batas = str_pad($kode,4, "0", STR_PAD_LEFT);    
          $kodetampil = "3"."0".$batas;  //format kode
          return $kodetampil;  
     }
    
    function checkvalue($string){
        if(!$string):
            $string = null;
        endif;

        return $string;
    }
    function check_device(){
      $iphone     = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
      $android    = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
      $palmpre    = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
      $berry      = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
      $ipod       = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

      if ($iphone || $android || $palmpre || $ipod || $berry == true){
          $status = FALSE;
      } else {
          $status = TRUE;
      }
      
      return $status;
    }
    function alt(){
        $alt = 'Rumah singgah ibu hamil - Rumah aman ibu hamil';

        return $alt;
    }
    public function kode_member(){
      $this->db->select('RIGHT(Member.Code,4) as Code', FALSE);
      $this->db->order_by('Code','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('Member');  //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){      
           //cek kode jika telah tersedia    
           $data = $query->row();      
           $kode = intval($data->Code) + 1; 
      }
      else{      
           $kode = 1;  //cek jika kode belum terdapat pada table
      } 
      $batas = str_pad($kode,4, "0", STR_PAD_LEFT);    
      $kodetampil = "1"."0".$batas;  //format kode
      return $kodetampil;  
    }
    public function label_member($Member_type){
        $label = "";
        if($Member_type == 2):
            $label = '<span class="label label-default" style="font-size:8pt;">Client</span>';
        endif;
        if($Member_type == 3):
            $label = '<span class="label label-info" style="font-size:8pt;">Subscriber</span>';
        endif;
        if($Member_type == 1):
            $label = '<span class="label label-warning" style="font-size:8pt;">Partner</span>';
        endif;
        return $label;
    }

    public function label_subscribe($status){
      if($status == 1):
        $label = '<span class="label label-success" style="font-size:8pt;">Subscribe</span>';
      else:
        $label = '<span class="label label-danger" style="font-size:8pt;">Unsubscribe</span>';
      endif;

      return $label;
    }

    // broadcast email
    public function label_type_broadcast($type, $cetak=""){
        if($type == 1):
            $label = "Member";
            if($cetak != "cetak"):
                $label = '<span class="label label-success">Member</span>';
            endif;
        endif;

        return $label;
    }
    public function label_status_broadcast($status, $cetak=""){
        if($status == 0):
            $label = "Draf";
            if($cetak != "cetak"):
                $label = '<span class="label label-abu">Dikirim</span>';
            endif;
        elseif($status == 1):
            $label = "Terkirim";
            if($cetak != "cetak"):
                $label = '<span class="label label-success">Terkirim</span>';
            endif;            
        elseif($status == 2):
            $label = "Gagal";
            if($cetak != "cetak"):
                $label = '<span class="label label-merah">Gagal</span>';
            endif;
        else:
            $label = "Draf";
            if($cetak != "cetak"):
                $label = '<span class="label label-abu">Dikirim</span>';
            endif;
        endif;

        return $label;
    }
    public function label_attachment($Type=""){
        $Type = $this->input->get("type");
        $Type = strtolower($Type);
        if($Type == "selling"):
            $label = "Selling";
            $format= "File format (pdf, doc, docx, excel, image .JPG .JPEG .PNG) MAX size file 1,8 MB";
        else:
            $label = "Galery";
            $format= "Pilih File foto terbaik. (format .JPG .JPEG .PNG max 1,8 MB), good image resolution 1200px x 600px";
        endif;
        $data["label"]  = $label;
        $data["Type"]   = $Type;
        $data["format"] = $format;
        return $data;
    }
    public function icon_file($type){
        if($type == "pdf"):
            $file = 'aset/images/icon_file/pdf.png';
        elseif($type == "doc" || $type == "docx"):
            $file = 'aset/images/icon_file/doc.png';
        elseif($type == "xls"):
            $file = 'aset/images/icon_file/excell.png';
        else:
            $file = 'aset/images/icon_file/file.png';
        endif;

        return $file;
    }
}
