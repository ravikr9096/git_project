<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('admin_adds_model');
		$this->load->model('admin_cat_model');
		$this->load->model('admin_model');
		$this->load->model('admin_polls_model');
		$this->load->model('admin_post_model');
		$this->load->model('admin_mag_model');
		$this->load->helper('cookie');

		
		//$checking=varify_session();  		
    }


    /*****Admin Login Page*****/
	public function index($msg = NULL)
	{
	    $data['msg']="Please enter your user name and password!";
        $this->load->view('admin/login', $data);
    }
	
    /*****Set Language for Site*****/
    function set_language($get)
    {
		if($get == '1')
		{
			$get_lang = $this->session->userdata['lang_used'];
			if($get_lang)
			{
				unset($get_lang);
			}
			$data = array(
			'lang_used'=>'english'
			);
			$this->session->set_userdata($data);
			//$config['language']	= 'english';
			redirect('adminCategory/category_list');
		}
		if($get == '2')
		{
		   // $config['language']	= 'euro';
			$get_lang = $this->session->userdata['lang_used'];
			if($get_lang)
			{
				unset($get_lang);
			}
			$data = array(
			'lang_used'=>'euro'
			);
			$this->session->set_userdata($data);
		    redirect('adminCategory/category_list');
		}
    }

	/*****Admin Login Validate*****/
	public function process()
	{
	
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_message('username', 'Please Enter both Username and Password');
			//$this->form_validation->set_message('required', 'Your custom message here');
			 redirect('admin/'); 
		}
		else
		{		
			 $this->load->model('admin_model');
			 $result = $this->admin_model->validate();
			 
			 if(!$result){
			 $this->session->set_flashdata('msg_wrong','Please enter correct Username and Password');  
			 redirect('admin/');  
			}else
			{
				//Check for Projects Deadline
				$this->load->model('admin_model');
				//$proj_data = $this->admin_model->check_projects();		 
				//$credit_data = $this->admin_model->credit_period();
				//set session data
				

				$this->session->set_flashdata('msg_write','Welcome to NEC Admin Panel');
				redirect('admin/view/home');
			}
		}
	}
	
	/*****Admin Logout*****/
	public function logout(){
		
       $this->session->sess_destroy();
	   //$this->session->set_flashdata('msg_wrong','Successfully  Logout');  
	   redirect('admin/');
    }
	
	/*****Show Static Pages of Frontend*****/
	public function view($page)
	{
		
		$this->load->model('admin_model');
		//SET PAGE LINK
	    //$this->admin_model->setPageLink('admin/view/'.$page);
        //SET PAGE LINK
		
		if ( ! file_exists('application/views/admin/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->database();
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['menu_type']='home';
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/'.$page, $data);
		$this->load->view('admin/templates/footer', $data);
		
	}
	
	/*****Show Password Reset by Mail View*****/
	function password_send()
	{
		$this->load->view('admin/password_send');
	}
	
	/*****Check Email Exists for Admin Users*****/
	function admin_email_check()
	{
		$email=$_GET['email'];
		$this->db->select('*');
		$this->db->from('backend_user');
		$this->db->where('email', $email);
		$query = $this->db->get();
		if($query->num_rows == 1)
		{
			echo '1';
		} else {
			echo '0';
		}
	}
	
	/*****Set Random Admin Password*****/
	function admin_password_send()
	{
		$email=$this->input->post('email');
		$this->db->select('*');
		$this->db->from('backend_user');
		$this->db->where('email', $email);
		$query = $this->db->get();
		$query_row=$query->row();
		$username=$query_row->user_name;
		
		$this->load->library('email');
		$newpassword=$this->randomPassword();
		/*save password in data base*/
		$data = array(
               'password' =>$newpassword			 
            );
		$this->db->where('user_name', $username);
		$this->db->update('backend_user',$data);
		/*end save*/
		
			$str=urlencode($username.';;'.$newpassword);
			$message='';
			$message.='Your User name = '.$username;
			$message.='<br />Your New Password = '.$newpassword;
			//$message.='<br /><br />for active this password click this link '.$pass_url;
			$subject='Forget Password(NEC)';
			$this->email->to($email);
			$this->email->from('nec@abc.com');
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_mailtype("html");
			if($this->email->send())
			{
				 redirect('admin/');  
			}
	}
	
	/*****Genrate Random Password*****/
	public function randomPassword()
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	/*****Show Pages Module in Admin*****/
	function show_page_data()
	{
		$this->load->model('admin_model');
		//SET PAGE LINK
	    $this->admin_model->setPageLink('admin/show_page_data');
        //SET PAGE LINK

		$this->load->model('admin_model');
		$data['page_data'] = $this->admin_model->show_page_data();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/pages', $data);
		$this->load->view('admin/templates/footer');
	}
	
	// function to show add page view with edit data
	function show_edit_page($id=null)
	{
		$this->load->model('admin_model');
		//SET PAGE LINK
	    $this->admin_model->setPageLink('admin/show_edit_page/'.$id);
        //SET PAGE LINK

		$this->load->model('admin_model');
		$data['page_edit_data'] = $this->admin_model->show_edit_page($id);
		$this->load->view('admin/templates/header');
		$this->load->view('admin/add_page', $data);
		$this->load->view('admin/templates/footer');
	}
	
	// function to save the new page data
	function save_page()
	{
		$this->load->model('admin_model');
		$result= $this->admin_model->save_page();
		if($result){
		$this->session->set_flashdata('msg_write','Page added successfully.');
        redirect('admin/show_page_data');
		}else{
        $this->session->set_flashdata('msg_wrong','Unable to add page.');  
		redirect('admin/view/add_page');
		}
	}
	
	// function to save the edit page data
	function save_edit_page()
	{
		$this->load->model('admin_model');
		$result= $this->admin_model->save_edit_page();
		if($result){
		$this->session->set_flashdata('msg_write','Page updated successfully.');
        redirect('admin/show_page_data');
		}else{
        $this->session->set_flashdata('msg_wrong','Unable to update page.');  
		redirect('admin/show_edit_page');
		}	
	}
	
	// function to delete page
	function delete_page($id)
	{
		$this->load->model('admin_model');
		$result= $this->admin_model->delete_page($id);
		if($result){
		$this->session->set_flashdata('msg_write','Page deleted successfully.');
        redirect('admin/show_page_data');
		}else{
        $this->session->set_flashdata('msg_wrong','Unable to delete page.');  
		redirect('admin/show_page_data');
		}	
	}
	
	/*****Admin Password Change*****/
	function admin_change_password()
	{
		$this->load->model('forum_model');
		$result= $this->forum_model->admin_change_password();
		if($result){
		$this->session->set_flashdata('msg_write','Password Change');
        redirect('admin/view/change_password');
		}else{
        $this->session->set_flashdata('msg_wrong','Password Not Changed');  
		redirect('admin/view/change_password');
		}		
	}
	
	/* for showing the page layout */
	function page_layout($page="home") {
		$data['ads'] = $this->admin_adds_model->get_advertise();
		$data['cats'] = $this->admin_cat_model->get_cat();
		$page_id = $this->common->getSingleValue('tbl_pages','id','title',$page);

		$data['regions'] = $this->admin_model->get_regions($page_id);
		$data['cat_data'] = $this->admin_cat_model->get_cat();
		usort($data['cat_data'], function($a, $b) {
							return $a['sort'] - $b['sort'];
		});
		$data['polls_data'] = $this->admin_polls_model->show_polls();

		$data['page_name'] = $page;
		$this->load->view('admin/templates/header');
		$this->load->view('admin/'.$page.'pagelayout',$data);
		$this->load->view('admin/templates/footer');
	
	}
	
	// functions to make the front slider dynamic
	function image_slider() {
		$data['slider_images'] = $this->admin_post_model->show_side_slider_images();
		$data['slider_images1'] = $this->admin_post_model->show_side_slider_images();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/image_slider',$data);
		$this->load->view('admin/templates/footer');
	
	}
	function image_slider_update() {
		$this->admin_post_model->update_slider_image($this->input->post('img_arr'));
		$data['slider_images'] = $this->admin_post_model->show_side_slider_images();
		$data['slider_images1'] = $this->admin_post_model->show_side_slider_images();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/image_slider',$data);
		$this->load->view('admin/templates/footer');
	
	}
	function save_slider_image() {
		foreach ($_FILES as $key=> $val) {
			if($val['name']) {
			
			//file upload configurations
			$dir_path = './uploads/slider/';
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
				redirect('admin/image_slider');
			}
			else
			{
				$upload_data = $this->upload->data();
				//$data['title'] = $this->input->post('title');
				$data['path']= 'uploads/slider/'.$upload_data['file_name'];
				$result = $this->admin_post_model->save_slider_image($data);
				$this->session->set_flashdata('msg_write','Added Successfully.');
				redirect('admin/image_slider');
			}
		}
		$data['slider_images'] = $this->admin_post_model->show_side_slider_images();
		$data['slider_images1'] = $this->admin_post_model->show_side_slider_images();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/image_slider',$data);
		$this->load->view('admin/templates/footer');
		}
	
	}
	
	/* save page layout */
	function savepagelayout($page) {
		$page_id = $this->common->getSingleValue('tbl_pages','id','title',$page);

		$data = $this->input->post();
		if($_FILES['logo']['name']) {
			$ext = explode('.',$_FILES['logo']['name']);
			$ext = end($ext);
			//file upload configurations
			$dir_path = './uploads/';
			$config['upload_path'] = $dir_path;
			$config['allowed_types'] = 'jpg|png|gif';
			$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['file_name'] = 'logo.'.$ext;
			$config['overwrite'] = 'TRUE';
			
			$this->load->library('upload',$config);
			if (!$this->upload->do_upload('logo'))
			{
				/* $error = array('error' => $this->upload->display_errors());
				$error_found =  $error['error'];
				$this->session->set_flashdata('msg_wrong',$error_found);  */ 
				redirect('admin/page_layout/'.$page);
			}
			else
			{
				$upload_data = $this->upload->data();
				$data['logo']= $upload_data['file_name'];

				$result = $this->admin_model->savepagelayout($data,$page_id);
				$this->session->set_flashdata('msg_write','Updated Successfully.');
				redirect('admin/page_layout/'.$page);
			}
		}

		$result = $this->admin_model->savepagelayout($data,$page_id);
		$this->session->set_flashdata('msg_write','Updated Successfully.');
		redirect('admin/page_layout/'.$page);

	}
	
	/* menu page */
	function menu($type="cat") {

		$data['cat_data'] = $this->admin_cat_model->get_cat_front();
		usort($data['cat_data'], function($a, $b) {
							return $a['sort'] - $b['sort'];
		});
		$this->load->view('admin/templates/header');
		$this->load->view('admin/'.$type.'-menu',$data);
		$this->load->view('admin/templates/footer');
		//$this->load->model('admin_cat_model');

		
	}
	
	function save_menu_order() {
		$order = explode(',',$this->input->post('order'));
		$data['cat_data'] = $this->admin_cat_model->update_cat_order($order);
		$this->session->set_flashdata('msg_write','Order saved successfully.');
		//redirect('admin/page_layout/'.$page);
		$this->menu('cat');
	
	}
	
	//function to manage color on front end
	function manage_color() {
		$data['webcolors'] = $this->admin_model->get_webcolors();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/manage_color',$data);
		$this->load->view('admin/templates/footer');
	
	}
	//function to save the changed color in admin panel
	function update_color() {
		$data = $this->input->post();
		foreach($data['bck_select'] as $key=>$val) {
			if($val == 1) {
				$dir_path = './uploads/backgrounds/';
				$config['upload_path'] = $dir_path;
				$config['allowed_types'] = 'jpg|png|gif';
				$config['max_size'] = '0';
				$config['max_filename'] = '255';
				$config['encrypt_name'] = TRUE;
				$config['file_name'] = $_FILES['bckfile_'.$key]['name'];
				$this->load->library('upload',$config);
				if ($this->upload->do_upload('bckfile_'.$key))
				{
					$upload_data = $this->upload->data();
					//$data['title'] = $this->input->post('title');
					$data['background_img'][$key]= 'uploads/backgrounds/'.$upload_data['file_name'];
				}
			}
			else {
				$filename = $this->common->getSingleValue('tbl_webcolors','background_img','title',$key);
				if($filename) {
					unlink('./'.$filename);
					$data['background_img'][$key] = "";				
				}
				
			}
		
		}
		$this->admin_model->update_webcolors($data);
		$this->manage_color();
	
	}
	
	//ajax function to record vote
	function record_vote() {
		$poll_id = $this->input->post('poll_id');
		$poll_ans = $this->input->post('poll_ans');
		$this->admin_polls_model->record_vote($poll_id,$poll_ans);
		$poll_data=$this->admin_polls_model->get_poll_details($poll_id);
		$total_votes = 0;
		foreach ($poll_data['answers'] as $ans) {
			$total_votes +=$ans['counter'];
		}
		foreach ($poll_data['answers'] as $ans) {
			if($total_votes>0){
				$per = ($ans['counter']/$total_votes)*100;
			}
			else {
				$per = 0;
			}
			//echo "<li>".$ans['answer']."</li>";
			echo '<div class="clearfix">
					<span class="pull-left">'.$ans['answer'].'</span>
					<span style="float:right;"class="pull-right">'.$ans["counter"].' votes</span>
				</div>
				<div class="progress xs">
					<div style="background: none repeat scroll 0% 0% green; height: 4px;width: '.$per.'%;" class="progress-bar progress-bar-green"></div>
				</div>';
		}
			
	}
	
	/* get the districts from selected state */
	function get_district() {
		$districts = $this->admin_model->get_district($this->input->post('state'));
		$str='<option value="0">-विकल्प चुने-</option>';
		if($districts){
			foreach($districts as $v) {
				$str.='<option value="'.$v['id'].'">'.$v['name'].'</option>';
			}
			echo $str;
		}
		else {
			echo $str;
		}
		
	
	}
	
	/* get district related news */
	function city_related_news() {
		
		$city_id =  $this->input->post('loc_id');
		$news = $this->admin_post_model->show_posts_front_loc(10,0,$city_id);
		$ctr=0;
		$news_array[0]="";
		$news_array[1]="";
		$news_array[2]="";
		$news_array[3]="";
		foreach($news as $val){
		
			if($ctr< 5) {
				if($news_array[0]== ""){
					$news_array[0] = '<img src="'.base_url().$val['art_image'].'">';
					$news_array[1].='<li class="active"><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';
					$ctr++;
					continue;
				}
				$news_array[1].='<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';
			}
			else {
				if($news_array[2]== ""){
					$news_array[2] = '<img src="'.base_url().$val['art_image'].'">';
					$news_array[3].='<li class="active"><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';
					$ctr++;
					continue;
				}
				$news_array[3].='<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';
			}
			$ctr++;
		}
		print_r(json_encode($news_array));
		
	
	}
	/* ajax fucntion to search news */
	function search_news() {
		$search_text = $this->input->post('search_text');
		$this->session->set_userdata('search',$search_text);
		$news = $this->admin_post_model->show_posts(20,0);
		$news_array = '<div class="common-news"><h3 style="font-size:22px;">खोज के परिणाम</h3><br/><ul>';
		if($news){
		foreach($news as $val){
				$news_array.='<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';
		}
		}
		else {
			$news_array.='        कोइ परिणाम नही ';
		}
		$news_array.= '</ul></div>';

		print_r($news_array);
	}
	
	
	/* function to import the data from previous table */
	function import_data() {
		$this->admin_model->import_data();
	}
	
	function text_speech() {
		$str = $this->input->post('str');
		$name = "uploads/audio/outfile".rand().".mp3";
		$this->converTextToMP3($str,$name);
		echo '<audio controls autoplay>
		  <source src="'.base_url().$name.'" type="audio/mpeg">
		Your browser does not support the audio element.
		</audio>';
	}
	
	
	/* functions to get audio  */
	function splitString($str)
{
    $ret=array();
    $arr=explode(" ",$str);
    $constr='';
    for($i=0;$i<count($arr);$i++)
    {
        if(strlen($constr.$arr[$i]." ") < 98)
        {
            $constr =$constr.$arr[$i]." ";
        }
        else
        {
            $ret[] =$constr;
            $constr='';
            $i--; //add the word back.
        }
 
    }
    $ret[]=$constr;
    return $ret;
}
function downloadMP3($url,$file)
{
    $ch = curl_init(); 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
    curl_close($ch);
    if($output === false)  
    return false;
 
    $fp= fopen($file,"wb");
    fwrite($fp,$output);
    fclose($fp);
 
    return true;
}

function CombineMultipleMP3sTo($FilenameOut, $FilenamesIn) {
 
    foreach ($FilenamesIn as $nextinputfilename) {
        if (!is_readable($nextinputfilename)) {
            echo 'Cannot read "'.$nextinputfilename.'"<BR>';
            return false;
        }
    }
 
    ob_start();
    if ($fp_output = fopen($FilenameOut, 'wb')) {
 
        ob_end_clean();
		include "assets/js/getid3/getid3.php";
        // Initialize getID3 engine
        $getID3 = new getID3;
        foreach ($FilenamesIn as $nextinputfilename) {
 
            $CurrentFileInfo = $getID3->analyze($nextinputfilename);
            if (@$CurrentFileInfo['fileformat'] == 'mp3') {
 
                ob_start();
                if ($fp_source = fopen($nextinputfilename, 'rb')) {
 
                    ob_end_clean();
                    $CurrentOutputPosition = ftell($fp_output);
 
                    // copy audio data from first file
                    fseek($fp_source, $CurrentFileInfo['avdataoffset'], SEEK_SET);
                    while (!feof($fp_source) && (ftell($fp_source) < $CurrentFileInfo['avdataend'])) {
                        fwrite($fp_output, fread($fp_source, 32768));
                    }
                    fclose($fp_source);
 
                    // trim post-audio data (if any) copied from first file that we don't need or want
                    $EndOfFileOffset = $CurrentOutputPosition + ($CurrentFileInfo['avdataend'] - $CurrentFileInfo['avdataoffset']);
                    fseek($fp_output, $EndOfFileOffset, SEEK_SET);
                    ftruncate($fp_output, $EndOfFileOffset);
 
                } else {
 
                    $errormessage = ob_get_contents();
                    ob_end_clean();
                    echo 'failed to open '.$nextinputfilename.' for reading';
                    fclose($fp_output);
                    return false;
 
                }
 
            } else {
 
                //echo $nextinputfilename.' is not MP3 format';
                fclose($fp_output);
                return false;
 
            }
 
        }
 
    } else {
 
        $errormessage = ob_get_contents();
        ob_end_clean();
        echo 'failed to open '.$FilenameOut.' for writing';
        return false;
 
    }
 
    fclose($fp_output);
    return true;
}

function converTextToMP3($str,$outfile)
{
    $base_url='http://translate.google.com/translate_tts?tl=hi&ie=UTF-8&q=';
    $words = $this->splitString($str);
    $files=array();
    foreach($words as $word)
    {
        $url= $base_url.urlencode($word);
        $filename ='uploads/audio/'.md5($word).".mp3";
        if(!$this->downloadMP3($url,$filename))
        {
            echo "Failed to Download URL.".$url."n";
        }
        else
        {
            $files[] = $filename;
        }
 
    }
 
    if(count($files) == count($words)) //if all the strings are converted
        $this->CombineMultipleMP3sTo($outfile,$files);
    else
        echo "ERROR. Unable to convert n";
 
    foreach($files as $file)
    {
		if( file_exists($file) ){
			unlink($file);
		}
    }
}
	/* functions to get audio endssssssss */

	
	/* ajax function to display all states in front */
	function display_all_location() {
		$str = "<h3 style='font-size:22px;'>सारे शहर</h3><br/>";
		$str.="<ul class='all_loc'>";
		// get the list of states and district for top menu
		$states = $this->admin_model->get_state();	
		$cities = array();
		foreach ($states as $k=>$st) {
			$dis = $this->admin_model->get_district($st['id']);
			$states[$k]['districts'] = $dis;
			if($dis) {
				$cities = array_merge($cities,$dis);
			}
		}
		
		foreach($states as $val){ 
			$str .= '<li><h4><a href="'.base_url().$val['alias'].'" title="'.$val['name'].'">'.$val['name'].'</a></h4><hr>';
			if($val['districts']){
               	$str .= '<div class="drop-down">';                               
				$ctr = 1;
				foreach ($val['districts'] as $val1){
					if($ctr==1) {
						$str .= '<ul>';
					}
					$str .= '<li><a href="'.base_url().$val['alias'].'/'.$val1['alias'].'" title="'.$val1['name'].'">'.$val1['name'].'</a></li>';
					$ctr++;
					
					if($ctr==5) {
						$str .= '</ul>';
						$ctr =1;
					}
				}
				$str .= '</div>';

			
			}
		$str .= '</li>';
						
		}
		$str.="</ul>";
		echo $str;
	}
	
	/* ajax function to display all states in front */
	function display_all_videos() {
		$vids = $this->admin_model->get_all_videos();
		$str = '<div class="all_vid_div"><h3 style="font-size:22px;">वीडियो</h3><br/><ul class="all_vids">';
		if($vids){
		foreach($vids as $vid){
				$ytarray=explode("/", $vid['vid_code']);
				$ytendstring=end($ytarray);
				$ytendarray=explode("?v=", $ytendstring);
				$ytendstring=end($ytendarray);
				$ytendarray=explode("&", $ytendstring);
				$ytcode=$ytendarray[0];
				$art_id = $this->common->getSingleValue('tbl_media','art_id','id',$vid['id']);
				$art_title = $this->common->getSingleValue('tbl_article','title','id',$art_id);
				$str.="<li><a title='".$art_title."'class='youtube1' href=\"http://www.youtube.com/embed/$ytcode\"><img src=\"http://img.youtube.com/vi/$ytcode/2.jpg\" /><img src=\" ".base_url()."assets/images/play_button.png\" class=\"play1\"/></a>
				<script>
				var width = (jQuery(window).width()*80)/100;
				var height = (jQuery(window).height()*80)/100;
				$('.youtube1').colorbox({iframe:true, innerWidth:width, innerHeight:height});
				</script></li>";
		}
		}
		else {
			$str.='        कोइ परिणाम नही ';
		}
		$str.= '</ul></div>';

		print_r($str);
		
		
	}
	
	function weather_store() {
		// get the list of states and district for top menu
		$states = $this->admin_model->get_state();	
		$cities = array();
		foreach ($states as $k=>$st) {
			$dis = $this->admin_model->get_district($st['id']);
			$states[$k]['districts'] = $dis;
			if($dis) {
				$cities = array_merge($cities,$dis);
			}
		}
		$data['state_list']=$states;
		
		/* whether info */
		$this->admin_model->empty_weather();
		date_default_timezone_set('Asia/Calcutta');
		foreach($cities as $v){
			$test = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$v['alias']);
			$city_data = json_decode($test);
			$w_arr['loc_id'] =$v['id'];
			$w_arr['loc_alias'] =$v['alias'];
			$w_arr['loc_name'] =$v['name'];
			$w_arr['temp'] =($city_data->main->temp_min-273.15)."�C";
			$w_arr['sunrise'] = date('H:i:s', $city_data->sys->sunrise);
			$w_arr['sunset'] =date('H:i:s', $city_data->sys->sunset);
			$this->admin_model->ins_weather($w_arr);
		}
	}
	
	/* ajax function to get countries for map navigation */
	function map_get_country() {
		$cont_id =  $this->input->post('cont_id');
		$str="<select id='map_countries' onchange='map_get_state();'>";
		$str.='<option value="">-विकल्प चुने-</option>';
		$country_list = $this->admin_model->map_get_country($cont_id);
		foreach($country_list as $val) {
			$str.='<option value="'.$val['alias'].'">'.$val['name'].'</option>';
		}
		$str.="</select>";
		echo $str;
		
	}
	function map_get_state() {
		$country_alias =  $this->input->post('country_id');
		$str="<select id='map_states' onchange='map_get_district();'>";
		$str.='<option value="">-विकल्प चुने-</option>';
		$state_list = $this->admin_model->map_get_state($country_alias);
		foreach($state_list as $val) {
			$str.='<option value="'.$val['alias'].'">'.$val['name'].'</option>';
		}
		$str.="</select>";
		echo $str;
		
	}
	function map_get_district() {
		$country_alias =  $this->input->post('state_id');
		$str="<select id='map_districts' onchange='change_go_url();'>";
		$str.='<option value="">-विकल्प चुने-</option>';
		$district_list = $this->admin_model->map_get_district($country_alias);
		foreach($district_list as $val) {
			$str.='<option value="'.$val['alias'].'">'.$val['name'].'</option>';
		}
		$str.="</select>";
		echo $str;
		
	}
	//ajax function to signup
	function site_signup() {
		$user_data =$this->input->post();
		$user_data['created_date'] = date("Y-m-d H:i:s");
		$user_data['user_type'] = 'site_user';
		$user_data['role_id'] = -1;
		unset($user_data['confirm_password']);
		$res = $this->admin_model->save_site_user($user_data);
		if($res) {
			$subject="Signup successfull";
			$mesg  = "Hi ".$user_data['first_name']."<br/><br/>";
			$mesg .= "Thanks for signin up.";
			$mesg .= "Following are the details using which you can log in"." <br/>";
			$mesg .= "Username:".$user_data['user_name']." <br/>";
			$mesg .= "Password:".$user_data['password']." <br/>";
			$mesg .= "Check the latest news on"." <br/>";
			$mesg .= base_url()."<br/><br/><br/><br/><br/><br/>";
			$mesg .= "<b>Regards,</b><br/>";
			$mesg .= "<b>Hindigaurav</b>";
			$to_mail = $user_data['email'];
			$this->common->sendMail($subject,$mesg,$to_mail);
		}
		echo $res;
	}
	//ajax function to signin
	function site_signin() {
		$user_data =$this->input->post();
		$user_data['user_type'] = 'site_user';
		$res = $this->admin_model->signin_site_user($user_data);
		echo $res;
	}
	
	//ajax to post comment
	function save_comment() {
		date_default_timezone_set('Asia/Calcutta');
		$comment_data['comment'] = $this->input->post('content');
		$comment_data['art_id'] = $this->input->post('art_id');
		$comment_data['comment_date'] = date("Y-m-d H:i:s");
		$logged_user = $this->session->userdata('logged_user');
		$comment_data['user_id'] =  $this->common->getSingleValue('tbl_users','id','email',$logged_user['email']);
		$res = $this->admin_model->save_comment($comment_data);
		echo $res;
	}
	
	/* ajax fucntion to show emagazines news */
	function show_emags() {
		$mags  = $this->admin_mag_model->get_mags();
		$mags_array = '<div class="all_vid_div"><h3 style="font-size:22px;">वीडियो</h3><br/><ul class="all_vids">';
		if($mags){
		foreach($mags as $val){
				$cover = $this->admin_mag_model->show_mag_images($val['id']);
				if(@$cover[0]){
					$cover_image = $cover[0]['path'];
					$img_path = '<img style="width:150px;height:200px;" src="'.base_url().$cover_image.'">';
				}
				else {
					$img_path = '';
				}
				$mags_array.='<li><a target="_blank" href="'.base_url().'emagazine/'.$val['id'].'" title="'.$val['title'].'">'.$img_path.'<br>'.$val['title'].'</a></li>';
		}
		}
		else {
			$mags_array.='        कोइ परिणाम नही ';
		}
		$mags_array.= '</ul></div>';

		print_r($mags_array);
	}
	
	/* ajax fucntion to increase the counter of the adds when clicked */
	function inc_click_ctr() {
		$ad_id = $this->input->post('ad_id');
		$this->common->inc_click_ctr($ad_id);	
		return true;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */