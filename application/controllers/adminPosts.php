<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminPosts extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('admin_model');
		$this->load->model('admin_post_model');
		$this->load->model('admin_cat_model');
		
    }

     private function no_cache()
	{
	  $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	  $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	  $this->output->set_header('Pragma: no-cache');
	  $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
	}

	//function to show articles	
	function show_posts()
	{	
		
		//$this->common->get_connected_users();
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($page==0 && $this->input->post('search')){
			$this->session->set_userdata("search",$this->input->post('search'));
		}
		elseif($page==0 && $this->input->post('search')=="") {
			$this->session->unset_userdata("search");
		}
		if($this->input->post('per_page')) {
			$this->session->set_userdata("per_page",$this->input->post('per_page'));
		}
		//set pagination parameters
		 $config = array();
        $config["base_url"] = base_url() . "index.php/adminPosts/show_posts";
        $config["total_rows"] = $this->admin_post_model->total_posts();
		if($this->session->userdata("per_page")){
			$config["per_page"] = $this->session->userdata("per_page");
		}
		else {
			$config["per_page"] = 20;
		}
        //$config["uri_segment"] = 3;
		
		$config['full_tag_open'] = '<ul class="pagination1 pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next →';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['last_link'] = 'last >>';
		$config['last_tag_open'] = '<li class="next">';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '← Previous';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '<< First';
		$config['first_tag_open'] = '<li class="prev">';
		$config['first_tag_close'] = '</li>';
        $this->pagination->initialize($config);
		
		//SET PAGE LINK
	    //$this->admin_model->setPageLink('managePost/show_posts');
        //SET PAGE LINK

		$data['posts_data'] = $this->admin_post_model->show_posts($config["per_page"], $page);
		//$data['posts_data'] = $this->admin_post_model->show_posts();
		
		$data["links"] = $this->pagination->create_links();
		$this->load->view('admin/templates/header');
		if(access_check('art_create') || access_check('art_read') || access_check('art_update') || access_check('art_delete')) {
			$this->load->view('admin/show_posts',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}	
		$this->load->view('admin/templates/footer');
		
	}
		
	//function to add new post
	function add_post() {
		$data['cat_list'] = $this->admin_post_model->get_categories();
		$data['country'] = $this->admin_cat_model->get_country();

		$this->load->view('admin/templates/header');
		if(access_check('art_create')) {
			$this->load->view('admin/add_post',$data);	
		}
		else {
			$this->load->view('admin/templates/403');
		}	
			
		$this->load->view('admin/templates/footer');
	}
	//function to process the add post form
	function save_article() {

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('alias', 'Alias', 'required');
		$this->form_validation->set_rules('cat_id', 'Category', 'required');
		$this->form_validation->set_rules('publish_date', 'Publish date', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			//if there are any validation error
			$this->add_post();
		}
		else {
		
	
		$media = $this->input->post('media');
		//upload files and save their path in the database
		$ctr = 0;
		foreach ($_FILES as $key=> $val) {
			//file upload configurations
			$dir_path = './uploads/';
			$config['upload_path'] = $dir_path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			if (!$this->upload->do_upload($key))
			{
				$error = array('error' => $this->upload->display_errors());
				$error_found =  $error['error'];
				$this->session->set_flashdata('msg_wrong',$error_found);  
				redirect('adminPosts/add_post');
			}
			else
			{
				$upload_data = $this->upload->data();
				 $this->load->library('image_lib');

				 /* First size */
				 $configSize1['image_library']   = 'gd2';
				 $configSize1['source_image']    = $dir_path.$upload_data['file_name'];
				 $configSize1['create_thumb']    = TRUE;
				 $configSize1['maintain_ratio']  = TRUE;
				 $configSize1['thumb_marker']  = "";
				 $configSize1['width']           = 100;
				 $configSize1['height']          = 100;
				 $configSize1['new_image']   = 'thumb_'.$upload_data['file_name'];

				 $this->image_lib->initialize($configSize1);
				 $this->image_lib->resize();
				 $upload_data['image_thumb'] =  $configSize1['new_image'];
				 $this->image_lib->clear();
				 
				 /* Second size */
				 
				 $configSize1['width']           = 200;
				 $configSize1['height']          = 200;
				 $configSize1['new_image']   = 'med_'.$upload_data['file_name'];

				 $this->image_lib->initialize($configSize1);
				 $this->image_lib->resize();
				 $upload_data['image_med'] =  $configSize1['new_image'];
				 $this->image_lib->clear();
				 
				 /* Third size */
				 $configSize1['width']           = 600;
				 $configSize1['height']          = 600;
				 $configSize1['new_image']   = 'large_'.$upload_data['file_name'];

				 $this->image_lib->initialize($configSize1);
				 $this->image_lib->resize();
				 $upload_data['image_large'] =  $configSize1['new_image'];
				 $this->image_lib->clear();
				 

				foreach($media as $k=>$v) {
					if($v['type']=='video' || isset($v['file_name'])) {
						$ctr++;
					}
					else {
						$media[$ctr] = array_merge($media[$ctr],$upload_data);
						break;
					}
				}
				
			}
		}
		$all_data = $this->input->post();
		
		$all_data['media'] = $media;
		$all_data['author'] = $this->session->userdata('id');
		
		$result= $this->admin_post_model->save_article($all_data);
		if($result){
			//send mail to all connected users
				//if($this->session->
			if($this->session->userdata('user_type') == 'panel_user'){
				$user_emails= $this->common->get_connected_users();			
				$subject="New article added";
				$mesg  = "Hi <br/><br/>";
				$mesg .= "A new article has been added by ".$this->session->userdata('name')." <br/>";
				$mesg .= "Please visit"." <br/>";
				$mesg .= base_url()."adminPosts/show_posts <br/><br/><br/><br/><br/><br/>";
				$mesg .= "<b>Regards,</b><br/>";
				$mesg .= "<b>Hindigaurav</b>";
				$to_mail = 'gfndselva007@gmail.com';
				$this->common->sendMail($subject,$mesg,$to_mail);
				foreach($user_emails as $email) {
					if($email){
						$this->common->sendMail($subject,$mesg,$email);
					}
				
				}
			}
			
		$this->session->set_flashdata('msg_write','Article added successfully');
        redirect('adminPosts/show_posts');
		}else{
        $this->session->set_flashdata('msg_wrong','Unable to add article');  
		redirect('adminPosts/view/show_posts');
		}
		}
	}
	
	function get_images_from_content() {
		$value = $this->input->post('val');
		preg_match_all('#(src=".*?")#', $value, $results);
		echo json_encode($results[1]);
	}
	
	
	//function to edit posts
	function edit_post($post_id) {
		
		$data['cat_list'] = $this->admin_post_model->get_categories();
		$data['post_data'] = $this->admin_post_model->get_post_data($post_id);
		$data['country'] = $this->admin_cat_model->get_country();
		$data['media']	= $this->admin_post_model->get_media($post_id);
		$this->load->view('admin/templates/header');
		if(access_check('art_update') && post_access_check($post_id)) {
			$this->load->view('admin/edit_post',$data);
		}
		else {
			$this->load->view('admin/templates/403');
		}	
		
		$this->load->view('admin/templates/footer');
	}
	
	function update_article($post_id) {
	
		$media = $this->input->post('media');
		//upload files and save their path in the database
		$ctr = 0;
		foreach ($_FILES as $key=> $val) {
			if($val['name']) {
			//file upload configurations
			$dir_path = './uploads/';
			$config['upload_path'] = $dir_path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			if (!$this->upload->do_upload($key))
			{
				$error = array('error' => $this->upload->display_errors());
				$error_found =  $error['error'];
				$this->session->set_flashdata('msg_wrong',$error_found);  
				redirect('adminPosts/show_posts');
			}
			else
			{
				$upload_data = $this->upload->data();
				 $this->load->library('image_lib');

				 /* First size */
				 $configSize1['image_library']   = 'gd2';
				 $configSize1['source_image']    = $dir_path.$upload_data['file_name'];
				 $configSize1['create_thumb']    = TRUE;
				 $configSize1['maintain_ratio']  = TRUE;
				 $configSize1['thumb_marker']  = "";
				 $configSize1['width']           = 100;
				 $configSize1['height']          = 100;
				 $configSize1['new_image']   = 'thumb_'.$upload_data['file_name'];

				 $this->image_lib->initialize($configSize1);
				 $this->image_lib->resize();
				 $upload_data['image_thumb'] =  $configSize1['new_image'];
				 $this->image_lib->clear();
				 
				 /* Second size */
				 
				 $configSize1['width']           = 200;
				 $configSize1['height']          = 200;
				 $configSize1['new_image']   = 'med_'.$upload_data['file_name'];

				 $this->image_lib->initialize($configSize1);
				 $this->image_lib->resize();
				 $upload_data['image_med'] =  $configSize1['new_image'];
				 $this->image_lib->clear();
				 
				 /* Third size */
				 $configSize1['width']           = 600;
				 $configSize1['height']          = 600;
				 $configSize1['new_image']   = 'large_'.$upload_data['file_name'];

				 $this->image_lib->initialize($configSize1);
				 $this->image_lib->resize();
				 $upload_data['image_large'] =  $configSize1['new_image'];
				 $this->image_lib->clear();
				 

				$a = explode("_",$key);
				$key_id = $a[2];
				$media[$key_id] = array_merge($media[$key_id],$upload_data); 
				
			}
		}
		}
		$all_data = $this->input->post();
		
		$all_data['media'] = $media;
		$all_data['mod_user_id'] = $this->session->userdata('id');
		
		
		$result= $this->admin_post_model->update_article($all_data,$post_id);
		
		if($result){
		$this->session->set_flashdata('msg_write','Article Updated successfully');
        redirect('adminPosts/show_posts');
		}else{
        $this->session->set_flashdata('msg_wrong','Unable to add article');  
		redirect('adminPosts/view/show_posts');
		}
		
	}
	//remove media using ajax
	function remove_media() {
		$media_id = $this->input->post('media_id');
		$result= $this->admin_post_model->remove_media($media_id);
		echo $result;
	}
	
	//delete articles
	function delete_post($art_id){
		$this->load->model('admin_post_model');
		$result = $this->admin_post_model->delete_post($art_id);
		redirect('adminPosts/show_posts');

	}
	//ajax function to change status of the post
	function toggle_status() {
		$post_id = $this->input->post('post_id');
		$result = $this->admin_post_model->toggle_status($post_id);
		if($result == 1) {
			echo 'published';
		}
		else {
			echo 'unpublished';
		}
 	
	}
	
	
}