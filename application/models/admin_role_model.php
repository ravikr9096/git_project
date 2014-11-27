<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Ravi
 * Description: model related to the roles addition
 */
class Admin_Role_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	//add role
	function add_role($result) {
		$result['created_by'] = $this->session->userdata('id');
		$this->db->insert('tbl_roles',$result);
		$insid = $this->db->insert_id();
		if($this->db->affected_rows())
		{
			$this->session->set_flashdata('msg_write', 'Role added successfully');			
			return true;
		}
		else{
			return false; 
		}
	}
	//get roles data
	function get_roles() {
		$query = $this->db->get('tbl_roles');
		return $query->result_array();
	}
	
	//get particular role details
	function get_role_details($role_id) {
		$this->db->where('id',$role_id);
		$query = $this->db->get('tbl_roles');
		return $query->row_array();
	}
	//get role_id title array
	function get_role_id_title() {
		$this->db->select(array('id','role_title'));
		$query = $this->db->get('tbl_roles');
		foreach($query->result_array() as $val) {
			$result[$val['id']] = $val['role_title'];
		}
		$result[0] = 'Super admin';
		return $result;
	}
	//update role
	function update_role($result,$role_id) {
		$this->db->where('id',$role_id);
		foreach($this->db->list_fields('tbl_roles') as $val) {
			if($val=='id' || $val=='created_by') {
				continue;
			}
			$flush_data[$val] = '';
		}
		$this->db->update('tbl_roles',$flush_data);
		$this->db->where('id',$role_id);
		$this->db->update('tbl_roles',$result);
		if($this->db->affected_rows())
		{
			$this->session->set_flashdata('msg_write', 'Role updated successfully');			
			return true;
		}
		else{
			return false; 
		}
	}
	//delete role
	function delete_role($role_id,$changed_role_id) {
		$this->db->where('role_id',$role_id);
		$data1 = array ('role_id'=>$changed_role_id);
		$this->db->update('tbl_users',$data1);
		$this->db->where('id',$role_id);
		$this->db->delete('tbl_roles');
		$this->session->set_flashdata('msg_write', 'Role deleted successfully');	
	}
}
    