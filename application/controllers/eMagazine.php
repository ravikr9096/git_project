<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EMagazine extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->model('admin_mag_model');
				
    }
	

	// getting show location 

	function index()
	{
		$data['mags']  = $this->admin_mag_model->get_mags();
		//$data['location'] = $this->admin_magzine_model->get_location();
		$this->load->view('admin/templates/header');
		//$this->load->view('admin/add_loc',$data);
		$this->load->view('admin/emagazine',$data);
		$this->load->view('admin/templates/footer');
	}
	
	function save_mag() {
		$data['publish_date'] =$this->input->post('publish_date');
		if($this->admin_mag_model->edition_exists($data)) {
			$this->session->set_flashdata('msg_wrong','Magazine edition already exists');
			redirect('EMagazine');			
		}
		foreach ($_FILES as $key=> $val) {
			//file upload configurations
			$dir_path = './uploads/magazines/';
			$config['upload_path'] = $dir_path;
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['file_name'] = $this->input->post('title').'.pdf';
			$this->load->library('upload',$config);
			if (!$this->upload->do_upload($key))
			{
				$error = array('error' => $this->upload->display_errors());
				$error_found =  $error['error'];
				$this->session->set_flashdata('msg_wrong',$error_found);  
				redirect('EMagazine');
			}
			else
			{
				$upload_data = $this->upload->data();
				$data['title'] = $this->input->post('title');
				$data['file']= $upload_data['file_name'];
				$data['publish_date'] =$this->input->post('publish_date');
				$res = $this->admin_mag_model->save_mag($data);
				if($res) {
					$this->session->set_flashdata('msg_write','Magazine edition added successfully.');
				}
				else {
					$this->session->set_flashdata('msg_wrong','Magazine edition already exists');
				}
				redirect('EMagazine');
			}
		}
		
	}
	function update_mag($post_id) {
		foreach ($_FILES as $key=> $val) {
			//file upload configurations
			if($val['name']) {
				$dir_path = './uploads/magazines/';
				$config['upload_path'] = $dir_path;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '0';
				$config['max_filename'] = '255';
				$config['file_name'] = $this->input->post('title').'.pdf';
				$this->load->library('upload',$config);
				if (!$this->upload->do_upload($key))
				{
					$error = array('error' => $this->upload->display_errors());
					$error_found =  $error['error'];
					$this->session->set_flashdata('msg_wrong',$error_found);  
					redirect('EMagazine');
				}
				else
				{
					$upload_data = $this->upload->data();
					$data['title'] = $this->input->post('title');
					$data['file']= $upload_data['file_name'];
					$res = $this->admin_mag_model->update_mag($data,$post_id);
					if($res) {
						$this->session->set_flashdata('msg_write','Magazine edition added successfully.');
					}
					else {
						$this->session->set_flashdata('msg_wrong','Magazine edition already exists');
					}
					redirect('EMagazine');			
				}
			}
			else {
				$data['title'] = $this->input->post('title');
				$res = $this->admin_mag_model->update_mag($data,$post_id);
				if($res) {
					$this->session->set_flashdata('msg_write','Magazine updated successfully.');
				}
				else {
					$this->session->set_flashdata('msg_wrong','Magazine edition already exists');
				}
				redirect('EMagazine');			
			
			}
		}
		
	}
	//delete magazine
	function delete_mag($mag_id) {
		$this->admin_mag_model->delete_mag($mag_id);
		$this->session->set_flashdata('msg_wrong','Magazine deleted successfully');
		$this->index();
		
	}
	
	//edit magazine/ add images to it
	function edit_magazine($mag_id) {
		$data['mag'] = $this->admin_mag_model->get_mag_details($mag_id);
		$data['slider_images'] = $this->admin_mag_model->show_mag_images($mag_id);
		$data['slider_images1'] = $this->admin_mag_model->show_mag_images($mag_id);
		$this->load->view('admin/templates/header');
		$this->load->view('admin/edit_magazine',$data);
		$this->load->view('admin/templates/footer');
	
	}
	
	function save_mag_image($mag_id) {
		$mag_detail = $this->admin_mag_model->get_mag_details($mag_id);
		foreach ($_FILES as $key=> $val) {
			if($val['name']) {
			
				if (!is_dir('./uploads/magazines/mag_'.$mag_detail['id'])) {
					mkdir('./uploads/magazines/mag_'.$mag_detail['id']);
				}
				
				//file upload configurations
				$dir_path = './uploads/magazines/mag_'.$mag_detail['id'];
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
					$this->edit_magazine($mag_id);
				}
				else
				{
					$upload_data = $this->upload->data();
					//$data['title'] = $this->input->post('title');
					$data['path']= 'uploads/magazines/mag_'.$mag_detail['id'].'/'.$upload_data['file_name'];
					$data['mag_id'] = $mag_id;
					$result = $this->admin_mag_model->save_mag_images($data);
					$this->session->set_flashdata('msg_write','Added Successfully.');
					$this->edit_magazine($mag_id);
				}
			}
		}
	
	}
	
	function image_mag_update($mag_id) {
		$this->admin_mag_model->update_mag_image($this->input->post(),$mag_id);
		/* $data['mag'] = $this->admin_mag_model->get_mag_details($mag_id);
		$data['slider_images'] = $this->admin_mag_model->show_mag_images($mag_id);
		$data['slider_images1'] = $this->admin_mag_model->show_mag_images($mag_id);
		$this->load->view('admin/templates/header');
		$this->load->view('admin/edit_magazine',$data);
		$this->load->view('admin/templates/footer'); */
		
		$this->session->set_flashdata('msg_write','Changes saved successfully Successfully.');
		redirect('EMagazine/edit_magazine/'.$mag_id);
	
	}
	
	
	
	
  

// controller ends //
}