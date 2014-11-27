<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminAdds extends CI_Controller {

	function __construct()
	{

		parent::__construct();
		$this->load->model('admin_cat_model');
		$this->load->model('admin_adds_model');

	}

	function index()
	{
		$data['country'] = $this->admin_cat_model->get_country();
		$data['ads_region'] = $this->admin_adds_model->get_ads_region();
		$data['adds'] = $this->admin_adds_model->get_advertise();
		$this->load->view('admin/templates/header');
		if(access_check('ads_read') || access_check('ads_create') || access_check('ads_update') || access_check('ads_delete'))  {
			$this->load->view('admin/adds',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}	
		
		$this->load->view('admin/templates/footer');
	}


    // save advertisement 

    function save_add()
    {

    	//print_r($this->input->post());
    	
		
		
    	$data = array('title'=>$this->input->post('title'),'url'=>$this->input->post('url'),'region_id'=>$this->input->post('region') );
		if($this->input->post('district')) {
			$data['loc_id'] =$this->input->post('district');
		}
		elseif($this->input->post('state')) {
			$data['loc_id'] =$this->input->post('state');
		}
		elseif($this->input->post('country')) {
			$data['loc_id'] =$this->input->post('country');
		}
		
		
    	if($data['loc_id'])
    	{
			if($this->input->post('set_field') == 2) {
				$data['script_code']=$this->input->post('script_code');
				$result = $this->admin_adds_model->save_add($data);
				$this->session->set_flashdata('msg_write','Added Successfully.');
				redirect('adminAdds');
			}
			else {
				foreach ($_FILES as $key=> $val) {
					if($val['name']) {
					
					//file upload configurations
					$dir_path = './uploads/adds/';
					$config['upload_path'] = $dir_path;
					$config['allowed_types'] = 'jpg|png|gif';
					$config['max_size'] = '0';
					$config['max_filename'] = '255';
					$config['encrypt_name'] = TRUE;
					$config['file_name'] = $val['name'];

					$this->load->library('upload',$config);
					if (!$this->upload->do_upload($key))
					{
						$error = array('error' => $this->upload->display_errors());
						$error_found =  $error['error'];
						$this->session->set_flashdata('msg_wrong',$error_found);  
						redirect('adminAdds');
					}
					else
					{
						$upload_data = $this->upload->data();
						//$data['title'] = $this->input->post('title');
						$data['add_img']= $upload_data['file_name'];
						$result = $this->admin_adds_model->save_add($data);
						$this->session->set_flashdata('msg_write','Added Successfully.');
						redirect('adminAdds');
					}
					}
				}
			}
			
    		
    	}
    	else
    	{
    		$this->session->set_flashdata('msg_wrong','Sorry, not submitted.');
			redirect('adminAdds');
    	}
    	
    	

    }


    // Delete Advertisement

    function delete($id)
    {

    	$result = $this->admin_adds_model->delete($id);
		if($result)
		{
			$this->session->set_flashdata('msg_write','Delete Successfully.');
			redirect('adminAdds');
		}
		else
		{
			$this->session->set_flashdata('msg_wrong','Sorry, can not delete.');
			redirect('adminAdds');
		}

    }


    // edit advertisement 

    function edit_add($add_id)
    {
		$data['country'] = $this->admin_cat_model->get_country();
		$data['adds'] = $this->admin_adds_model->get_advertise();
		$data['ads_region'] = $this->admin_adds_model->get_ads_region();
		$data['add_data'] = $this->admin_adds_model->get_add_data($add_id);
		$this->load->view('admin/templates/header');
		if(access_check('ads_update')) {
			$this->load->view('admin/edit_add',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}	
		$this->load->view('admin/templates/footer');
    	
    }

	function update_add($add_id) 
	{
		
		$result = $this->admin_adds_model->update_add();
		if($result)
		{
			$this->session->set_flashdata('msg_write','Updated Successfully.');
			redirect('adminAdds');
		}
		else
		{
			$this->session->set_flashdata('msg_wrong','Sorry, can not update.');
			redirect('adminAdds');
		}

	}


	//********** class ends **************//
	


}