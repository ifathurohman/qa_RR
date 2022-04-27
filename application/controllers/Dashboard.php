<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    var $tahun;
    public function __construct()
    {
        parent::__construct();
        $this->main->cek_session();
        $this->tahun = date("Y");
    }
    public function index()
    {        
        $this->session->set_userdata("index","backend");
        $v["title"]     = "Dashboard";
        $v["content"]   = "backend/dashboard/index";
        $this->load->view('backend/index',$v);
    }

    public function data_dashboard(){
        $numberWeek = 0;
        $Tahun      = $this->input->post("Tahun");
        if($Tahun && $Tahun != "none"):
            $Tahun = $this->tahun =  $this->input->post("Tahun");
        else:
            $Tahun = $this->tahun = date("Y");
        endif;
        if($this->input->post("numberWeek")):
            $numberWeek = $this->input->post("numberWeek");
        endif;
        $StatusProject = $this->status_project();
        $StatusPegawai = $this->status_pegawai();
        $output     = array(
            "StatusProject" => $StatusProject,
            "StatusPegawai" => $StatusPegawai,
            "Tahun"         => $Tahun,
            "numberWeek"    => $numberWeek,
            "HakAkses"      => $this->session->HakAkses,
            "Tahun"         => $this->tahun,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
    }
    private function status_project($page = '',$datawhere = ''){
        $Date                = date("Y-m-d");
        $FilterProjectStatus = $this->input->post("FilterProjectStatus");
        if($FilterProjectStatus == "overview"):
            $this->db->select("
                TL.TransactionListID,
                TL.Name,
                (select count(TS.TransactionStatusID) from SP_TransactionStatus as TS where TS.TransactionListID = TL.TransactionListID and TS.ApprovalStatus= '2') as JumlahRencana,
                (select count(TS.TransactionStatusID) from SP_TransactionStatus as TS where TS.TransactionListID = TL.TransactionListID and TS.ApprovalStatus= '2' and EndDate <='$Date') as JumlahRencanaToday,
                (select sum(TS.Percentage) from SP_TransactionStatus as TS where TS.TransactionListID = TL.TransactionListID and TS.ApprovalStatus= '2') as JumlahPercentage,
                (select sum(TS.Percentage) from SP_TransactionStatus as TS where TS.TransactionListID = TL.TransactionListID and TS.ApprovalStatus= '2' and EndDate <= '$Date') as JumlahPercentageToday,
                '' as PersenTotal,
                '' as PersenBelumSelesai,
                '' as PersenSelesai,

            ");
            $this->db->where("TL.CompanyID",$this->session->CompanyID);
            $this->db->where("TL.Finish",0);
            $this->db->where("(select count(TS.TransactionListID) from SP_TransactionStatus as TS where TS.TransactionListID = TL.TransactionListID and TS.ApprovalStatus) >",0);
            $this->db->order_by("TL.Name","ASC");
            $query = $this->db->get("SP_TransactionList as TL");
            return $query->result();
        else:
            $this->db->select("
                TL.TransactionListID,
                TL.Name,
                count(TS.TransactionStatusID)           as JumlahRencana,
                convert((count(TS.TransactionStatusID) * 100), decimal(10,0))   as PersenTotal,
                convert(sum(TS.Percentage) / (count(TS.TransactionStatusID) * 100) * 100, decimal(10,0))    as PersenSelesai,
                convert(((count(TS.TransactionStatusID) * 100) - (sum(TS.Percentage)) ) / (count(TS.TransactionStatusID) * 100) * 100, decimal(10,0))   as PersenBelumSelesai,
            ");
            $this->db->join("SP_TransactionList as TL","TS.TransactionListID = TL.TransactionListID","left");
            $this->db->where("TL.CompanyID",$this->session->CompanyID);
            $this->db->where("TL.Finish",0);
            $this->db->where("TS.ApprovalStatus",2);
            if($FilterProjectStatus == "missx"):
                $this->db->where("TS.EndDate <=",$Date);
            endif;
            $this->db->group_by("TS.TransactionListID");
            $this->db->order_by("TL.Name","ASC");
            $query = $this->db->get("SP_TransactionStatus as TS");
            return $query->result();
        endif;
    }
    public function tgl_buku(){
        $TglBukaBuku    = 25;
        $TglTutupBuku   = 26;
        $pu             = $this->api->pengaturan_umum();
        foreach($pu as $a):
            if($a->Code == "TutupBuku"):
                $TglTutupBuku = $a->Value;
            elseif($a->Code == "BukaBuku"):
                $TglBukaBuku = $a->Value;
            endif;
        endforeach;
        $tgl   = date("tgl");
        $bulan = date("m");
        if($tgl <= $TglBukaBuku):
            $bulanbuka = date("Y-m-d");
            $bulantutup = date("Y-m-d",strtotime("+1 month"));
        else:
            $bulanbuka  = date("Y-m-d",strtotime("-1 month"));
            $bulantutup = date("Y-m-d");
        endif;
        $bulanbuka      = date("m",strtotime($bulanbuka));
        $bulantutup     = date("m",strtotime($bulantutup));
        $TglBukaBuku    = date("Y-".($bulanbuka)."-".$TglBukaBuku);
        $TglTutupBuku   = date("Y-".($bulantutup)."-".$TglTutupBuku);
        $data = array(
            "TglBukaBuku"   => $TglBukaBuku,
            "TglTutupBuku"  => $TglTutupBuku,
        );
        return $data;
    }
    private function status_pegawai(){
        $Date    = date("Y-m-d");
        $baseurl = base_url();
        $img     = site_url("aset/img/noicon.png");
        $ProjectID = $this->input->post("ProjectIDps");
        $tgl_buku  = $this->tgl_buku();
        $StartDate = $tgl_buku["TglBukaBuku"];
        $EndDate   = $tgl_buku["TglTutupBuku"];
        $this->db->select("
            (case when U.Image is not null then concat('$baseurl',U.Image) else '$img' end) as WorkerImage, 
            U.Name as WorkerName, 
            count(TS.TransactionStatusID)           as JumlahRencana,
            convert((count(TS.TransactionStatusID) * 100), decimal(10,0))   as PersenTotal,
            convert(sum(TS.Percentage) / (count(TS.TransactionStatusID) * 100) * 100, decimal(10,0))    as PersenSelesai,
            convert(((count(TS.TransactionStatusID) * 100) - (sum(TS.Percentage)) ) / (count(TS.TransactionStatusID) * 100) * 100, decimal(10,0))   as PersenBelumSelesai,
        ");
        $this->db->join("UT_User as U","TS.UserID = U.UserID","left");
        $this->db->join("SP_TransactionList as TL","TS.TransactionListID = TL.TransactionListID","left");
        $this->db->where("TS.CompanyID",$this->session->CompanyID);
        $this->db->where("TS.ApprovalStatus",2);
        $this->db->where("TL.Finish",0);
        if($ProjectID != "none"):
            $this->db->where("TS.TransactionListID",$ProjectID);
        endif;
        $this->db->where("TS.StartDate >=",$StartDate);
        $this->db->where("TS.StartDate <=",$EndDate);
        $this->db->group_by("TS.UserID");
        $this->db->order_by("count(TS.TransactionStatusID)","desc");
        $query = $this->db->get("SP_TransactionStatus as TS");
        return $query->result();
    }

    public function detail_project($TransactionListID){
        $Date = date("Y-m-d");
        $this->db->select("
            MD.ModuleID,
            MD.Name as ModuleName,
            (case when TS.WorkStatusID2 = '0' then 'Normal' else WJ.Name end ) as TypeName,
            WS.Name as WorkName,
            TS.Percentage as Percentage,
            concat(TS.Percentage,'%') as PercentageTxt,
            (case 
            when TS.Percentage < '100' and TS.EndDate <= '$Date' then 'Miss' 
            when TS.Percentage = '100' and TS.EndDate <= '$Date' then 'On Target' 
            else 'On Proggress' end) as Status
        ");
        $this->db->join("SP_TransactionListDetail as TLD","TS.TransactionListDetailID = TLD.TransactionListDetailID","left");
        $this->db->join("PS_Module as MD","TLD.ModuleID = MD.ModuleID","left");
        $this->db->join("PS_WorkStatus as WJ","TS.WorkStatusID2 = WJ.WorkStatusID","left");
        $this->db->join("PS_WorkStatus as WS","TS.WorkStatusID = WS.WorkStatusID","left");
        $this->db->where("TS.ApprovalStatus",2);
        $this->db->where("TS.TransactionListID",$TransactionListID);
        $this->db->group_by("MD.ModuleID,TS.WorkStatusID,TS.WorkStatusID2,TS.Percentage,TS.EndDate");
        $this->db->order_by("MD.Name,WJ.Name,WS.Name","asc");
        $query = $this->db->get("SP_TransactionStatus as TS");
        $ListData = $query->result();
        $output     = array(
            "ListData"          => $ListData,
            "TransactionListID" => $TransactionListID,
            "HakAkses"          => $this->session->HakAkses,
        );
        header('Content-Type: application/json');
        echo json_encode($output,JSON_PRETTY_PRINT);  
    }
}