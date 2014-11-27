<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminLocation extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('common');
		$this->load->library('form_validation');
		$this->load->model('admin_cat_model');
				
    }
	

	// getting show location 

	function location()
	{
		$data['country']  = $this->admin_cat_model->get_country();
		$data['continent']  = $this->admin_cat_model->get_continents();
		$data['location'] = $this->admin_cat_model->get_location();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/add_loc',$data);
		$this->load->view('admin/templates/footer');
	}
	
	// function for add Country location

	function save_country()
	{
		
		$result = $this->admin_cat_model->save_country();
		if($result)
		{
			$this->session->set_flashdata('msg_write','Country Added Successfully.');
			redirect('adminLocation/location');
		}else{
			$this->session->set_flashdata('msg_wrong','Sorry, not submitted.');
			redirect('adminLocation/location');
		}
	}

	// function for add country State 

	function save_state()
	{
		
		$result = $this->admin_cat_model->save_state();
		if($result)
		{
			$this->session->set_flashdata('msg_write','State Added Successfully.');
			redirect('adminLocation/location');
		}
		else
		{
			$this->session->set_flashdata('msg_wrong','Sorry, not submitted.');
			redirect('adminLocation/location');
		}
	}

	// get State for selected country

	function get_state()
	{

		$result = $this->admin_cat_model->get_state();
		print_r($result);

	}

	// get State for selected country

	function get_state2()
	{

		$result = $this->admin_cat_model->get_state2();
		print_r($result);

	}
	
	// get district for selected country

	function get_district()
	{

		$result = $this->admin_cat_model->get_district();
		print_r($result);

	}
	
	// function for add country State 

	function save_district()
	{
		
		$result = $this->admin_cat_model->save_district();
		if($result)
		{
			$this->session->set_flashdata('msg_write','District Added Successfully.');
			redirect('adminLocation/location');
		}
		else
		{
			$this->session->set_flashdata('msg_wrong','Sorry, not submitted.');
			redirect('adminLocation/location');
		}
	}

	// delete location

	function delete($id)
	{
		

		$count = $this->admin_cat_model->chk_dis_delete($id);

		if($count > 0)
        {
			
				$this->session->set_flashdata('msg_wrong','Can not delete, selected in articles.');
				redirect('adminLocation/location');
			
	    }
	    else
	    {
	    	$result = $this->admin_cat_model->delete($id);
			if($result)
			{
				$this->session->set_flashdata('msg_write','Deleted  Successfully.');
				redirect('adminLocation/location');
			}
			else
			{
				$this->session->set_flashdata('msg_wrong','Sorry, not submitted.');
				redirect('adminLocation/location');
			}
	    }
		
	}

	// function for delete_country

	function delete_country()
	{
		
		
		
			$result = $this->admin_cat_model->delete_country();
		if($result)
		{
			$this->session->set_flashdata('msg_write','Country Deleted  Successfully.');
			redirect('adminLocation/location');
		}
		else
		{
			$this->session->set_flashdata('msg_wrong','Can not deleted.');
			redirect('adminLocation/location');
		}
		
		
	}

	// function for delete_state

	function delete_state()
	{
		
		
		
	    $result = $this->admin_cat_model->delete_state();
		if($result)
		{
			$this->session->set_flashdata('msg_write','State Deleted  Successfully.');
			redirect('adminLocation/location');
		}
		else
		{
			$this->session->set_flashdata('msg_wrong','Can not deleted.');
			redirect('adminLocation/location');
		}
		
		
	}

	// function for edit district

	function edit_district()
	{

		
		$result = $this->admin_cat_model->edit_district();
		if($result)
		{
			$this->session->set_flashdata('msg_write','District Edited Successfully.');
			redirect('adminLocation/location');
		}
		else
		{
			$this->session->set_flashdata('msg_wrong','You did not changed anything.');
			redirect('adminLocation/location');
		}
		
	}

	// function for check country delete 

	function check_for_delete()
	{

		$result = $this->admin_cat_model->check_for_delete();
		print($result);
		
	}

  

// controller ends //
}