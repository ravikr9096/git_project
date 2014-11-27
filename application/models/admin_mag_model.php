<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Mag_Model extends CI_Model{
   
    function __construct()
    {
       
        parent::__construct();

    }


    // save magazine fields value

    function save_mag($data)
    {
		$this->db->insert('tbl_magazine',$data);
		if($this->db->affected_rows())
		{
			return true;
		}
		else
    	{
    		return false;
    	}
    }
	
	//check if previous version exist or not
	function edition_exists($data) {
		$pub_date = date("Y-m-d",strtotime($data['publish_date']));
 		$this->db->where('publish_date',date($pub_date));
		$query = $this->db->get('tbl_magazine');
		$row = $query->row();
		if($pub_date==$row->publish_date) {
			return true;
		}
		else {
			return false;
		}
	
	}
	//update magazine post
	function update_mag($data,$mag_id)
    {

		$this->db->where('id',$mag_id);
		$this->db->update('tbl_magazine',$data);
		if($this->db->affected_rows())
			{
				return true;
			}
		else
    	{
    		return false;
    	}
    }
	
	function get_mags() {
		$query = $this->db->get('tbl_magazine');
		return $query->result_array();
		
	}
	
	function delete_mag($mag_id) {
		$this->db->select('file');
		$this->db->where('id',$mag_id);
		$query = $this->db->get('tbl_magazine');
		$row = $query->row();
		$dir_path = './uploads/magazines/';
		unlink($dir_path.$row->file);
		$this->db->where('id',$mag_id);
		$this->db->delete('tbl_magazine');
		
	}
	
	//get magazine details
	function get_mag_details($mag_id) {
		$this->db->where('id',$mag_id);
		$query = $this->db->get('tbl_magazine');
		return $query->row_array();
		
	}
	
	//function to save images for magazines
	function save_mag_images($data) {
		$this->db->select_max('sort');
		$this->db->where('mag_id',$data['mag_id']);
		$query = $this->db->get('tbl_magazine_imgs');
		$res = $query->row_array();
		$data['sort'] = $res['sort']+1;
		$this->db->insert('tbl_magazine_imgs',$data);
			
	}
	
	//function to save images for magazines
	function show_mag_images($mag_id)
	{
		$this->db->where('mag_id',$mag_id);
		$this->db->order_by('sort','asc');
		$query = $this->db->get('tbl_magazine_imgs');
		$rows = $query->result_array();
		return $rows;	
	}
	
	function update_mag_image($data,$mag_id) {
		$this->db->where('mag_id',$mag_id);
		$query = $this->db->get('tbl_magazine_imgs');
		$rows = $query->result_array();
		foreach($rows as $val) {
			$ids[] = $val['id'];		
		}
		$arr_img = $data['img_arr'];
		foreach($ids as $val){
			if( !in_array($val,$arr_img)) {
				unlink('./'.$this->common->getSingleValue('tbl_magazine_imgs','path','id',$val));
				$this->db->where('id',$val);
				$this->db->delete('tbl_magazine_imgs');
			}
		}
		
		$sort = $data['img_arr_sort'];
		foreach($sort as $k=>$val){
			$res['sort'] = $val;
			$this->db->where('id',$k);
			$this->db->update('tbl_magazine_imgs',$res);

		}
		
	
	}


// ******* model end ****** //
}