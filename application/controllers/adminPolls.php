<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminPolls extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('admin_polls_model');
		
    }

     private function no_cache()
	{
	  $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	  $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	  $this->output->set_header('Pragma: no-cache');
	  $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
	}

	//function to show posts	
	function show_polls()
	{
			
		$data['polls_data'] = $this->admin_polls_model->show_polls();
		//$data['posts_data'] = $this->admin_post_model->show_posts();
		foreach($data['polls_data'] as $k=>$val) {
			$answers = $this->admin_polls_model->get_poll_answers($val['id']);
			$data['polls_data'][$k]['answers'] = $answers;
		}
		$this->load->view('admin/templates/header');
		if(access_check('polls_create') || access_check('polls_read') || access_check('polls_update') || access_check('polls_delete')) {
			$this->load->view('admin/show_polls',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}	
		$this->load->view('admin/templates/footer');
		
	}
	
	//function to edit posts
	function edit_post($post_id) {
		$data["posts_data"] = $this->admin_post_model->get_post_data($post_id);
		$this->load->view('admin/edit_post',$data);
		
	
	}

	//function to process the add post form
	function save_poll() {
		$data=$this->input->post();
		$data['created_on'] = date("Y-m-d H:i:s",strtotime($data['created_on']));
		$data['created_by'] = $this->session->userdata('id');
		$this->admin_polls_model->save_poll($data);
		redirect('adminPolls/show_polls');
	}
	
	function delete_poll($poll_id) {
		$this->admin_polls_model->delete_poll($poll_id);
		redirect('adminPolls/show_polls');
	}
	
	function edit_poll($poll_id) {
		$data['poll_data'] = $this->admin_polls_model->get_poll_details($poll_id);
		
		$this->load->view('admin/templates/header');
		$this->load->view('admin/edit_poll',$data);
		$this->load->view('admin/templates/footer');
	}
	function update_poll($poll_id) {
		$up_data = $this->input->post();
		$up_data['modified_on'] = date("Y-m-d H:i:s");
		if(!isset($up_data['status'])) {
			$up_data['status']=0;
		}
		$data['poll_data'] = $this->admin_polls_model->update_poll_details($up_data,$poll_id);
		redirect('adminPolls/show_polls');
	}
	
}