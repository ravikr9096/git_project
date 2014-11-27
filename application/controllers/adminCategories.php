<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminCategories extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		if($this->session->userdata('site_lang') == 'european')
		{
			$this->lang->load('euro', 'euro');
		}else{
			$this->lang->load('english', 'english');
		}
		//$checking=varify_session();  		
    }
	
	// add category view
	function add_cat() {
		//$this->load->model('admin_cat_model');
		$this->load->view('admin/templates/header');
		$this->load->view('admin/add_cat');
		$this->load->view('admin/templates/footer');	
	}

	 // save category processed from add_cat view
	function save_cat() {
		$this->form_validation->set_rules('category', 'Category', 'required|is_unique[tbl_category.category]');
		$this->form_validation->set_rules('alias', 'Alias', 'required|callback_alpha_dash_space');
		$this->form_validation->set_rules('sort', 'Sort order', 'numeric');

		if ($this->form_validation->run() == FALSE)
		{
			//if there are any validation error
			$this->load->view('admin/templates/header');
			$this->load->view('admin/add_cat');
			$this->load->view('admin/templates/footer');
		}
		else
		{
			//save the date to the tbl_user
			$post = $this->input->post();
			$this->load->model('admin_cat_model');
			$result = $this->admin_cat_model->add_cat($post);
			redirect('adminCategories/show_cat/?x=1');
			
		}
	}

	
	//show list of roles 
	function show_cat(){
		$this->load->model('admin_cat_model');
		$data['cat_data'] = $this->admin_cat_model->get_cat();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/show_cat',$data);
		$this->load->view('admin/templates/footer');
	}
	
	//edit cat
	function edit_cat($cat_id) {
		$this->load->model('admin_cat_model');
		$data['cat_data'] = $this->admin_cat_model->get_cat_details($cat_id);
		$this->load->view('admin/templates/header');
		$this->load->view('admin/edit_cat',$data);
		$this->load->view('admin/templates/footer');
	}
	
	//to update the edited cat
	function update_cat($cat_id) {
		$post = $this->input->post();
		$this->load->model('admin_cat_model');
		$data['cat_data'] = $this->admin_cat_model->get_cat_details($cat_id);
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('alias', 'Alias', 'required|callback_alpha_dash_space');
		$this->form_validation->set_rules('sort', 'Sort order', 'numeric');

		
		if ($this->form_validation->run() == FALSE)
		{
			//if there are any validation error
			$this->load->view('admin/templates/header');
			$this->load->view('admin/edit_cat',$data);
			$this->load->view('admin/templates/footer');
		}
		else
		{
			//save the date to the tbl_user
			$post = $this->input->post();
			$this->load->model('admin_cat_model');
			$result = $this->admin_cat_model->update_cat($post,$cat_id);
			redirect('adminCategories/show_cat/?x=1');
			
		}

	}

	//delete category
	function delete_cat($cat_id) {
		$this->load->model('admin_cat_model');
		$result = $this->admin_cat_model->delete_cat($cat_id);
		redirect('adminCategories/show_cat');

	}
	
	//callback function for checking alphabets with spaces
	function alpha_dash_space($str)
	{
		if (! preg_match("/^([-a-z_. ])+$/i", $str))
		{
			$this->form_validation->set_message('alpha_dash_space', 'Alias field can have alphabets with space,period(.) or underscores(_)');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	} 
	
	
	
}