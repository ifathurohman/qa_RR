<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_broadcast extends CI_Controller {
	var $HakAksesID = '';
	// var $MemberID 	= '';
	public function __construct()
	{
		parent::__construct();
		$this->main->cek_session();
		$this->load->model('M_email','broadcast');
		$this->HakAksesID 	= $this->session->HakAksesID;
		// $this->MemberID 	= $this->session->MemberID;
	}

	public function index(){
		$url_modul 	= $this->uri->segment(1); 
		
		$tambah 	= "";
		$hakakses 	= "all";
        
        $id_url 	= $this->main->GetMenuID($url_modul);
		$read 		= $this->main->read($id_url);
		if($read == 0): redirect(); endif;
		$view_tambah = $this->main->menu_tambah($id_url);
		if($view_tambah > 0):
			 $tambah = '<button type="button" class="btn btn-white" onclick="add_new()" >Add New Data</button>';
		endif;

		$data['title']  	= 'Email Broadcast';
		$data['tambah'] 	= $tambah;
		$data['hakakses']	= $hakakses;
		$data['modul']		= 'Email Broadcast';
		$data['url_modul']	= $url_modul;
		$data['modal'] 	 	= 'backend/email_broadcast/form';
		$data['print'] 	 	= 'backend/email_broadcast/view_print';
		$data['content']	= 'backend/email_broadcast/list';
		$data['filter']		= 'backend/email_broadcast/filter';
		$this->load->view('backend/index',$data);
	}

	public function ajax_list($url_modul = "")
	{
		$id_url = $this->main->GetMenuID($url_modul);
		$list 	= $this->broadcast->get_datatables();
		$data 	= array();
		$no 	= $this->input->post("start");
		$i 		= 1;
		foreach ($list as $a) {

			$view 	= '<button title="Print" onclick="view_print('."'".$a->EmailID."','view'".')" class="btn btn-default"><i class="ti-search"></i></button>';

			$button 	= '<div class="btn-group btn-group-xs btn-kotak" aria-label="Basic example" role="group">';
				$button .= $view;
			$button .= '</div>';

			$status = $this->main->label_status_broadcast($a->Status);

			$no++;
			$row 	= array();
			$row[] 	= $no;
			$row[] 	= $a->EmailSubject;
			$row[] 	= $a->userName;
			$row[] 	= $this->main->convertDate($a->EmailDate, "d-m-Y");
			$row[]	= $this->main->label_type_broadcast($a->Type);
			$row[] 	= '<a href="javascript:void(0)" onclick="view_print('."'".$a->EmailID."','view_status','".$a->Status."'".')">'.$status.'</a>';		
			$row[] 	= $button;
			$data[] = $row;
		}

		$output = array(
			"draw"  		  => $this->input->post("draw"),
			"recordsTotal" 	  => $this->broadcast->count_all(),
			"recordsFiltered" => $this->broadcast->count_filtered(),
			"data"			  => $data,
		);
		echo json_encode($output);
	}

	public function save(){
		$this->validation->broadcast_email();

		$member     = $this->input->post('member');
        $other      = $this->input->post('other');
        $Date 		= $this->input->post('Date');
        $Subject 	= $this->input->post('Subject');
        $descrition = $this->input->post('descrition');

        $data_email  = array();
        $data_id 	 = array();
        $data_other  = array();
        $data_member = $this->check_email_member();
        foreach ($data_member as $k => $v) {
        	array_push($data_email, $v->Email);
        	array_push($data_id, $v->ID);
        }

        // other
        if($other != ""):
        	$other = explode(",", $other);
        	foreach ($other as $k => $v) {
        		array_push($data_other, $v);
        	}
        endif;

        $data_email = array_merge($data_email,$data_other);

        $data_insert = array(
        	"EmailDate" 	=> date("Y-m-d", strtotime($Date)),
        	"EmailTo"		=> json_encode($data_id),
        	"EmailTo2"		=> json_encode($data_other),
        	"EmailSender"	=> $this->session->UserID,
        	"EmailSubject"	=> $Subject,
        	"EmailContent"	=> $descrition,
        	"Type"			=> 1,
        	"Status"		=> 1,
        );

        $id 	= $this->broadcast->save($data_insert);

        #attachment
		$FileB64 		= $this->input->post("FileB64");
		$FormatFileB64 	= $this->input->post("FormatFileB64");
		if(count($FileB64) > 0):
			foreach($FileB64 as $key => $a):
				$data_file = array(
					"Type" 			=> "BroadcastEmail",
					"Key" 			=> $key,
					"EmailID" 		=> $id,
					"FileB64" 		=> $a,
					"FormatFileB64" => $FormatFileB64[$key]
				);
				$this->api->save_attachment($data_file);
			endforeach;
		endif;

        $list 	= $this->broadcast->get_by_id($id);
        $this->broadcast->send_email($data_email,$list);
		$res['status'] 		= TRUE;
		$res['hakakses'] 	= $this->session->HakAkses;

		$this->main->echoJson($res);
	}

	private function check_email_member(){
		$member     	= $this->input->post('member');
		$data 			= array();
		$data_all 		= array();
		$data_not_all 	= array();
		if($member):
			foreach ($member as $k => $v) {
				//membertype =  member,partner,client,subscriber
				$d = explode("-", $v);
				$ID 		= $d[0];
				$memberType = $d[1];
				$email 		= $d[2];

				if($ID == "all"):
					$member_data = $this->get_member($memberType);
					$data_all = array_merge($data_all,$member_data);
				else:
					$x = (object) [
					    'ID' 	=> $ID,
					    'Email' => $email,
					];
					array_push($data_not_all, $x);
				endif;
			}
		endif;
		$data = array_merge($data_not_all,$data_all);
		$data = array_map("unserialize", array_unique(array_map("serialize", $data)));
		return $data;
	}

	private function get_member($membertype){
		// format member($page = "",$id = "",$membertype="",$active="",$email="",$subscribe)
		$data = array();
		if($membertype == "member"):
			$list = $this->api->member("","","","active","active","active");
		elseif($membertype == "partner"):
			$list = $this->api->member("","","1","active","active","active");
		elseif($membertype == "client"):
			$list = $this->api->member("","","2","active","active","active");
		elseif($membertype == "subscriber"):
			$list = $this->api->member("","","3","active","active","active");
		endif;

		foreach ($list as $k => $v) {
			if (filter_var($v->Email, FILTER_VALIDATE_EMAIL)):
				$x = (object) [
				    'ID' 	=> $v->MemberID,
				    'Email' => $v->Email,
				];
				array_push($data, $x);
			endif;
		}

		return $data;
	}
	private function get_email_member($list){
		$data_email 	= array();
		$data_member 	= json_decode($list->EmailTo);
		$data_other  	= json_decode($list->EmailTo2);
		if(count($data_member)>0):
			$list_member = $this->api->member("detail_array",$data_member);
			foreach ($list_member as $k => $v) {
				$h = $v->Email."(".$this->main->label_member($v->Member_type)."), ";
				array_push($data_email, $h);
			}
		endif;
		foreach ($data_other as $k => $v) {
			array_push($data_email, $v.", ");
		}
		return $data_email;
	}

	public function cetak($id){
		$cetak 		= $this->input->get("cetak");
		$position 	= $this->input->get("position");
		$method 	= $this->input->get("method");

		if($method == "view"):
			$list 			= $this->broadcast->get_by_id($id);
			$data_email 	= $this->get_email_member($list);
			$data['title']  		= 'Lihat Broadcast Email';
			$data['content']		= 'backend/email_broadcast/view';
			$data['modul'] 			= 'view';
			$data["email"]			= $data_email;
			$data['list']			= $list;
			$this->load->view('backend/email_broadcast/view',$data);
		elseif($method == "view_status"):
			$list = $this->broadcast->get_by_id($id);
			$data['title']  		= 'Lihat Broadcast Email';
			$data['content']		= 'backend/email_broadcast/view';
			$data['modul'] 			= 'view_status';
			$data['list']			= $list;
			$this->load->view('backend/email_broadcast/view',$data);
		endif;

		if($cetak == "pdf"):
			$this->load->library('dompdf_gen'); 
			$html = $this->output->get_output();
			if($position == "landscape"):
	   	   		$this->dompdf->set_paper('legal', 'landscape');
	   	   	else:
	   	   		$this->dompdf->set_paper('legal', 'portrait');
	   	   	endif;

	    	$this->dompdf->load_html($html);
	    	$this->dompdf->render();
			$this->dompdf->stream("BraodcastEmail_".time().".pdf",array('Attachment'=>0));
		endif;
	}

	public function sendTo($id=""){
		$list = $this->broadcast->get_by_id($id);
		$data = $this->checkEmail($list);
		$data_email = $data['data_email'];
		$status  = $this->broadcast->send_email($data_email,$list);

		if(in_array(2, $data['status_ar']) || $status != TRUE):
			$res["message"] = "Gagal mengirim Broadcast";
			$res["status"]	= FALSE;
		else:
			$res["message"] 	= "Berhasil mengirim Broadcast";
			$res["status"]	= TRUE;
		endif;
		$res['data'] 		= $data;
		$res['hakakses'] 	= $this->session->HakAkses;

		$this->main->echoJson($res);
	}

	public function tes(){
		$data_email = array('boill.mortal@gmail.com');
		$list = $this->broadcast->get_by_id(56);
		$this->broadcast->send_email($data_email,$list);
	}

	public function checkEmail($list){
		$sendTo 		= json_decode($list->EmailTo);
		$data_email 	= array();
		$data_sendto 	= array();
		$status_ar 		= array();
		foreach ($sendTo as $d) {
			$ID 		= $d->ID;
			$status 	= $d->status;
			if($list->Type == 1):
				$member 	= $this->api->member($ID);
			// elseif($list->Type == 2 || $list->Type == 3):
			// 	$marketing 	= $this->api->vendor_detail($ID);
			// else:
			// 	$marketing 	= $this->api->user_detail("",$ID);
			endif;

			$h['ID'] = $ID;
			if (filter_var($member->Email, FILTER_VALIDATE_EMAIL)):
	            $h['status'] = 1;
            	$status_ar[] = 1;
	            if($status != 1):
	            	array_push($data_email, $member->Email);
	            endif;
		    else:
		    	$h['status'] = 2;
		    	$status_ar[] = 2;
	        endif;
	        array_push($data_sendto, $h);
		}

		$data_update = array(
			'EmailTo'	=> json_encode($data_sendto),
			);
		if (in_array(2, $status_ar)):
			$data_update['status'] = 2;
		else:
			$data_update['status'] = 1;    
		endif;

		$this->broadcast->update(array("EmailID" => $list->EmailID), $data_update);

		$res['data_email'] 	= $data_email;
		$res['data']		= $data_update;
		$res['status_ar']	= $status_ar;
		
		return $res;

	}

	public function get_all_data($MemberID,$Type){
		$branch  	= $this->api->branch();
		$urlFilter 	= $this->session->urlFilter;
		$data_branch= array();
		$ID = array();
		if($Type == 1):
			if($urlFilter == 1 || $urlFilter == 2 || $urlFilter == 3):
				$data_branch[] 	= (object) array('MemberID' => $MemberID);
			else:
				$data_branch 	= $branch;
			endif;
			// foreach ($data_branch as $b) {
			// 	$marketing = $this->api->marketing_branch($b->MemberID);
			// 	foreach ($marketing as $d) {
			// 		// array_push($ID, $d->MarketingID);
			// 		$h['ID'] 		= $d->MarketingID;
			// 		$h['status'] 	= 0;
			// 		array_push($ID, $h);
			// 	}	
			// }
		elseif($Type == 2 || $Type == 3):
			$method = 0;
			if($urlFilter == 1):
				$data_branch[] 	= (object) array('MemberID' => $MemberID);
			elseif($urlFilter == 2):
				$data_branch[] 	= (object) array('MemberID' => $MemberID);
				$method 		= "marketing";
			elseif($urlFilter == 3):
				$data_branch[] 	= (object) array('MemberID' => $MemberID);
				$method 		= "marketing_group";
			else:
				$data_branch 	= $branch;
			endif;

			foreach ($data_branch as $b) {
				$vendor = $this->api->vendor_branch($b->MemberID,$Type,$method);
				foreach ($vendor as $d) {
					// array_push($ID, $d->VendorID);
					if (filter_var($d->Email, FILTER_VALIDATE_EMAIL)):
						$h['ID'] 		= $d->VendorID;
						$h['status'] 	= 0;
						array_push($ID, $h);
					endif;
				}
			}
		elseif($Type == 4):
			$user = $this->api->user_select();
			foreach ($user as $d) {
				// array_push($ID, $d->MarketingID);
				if (filter_var($d->Email, FILTER_VALIDATE_EMAIL)):
					$h['ID'] 		= $d->ID;
					$h['status'] 	= 0;
					array_push($ID, $h);
				endif;
			}	
		endif;
		return $ID;
	}
	public function tes2(){
        $insert = 131;
        $this->broadcast->send_email("broadcast_email",$insert,"ya");
        // $this->broadcast->send_email("broadcast_email",$insert,array('ilham@rcelectronic.net'));
    }
}