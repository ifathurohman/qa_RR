<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_slideshow extends CI_Model {
    
    var $table = "Slider";
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function get_slideshow($Type){
        $this->db->select("
            SliderID,
            ImageUrl,
            Cek,
            Type,
            Type2,
            Active,
            ");
        $this->db->where("Type",$Type);
        $this->db->order_by('SliderID');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id){
        $this->db->select("
            SliderID,
            ImageUrl,
            Cek,
            Type,
            Type2,
            Active,
            ");
        $this->db->where("SliderID",$id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function update_attachment_cek($Type,$ID)
    {
        $this->db->set("Cek",0);
        $this->db->where("Type",$Type);
        if($Type == "selling"){
            $this->db->where("ID",$ID);
        }
        $query = $this->db->update($this->table);
        if($query): $a = 1; else: $a = 0; endif;
        return $a; 
    }

    public function delete_file($id,$column=""){
        if($column == ''):
            $column = 'ImageUrl';
        endif;
        $this->db->select("SliderID,ImageUrl,ImageUrlCrop");
        $this->db->where('SliderID', $id);
        $query      = $this->db->get("Slider")->row();
        $gambar_url = site_url($query->$column);
        if($query->$column):
            if(!empty($gambar_url)):
                $root       = explode(base_url(), $gambar_url)[1];
                $headers    = @get_headers($gambar_url);
                if (preg_match("|200|", $headers[0])) {

                    if(file_exists('./' . $root)){
                        unlink('./' . $root);
                    }else{

                    }
                } 
            endif;
        endif;
    }
}