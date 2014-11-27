<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminUsers extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('admin_role_model');
		$this->load->model('admin_cat_model');		
    }
	
	// add user view
	function add_user() {
		$this->session->set_userdata('access_page','add_user');
		$data['country'] = $this->admin_cat_model->get_country();
		$data['roles_data'] = $this->admin_role_model->get_roles();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/add_user',$data);
		$this->load->view('admin/templates/footer');	
	}
	
	 // save role processed from add_role view
	function save_user() {
		$data['country'] = $this->admin_cat_model->get_country();
		$this->form_validation->set_rules('user_name', 'Username', 'required|is_unique[tbl_users.user_name]|min_length[6]|max_length[50]|callback_alpha_dash_hyphen');
		$this->form_validation->set_rules('first_name', 'First name', 'required|min_length[2]|max_length[50]|callback_alpha_space');
		$this->form_validation->set_rules('last_name', 'Last name', 'required|min_length[2]|max_length[50]|callback_alpha_space');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[conf_pass]|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('conf_pass', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_users.email]');
		$this->form_validation->set_rules('role_id', 'Role', 'required');
		$this->form_validation->set_rules('gender', 'Gender', '');

		if ($this->form_validation->run() == FALSE)
		{
			//if there are any validation error
			$this->session->set_userdata('access_page','add_user');
			$this->load->model('admin_role_model');
			$data['roles_data'] = $this->admin_role_model->get_roles();
			$this->load->view('admin/templates/header');
			$this->load->view('admin/add_user',$data);
			$this->load->view('admin/templates/footer');
		}
		else
		{
			//save the date to the tbl_user
			$post = $this->input->post();
			$post['created_date'] = date("Y-m-d H:i:s");
			$this->load->model('admin_user_model');
			$result = $this->admin_user_model->add_user($post);
			redirect('adminUsers/show_users/?x=1');
			
		}
	}
	
	
	//show list of roles 
	function show_users($user_type='panel_user'){
		$data['user_type'] = $user_type;
		$this->load->model('admin_user_model');
		$data['users_data'] = $this->admin_user_model->get_users($user_type);
		$this->load->model('admin_role_model');
		$data['roles_data'] = $this->admin_role_model->get_roles();
		$data['role_name'] = $this->admin_role_model->get_role_id_title(); 
		$this->load->view('admin/templates/header');
		if( access_check('pusr_create') || access_check('pusr_read') || access_check('pusr_update') || access_check('pusr_delete') ) {
			$this->load->view('admin/show_users',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}
		$this->load->view('admin/templates/footer');
	}
	
	//edit user
	function edit_user($user_id) {
		$this->load->model('admin_user_model');
		$data['user_data'] = $this->admin_user_model->get_user_details($user_id);
		$this->load->model('admin_role_model');
		$data['roles_data'] = $this->admin_role_model->get_roles();
		$data['country'] = $this->admin_cat_model->get_country();
		$data['access_locations'] = $this->admin_user_model->get_access_location($user_id);
		$this->load->view('admin/templates/header');

		if( access_check('pusr_update') && user_access_check($user_id)) {
			$this->load->view('admin/edit_user',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}
		$this->load->view('admin/templates/footer');
	}
	
	//to update the edited user
	function update_user($user_id) {
		$data['country'] = $this->admin_cat_model->get_country();

		$post = $this->input->post();
		$this->load->model('admin_user_model');
		$data['user_data'] = $this->admin_user_model->get_user_details($user_id);
		
		$this->form_validation->set_rules('first_name', 'First name', 'required|callback_alpha_space|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('last_name', 'Last name', 'required|callback_alpha_space|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'matches[conf_pass]|min_length[6]|max_length[50]');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('role_id', 'Role', 'required');
		$this->form_validation->set_rules('gender', 'Gender', '');
		
		if ($this->form_validation->run() == FALSE)
		{
			//if there are any validation error
			$this->session->set_userdata('access_page','edit_user');
			$this->load->model('admin_role_model');
			$data['roles_data'] = $this->admin_role_model->get_roles();
			$this->load->view('admin/templates/header');
			$this->load->view('admin/edit_user',$data);
			$this->load->view('admin/templates/footer');
		}
		else
		{
			//save the date to the tbl_user
			$post = $this->input->post();
			$this->load->model('admin_user_model');
			$result = $this->admin_user_model->update_user($post,$user_id);
			redirect('adminUsers/show_users/?x=1');
			
		}

	}
	
	//delete user
	function delete_user($user_id) {
		$this->load->model('admin_user_model');
		$type = $this->common->getSingleValue('tbl_users','user_type','id',$user_id);
		$result = $this->admin_user_model->delete_user($user_id);
		redirect('adminUsers/show_users/'.$type);

	}
	
	//callback function for checking alphabets with unders
	function alpha_dash_hyphen($str)
	{
		if (! preg_match("/^([-0-9-a-z_.])+$/i", $str))
		{
			$this->form_validation->set_message('alpha_dash_hyphen', 'This field can have alphabets with period(.),underscores(_) or hyphen(-)');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	} 
	//callback function for checking alphabets with spaces
	function alpha_space($str)
	{
		if (! preg_match("/^([-a-z ])+$/i", $str))
		{
			$this->form_validation->set_message('alpha_space', 'This field can only have alphabets with space');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	// ajax function to add location access
	function add_location_access() {
		$loc_id = $this->input->post('loc_id');
		$loc_name = $this->common->getSingleValue('tbl_location','name','id',$loc_id);
		$str = '<tr><td><input type="hidden" class="loc_ids" readonly name="loc_id[]" value="'.$loc_id.'"></td><td><input readonly class="loc_names" type="text" name="loc_name[]" value="'.$loc_name.'"></td><td><a href="#" id="'.rand().'" onclick="remove_location(this.id);return false;"><i style="color:#3c8dbc" class="glyphicon glyphicon-remove"></i>&nbsp;Remove</a></td></tr>';
		echo json_encode($str);
		
	}
	
	
	
}