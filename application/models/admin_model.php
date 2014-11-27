<?php 
//error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
/* Author: Naresh
 * Description: Login model class
 */
class Admin_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    //Validate Admin User
    public function validate(){
		$this->load->database();
	    // grab user inputposts
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        //$user_type = $this->input->post('user_type');
        // Prep the query
		
        $this->db->where('user_name',$username);
        $this->db->where('password',md5($password));
        //$this->db->where('user_type',$user_type);
		//$this->db->where('status',1);
		
		
        // Run the query
        $query = $this->db->get('tbl_users');
        // Let's check if there are any results
        if($query->num_rows == 1)
        {	
			$row = $query->row();
			//get role_id
			$role_id = $row->role_id;
			if($role_id == '0') {
				$data = array(
                    'id'=>$row->id,
                    'name' =>$row->user_name,
					'email'=>$row->email,
					'gender'=>$row->gender,
					'member_since'=>date('d-m-Y',strtotime($row->created_date)),
                    'admin_validated'=>true,
                    'user_role'=>$role_id,
                    
                    );           
				$this->session->set_userdata($data);
			}
			else {
				$data = array(
                    'id'=>$row->id,
                    'name' =>$row->user_name,
					'email'=>$row->email,
					'loc_id'=>$row->loc_id,
					'gender'=>$row->gender,
					'member_since'=>$row->created_date,
                    'admin_validated'=>true,
                    'user_role'=>$role_id,
					'user_type' => $row->user_type,
                    
                    );
				$this->db->where('id',$role_id);
				$query = $this->db->get('tbl_roles');
				foreach ($query->result_array() as $row)
				{
				   $data['role_access'] = $row;
				}
				
				$this->session->set_userdata($data);
				
			
			
			
			}
			
            
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
	
	

	/* page layout related */
	function get_regions($page_id) {
		$this->db->select('title,data');
		$this->db->where('page_id',$page_id);
		$query = $this->db->get('tbl_regions');
		$result = $query->result_array();
		foreach($result as $v) {
			$final[$v['title']] = $v['data'];
		}
		return $final;
	}
	function savepagelayout($data,$page_id) {
		foreach($data as $k=>$v) {
			$this->db->where('title',$k);
			$this->db->where('page_id',$page_id);
			$this->db->update('tbl_regions',array('data'=>$v));	
		}	
	}
	
	function get_state() {
		$this->db->select('*');
		$this->db->order_by("sort", "asc");
		$this->db->where('parent_id',$this->session->userdata('main_country_id'));
		$this->db->where('type','state');
		$query = $this->db->get('tbl_location');
        $data = $query->result_array();
		return $data;
	}
	
	function get_district($state_id) {
		$this->db->select('id,name,alias');
		$this->db->order_by("name", "asc");
		$this->db->where('parent_id',$state_id);
		$this->db->where('type','district');
		$query = $this->db->get('tbl_location');
		$data = $query->result_array();
		$count =  $query->num_rows();
		if($count > 0) {
			/* foreach ($data as $check) {
				$result[$check['id']]=$check['name'];
				$result[$check['id']]['alias']=$check['alias'];
			} */
			return $data;  
		}
		else {
			return 0;
		} 
	}
	
	/* function to get the videos */
	function get_videos() {
		$this->db->where('type','video');
		$this->db->order_by('id','desc');
		$this->db->limit(6);
		$query = $this->db->get('tbl_media');
		return $query->result_array();
	}
	/* function to get the videos */
	function get_all_videos() {
		$this->db->where('type','video');
		$this->db->order_by('id','desc');
		$query = $this->db->get('tbl_media');
		return $query->result_array();
	}
	

	/* queries to import the data */
	function import_data() {
	
		//import category
		/* $query=$this->db->get('post_category');
		$result = $query->result_array();
		foreach($result as $cat) {
			if($cat['category_id']<61 || $cat['category_id']<93 || $cat['category_id']<94 ||$cat['category_id']<96  ) {
            $data=$cat;
			$temp = $data['alias'];
			$data['alias'] = $data['category'];
			$data['category'] = $temp;
			$prev_id = $data['category_id'];
			unset($data['category_id']);
			$data['status'] = 1;
			$q  = 'INSERT INTO tbl_category(alias,category,sort,show_in_menu,status,prev_id) VALUES ("'.$data["alias"].'",convert(cast(convert("'.$data['category'].'" using  latin1) as binary) using utf8),"'.$data["sort"].'","'.$data["show_in_menu"].'","'.$data["status"].'","'.$prev_id.'")';
			$this->db->query($q);
			//$this->db->insert('tbl_category',$data);
			
			}
			else {
			$data=$cat;
			$temp = $data['alias'];
			$data['alias'] = $data['category'];
			$data['category'] = $temp;
			$prev_id = $data['category_id'];
			unset($data['category_id']);
			$data['status'] = 1;
			$q  = 'INSERT INTO tbl_location(parent_id,alias,name,type,prev_id) VALUES ("1","'.$data["alias"].'",convert(cast(convert("'.$data['category'].'" using  latin1) as binary) using utf8),"state","'.$prev_id.'")';
			$this->db->query($q);
				
			}
		} */
		
		//import articles
		$this->db->select('id,prev_id');
		$query = $this->db->get('tbl_category');
		$cat = $query->result_array();
		$this->db->select('id,prev_id');
		$query = $this->db->get('tbl_location');
		$loc = $query->result_array();
		$cat_com = array_merge($cat,$loc);
		$query=$this->db->get('post');
		$result = $query->result_array();
		foreach($result as $val ) {
			if($val['post_id']<10000) {
				continue;
			}

			if($val['post_id']>14000){
				break;
			}
			//extract image and correct the path accordingly
			$art_image ="";
			preg_match_all('#(src=".*?")#', $val['post_content'], $imgs);
			if(isset($imgs[0][0])){
			$img = $imgs[0][0];
			$art_image = str_replace('src="/file/php/../files','uploads',$img);
			$art_image = str_replace('"','',$art_image);
			}
			
			$val['post_content'] = str_replace('src="/file/php/../files','src="'.base_url().'uploads',$val['post_content']);
			
			
			if($val['category_id'] <61) { 			
				$q  = "INSERT INTO tbl_article(title,content,alias,art_image,cat_id,loc_id,slider,ticker,author,publish_date,seo_url,seo_desc,seo_keyword,status) VALUES (convert(cast(convert('".mysql_real_escape_string($val["post_title"])."' using  latin1) as binary) using utf8),convert(cast(convert('".mysql_real_escape_string($val["post_content"])."' using  latin1) as binary) using utf8),'".md5($val["post_id"])."','".mysql_real_escape_string($art_image)."','".$val["category_id"]."','1','0','".$val["tickler"]."','1','".$val["published_date"]."','".md5($val["post_id"])."','".$val["description"]."','".$val["keywords"]."','1')";
				$this->db->query($q);
			}
			else {			
				$q  = "INSERT INTO tbl_article(title,content,alias,art_image,cat_id,loc_id,slider,ticker,author,publish_date,seo_url,seo_desc,seo_keyword,status) VALUES (convert(cast(convert('".mysql_real_escape_string($val["post_title"])."' using  latin1) as binary) using utf8),convert(cast(convert('".mysql_real_escape_string($val["post_content"])."' using  latin1) as binary) using utf8),'".md5($val["post_id"])."','".mysql_real_escape_string($art_image)."','9','".$val["category_id"]."','0','".$val["tickler"]."','1','".$val["published_date"]."','".md5($val["post_id"])."','".$val["description"]."','".$val["keywords"]."','1')";
				$this->db->query($q);
				
			}
			
		}

		
		exit();
		
	
	
	}
	
	function empty_weather() {
		$this->db->truncate('tbl_weather');
	}	
	function ins_weather($w_arr) {
		$this->db->insert('tbl_weather',$w_arr);
	}
	
	function get_weather_info() {
		$query = $this->db->get('tbl_weather');
		$rows = $query->result_array();
		foreach($rows as $k=>$v) {
			if($v['temp']<0) {
				unset($rows[$k]);
			}
		}
		return $rows;
	
	}
	
	function get_webcolors() {
		$query = $this->db->get('tbl_webcolors');
		$rows = $query->result_array();
		return $rows;
	
	}
	
	function update_webcolors($post) {
		foreach($post as $key=>$val) {
			foreach($val as $k=>$v) {
				$this->db->where('title',$k);
				$data = array($key=>$v);
				$this->db->update('tbl_webcolors',$data);
			}
		
		}	
	}
	
	function map_get_country($cont_id) {
		$this->db->select('name,id,alias');
		$this->db->where('continent',$cont_id);
		$query =  $this->db->get('tbl_location');
		$result = $query->result_array();
		return $result;
	}
	function map_get_state($cont_id) {
		$country_id = $this->common->getSingleValue('tbl_location','id','alias',$cont_id);
		$this->db->select('name,id,alias');
		$this->db->where('parent_id',$country_id);
		$query =  $this->db->get('tbl_location');
		$result = $query->result_array();
		return $result;
	}
	function map_get_district($state_id) {
		$state_id = $this->common->getSingleValue('tbl_location','id','alias',$state_id);
		$this->db->select('name,id,alias');
		$this->db->where('parent_id',$state_id);
		$query =  $this->db->get('tbl_location');
		$result = $query->result_array();
		return $result;
	}
	
	
	function save_site_user($user_data) {
		//check if email already exists
		$email = $this->common->getSingleValue('tbl_users','id','email',$user_data['email']);
		$user_type = $this->common->getSingleValue('tbl_users','user_type','email',$user_data['email']);

		if($user_data['user_type'] == 'site_user') {
			if($email && ($user_type=='site_user' || $user_type== 'fb_user')) {
				return false;
			}
			$user_data['password'] = md5($user_data['password']);
		}
		if($user_data['user_type'] == 'fb_user') {
			if($email ) {
				return  true;
			}
		}
		
		$this->db->insert('tbl_users',$user_data);
		$insert_id = $this->db->insert_id();
		if($insert_id) {
			return  $insert_id;
		}
		else {
			return false;
		}
	}
	function signin_site_user($user_data) {
		//check if email already exists
		$this->db->where('((user_name="'.$user_data['user_name'].'" AND password="'.md5($user_data['password']).'") OR (email="'.$user_data['user_name'].'" AND password="'.md5($user_data['password']).'"))');
		$query = $this->db->get('tbl_users');
		$res =  $query->result_array();
		if($res) {
			foreach($res as $val){
			$logged_user['user_name'] = $val['user_name'] ;
			$logged_user['email'] = $val['email'];
			$logged_user['first_name'] = $val['first_name'];
			$logged_user['last_name'] = $val['last_name'];
			$logged_user['gender'] = $val['gender'];
			$logged_user['created_date'] = $val['created_date'];
			$logged_user['user_type'] = 'site_user';
			}
			$this->session->set_userdata('logged_user',$logged_user);
			return true;
		}
		else {
			return false;
		}
	}
	function save_comment($comment_data) {
		$this->db->insert('tbl_comments',$comment_data);
		$insert_id = $this->db->insert_id();
		if($insert_id) {
			return  $insert_id;
		}
		else {
			return false;
		}
	}
		

}	
?>