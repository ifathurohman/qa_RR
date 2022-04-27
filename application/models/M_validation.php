<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#tanggal 2018-04-19
#author m iqbal ramadhan
class M_validation extends CI_Model {
    var $host;
    var $app;
    public function __construct()
    {
        parent::__construct();
    }
    public function login()
    {
        
        $email_con      = 0;
        $password_con   = 0;   
        $active         = 0;
        $email          = $this->input->post("Email");
        $password       = $this->input->post("Password");
        $password       = $this->main->hash($password);

        $this->db->select("Email,Password,Active");
        $this->db->where("Email",$email);
        $a = $this->db->get("UT_User")->row();
        if($a):
            $email_con      = $a->Email;
            $password_con   = $a->Password; 
            $active         = $a->Active;
        endif;
        $data       = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("Email") == "")
        {
            $data['inputerror'][] = 'Email';
            $data['error_string'][] = 'Please fill out Email';
            $data['status'] = FALSE;
        }
        if($this->input->post("Password") == "")
        {
            $data['inputerror'][] = 'Password';
            $data['error_string'][] = 'Please fill out Password';
            $data['status'] = FALSE;
        }
        if($email && !$a)
        {
            $data['inputerror'][] = 'Email';
            $data['error_string'][] = 'Sorry your email not registered';
            $data['status'] = FALSE;
        }
        if($this->input->post("Password") && $password != $password_con)
        {
            $data['inputerror'][]   = 'Password';
            $data['error_string'][] = 'Sorry your password is wrong';
            $data['status'] = FALSE;

        }
        if($a && $active == 0)
        {
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Sorry your account has been nonactive';
            $data['status'] = FALSE;
            // $data["popup"]    = TRUE;
            // $data["status"]   = FALSE;
            // $data["message"]  = "Sorry your account is not active";
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function forgot_password()
    {
        $email      = $this->input->post('Email');
        $cek_email  = $this->db->count_all("UT_User where Email='$email'");

        $data = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($email == "")
        {
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Please fill out new Email';
            $data['status']         = FALSE;
        }
        if($email && $cek_email == 0)
        {
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Email not resgitered';
            $data['status']         = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    public function forgot_password_reset()
    {
        $email      = $this->input->post('email');
        $cek_email  = $this->db->count_all("UT_User where Email='$email'");

        $data = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if(strlen($this->input->post('Password')) < 6)
        {
            $data['inputerror'][]   = 'Password';
            $data['error_string'][] = 'Password must be at least 6 characters';
            $data['status']         = FALSE;
        }
        if($this->input->post('Password') == '')
        {
            $data['inputerror'][]   = 'Password';
            $data['error_string'][] = 'Please fill out new Password';
            $data['status']         = FALSE;
        }
        if($this->input->post('PasswordConfirmation') == '')
        {
            $data['inputerror'][]   = 'PasswordConfirmation';
            $data['error_string'][] = 'Please fill out confirmation Password';
            $data['status']         = FALSE;
        }
        if($this->input->post('PasswordConfirmation') != $this->input->post('Password'))
        {
            $data['inputerror'][]   = 'PasswordConfirmation';
            $data['error_string'][] = 'Password does not match';
            $data['status']         = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    private function _validate_send_email_contact()
    {
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post('Name') == '')
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Name';
            $data['status']         = FALSE;
        }
        if($this->input->post('Email') == '')
        {
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Email';
            $data['status']         = FALSE;
        }
        if($this->input->post('Phone') == '')
        {
            $data['inputerror'][]   = 'Phone';
            $data['error_string'][] = 'Whatsapp No';
            $data['status']         = FALSE;
        }
        if($this->input->post('Subject') == '')
        {
            $data['inputerror'][]   = 'Subject';
            $data['error_string'][] = 'Subject';
            $data['status']         = FALSE;
        }
        if($this->input->post('Message') == '')
        {
            $data['inputerror'][]   = 'Message';
            $data['error_string'][] = 'Message';
            $data['status']         = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    private function _validate_req_app()
    {
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post('Name') == '')
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = $this->lang->line("nama_pasien");
            $data['status']         = FALSE;
        }
        if($this->input->post('BirthDate') == '')
        {
            $data['inputerror'][]   = 'BirthDate';
            $data['error_string'][] = $this->lang->line("tgl_lahir");
            $data['status']         = FALSE;
        }
        if($this->input->post('PassportNo') == '')
        {
            $data['inputerror'][]   = 'PassportNo';
            $data['error_string'][] = $this->lang->line("passport_no");
            $data['status']         = FALSE;
        }
        if($this->input->post('ContactNo') == '')
        {
            $data['inputerror'][]   = 'ContactNo';
            $data['error_string'][] = $this->lang->line("contact_no");
            $data['status']         = FALSE;
        }
        if($this->input->post('MedicalCase') == '')
        {
            $data['inputerror'][]   = 'MedicalCase';
            $data['error_string'][] = $this->lang->line("medical_case");
            $data['status']         = FALSE;
        }
        if($this->input->post('Doctor') == '')
        {
            $data['inputerror'][]   = 'Doctor';
            $data['error_string'][] = $this->lang->line("req_doctor");
            $data['status']         = FALSE;
        }
        if($this->input->post('Hospital') == '')
        {
            $data['inputerror'][]   = 'Hospital';
            $data['error_string'][] = $this->lang->line("hospital_clinic");
            $data['status']         = FALSE;
        }
        if($this->input->post('PlannedDate') == '')
        {
            $data['inputerror'][]   = 'PlannedDate';
            $data['error_string'][] = $this->lang->line("visit_date");
            $data['status']         = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
    #backend
    
    public function user(){
        $this->_validation_script();
        $data       = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;

        $BranchID = $this->session->BranchID;

        if($this->input->post("Name") == "")
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Name cannot be null';
            $data['status']         = FALSE;
            $data["type"][]         = '';
        }
        if($this->input->post("Email") == ""):
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Email address cannot be null';
            $data['status']         = FALSE;
            $data["type"][]         = '';
        else:
            $UserID    = $this->input->post("UserID");
            $Email     = $this->input->post("Email");
            $user = $this->api->user($Email);
            if($UserID != ''):

                $cek = $this->db->count_all("UT_User where UserID != '$UserID' AND Email = '$Email'");
                if($cek>0):
                    $data['inputerror'][] = 'Email';
                    $data['error_string'][] = 'Email has been already';
                    $data['status'] = FALSE;
                    $data['type'][]   = "";
                endif;
            else:
                if($user->num_rows()>0):
                    $data['inputerror'][] = 'Email';
                    $data['error_string'][] = 'Email has been already';
                    $data['status'] = FALSE;
                    $data['type'][]   = "";
                endif;
            endif;
        endif;

        if ($this->input->post("Email") && !filter_var($this->input->post("Email"), FILTER_VALIDATE_EMAIL)):
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Email address format is invalid';
            $data['status']         = FALSE;
            $data['type'][]         = "";
        endif;

        if($this->input->post("password") == "")
        {
            $data['inputerror'][]   = 'password';
            $data['error_string'][] = 'Password cannot be null';
            $data['status']         = FALSE;
            $data["type"][]         = '';
            
        }
        $validasi_password = $this->validasi_password($this->input->post("password"));
        if($this->input->post("password") != "" && $this->input->post("password") != "********" && $validasi_password != ""){
            $data['inputerror'][]   = 'password';
            $data['error_string'][] = $validasi_password;
            $data['type'][]         = 'icon';
            $data['status']         = FALSE;
        }
        
        if($this->input->post("role") == "none")
        {
            $data['inputerror'][]   = 'role';
            $data['error_string'][] = 'Choose role';
            $data["type"][]         = 'select';
            $data['status']         = FALSE;
        }


        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }

    public function admin($modul = "")
    {
        $Email      = $this->input->post("Email");
        $password   = $this->input->post("Password");
        $data       = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("Name") == "")
        {
            $data['inputerror'][] = 'Name';
            $data['error_string'][] = 'Please fill out Name';
            $data['status'] = FALSE;
        }
        if($this->input->post("Email") == "")
        {
            $data['inputerror'][] = 'Email';
            $data['error_string'][] = 'Please fill out Email';
            $data['status'] = FALSE;
        }
        if($modul == "save" && $this->input->post("Password") == "")
        {
            $data['inputerror'][] = 'Password';
            $data['error_string'][] = 'Please fill out Password';
            $data['status'] = FALSE;
        }
        if($modul == "save" && $this->db->count_all("User where Email='$Email' ") > 0)
        {
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Email address has been already exist';
            $data['status']         = FALSE;
        }
        $a = $this->admin->get_by_id($this->input->post('UserID'));
        $UserID     = $a->UserID;
        $EmailVal   = $a->Email;

        if($modul == "update" && $Email != $EmailVal){
            if($this->db->count_all("User where Email='$Email' ") > 0)
            {
                $data['inputerror'][]   = 'Email';
                $data['error_string'][] = 'Email address has been already exist';
                $data['status']         = FALSE;
            }
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function module($modul = "")
    {
        $data       = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("Name") == "")
        {
            $data['inputerror'][]    = 'Name';
            $data['error_string'][]  = 'Nama Panel Tidak Boleh kosong';
            $data['status'] = FALSE;
        }
        if($this->input->post("Type") == "single" && $this->input->post("TotalPoint") == "")
        {
            $data['inputerror'][] = 'TotalPoint';
            $data['error_string'][] = 'Jumlah Panel Tidak Boleh kosong';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function status_pekerjaan($modul = "")
    {
        $CompanyID                  = $this->session->CompanyID;
        $WorkStatusOrder            = $this->input->post("WorkStatusOrder");
        $Color                      = $this->input->post("Color");
        $data = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("Name") == "")
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Nama pekerjaan tidak boleh kosong';
            $data['status']         = FALSE;
        }
         if($this->input->post("Color") == "")
        {
            $data['inputerror'][]   = 'Color';
            $data['error_string'][] = 'Warna pekerjaan Tidak Boleh Kosong';
            $data['select'][]       = 1;
            $data['status']         = FALSE;
        }
        
        if($modul == "save"){
            $cekWarna = $this->db->count_all("PS_WorkStatus where Color = '$Color' and CompanyID='$CompanyID' ");
            if($cekWarna > 0){
                $data['inputerror'][]   = 'Color';
                $data['error_string'][] = 'Warna pekerjaan telah digunakan';
                $data['status']         = FALSE;
            }
        }
        if($modul == "update"){
            $Colorx             = 0;
            $WorkStatusOrderx   = 0;
            $WorkStatusID       = $this->input->post('WorkStatusID');
            $this->db->where("WorkStatusID",$WorkStatusID);
            $query = $this->db->get("PS_WorkStatus");
            $a     = $query->row();
            if($a):
                $ID                 = $a->WorkStatusID;
                $Colorx             = $a->Color;
                $WorkStatusOrderx   = $a->WorkStatusOrder;
            endif;
            if($Color != $Colorx):
                $cekWarna = $this->db->count_all("PS_WorkStatus where Color = '$Color' and CompanyID='$CompanyID'");
                if($cekWarna > 0){
                    $data['inputerror'][]   = 'Color';
                    $data['error_string'][] = 'Warna pekerjaan telah digunakan';
                    $data['status']         = FALSE;
                }
            endif;
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function jenis_pekerjaan($modul = "")
    {
        $CompanyID                  = $this->session->CompanyID;
        $WorkStatusOrder            = $this->input->post("WorkStatusOrder");
        $Color                      = $this->input->post("Color");
        $data = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("Name") == "")
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Nama pekerjaan tidak boleh kosong';
            $data['status']         = FALSE;
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function pegawai($modul = "")
    {
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("Name") == "")
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Nama Pegawai Tidak Boleh Kosong';
            $data['type'][]         = '';
            $data['status']         = FALSE;
        }
        if($this->input->post("Email") == "")
        {
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Alamat Email Tidak Boleh Kosong';
            $data['type'][]         = '';
            $data['status']         = FALSE;
        }
        if($this->input->post("Password") == "")
        {
            $data['inputerror'][]   = 'Password';
            $data['error_string'][] = 'Kata Sandi Tidak Boleh Kosong';
            $data['type'][]         = 'icon';
            $data['status']         = FALSE;
        }
        $validasi_password = $this->validasi_password($this->input->post("Password"));
        if($this->input->post("Password") != "" && $this->input->post("Password") != "********" && $validasi_password != ""){
            $data['inputerror'][]   = 'Password';
            $data['error_string'][] = $validasi_password;
            $data['type'][]         = 'icon';
            $data['status']         = FALSE;
        }
        if($this->input->post("Phone") == "")
        {
            $data['inputerror'][]   = 'Phone';
            $data['error_string'][] = 'No Telphone Tidak Boleh Kosong';
            $data['type'][]         = '';
            $data['status']         = FALSE;
        }
        if($this->input->post("Skill") == "")
        {
            $data['inputerror'][]   = 'Skill';
            $data['error_string'][] = 'Keahlian Tidak Boleh Kosong';
            $data['status']         = FALSE;
            $data['type'][]         = 'select';
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
     public function company($modul = "")
    {
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
     
        if($this->input->post("Name") == "")
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Nama Perusahaan Tidak Boleh Kosong';
            $data['type'][]         = '';
            $data['status']         = FALSE;

        }
        if($this->input->post("Phone") == "")
        {
            $data['inputerror'][]   = 'Phone';
            $data['error_string'][] = 'Nomor telphone Tidak Boleh Kosong';
            $data['type'][]       = '';
            $data['status'] = FALSE;

        }

        if($this->input->post("Email") == "")
        {
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Alamat Email Tidak Boleh Kosong';
            $data['type'][]       = '';
            $data['status']         = FALSE;

        }
          if($this->input->post("Password") == "")
        {
            $data['inputerror'][]   = 'Password';
            $data['error_string'][] = 'Password Tidak Boleh Kosong';
            $data['type'][]         = '';
            $data['status']         = FALSE;

        }
         $validasi_password = $this->validasi_password($this->input->post("Password"));
        if($this->input->post("Password") != "" && $this->input->post("Password") != "********" && $validasi_password != ""){
            $data['inputerror'][]   = 'Password';
            $data['error_string'][] = $validasi_password;
            $data['type'][]         = '';
            $data['status']         = FALSE;
        }
        if($this->input->post("Province") == "" || $this->input->post("Province") == "none")
        {
            $data['inputerror'][]   = 'Province';
            $data['error_string'][] = 'Provinsi Tidak Boleh Kosong';
            $data['type'][]         = "select";
            $data['status']         = FALSE;

        }
        if($this->input->post("City") == "" || $this->input->post("City") == "none")
        {
            $data['inputerror'][]   = 'City';
            $data['error_string'][] = 'Kota Tidak Boleh Kosong';
            $data['type'][]         = "select";
            $data['status']         = FALSE;

        }

         if($this->input->post("Address") == "")
        {
            $data['inputerror'][]   = 'Address';
            $data['error_string'][] = 'Alamat Tidak Boleh Kosong';
            $data['type'][]         = '';
            $data['status']         = FALSE;

        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function hari_libur($modul = "")
    {
        $data       = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("Name") == "")
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Nama event tidak boleh kosong';
            $data['status']         = FALSE;
        }
        if($this->input->post("StartDate") == "")
        {
            $data['inputerror'][]   = 'StartDate';
            $data['error_string'][] = 'Tanggal awal tidak boleh kosong';
            $data['status']         = FALSE;
        }
        if($this->input->post("EndDate") == "")
        {
            $data['inputerror'][]   = 'EndDate';
            $data['error_string'][] = 'Tanggal akhir tidak boleh kosong';
            $data['status']         = FALSE;
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function Contact($modul = ""){
        if($modul != "update"):
            $modul = "save";
        endif;
        $data = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        $ContactID = $this->input->post("ContactID");
        $Name       = $this->input->post("Name");
        if($this->input->post("Name") == ""):
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Please fill out Name';
            $data['status']         = FALSE;
        endif;

        $LinkOld    = "";
        $Link       = $this->main->link($Name);
        $CekData = $this->db->count_all("Contact where Link='$Link' ");
        if($modul == "update"):
            $a = $this->category->get_by_id($ContactID);
            $LinkOld = $a->Link;
        endif;
        if($modul == "save" &&  $CekData > 0 ||
            $modul == "update" && $CekData > 0 && $Link != $LinkOld) 
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'This name already exist';
            $data['status']         = FALSE;
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }

    }
    public function kendaraan_masuk($modul = "")
    {
        $data                   = array();
        $data["method"]         = $modul;
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;

        if($modul == 'save' || $modul == "update"){
            if($this->input->post("Name") == "")
            {
                $data['inputerror'][]   = 'Name';
                $data['error_string'][] = 'Project tidak boleh kosong';
                $data['status']         = FALSE;
            }
            if($this->input->post("Client") == "")
            {
                $data['inputerror'][]   = 'Client';
                $data['error_string'][] = 'Client tidak boleh kosong';
                $data['status']         = FALSE;
            }
            if($this->input->post("PICID") == "0")
            {
                $data['inputerror'][]   = 'PICID';
                $data['error_string'][] = 'PIC tidak boleh kosong';
                $data['status']         = FALSE;
            }
        }
        $Cek                 = 0;
        $TransactionListID   = $this->input->post("TransactionListID");
        if($modul == "update"):
            $Cek = $this->db->count_all("SP_TransactionStatus where TransactionListID='$TransactionListID'");
        endif;
        if(in_array($modul, array("save","cek_tanggal","update")) && $Cek == 0){
            $StartDate      = $this->input->post("StartDate");            
            $EndDate        = $this->input->post("EndDate");            
            if($StartDate == "")
            {
                $data['inputerror'][]   = 'StartDate';
                $data['error_string'][] = 'Tanggal mulai tidak boleh kosong';
                $data['status']         = FALSE;
            }
            if($EndDate == "")
            {
                $data['inputerror'][]   = 'EndDate';
                $data['error_string'][] = 'Tanggal selesai tidak boleh kosong';
                $data['status']         = FALSE;
            }
            if($EndDate && date("Y-m-d",strtotime($EndDate)) < date("Y-m-d",strtotime($StartDate))){
                $data['inputerror'][]   = 'EndDate';
                $data['error_string'][] = 'tanggal selesai tidak boleh kurang dari tanggal mulai';
                $data['status']         = FALSE;
            }
        }
        if($Cek == 0 && $this->input->post("StartDate") == "")
        {
            $data['inputerror'][]   = 'StartDate';
            $data['error_string'][] = 'Tanggal mulai tidak boleh kosong';
            $data['status']         = FALSE;
        }
        #ini untuk validasi detail
        $Count1     = 0;
        $Count2     = 0;
        $CountRH    = 0;
        $CountLH    = 0;
        $NomerRow   = $this->input->post("NomerRow");
        $ModuleID   = $this->input->post("ModuleID");
        $Type       = $this->input->post("Type");
        if($this->input->post("ModuleID")):
            foreach($this->input->post("ModuleID") as $key => $a):
                $Count1 += 1;
                if($a > 0):
                    $Count2 += 1;    
                endif;
            endforeach;
            if($Count1 != $Count2 && $modul != "cek_tanggal"){
                $data['message'] = 'Panel tidak boleh kosong, silakan pilih panel';
                $data['status']  = FALSE;
            }
        endif;
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function rencana_pekerjaan($modul = "")
    {        
        $data                       = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("TransactionListID") == "")
        {
            $data['error_string'][] = 'TransactionListID tidak boleh kosong';
            $data['status']         = FALSE;

        }
        if($this->input->post("TransactionListDetailID") == "")
        {
            $data['error_string'][] = 'TransactionListDetailID tidak boleh kosong';
            $data['status']         = FALSE;

        }
        if($this->input->post("PegawaiID") == "none")
        {
            $data['error_string'][] = 'Team tidak boleh kosong';
            $data['status']         = FALSE;

        }
        if($this->input->post("Point") == "" || $this->input->post("Point") == 0)
        {
            $data['error_string'][] = 'Mandays tidak boleh kosong';
            $data['status']         = FALSE;

        }
        $Point     = $this->input->post("Point");
        $Pointx    = intval($Point);
        $PointxMin = $Pointx;
        $PointxMid = $Pointx + 0.5;
        $PointxMax = $Pointx + 1;
        if($Point > $PointxMin && $Point < $PointxMid || $Point > $PointxMid && $Point < $PointxMax)
        {
            $data['error_string'][] = 'Mandays hanya boleh berkelipatan 0.5';
            $data['status']         = FALSE;

        }
        if($this->input->post("WorkStatusID") == "none" || $this->input->post("WorkStatusID") == 0)
        {
            $data['error_string'][] = 'Pekerjaan tidak boleh kosong';
            $data['status']         = FALSE;

        }
        if($this->input->post("StartDate") == "")
        {
            $data['error_string'][] = 'Tanggal mulai tidak boleh kosong';
            $data['status']         = FALSE;

        }
        if($this->input->post("EndDate") == "")
        {
            $data['error_string'][] = 'Tanggal Selesai tidak boleh kosong';
            $data['status']         = FALSE;

        }
        if($data['status'] == true){
            // $validasi = $this->validation_rencana_pekerjaan();
            // if($validasi["status"] == false){
            //     $data['error_string'][] = 'Rencana pekerjaan pada tanggal ini sudah penuh';
            //     $data['status']         = FALSE;
            // }
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    private function validation_rencana_pekerjaan(){
        $TransactionListID = $this->input->post('TransactionListID');
        $PegawaiID         = $this->input->post('PegawaiID');
        $StartDate         = date("Y-m-d",strtotime($this->input->post('StartDate')));
        $EndDate           = date("Y-m-d",strtotime($this->input->post('EndDate')));
        $MandaysReal       = $this->input->post('Point');
        $HitungHari        = $this->api->hitung_hari($StartDate,$EndDate);
        $Mandays           = ($MandaysReal / $HitungHari);
        $status            = true;

        $this->db->select("Point as Mandays,StartDate,EndDate");
        $this->db->where("TS.TransactionListID",$TransactionListID);
        $this->db->where("TS.UserID",$PegawaiID);
        $this->db->where("TS.ApprovalStatus",2);
        $this->db->where("TS.StartDate",$StartDate);
        $query = $this->db->get("SP_TransactionStatus as TS");
        $list  = $query->result();
        $TotalMandays = 0;
        foreach($list as $a):
            $TotalMandays += $a->Mandays;
        endforeach;
        $MandaysSum = ($TotalMandays + $Mandays);
        if(count($list) > 0):
            if($MandaysSum > 1):
                $status = false;
            endif;
            $data = array(
                "status"        => $status,
                "MandaysReal"   => $MandaysReal,
                "HitungHari"    => $HitungHari,
                "TotalMandays"  => $TotalMandays,
                "Mandays"       => $Mandays,
                "MandaysSum"    => $MandaysSum,
            );
            print_r($data);
            exit();
        endif;
        $data = array(
            "status" => $status,
        );
        return $data;
    }
    public function upload($file,$allow_file)
    {
        if($allow_file == "image"):
            $allowed = array("png","jpg","jpeg");
        elseif($allow_file == "image|pdf"):
            $allowed = array("png","jpg","jpeg","pdf");
        else:
            $allowed = array("png","jpg","pdf","csv");
        endif;
        $filename   = $_FILES[$file]['name'];
        $ext        = pathinfo($filename, PATHINFO_EXTENSION);
        if($filename && !in_array(strtolower($ext),$allowed) ) {
            echo json_encode(array("status" => FALSE, "message" => "The filetype you are attempting to upload is not allowed."));
            exit();
        }
    }
    public function validasi_password($password){
        $passwordErr = '';
        if (strlen($password) < 8) {
            $passwordErr = "Your Password Must Contain At Least 8 Characters!";
            // $passwordErr = "kata sandi Anda harus mengandung setidaknya 8 karakter";
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
            // $passwordErr = "Kata Sandi Anda Harus Berisi Sedikitnya 1 Angka";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
            // $passwordErr = "Kata Sandi Anda Harus Mengandung Sedikitnya 1 Huruf Kapital";
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
            // $passwordErr = "Kata Sandi Anda Harus Berisi Sedikitnya 1 Huruf Kecil";
        }
        return $passwordErr;
    }
    public function content()
    {
        $this->_validation_script();

        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;

        if($this->input->post('Name') == '')
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Please fill out Name';
            $data['status']         = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    public function article()
    {
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;

        if($this->input->post('Name') == '')
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Please fill out Name';
            $data['status']         = FALSE;
        }
        if($this->input->post('Date') == '')
        {
            $data['inputerror'][]   = 'Date';
            $data['error_string'][] = 'Please fill out Date';
            $data['status']         = FALSE;
        }
        // if($this->input->post('Description') == '')
        // {
        //     $data['inputerror'][]   = 'Description';
        //     $data['error_string'][] = 'Please fill out Description';
        //     $data['status']         = FALSE;
        // }
        // if(!$this->input->post('CategoryID'))
        // {
        //     $data['inputerror'][]   = 'CategoryID';
        //     $data['error_string'][] = 'Please select key Category';
        //     $data['status']         = FALSE;
        // }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    public function product($modul = "")
    {
        $this->_validation_script();
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        $ProductID  = $this->input->post('ProductID');
        $Name       = $this->input->post('Name');
        if($this->input->post('Name') == '')
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Please fill out Name';
            $data['status']         = FALSE;
        }
        
        $LinkOld    = "";
        $Link       = $this->main->link($Name);
        $CekProduct = $this->db->count_all("Product where Link='$Link' ");
        if($modul == "update"):
            $a = $this->product->get_by_id($ProductID);
            $LinkOld = $a->Link;
        endif;
        if($modul == "save" &&  $CekProduct > 0 ||
            $modul == "update" && $CekProduct > 0 && $Link != $LinkOld) 
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'This name already exist';
            $data['status']         = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    public function Category($modul = ""){
        if($modul != "update"):
            $modul = "save";
        endif;
        $data = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        $CategoryID = $this->input->post("CategoryID");
        $Name       = $this->input->post("Name");
        if($this->input->post("Name") == ""):
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Please fill out Name';
            $data['status']         = FALSE;
        endif;

        $LinkOld    = "";
        $Link       = $this->main->link($Name);
        $CekData = $this->db->count_all("Category where Link='$Link' ");
        if($modul == "update"):
            $a = $this->category->get_by_id($CategoryID);
            $LinkOld = $a->Link;
        endif;
        if($modul == "save" &&  $CekData > 0 ||
            $modul == "update" && $CekData > 0 && $Link != $LinkOld) 
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'This name already exist';
            $data['status']         = FALSE;
        }
        if($data['status'] === FALSE){
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }

    }
    public function broadcast_email(){
        $data       = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;

        $member     = $this->input->post('member');
        $other      = $this->input->post('other');

        if($this->input->post("Subject") == ""):
            $data['inputerror'][]   = 'Subject';
            $data['error_string'][] = '';
            $data['status']         = FALSE;
            $data["type"][]         = "";
            $data["index"][]        = "";
        endif;

        if($other == '' and $member == ''):
            $data['inputerror'][] = 'member[]';
            $data['error_string'][] = '';
            $data['status'] = FALSE;
            $data["type"][]   = "select";
            $data["index"][]  = "";
        endif;

        if($data['status'] === FALSE){
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function member($modul = "")
    {
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        if($this->input->post("Name") == "")
        {
            $data['inputerror'][]   = 'Name';
            $data['error_string'][] = 'Nama Tidak Boleh Kosong';
            $data['select'][]       = 0;
            $data['type'][]         = '';
            $data['status'] = FALSE;

        }

        if($this->input->post("Email") == "")
        {
            $data['inputerror'][]   = 'Email';
            $data['error_string'][] = 'Email Tidak Boleh Kosong';
            $data['select'][]       = 0;
            $data['type'][]         = '';
            $data['status'] = FALSE;

        }

        if($this->input->post("Member_type") == "")
        {
            $data['inputerror'][]   = 'Member_type';
            $data['error_string'][] = 'Member Type Tidak Boleh Kosong';
            $data['select'][]       = 1;
            $data['status']         = FALSE;
            $data['type'][]         = 'select';
        }
        if($data['status'] === FALSE)
        {
            header('Content-Type: application/json');
            echo json_encode($data,JSON_PRETTY_PRINT);  
            exit();
        }
    }
    public function _validation_script(){
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;
        $ArrayScript = array(
            '<script>','<script','</script>','</script','onclick=','onchange=','alert(','onfocus=','onhover='
        );
        $post      = $this->input->post();
        foreach($post as $key => $a):
            $Code   = $key;
            $Value  = $this->input->post($Code);
            if(!in_array($Code, array("Description","ImageB64"))):
                foreach($ArrayScript as $xss):
                    if(\strpos($Value, $xss) !== false):
                        $data['message'] = 'Script detection';
                        $data['status']  = FALSE;
                    endif;
                endforeach;
            endif;
        endforeach;

        if($data['status'] === FALSE):
            echo json_encode($data);
            exit();
        endif;
    }
    public function subscriber(){
        $data                   = array();
        $data['error_string']   = array();
        $data['inputerror']     = array();
        $data['status']         = TRUE;

        $email = $this->input->post('email');
        $cek_email  = $this->db->count_all("Member where Email = '$email' and Member_type = '3'");
        $cek_active = $this->db->count_all("Member where Email = '$email' and Member_type = '3' and Active = '0'");
        if($email== ''):
            $data['inputerror'][]   = 'email';
            $data['error_string'][] = '';
            $data['status']         = FALSE;
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            $data['inputerror'][]   = 'email';
            $data['error_string'][] = $this->lang->line("email_invalid");;
            $data['status']         = FALSE;
        elseif($cek_active>0):
            $data['inputerror'][]   = 'email';
            $data['error_string'][] = $this->lang->line("email_inactive");
            $data['status']         = FALSE;
        elseif($cek_email>0):
            $data['inputerror'][]   = 'email';
            $data['error_string'][] = $this->lang->line("email_exist");
            $data['status']         = FALSE;
        endif;
        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    // public function broadcast_email(){
    //     $data       = array();
    //     $data['error_string']   = array();
    //     $data['inputerror']     = array();
    //     $data['status']         = TRUE;

    //     $member     = $this->input->post('member');
    //     $other      = $this->input->post('other');

    //     if($this->input->post("Subject") == ""):
    //         $data['inputerror'][]   = 'Subject';
    //         $data['error_string'][] = '';
    //         $data['status']         = FALSE;
    //         $data["type"][]         = "";
    //         $data["index"][]        = "";
    //     endif;

    //     if($other == '' and $member == ''):
    //         $data['inputerror'][] = 'member[]';
    //         $data['error_string'][] = '';
    //         $data['status'] = FALSE;
    //         $data["type"][]   = "select";
    //         $data["index"][]  = "";
    //     endif;

    //     if($data['status'] === FALSE){
    //         header('Content-Type: application/json');
    //         echo json_encode($data,JSON_PRETTY_PRINT);  
    //         exit();
    //     }
    // }
}
