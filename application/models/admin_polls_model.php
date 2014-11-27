<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Ravi
 * Description: model related to the posts
 */
class Admin_Polls_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
	//function to get the list of all categories
	

	function total_polls() {
		$this->load->database();
		return $this->db->count_all("tbl_polls");
		
	}
	
	//function to show tbl_article using codeigniter pagination
	function show_polls()
	{
		$this->load->database();
		$this->db->select('tbl_polls.*');
		$this->db->from('tbl_polls');
		
		$query = $this->db->get();
		$rows = $query->result_array();
		return $rows;	
	}
	
	function get_poll_answers($poll_id) {
		$this->db->where('poll_id',$poll_id);
		$query = $this->db->get('tbl_poll_answers');
		$rows = $query->result_array();
		return $rows;	
	
	}
	
	//get post data from the database
	function get_poll_details($poll_id) {
		$this->db->where('id',$poll_id);
		$query = $this->db->get('tbl_polls');
		$rows = $query->row_array();
		$this->db->where('poll_id',$poll_id);
		$query = $this->db->get('tbl_poll_answers');
		$rows['answers'] = $query->result_array();
		return $rows;
	}
	
	//save new aricle data to the database
	function save_poll($data) {
		$answers = $data['answers'];
		unset($data['answers']);
		$all_data = $data;
		
		$this->db->insert('tbl_polls',$all_data);
		
		$poll_id = $this->db->insert_id();
		foreach($answers as $v) {
				if(!empty($v)) {
				$d['poll_id'] = $poll_id;
				$d['answer'] = $v;
				$this->db->insert('tbl_poll_answers',$d);
				}
			}
		$this->session->set_flashdata('msg_write', 'Poll added successfully');
		
	
	}
	
	//delete poll
	function delete_poll($poll_id){
		//delete poll from tbl_polls
		$this->db->where('id',$poll_id);
		$this->db->delete('tbl_polls');
		//delte answers from tbl_poll_answers
		$this->db->where('poll_id',$poll_id);
		$this->db->delete('tbl_poll_answers');
		$this->session->set_flashdata('msg_wrong', 'Poll delete successfully');
	}
	
	function update_poll_details($data,$poll_id) {
		$answers = $data['answers'];
		unset($data['answers']);
		$all_data = $data;
		$this->db->where('id',$poll_id);
		$this->db->update('tbl_polls',$all_data);
		$this->db->where('poll_id',$poll_id);
		$this->db->delete('tbl_poll_answers');
		foreach($answers as $v) {
			if(!empty($v)) {
				$d['poll_id'] = $poll_id;
				$d['answer'] = $v;
				$this->db->insert('tbl_poll_answers',$d);
			}
		}
		$this->session->set_flashdata('msg_write', 'Poll modified successfully');	
	}
	
	function record_vote($poll_id,$poll_ans) {
		$ctr = $this->common->getSingleValue('tbl_poll_answers','counter','id',$poll_ans);
		$ctr++;
		$this->db->where('id',$poll_ans);
		$this->db->update('tbl_poll_answers',array('counter'=>$ctr));

	
	}
}