<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Ravi
 * Description: model related to the posts
 */
class Admin_Post_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
	//function to get the list of all categories
	
	function get_categories() {
		$this->db->select('*');
		$this->db->from('tbl_category');
		$query = $this->db->get();
		$rows = $query->result_array();
		return $rows;
	}
	
   // function  to show post normally
   /* function show_posts()
   {
		$this->load->database();
		$this->db->select('posts.*,post_category.*');
		$this->db->from('posts');
		$this->db->join('post_category','posts.category_id=post_category.category_id');
		$query = $this->db->get();
		$rows = $query->result_array();
		return $rows;	
   } */
	function total_posts() {
		$this->load->database();
		$search = $this->session->userdata('search');
		$this->db->select('tbl_article.*,tbl_category.category,tbl_category.alias as cat_alias,tbl_users.user_name as author_name');
		$this->db->from('tbl_article');
		$this->db->join('tbl_category','tbl_article.cat_id=tbl_category.id','left');
		$this->db->join('tbl_users','tbl_article.author=tbl_users.id','left');
		if($search) {
			/* $this->db->like('tbl_article.title', $search);
			$this->db->like('tbl_category.category', $search); */
			if(ctype_digit($search)){
				$this->db->where("(tbl_article.id LIKE '%$search%' OR  tbl_article.publish_date LIKE '%$search%' )");
			}
			else {
				$this->db->where("(tbl_article.title LIKE '%$search%' OR  tbl_category.category LIKE '%$search%' )");
			
			}
		}
		/* filter result on the basis of location access*/
		if($this->session->userdata('user_type') == 'panel_user'){
			$loc_ids = $this->common->loc_access_ids();
			$this->db->where("(tbl_article.loc_id IN ($loc_ids))");
		}
		$query = $this->db->get();

		$rows = $query->result_array();
		return sizeof($rows);
		//return $this->db->count_all_results("tbl_article");
		
	}
	
	//function to show tbl_article using codeigniter pagination
	function show_posts($limit,$start)
	{
		
		$this->load->database();
		$this->db->select('tbl_article.*,tbl_category.category,tbl_category.alias as cat_alias,tbl_users.user_name as author_name');
		$this->db->from('tbl_article');
		$this->db->join('tbl_category','tbl_article.cat_id=tbl_category.id','left');
		$this->db->join('tbl_users','tbl_article.author=tbl_users.id','left');
		$this->db->order_by("tbl_article.publish_date", "desc"); 
		$this->db->limit($limit,$start);
		$search = $this->session->userdata('search');
		if($search) {
			/* $this->db->like('tbl_article.title', $search);
			$this->db->like('tbl_category.category', $search); */
			/* $this->db->where("(tbl_article.title LIKE '%$search%' OR  tbl_category.category LIKE '%$search%' )"); */
			//$this->db->where("(tbl_article.id LIKE '%$search%' OR  tbl_article.title LIKE '%$search%' OR  tbl_article.publish_date LIKE '%$search%' OR  tbl_category.category LIKE '%$search%' )");
			if(ctype_digit($search)){
				$this->db->where("(tbl_article.id LIKE '%$search%' OR  tbl_article.publish_date LIKE '%$search%' )");
			}
			else {
				$this->db->where("(tbl_article.title LIKE '%$search%' OR  tbl_category.category LIKE '%$search%' )");
			
			}
		}
		/* filter result on the basis of location access*/
		if($this->session->userdata('user_type') == 'panel_user'){
			$loc_ids = $this->common->loc_access_ids();
			$user_id = $this->session->userdata('id');
			$this->db->where("(tbl_article.loc_id IN ($loc_ids) OR tbl_article.author=$user_id)");
		}
		
		$query = $this->db->get();

		$rows = $query->result_array();
		foreach($rows as $k=>$val) {
			$rows[$k]['url']= $val['cat_alias'].'/'.$val['seo_url'].'-'.$val['id'];	
		}
		return $rows;	
	}
	
	//get post data from the database
	function get_post_data($post_id) {
		$this->db->select('tbl_article.*,tbl_category.category as cat_name');
		$this->db->from('tbl_article');
		$this->db->join('tbl_category','tbl_article.cat_id=tbl_category.id');
		$this->db->where('tbl_article.id',$post_id);
		$query = $this->db->get();
		$rows = $query->row_array();
		return $rows;
	}
	
	//save new aricle data to the database
	function save_article($all_data) {
		$seo_url = $all_data['seo_url'];
		$this->db->select('seo_url');
		$this->db->where('seo_url',$seo_url);
		$query = $this->db->get('tbl_article');
		$rows = $query->row_array();


		$i=1;
		while(1) {
			if(!isset($rows['seo_url'])) {break;}
			$seo_url = $all_data['seo_url'].$i;
			$this->db->select('seo_url');
			$this->db->where('seo_url',$seo_url);
			$query = $this->db->get('tbl_article');
			$rows = $query->row_array();
			
			$i++;
		}
		$all_data['seo_url'] = $seo_url;
		//extract media files from the article
		if($all_data['media']) {
			$all_data['has_media'] = 1;
			foreach($all_data['media'] as $k=>$v) {
				//insert all the media related values in the database
				$data1[$k]['caption']=$v['caption'];
				if($v['type']=='image') {
					//hard code for adding first value of media in art image
					if(!isset($all_data['art_image'])){
						$all_data['art_image'] = 'uploads/'.$v['file_name'];
					}
					$data1[$k]['image_orig']=$v['file_name'];
					$data1[$k]['image_thumb']=$v['image_thumb'];
					$data1[$k]['image_med']=$v['image_med'];
					$data1[$k]['image_large']=$v['image_large'];
					$data1[$k]['type']=$v['type'];
				}
				elseif ($v['type']=='video') {
					if(!isset($all_data['art_image'])){
						$ytarray=explode("/", $v['video_code']);
						$ytendstring=end($ytarray);
						$ytendarray=explode("?v=", $ytendstring);
						$ytendstring=end($ytendarray);
						$ytendarray=explode("&", $ytendstring);
						$ytcode=$ytendarray[0];
						$image_vid = file_get_contents("http://img.youtube.com/vi/".$ytcode."/0.jpg");
						file_put_contents('uploads/'.md5($all_data['alias']).'.jpg', $image_vid);
						$all_data['art_image'] = 'uploads/'.md5($all_data['alias']).'.jpg';
					}
					$data1[$k]['vid_code'] = $v['video_code'];
					$data1[$k]['type'] = $v['type'];
				}
			}
			
		}
		
		unset($all_data['media']);
		// location id save
		if(isset($all_data['district']) && @$all_data['district']!='' ) {
			unset($all_data['country']);
			unset($all_data['state']);
			$all_data['loc_id'] = $all_data['district'];
			unset($all_data['district']);
		}
		elseif(isset($all_data['state']) && @$all_data['state']!='') {
			unset($all_data['country']);
			$all_data['loc_id'] = $all_data['state'];
			unset($all_data['state']);
			unset($all_data['district']);
		}
		elseif(isset($all_data['country'])) {
			$all_data['loc_id'] = $all_data['country'];
			unset($all_data['country']);
			unset($all_data['state']);
		}
		
			
		
		$this->db->insert('tbl_article',$all_data);
		
		$art_id = $this->db->insert_id();
		if($all_data['has_media'] == 1) {
			foreach($data1 as $v) {
				$v['art_id'] = $art_id;
				$this->db->insert('tbl_media',$v);
			}
			
		
		}
		
		return true;	
	}
	
	function get_media($post_id) {
		$this->db->select('tbl_media.*');
		$this->db->where('art_id',$post_id);
		$query = $this->db->get('tbl_media');
		$rows = $query->result_array();
		return $rows;
	
	}
	
	//Update the aricle data to the database
	function update_article($all_data,$art_id) {
		//extract media files from the article
		$all_data['has_media'] = 0;
		if($all_data['media']) {
			$all_data['has_media'] = 1;
			foreach($all_data['media'] as $k=>$v) {
				//insert all the media related values in the database
				$data1[$k]['caption']=$v['caption'];
				if($v['type']=='image' ) {
					if( isset($v['file_name'])) {
						$all_data['art_image'] = 'uploads/'.$v['file_name'];
						$data1[$k]['image_orig']=$v['file_name'];
						$data1[$k]['image_thumb']=$v['image_thumb'];
						$data1[$k]['image_med']=$v['image_med'];
						$data1[$k]['image_large']=$v['image_large'];
						$data1[$k]['type']=$v['type'];
						if(isset($v['id'])){
							$data1[$k]['id']=$v['id'];
						}
					}
					else {
						$data1[$k]['type']=$v['type'];
						$data1[$k]['id']=$v['id'];
					}
				}
				elseif ($v['type']=='video') {
					$data1[$k]['vid_code'] = $v['video_code'];
					$data1[$k]['type'] = $v['type'];
					$data1[$k]['id'] = $v['id'];
				}
			}
			
		}
		unset($all_data['media']);
		
		// location id save
		if(isset($all_data['district']) && @$all_data['district']!='' ) {
			unset($all_data['country']);
			unset($all_data['state']);
			$all_data['loc_id'] = $all_data['district'];
			unset($all_data['district']);
		}
		elseif(isset($all_data['state']) && @$all_data['state']!='') {
			unset($all_data['country']);
			$all_data['loc_id'] = $all_data['state'];
			unset($all_data['state']);
			unset($all_data['district']);
		}
		elseif(isset($all_data['country'])) {
			$all_data['loc_id'] = $all_data['country'];
			unset($all_data['country']);
			unset($all_data['state']);
		}
		if($all_data['loc_id'] == "") {
			unset($all_data['loc_id']);
		}

		if(!isset($all_data['ticker'])) {
			$all_data['ticker']=0;
		}
		if(!isset($all_data['slider'])) {
			$all_data['slider']=0;
		}
		
		
		$this->db->where('id',$art_id);
		$this->db->update('tbl_article',$all_data);
		
		if($all_data['has_media'] == 1) {
			foreach($data1 as $v) {
				if(isset($v['id'])) {				
				$v['art_id'] = $art_id;
				$this->db->where('id',$v['id']);
				unset($v['id']);
				$this->db->update('tbl_media',$v);
				}
				else {
					$v['art_id'] = $art_id;
					$this->db->insert('tbl_media',$v);
				}
			}
			
		
		}
		return true;	
	}
	
	// to delete media from the database using ajax remove button
	function remove_media($media_id) {
		$dir_path = './uploads/';
		$this->db->where('id',$media_id);
		$res = $this->db->get('tbl_media');
		foreach ($res->result() as $row)
		{
			unlink($dir_path.$row->image_orig);
			unlink($dir_path.$row->image_thumb);
			unlink($dir_path.$row->image_med);
			unlink($dir_path.$row->image_large);
		}
		$this->db->where('id',$media_id);
		$this->db->delete('tbl_media');
		return true;
	}
	
	//delete cat
	function delete_post($art_id) {
		$this->db->where('id',$art_id);
		$this->db->delete('tbl_article');
		// delete media if any
		$this->db->where('art_id',$art_id);
		$query=$this->db->get('tbl_media');
		foreach($query->result_array() as $row){
			$this->remove_media($row['id']);		
		}
		
		$this->session->set_flashdata('msg_write', 'Article deleted successfully');	
	}
	
	//function to get post and data for front page
	function show_posts_front($limit,$start,$cat_id)
	{
		$this->load->database();
		$this->db->select('tbl_article.*,tbl_category.category,tbl_category.alias as cat_alias,tbl_users.user_name as author_name');
		$this->db->from('tbl_article');
		$this->db->join('tbl_category','tbl_article.cat_id=tbl_category.id');
		$this->db->join('tbl_users','tbl_article.author=tbl_users.id');
		$this->db->where(array('tbl_article.cat_id'=>$cat_id));
		//less than publish date
		$this->db->where('tbl_article.publish_date < now()');
		
		$this->db->where('tbl_article.status','1');
		$this->db->limit($limit,$start);
		$this->db->order_by("tbl_article.publish_date", "desc"); 
	
		$query = $this->db->get();
		$rows = $query->result_array();
		//add url to each article
		foreach($rows as $k=>$val) {
			$rows[$k]['url']= $val['cat_alias'].'/'.$val['seo_url'].'-'.$val['id'];		
		}
		return $rows;	
	}
	function show_posts_front_loctype($limit,$start,$loc_type)
	{
		$this->load->database();
		$this->db->select('tbl_article.*,tbl_location.name,tbl_location.type,tbl_location.alias as loc_alias');
		$this->db->from('tbl_article');
		$this->db->join('tbl_location','tbl_article.loc_id=tbl_location.id');
		$this->db->order_by("tbl_article.publish_date", "desc"); 
		$this->db->where('tbl_location.type',$loc_type);
		//less than publish date
		$this->db->where('tbl_article.publish_date < now()');
		
		//filter news according to locations
		$loc_id = $this->session->userdata('main_loc_id');
		$loc_ids = $this->common->heir_country_to_district($loc_id);
		$loc_ids = implode(',',$loc_ids);
		$this->db->where("tbl_article.loc_id in ($loc_ids)");
		
		$this->db->where('tbl_article.status','1');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$rows = $query->result_array();
		foreach($rows as $k=>$val) {
			$rows[$k]['url']= $val['loc_alias'].'/'.$val['seo_url'].'-'.$val['id'];
			if($val['type']=='district') {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
				$state = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$state);
				$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$rows[$k]['url']= $country.'/'.$state.'/'.$rows[$k]['url'];				
			}
			if($val['type']=='state') {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
				$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$rows[$k]['url']= $country.'/'.$rows[$k]['url'];				
			}			
		}
		return $rows;	
	}
	
	function show_posts_front_desh($limit,$start,$loc_id,$inc=1)
	{
		$this->load->database();
		$this->db->select('tbl_article.*,tbl_location.name,tbl_location.type,tbl_location.alias as loc_alias');
		$this->db->from('tbl_article');
		$this->db->join('tbl_location','tbl_article.loc_id=tbl_location.id');
		$this->db->order_by("tbl_article.publish_date", "desc"); 
		//less than publish date
		$this->db->where('tbl_article.publish_date < now()');
		
		//filter news according to locations
		$loc_ids = $this->common->heir_country_to_district_country($loc_id,$inc);
		$loc_ids = implode(',',$loc_ids);
		$this->db->where("tbl_article.loc_id in ($loc_ids)");
		
		$this->db->where('tbl_article.status','1');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$rows = $query->result_array();
		foreach($rows as $k=>$val) {
			$rows[$k]['url']= $val['loc_alias'].'/'.$val['seo_url'].'-'.$val['id'];
			if($val['type']=='district') {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
				$state = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$state);
				$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$rows[$k]['url']= $country.'/'.$state.'/'.$rows[$k]['url'];				
			}
			if($val['type']=='state') {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
				$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$rows[$k]['url']= $country.'/'.$rows[$k]['url'];				
			}			
		}
		return $rows;	
	}
	
	function show_posts_front_slider($limit,$start)
	{
		$this->load->database();
		$this->db->select('tbl_article.*,tbl_category.category,tbl_category.alias as cat_alias,tbl_users.user_name as author_name');
		$this->db->from('tbl_article');
		$this->db->join('tbl_category','tbl_article.cat_id=tbl_category.id');
		$this->db->join('tbl_users','tbl_article.author=tbl_users.id');
		$this->db->where('tbl_article.slider','1');
		$loc_id = $this->session->userdata('main_loc_id');
		$loc_ids = $this->common->heir_country_to_district($loc_id);
		$loc_ids = implode(',',$loc_ids);
		$this->db->where("tbl_article.loc_id in ($loc_ids)");
		
		//less than publish date
		$this->db->where('tbl_article.publish_date < now()');

		$this->db->where('tbl_article.status','1');
		$this->db->order_by("tbl_article.publish_date", "desc"); 
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$rows = $query->result_array();
		foreach($rows as $k=>$val) {

			$rows[$k]['url']= $val['cat_alias'].'/'.$val['seo_url'].'-'.$val['id'];	
		}
		return $rows;	
	}
	function show_posts_front_ticker($limit,$start)
	{
		$this->load->database();
		$this->db->select('tbl_article.*,tbl_category.category,tbl_category.alias as cat_alias,tbl_users.user_name as author_name');
		$this->db->from('tbl_article');
		$this->db->join('tbl_category','tbl_article.cat_id=tbl_category.id');
		$this->db->join('tbl_users','tbl_article.author=tbl_users.id');
		$this->db->where('tbl_article.ticker','1');
		//less than publish date
		$this->db->where('tbl_article.publish_date < now()');
		
		//filter news according to locations
		$loc_id = $this->session->userdata('main_loc_id');
		$loc_ids = $this->common->heir_country_to_district($loc_id);
		$loc_ids = implode(',',$loc_ids);
		$this->db->where("tbl_article.loc_id in ($loc_ids)");

		$this->db->where('tbl_article.status','1');
		$this->db->order_by("tbl_article.publish_date", "desc"); 
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$rows = $query->result_array();
		foreach($rows as $k=>$val) {
			$rows[$k]['url']= $val['cat_alias'].'/'.$val['seo_url'].'-'.$val['id'];		
		}
		return $rows;	
	}
	
	//function to show tbl_article using codeigniter pagination
	function get_related_post($post_id,$type,$total)
	{
		$this->db->where('tbl_article.id !=',$post_id);
		//less than publish date
		$this->db->where('tbl_article.publish_date < now()');
		$this->db->where('tbl_article.status','1');
		if($type=="location") {
			$loc_id = $this->common->getSingleValue('tbl_article','loc_id','id',$post_id);
			$this->db->where('loc_id',$loc_id);
			//check for district / counrty
			$parent_id = $this->common->getSingleValue('tbl_location','parent_id','id',$loc_id);
			if($parent_id) {
				$this->db->or_where('loc_id',$parent_id);
				$super_parent = $this->common->getSingleValue('tbl_location','parent_id','id',$parent_id);
				if($super_parent) {
					$this->db->or_where('loc_id',$super_parent);
				}
			}
			
		}
		if($type=="category") {
			$cat_id = $this->common->getSingleValue('tbl_article','cat_id','id',$post_id);
			$this->db->where('cat_id',$cat_id);
		}

		$this->db->select('tbl_article.*,tbl_category.category,tbl_category.alias as cat_alias,tbl_location.alias as loc_alias,tbl_location.type as type');
		$this->db->from('tbl_article');
		$this->db->join('tbl_category','tbl_article.cat_id=tbl_category.id','left');
		$this->db->join('tbl_location','tbl_article.loc_id=tbl_location.id','left');
		$this->db->order_by("tbl_article.publish_date", "desc"); 
		$this->db->limit($total,0);
		$query = $this->db->get();
		
		$rows = $query->result_array();
		
		//add url to each article
		if($type == "category" ) {
			foreach($rows as $k=>$val) {
				$rows[$k]['url']= $val['cat_alias'].'/'.$val['seo_url'].'-'.$val['id'];		
			}
		}
		if($type == "location" ) {
			foreach($rows as $k=>$val) {
				$rows[$k]['url']= $val['loc_alias'].'/'.$val['seo_url'].'-'.$val['id'];
				if($val['type']=='district') {
					$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
					$state = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
					$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$state);
					$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
					$rows[$k]['url']= $country.'/'.$state.'/'.$rows[$k]['url'];				
				}
				if($val['type']=='state') {
					$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
					$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
					$rows[$k]['url']= $country.'/'.$rows[$k]['url'];				
				}			
			}
		}
				
		return $rows;	
	}
	
	//function to get the news for location page cat-dist page
	function show_posts_front_loc($limit,$start,$loc_id)
	{
		$child_ids[] = $loc_id;
		$this->db->select('id');
		$this->db->where('parent_id',$loc_id);
		$query = $this->db->get('tbl_location');
		foreach($query->result_array() as $v){
			$child_ids[] = $v['id'];
		}

		$this->db->flush_cache();
		$this->db->where_in('tbl_location.id',$child_ids);
		//less than publish date
		$this->db->where('tbl_article.publish_date < now()');
		$this->db->where('tbl_article.status','1');
		$this->db->select('tbl_article.*,tbl_location.name,tbl_location.type,tbl_location.alias as loc_alias');
		$this->db->from('tbl_article');
		$this->db->join('tbl_location','tbl_article.loc_id=tbl_location.id');
		$this->db->order_by('tbl_article.id','DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$rows = $query->result_array();
		foreach($rows as $k=>$val) {
			$rows[$k]['url']= $val['loc_alias'].'/'.$val['seo_url'].'-'.$val['id'];
			if($val['type']=='district') {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
				$state = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$state);
				$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$rows[$k]['url']= $country.'/'.$state.'/'.$rows[$k]['url'];				
			}
			if($val['type']=='state') {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
				$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$rows[$k]['url']= $country.'/'.$rows[$k]['url'];				
			}			
		}
		return $rows;		
	}
	
	//function to most popular news
	function get_popular_post()
	{
		
		//less than publish date
		$this->db->where('tbl_article.publish_date < now()');
		$this->db->where('tbl_article.status','1');
		$this->db->select('tbl_article.*,tbl_location.name,tbl_location.type,tbl_location.alias as loc_alias');
		$this->db->from('tbl_article');
		$this->db->join('tbl_location','tbl_article.loc_id=tbl_location.id');
		$this->db->order_by('tbl_article.read_count','DESC');
		$this->db->limit(5,0);
		$query = $this->db->get();
		$rows = $query->result_array();
		foreach($rows as $k=>$val) {
			$rows[$k]['url']= $val['loc_alias'].'/'.$val['seo_url'].'-'.$val['id'];
			if($val['type']=='district') {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
				$state = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$state);
				$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$rows[$k]['url']= $country.'/'.$state.'/'.$rows[$k]['url'];				
			}
			if($val['type']=='state') {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','alias',$val['loc_alias']);
				$country = $this->common->getSingleValue('tbl_location','alias','id',$parent_id);
				$rows[$k]['url']= $country.'/'.$rows[$k]['url'];				
			}			
		}
		return $rows;		
	}
	//function to get most popular media
	function get_popular_media()
	{
		
		//less than publish date
		$this->db->where('publish_date < now()');
		$this->db->where('has_media = 1');
		$this->db->select('id');
		$this->db->from('tbl_article');
		$this->db->order_by('read_count','DESC');
		$query = $this->db->get();
		$rows = $query->result_array();
		foreach ($rows as $val) {
			$in_id[] = $val['id'];
		}
		$in_ids = implode($in_id,',');
		$this->db->where('type','video');
		$this->db->order_by('read_count','DESC');
		$this->db->limit(6);		
		$query = $this->db->get('tbl_media');
		$media['videos'] = $query->result_array();
		$this->db->where('type','image');
		$this->db->order_by('read_count','DESC');
		$this->db->limit(6);		
		$query = $this->db->get('tbl_media');
		$media['images'] = $query->result_array();
		return $media;		
	}
	
	//function to change the status of the post
	function toggle_status($post_id){
		$this->db->select('status');
		$this->db->where('id',$post_id);
		$query = $this->db->get('tbl_article');
		$result = $query->row();
		$status = $result->status;
		if($status == 0) {
			$status = 1;
		}
		else {
			$status = 0;
		}
		$arr = array('status'=>$status);
		$this->db->where('id',$post_id);
		$this->db->update('tbl_article',$arr);
		return $status;
	}
	
	//function to get post and data for front page
	function show_side_slider_images()
	{
		$this->db->order_by('id','DESC');
		$query = $this->db->get('tbl_img_slider');
		$rows = $query->result_array();
		return $rows;	
	}
	function update_slider_image($arr_img) {
		$query = $this->db->get('tbl_img_slider');
		$rows = $query->result_array();
		foreach($rows as $val) {
			$ids[] = $val['id'];		
		}
		
		foreach($ids as $val){
			if( !in_array($val,$arr_img)) {
				$this->db->where('id',$val);
				$this->db->delete('tbl_img_slider');
			}
		}
	
	}
	function save_slider_image($data) {
		$this->db->insert('tbl_img_slider',$data);
			
	}
}