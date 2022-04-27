<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_article extends CI_Model {

	var $table 	= 'Article';
	var $column = array('Article.ArticleID','Article.Name','Article.Category','Article.Date','Article.Keywords','Article.Active'); //set column field database for order and search
	var $order 	= array('ArticleID' => 'desc'); // default order 
	var $host;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->host = base_url();
	}
	private function _get_datatables_query()
	{
		$url = $this->uri->segment(1);
		$this->db->select("
			Article.ArticleID,
			Article.Code,
			Article.Date,
			Article.Name,
			Article.Category,
			Article.Active,
			Article.Keywords,
			(CASE WHEN Article.Active = '1' THEN 'publish' ELSE 'unpublish' END) as ActiveLabel,
			(CASE WHEN Article.Image IS NOT NULL THEN CONCAT('$this->host/img/article/',Article.Image) ELSE  '$this->host/aset/img/default.png' END) as Image
		");
		$this->db->where("Article.Language", 1);
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column as $item):
			if($_POST['search']['value']):
				if($i===0):
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				else:
					$this->db->or_like($item, $_POST['search']['value']);
				endif;
				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			endif;
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		endforeach;
		if(isset($_POST['order'])):
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']); 
		elseif(isset($this->order)):
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		endif;
	}
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($this->input->post("length") != -1)
		$this->db->limit($this->input->post("length"), $this->input->post("start"));
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	public function get_by_id($id)
	{
		$this->db->select("
			Article.ArticleID,
			Article.ParentID,
			Article.UserID,
			Article.CategoryID,
			Article.Code,
			Article.Name,
			Article.Image,
			Article.ImageUrl,
			Article.Category,
			Article.Date,
			Article.Location,
			Article.Summary,
			Article.Description,
			Article.Keywords,
			Article.Permission,
			Article.Active,
			Article.Language,
			(CASE WHEN Article.Image IS NOT NULL THEN CONCAT('$this->host/img/article/',Article.Image) ELSE  '$this->host/aset/img/RC/icon/no_image.jpg' END) as Image,

			articleEng.ArticleID 	as ArticleIDeng,
			articleEng.ParentID 	as ParentIDeng,
			articleEng.UserID 		as UserIDeng,
			articleEng.Code 		as Codeeng,
			articleEng.Name 		as Nameeng,
			articleEng.Image 		as Imageeng,
			articleEng.ImageUrl 	as ImageUrleng,
			articleEng.Category 	as Categoryeng,
			articleEng.Date 		as Dateeng,
			articleEng.Location 	as Locationeng,
			articleEng.Summary 		as Summaryeng,
			articleEng.Description 	as Descriptioneng,
			articleEng.Keywords 	as Keywordseng,
			articleEng.Permission 	as Permissioneng,
			articleEng.Active 		as Activeeng,
			articleEng.Language 	as Languageeng,
			(CASE WHEN articleEng.Image IS NOT NULL THEN CONCAT('$this->host/img/article/',articleEng.Image) ELSE  '$this->host/aset/img/RC/icon/no_image.jpg' END) as Imageeng,

			Category.Name as categoryName,

		");
		$this->db->join("Article as articleEng", "Article.ArticleID = articleEng.ParentID", "left");
		$this->db->join("Category", "Category.CategoryID = Article.CategoryID", "left");
		$this->db->from($this->table);
		$this->db->where('Article.ArticleID',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function save($data)
	{
		$this->db->set("UserAdd",$this->session->Name);
		$this->db->set("DateAdd",date("Y-m-d H:i:s"));
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->set("UserCh",$this->session->Name);
		$this->db->set("DateCh",date("Y-m-d H:i:s"));
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->article->hapus_img($id);

		$this->db->where('ArticleID', $id);
		$this->db->delete($this->table);
	}
	public function hapus_img($id){
        $this->db->select("ArticleID,Image");
        $this->db->where('ArticleID', $id);
        $query = $this->db->get($this->table)->row();
        $Image = site_url("img/article/".$query->Image);
        if(!empty($query->Image)):
	        $root       = explode(base_url(), $Image)[1];
	        $headers = @get_headers($Image);
	        if (preg_match("|200|", $headers[0])) {
	            unlink('./' . $root);
	        } 
        endif;
    }

    public function getArticle(){
	$this->db->select("
		ArticleID,
		Name,
		Keywords,
		Date,
		Active,
		ImageUrl");

	$query = $this->db->get("Article");
	return $query->result();
    }

    public function getArticle_active(){
	$this->db->select("
		ArticleID,
		CategoryID,
		Name,
		Date,
		Keywords,
		Active,
		ImageUrl,
		Description,
		");
	$this->db->where("Active", "1");
	$this->db->order_by('Name', 'asc');
	$query = $this->db->get("Article");
	return $query;
    }

    public function get_detail($ArticleID){
	$this->db->select('
		ArticleID,
		CategoryID,
		Name,
		Keywords,
		Description,
		Active,
		Image,
		ImageUrl');
	$this->db->where('ArticleID', $ArticleID);
	$query = $this->db->get("Article");
	return $query->row();
    }
}
