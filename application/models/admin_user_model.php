<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Ravi
 * Description: model related to the users addition
 */
class Admin_User_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	//add user
	function add_user($result) {
		unset($result['conf_pass']);
		$result['password'] = md5($result['password']);
		$result['created_by'] = $this->session->userdata('id');
		$result['user_type'] = 'panel_user';
		$loc_acc = $result['loc_id'];
		unset($result['loc_id']);
		unset($result['loc_name']);
		unset($result['state']);
		unset($result['district']);
		$this->db->insert('tbl_users',$result);
		$insid = $this->db->insert_id();
		if($this->db->affected_rows())
		{
			foreach($loc_acc as $val) {
				$arr['user_id'] = $insid;
				$arr['loc_id'] = $val;
				$this->db->where($arr);
				$q = $this->db->get('tbl_location_access');
				if(!$q->result()) {
					$this->db->insert('tbl_location_access',$arr);
				}
			}
			$this->session->set_flashdata('msg_write', 'User added successfully');			
			return true;
		}
		else{
			$this->session->set_flashdata('msg_write', 'Unable to add user.Please try again');
			return false; 
		}
	}
	 //get users data
	function get_users($user_type=null) {
		if($this->session->userdata('id')!=1 && $user_type=='panel_user') {
			$this->db->where('created_by',$this->session->userdata('id'));
		}
		if($user_type) {
			$this->db->where('user_type',$user_type);
		}
			
		$query = $this->db->get('tbl_users');
		$result = $query->result_array();
		return $result;
	}
	
	//get particular user details
	function get_user_details($user_id) {
		$this->db->where('id',$user_id);
		$query = $this->db->get('tbl_users');
		return $query->row_array();
	}
	
	//update user
	function update_user($result,$user_id) {
		unset($result['conf_pass']);
		if($result['password']){
			$result['password'] = md5($result['password']);
		}
		else {
			unset($result['password']);
		}
		$this->db->select('email');
		$this->db->where('id',$user_id);
		$query=$this->db->get('tbl_users');
		$row = $query->row();
		if($result['email'] == $row->email){
			unset($result['email']);
		}
		$result['modified_date'] = date("Y-m-d H:i:s");
		
		$loc_acc = $result['loc_id'];	
		unset($result['loc_id']);
		unset($result['loc_name']);
		unset($result['state']);
		unset($result['district']);
		$this->db->where('user_id',$user_id);
		$this->db->delete('tbl_location_access');
		foreach($loc_acc as $val) {
				$arr['user_id'] = $user_id;
				$arr['loc_id'] = $val;
				$this->db->where($arr);
				$q = $this->db->get('tbl_location_access');
				if(!$q->result()) {
					$this->db->insert('tbl_location_access',$arr);
				}
			}
		
		
		$this->db->where('id',$user_id);
		
		$this->db->update('tbl_users',$result);			
			$this->session->set_flashdata('msg_write', 'user updated successfully');			
			return true;
		
	}

	//delete user
	function delete_user($user_id) {
		$this->db->where('id',$user_id);
		$this->db->delete('tbl_users');
		$this->session->set_flashdata('msg_write', 'user deleted successfully');
	}
	
	function get_access_location($user_id) {
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('tbl_location_access');
		return $query->result_array();
		
	}
}
    