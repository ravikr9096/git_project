<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->helper('cookie');
		//load models
		$this->load->model('admin_adds_model');
		$this->load->model('admin_cat_model');
		$this->load->model('admin_model');
		$this->load->model('admin_polls_model');
		$this->load->model('admin_post_model');
		$this->load->model('admin_comments_model');
		$this->load->model('admin_mag_model');

    }
	function site_logout() {

		$this->session->set_userdata('fb_destroy',1);
		$this->session->unset_userdata('logged_user');
		header('Location: ' .base_url().$this->session->userdata('current_url'));	
		//header('Location: ' .base_url().$this->session->userdata('main_loc_alias'));
		//$this->index($this->session->userdata('main_loc_id'));
		
	}
	
	
	
	function fb_login() {
		$this->load->library('facebook');
		$user = $this->facebook->getUser();
		if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
				$user_name_create = explode('@',$data['user_profile']['email']);
				$logged_user['user_name'] = $user_name_create[0];
				$logged_user['email'] = $data['user_profile']['email'];
				$logged_user['first_name'] = $data['user_profile']['first_name'];
				$logged_user['last_name'] = $data['user_profile']['last_name'];
				$logged_user['gender'] = $data['user_profile']['gender'];
				$logged_user['created_date'] = date("Y-m-d H:i:s");
				$logged_user['user_type'] = 'fb_user';
				$logged_user['role_id'] = -1;
				$ins_id = $this->admin_model->save_site_user($logged_user);
				if($ins_id) {
					$this->session->set_userdata('logged_user',$logged_user);
				}
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $this->facebook->destroySession();
        }	
		header('Location: ' .base_url().$this->session->userdata('current_url'));
	}
	
	public function index($loc_id=1)
	{
	
		$this->session->set_userdata('current_url',$this->session->userdata('main_loc_alias'));
/* 		print_r('main');
		print_r($this->session->userdata('current_url')); */
		$this->load->library('facebook');
		if($this->session->userdata('fb_destroy')){
			$this->facebook->destroySession();
			$this->session->set_userdata('fb_destroy',0);
		}
			
		$user = $this->facebook->getUser();
		if ($user) {
			$data['logout_url'] = site_url('site_logout');

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => base_url().'fb_login', 
                'scope' => array("email"), // permissions here
            ));
        }
		
		/* name of loction in header */
		$main_loc_name =  $this->common->getSingleValue('tbl_location','name','id',$loc_id);
		$this->session->set_userdata('main_loc_name',$main_loc_name);
		$this->session->set_userdata('loc_id',$loc_id);
		$main_loc_alias =  $this->common->getSingleValue('tbl_location','alias','id',$loc_id);
		$this->session->set_userdata('main_loc_alias',$main_loc_alias);
		$this->session->set_userdata('main_loc_id',$loc_id);
		$this->session->set_userdata('main_country_id',$loc_id);
		
		$data['regions'] = $this->admin_model->get_regions(1);
		//get region details
		/* for($i=1;$i<=6;$i++) {
			$ad = 'ad_'.$i;
			$data['ads'][$i] = $this->admin_adds_model->get_add_data($data['regions'][$ad]);
		} */

		$data['ads'] = $this->admin_adds_model->get_ad_data($loc_id);
		/* increase the shown ounter of the adds */
		foreach($data['ads'] as $val) {
			$this->common->inc_view_ctr($val['id']);
		}

		//show menu
		$data['cat_data'] = $this->admin_cat_model->get_cat_front();
		usort($data['cat_data'], function($a, $b) {
							return $a['sort'] - $b['sort'];
		});
		//articles for various regions
		$data['cat_1'] = $this->admin_cat_model->get_cat_details($data['regions']['cat_1']);
		$data['cat_2'] = $this->admin_cat_model->get_cat_details($data['regions']['cat_2']);
		$data['cat_3'] = $this->admin_cat_model->get_cat_details($data['regions']['cat_3']);
		$data['cat_4'] = $this->admin_cat_model->get_cat_details($data['regions']['cat_4']);
		$data['articles']['cat_1'] = $this->admin_post_model->show_posts_front(5,0,$data['regions']['cat_1']);

		$data['articles']['cat_2'] = $this->admin_post_model->show_posts_front(5,0,$data['regions']['cat_2']);
		$data['articles']['cat_3'] = $this->admin_post_model->show_posts_front(5,0,$data['regions']['cat_3']);
		$data['articles']['cat_4'] = $this->admin_post_model->show_posts_front(5,0,$data['regions']['cat_4']);
		$data['poll_data']=$this->admin_polls_model->get_poll_details($data['regions']['poll']);
		
		//for tabbing region hardcoded category id
		$data['articles']['cat_2_1'] = $this->admin_post_model->show_posts_front_desh(12,0,$loc_id,1);
		$data['articles']['cat_2_2'] = $this->admin_post_model->show_posts_front_desh(12,0,$loc_id,0);
		$data['articles']['cat_2_3'] = $this->admin_post_model->show_posts_front_loctype(12,0,'state');
		$data['articles']['cat_2_4'] = $this->admin_post_model->show_posts_front_loctype(12,0,'district');
		
		//for slider 
		$data['slider_articles'] = $this->admin_post_model->show_posts_front_slider(12,0);
		
		//for ticker news
		$data['ticker_articles'] = $this->admin_post_model->show_posts_front_ticker(20, 0);
		
		$data['states'] = $this->admin_model->get_state();
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
		$city_weather = $this->admin_model->get_weather_info();
		$data['city_weather'] = $city_weather;
		/* side videos */
		$data['videos'] = $this->admin_model->get_videos();
		/* most popular  */
		$data['popular'] = $this->admin_post_model->get_popular_post();
		$data['popular_media'] = $this->admin_post_model->get_popular_media();
		
		//for recipe in sidebar
		$data['recipe'] = $this->admin_cat_model->get_cat_details(15);
		$data['articles']['recipe'] = $this->admin_post_model->show_posts_front(6,0,15);
		
		//for slider image 
		$data['slider_images'] = $this->admin_post_model->show_side_slider_images();
		
		//for dynamic colors
		$data['webcolors'] = $this->admin_model->get_webcolors();
		
		
		
		$this->load->view('front/templates/header',$data);
		$this->load->view('front/homepage',$data);
		$this->load->view('front/templates/footer',$data);
	}
	
	function params_check($p1,$p2=null,$p3=null,$p4=null) {
			
/* 		print_r('sub');
		print_r($this->session->userdata('current_url')); */
			
		if($p1 && $p2 && $p3 && $p4) {
			$art_arr = $this->param4($p1,$p2,$p3,$p4);
		}
		elseif($p1 && $p2 && $p3) {
			$art_arr = $this->param3($p1,$p2,$p3);
		}
		elseif($p1 && $p2) {
			$art_arr = $this->param2($p1,$p2);
		}
		elseif($p1) {
			$art_arr = $this->param1($p1);
		}		
		
		
		$related_article = $art_arr;
		$page = $related_article['page'];
		unset($related_article['page']);
		if(@$related_article['subpage']){
			$data['page_type'] = $related_article['subpage'];
			unset($related_article['subpage']);
		}
		$data['main_article'] = @$related_article[0];
		if(@$related_article[0]['has_media']) {
			$data['main_article']['media'] = $this->admin_post_model->get_media($related_article[0]['id']);
			
		}
		$data['breadcrumb'] = $this->common->loc_details($data['main_article']['loc_id']);
		unset($related_article[0]);
		$data['all_articles'] = $related_article;
		
		$this->load->library('facebook');
		if($this->session->userdata('fb_destroy')){
			$this->facebook->destroySession();
			$this->session->set_userdata('fb_destroy',0);
		}
			
		$user = $this->facebook->getUser();
		if ($user) {
			
			$data['logout_url'] = site_url('site_logout');

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => base_url().'fb_login', 
                'scope' => array("email"), 
            ));
        }
		//get page details
		$page_id = $this->common->getSingleValue('tbl_pages','id','title',$page);
		$data['regions'] = $this->admin_model->get_regions($page_id);
		//get region details
		/*
		for($i=1;$i<=7;$i++) {
			$ad = 'ad_'.$i;
			$data['ads'][$i] = $this->admin_adds_model->get_add_data($data['regions'][$ad]);
		} */
		$data['ads'] = $this->admin_adds_model->get_ad_data($this->session->userdata('loc_id'));
		foreach($data['ads'] as $val) {
			if(@$val['id']) {
				$this->common->inc_view_ctr($val['id']);
			}
		}
		//show menu
		$data['cat_data'] = $this->admin_cat_model->get_cat_front();
		usort($data['cat_data'], function($a, $b) {
							return $a['sort'] - $b['sort'];
		});
		
		//get common logo and poll
		$data['regions']['logo'] = $this->common->getSingleValue('tbl_regions','data','title','logo');
		$data['regions']['poll'] = $this->common->getSingleValue('tbl_regions','data','title','poll');
		$data['poll_data']=$this->admin_polls_model->get_poll_details($data['regions']['poll']);

		//articles for various regions
		if($page=='cat-dist'){
		$data['cat_1'] = $this->admin_cat_model->get_cat_details($data['regions']['cat_1']);
		$data['cat_3'] = $this->admin_cat_model->get_cat_details($data['regions']['cat_3']);
		$data['cat_4'] = $this->admin_cat_model->get_cat_details($data['regions']['cat_4']);
		$data['articles']['cat_1'] = $this->admin_post_model->show_posts_front(5,0,$data['regions']['cat_1']);
		$data['articles']['cat_3'] = $this->admin_post_model->show_posts_front(5,0,$data['regions']['cat_3']);
		$data['articles']['cat_4'] = $this->admin_post_model->show_posts_front(5,0,$data['regions']['cat_4']);
		$data['poll_data']=$this->admin_polls_model->get_poll_details($data['regions']['poll']);	
		
		//for tabbing region hardcoded category id
		//$data['articles']['cat_2_1'] = $this->admin_post_model->show_posts_front(12,0,1);
		//$data['articles']['cat_2_2'] = $this->admin_post_model->show_posts_front(12,0,2);
		$loc_id = $this->session->userdata('main_loc_id');
		$data['articles']['cat_2_1'] = $this->admin_post_model->show_posts_front_desh(12,0,$loc_id,1);
		$data['articles']['cat_2_2'] = $this->admin_post_model->show_posts_front_desh(12,0,$loc_id,0);
		
		$data['articles']['cat_2_3'] = $this->admin_post_model->show_posts_front_loctype(12,0,'state');
		$data['articles']['cat_2_4'] = $this->admin_post_model->show_posts_front_loctype(12,0,'district');
		}
		//for slider 
		$data['slider_articles'] = $this->admin_post_model->show_posts_front_slider(12, 0);
		
		//for ticker news
		$data['ticker_articles'] = $this->admin_post_model->show_posts_front_ticker(20, 0);		
		
		$data['states'] = $this->admin_model->get_state();
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
		$city_weather = $this->admin_model->get_weather_info();
		$data['city_weather'] = $city_weather;
		/* side videos */
		$data['videos'] = $this->admin_model->get_videos();
		/* most popular  */
		$data['popular'] = $this->admin_post_model->get_popular_post();
		$data['popular_media'] = $this->admin_post_model->get_popular_media();
		
		//for recipe in sidebar		
		$data['recipe'] = $this->admin_cat_model->get_cat_details(15);
		$data['articles']['recipe'] = $this->admin_post_model->show_posts_front(6,0,15);
		
		//for slider image 
		$data['slider_images'] = $this->admin_post_model->show_side_slider_images();
		
		//for dynamic colors
		$data['webcolors'] = $this->admin_model->get_webcolors();
		
		//for showing the comments related to the post 
		$data['comments'] = $this->admin_comments_model->get_comments_front($data['main_article']['id']);
		
		$this->load->view('front/templates/header',$data);
		$this->load->view('front/'.$art_arr['page'].'page',$data);
		$this->load->view('front/templates/footer',$data);
	}
	function param4($p1,$p2,$p3,$p4) {
		//case country/state/district/news
		$art_arr = $this->get_articles($p4,'location');
		$art_arr['page'] = 'news';
		$this->session->set_userdata('main_loc_name',$this->common->getSingleValue('tbl_location','name','alias',$p3));
		$this->session->set_userdata('loc_id',$this->common->getSingleValue('tbl_location','id','alias',$p3));
		return $art_arr;
	}
	function param3($p1,$p2,$p3) {
		//case country/state/news
		$art_arr = $this->get_articles($p3,'location');
		$art_arr['page'] = 'news';
		$this->session->set_userdata('main_loc_name',$this->common->getSingleValue('tbl_location','name','alias',$p2));
		$this->session->set_userdata('loc_id',$this->common->getSingleValue('tbl_location','id','alias',$p2));
		return $art_arr;
	}
	function param2($p1,$p2) {
	//echo "2 params";
		$seo_url = explode("-",$p2);
		array_pop($seo_url);
		$seo_url = implode('-',$seo_url);
		$news = $this->common->getSingleValue('tbl_article','id','seo_url',$seo_url);
		
		//case category/news
		
		$cat = $this->common->getSingleValue('tbl_category','id','alias',$p1);
		if ($cat && $news){
			$this->common->read_art($news);
			$art_arr = $this->get_articles($p2,'category');
			$art_arr['page'] = 'news';
		}
		//case country/news
		$loc = $this->common->getSingleValue('tbl_location','id','alias',$p1);
		if ($loc && $news){
			$this->common->read_art($news);
			$art_arr = $this->get_articles($p2,'location');
			$art_arr['page'] = 'news';
			$this->session->set_userdata('main_loc_name',$this->common->getSingleValue('tbl_location','name','alias',$p1));
			$this->session->set_userdata('loc_id',$this->common->getSingleValue('tbl_location','id','alias',$p1));
		}		

		
		//case state/district
		$loc1 = $this->common->getSingleValue('tbl_location','id','alias',$p2);

		$loc2 = $this->common->getSingleValue('tbl_location','id','alias',$p1);
		if ($loc1 && $loc2){
			$art_arr = $this->get_articles_loc($p2);
			$art_arr['page'] = 'cat-dist';
			$this->session->set_userdata('main_loc_name',$this->common->getSingleValue('tbl_location','name','alias',$p2));
			$this->session->set_userdata('loc_id',$this->common->getSingleValue('tbl_location','id','alias',$p2));
		}

 		return $art_arr;
		
		
	}
	function param1($p1) {
		// case category
		
		$cat = $this->common->getSingleValue('tbl_category','id','alias',$p1);
		if ($cat){
			$art_arr = $this->get_articles_cat($p1,'category');
			$art_arr['subpage'] = 'cat';
			$art_arr['page'] = 'cat-dist';

		}

		// case location
		$loc = $this->common->getSingleValue('tbl_location','id','alias',$p1);
		$loc_type_check = $this->common->getSingleValue('tbl_location','type','id',$loc);
		if($loc && ($loc_type_check == 'country' || $loc_type_check == 'continent')) {
			$this->index($loc);
			exit();
		}
		elseif ($loc ){
			$art_arr = $this->get_articles_loc($p1);
			$art_arr['subpage'] = 'dist';
			$this->session->set_userdata('main_loc_name',$this->common->getSingleValue('tbl_location','name','alias',$p1));
			$this->session->set_userdata('loc_id',$this->common->getSingleValue('tbl_location','id','alias',$p1));
			$art_arr['page'] = 'cat-dist';
		}
		
		
		return $art_arr;

		
	}
	
	function get_articles($news_seo,$type="location") {
		$seo_url = explode("-",$news_seo);
		array_pop($seo_url);
		$seo_url = implode('-',$seo_url);
		$post_id = $this->common->getSingleValue('tbl_article','id','seo_url',$seo_url);
		if($post_id){
			$art_arr[] = $this->admin_post_model->get_post_data($post_id);
		}
		$art_arr = array_merge($art_arr,$this->admin_post_model->get_related_post($post_id,$type,4));
		return $art_arr;
	}
	function get_articles_cat($cat_alias,$type="location") {
		$cat_id = $this->common->getSingleValue('tbl_category','id','alias',$cat_alias);		
		$art_arr = $this->admin_post_model->show_posts_front(10,0,$cat_id);
		return $art_arr;
	}
	function get_articles_loc($loc_alias) {
		$loc_id = $this->common->getSingleValue('tbl_location','id','alias',$loc_alias);		
		$art_arr = $this->admin_post_model->show_posts_front_loc(10,0,$loc_id);
		return $art_arr;
	}
	
	function emagazine($mag_id) {
		$data['mag'] = $this->admin_mag_model->get_mag_details($mag_id);
		$data['slider_images'] = $this->admin_mag_model->show_mag_images($mag_id);
		$data['slider_images1'] = $this->admin_mag_model->show_mag_images($mag_id);
		$this->load->view('front/emagazine',$data);
	}
		
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */