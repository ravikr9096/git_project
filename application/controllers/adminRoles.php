<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminRoles extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('admin_cat_model');

		//$checking=varify_session();  		
    }
	
	// add role view
	function add_role() {
		$data['country'] = $this->admin_cat_model->get_country();
		$this->session->set_userdata('access_page','add_role');
		$this->load->view('admin/templates/header');
		$this->load->view('admin/add_role',$data);
		$this->load->view('admin/templates/footer');	
	}
	
	// save role processed from add_role view
	function save_role() {
		$data['country'] = $this->admin_cat_model->get_country();
		$flag = 0;
		$keys = array('art_create','art_read','art_update','art_delete','art_mod','ads_create','ads_read','ads_update','ads_delete','ads_mod','polls_create','polls_read','polls_update','polls_delete','polls_mod','cmnt_create','cmnt_read','cmnt_update','cmnt_delete','cmnt_mod','pusr_create','pusr_read','pusr_update','pusr_delete','pusr_mod','susr_create','susr_read','susr_update','susr_delete','susr_mod');
		foreach($keys as $k) {
			if(array_key_exists($k,$this->input->post())) {
				$flag=1;
				break;
			}
		}
		$this->form_validation->set_rules('role_title', 'Role', 'required|is_unique[tbl_roles.role_title]');
		$this->form_validation->set_rules('role_desc', 'Description ', 'required');
		if($flag==0) {
			$this->form_validation->set_rules('access_rights', 'Access rights', 'callback_access_check12');
		}

		if ($this->form_validation->run() == FALSE)
		{
			//if there are any validation error
			$this->session->set_userdata('access_page','add_role');
			$this->load->view('admin/templates/header');
			$this->load->view('admin/add_role',$data);
			$this->load->view('admin/templates/footer');
		}
		else {
			$post = $this->input->post();
			foreach( $post as $k=>$v) {
				if($v=='accept') {
					$post[$k]= 1;
				}
			}
				
			unset($post['access_rights']);
			$this->load->model('admin_role_model');
			$result = $this->admin_role_model->add_role($post);
			redirect('adminRoles/show_roles/?x=1');
		}
	}
	public function access_check12($str) {
		if ($str == '0')
		{
			$this->form_validation->set_message('access_check12', 'Please select atleast one permission');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//show list of roles 
	function show_roles(){
		$this->load->model('admin_role_model');
		$data['roles_data'] = $this->admin_role_model->get_roles();
		$this->load->view('admin/templates/header');
		if( access_check('pusr_create') || access_check('pusr_read') || access_check('pusr_update') || access_check('pusr_delete') ) {
			$this->load->view('admin/show_roles',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}
		$this->load->view('admin/templates/footer');
	}
	
	//edit role
	function edit_role($role_id) {
		$this->load->model('admin_role_model');
		$data['role_data'] = $this->admin_role_model->get_role_details($role_id);
		$data['country'] = $this->admin_cat_model->get_country();
		$this->load->view('admin/templates/header');
		if( access_check('pusr_update') && role_access_check($role_id)) {
			$this->load->view('admin/edit_role',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}
		$this->load->view('admin/templates/footer');
	}
	//to update the edited role
	function update_role($role_id) {
		$flag = 0;
		$keys = array('art_create','art_read','art_update','art_delete','art_mod','ads_create','ads_read','ads_update','ads_delete','ads_mod','polls_create','polls_read','polls_update','polls_delete','polls_mod','cmnt_create','cmnt_read','cmnt_update','cmnt_delete','cmnt_mod','pusr_create','pusr_read','pusr_update','pusr_delete','pusr_mod','susr_create','susr_read','susr_update','susr_delete','susr_mod');
		foreach($keys as $k) {
			if(array_key_exists($k,$this->input->post())) {
				$flag=1;
				break;
			}
		}
		$this->form_validation->set_rules('role_desc', 'Description ', 'required');
		if($flag==0) {
			$this->form_validation->set_rules('access_rights', 'Access rights', 'callback_access_check12');
		}
		if ($this->form_validation->run() == FALSE)
		{
			//if there are any validation error
			$this->load->model('admin_role_model');
			$data['role_data'] = $this->admin_role_model->get_role_details($role_id);
			$this->load->view('admin/templates/header');
			$this->load->view('admin/edit_role',$data);
			$this->load->view('admin/templates/footer');
		}
		else {
			$post = $this->input->post();
			foreach( $post as $k=>$v) {
				if($v=='accept') {
					$post[$k]= 1;
				}
			}
				// location id save
			
			if(isset($post['district']) && @$post['district']!='' ) {
				unset($post['country']);
				unset($post['state']);
				$post['loc_id'] = $post['district'];
				unset($post['district']);
			}
			elseif(isset($post['state']) && @$post['state']!='') {
				unset($post['country']);
				$post['loc_id'] = $post['state'];
				unset($post['state']);
				unset($post['district']);
			}
			elseif(isset($post['country'])) {
				$post['loc_id'] = $post['country'];
				unset($post['country']);
				unset($post['state']);
			}
			
			unset($post['access_rights']);
			$this->load->model('admin_role_model');
			$result = $this->admin_role_model->update_role($post,$role_id);
			redirect('adminRoles/show_roles/?x=1');
			}		
	}
	
	//delete role
	function delete_role($role_id) {	
		$this->load->model('admin_role_model');
		$result=$this->admin_role_model->get_roles();
		foreach($result as $k=>$v) {
			if($v['id']==$role_id) {
				unset($result[$k]);
			}
		}
		$data['roles_data']= $result;
		$data['role_id'] = $role_id;
		$this->load->view('admin/templates/header');
		$this->load->view('admin/delete_role',$data);
		$this->load->view('admin/templates/footer');
		
		
	}
	function delete_role_data($role_id) {
		$this->form_validation->set_rules('role_id', 'Role', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('admin_role_model');
			$result=$this->admin_role_model->get_roles();
			foreach($result as $k=>$v) {
				if($v['id']==$role_id) {
					unset($result[$k]);
				}
			}
			$data['roles_data']= $result;
			$data['role_id'] = $role_id;
			$this->load->view('admin/templates/header');
			$this->load->view('admin/delete_role',$data);
			$this->load->view('admin/templates/footer');
		}
		else
		{
			$changed_role_id = $this->input->post('role_id');
			$this->load->model('admin_role_model');
			$this->admin_role_model->delete_role($role_id,$changed_role_id);
			redirect('adminRoles/show_roles');
			
			
		}
	
	}
	
	
}