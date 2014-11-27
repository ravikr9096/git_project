<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminComments extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('admin_comments_model');
		
    }

     private function no_cache()
	{
	  $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	  $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	  $this->output->set_header('Pragma: no-cache');
	  $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
	}

	//function to show posts	
	function show_comments()
	{
			
		$data['comments_data'] = $this->admin_comments_model->show_comments();
		$this->load->view('admin/templates/header');
		if(access_check('comments_create') || access_check('comments_read') || access_check('comments_update') || access_check('comments_delete')) {
			$this->load->view('admin/show_comments',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}	
		$this->load->view('admin/templates/footer');
		
	}
	
	//function to process the add post form
	function save_comment() {
		$data=$this->input->post();
		$data['created_on'] = date("Y-m-d H:i:s",strtotime($data['created_on']));
		$data['created_by'] = $this->session->userdata('id');
		$this->admin_comments_model->save_comment($data);
		redirect('adminComments/show_comments');
	}
	
	function delete_comment($comment_id) {
		$this->admin_comments_model->delete_comment($comment_id);
		redirect('adminComments/show_comments');
	}
	
	
}