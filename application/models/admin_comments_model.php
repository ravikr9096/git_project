<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Ravi
 * Description: model related to the posts
 */
class Admin_Comments_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
	//function to get the list of all categories
	

	function total_comments() {
		$this->load->database();
		return $this->db->count_all("tbl_comments");
		
	}
	
	//function to show tbl_article using codeigniter pagination
	function show_comments()
	{
		$this->load->database();
		$this->db->select('tbl_comments.*');
		$this->db->from('tbl_comments');
		
		$query = $this->db->get();
		$rows = $query->result_array();
		return $rows;	
	}
	
	//function to show tbl_article using codeigniter pagination
	function get_comments_front($art_id)
	{
		$this->load->database();
		$this->db->select('tbl_comments.*');
		$this->db->where('art_id',$art_id);
		$this->db->order_by('comment_date','DESC');
		//$this->db->where('status','1');
		$this->db->from('tbl_comments');
		
		$query = $this->db->get();
		$rows = $query->result_array();
		return $rows;	
	}
	
	
	
	//delete comment
	function delete_comment($comment_id){
		//delete comment from tbl_comments
		$this->db->where('id',$comment_id);
		$this->db->delete('tbl_comments');
		$this->session->set_flashdata('msg_wrong', 'Comment deleted successfully');
	}
	
	
}