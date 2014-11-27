<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter User Class v1
 *
 * This class contains functions that will give you the option to run a Member/User/Login system
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	User System
 * @author		Mike Owens [Xikeon]
 * @link		http://www.xikeon.com/
 */
class Common {
	
	/**
	 * Constructor
	 *
	 * Get instance for Database Lib
	 *
	 * @access	public
	 */
	function Common()
	{
		$this->CI =& get_instance();
		
		log_message('debug', "User Class Initialized");

	}

	// general function to fetch data
	
	function get_data($name,$tbl_name,$col_name,$value)
	{
		$sel_q ="SELECT ".$name." FROM ".$tbl_name." WHERE ".$col_name."='".$value."'";
		$q  = $this->CI->db->query( $sel_q );
		$data = $q->row();
			if($data)
			{
				return $data->$name;
			}				
	}


function getSingleValue($table,$get,$key,$value)
	{
		$sel_q ="SELECT $get FROM $table WHERE $key = '".$value."' ORDER BY $key DESC";
		$q  = $this->CI->db->query( $sel_q );
		$data = $q->row();
			if($data)
			{
				return $data->$get;
			}
				
	}






public function get_all_data($table,$key,$value) {

	$d = array();
		
	         $sel_q ="SELECT * FROM $table WHERE $key = '".$value."' ORDER BY $key DESC";
			$q  = $this->CI->db->query( $sel_q );
			$data = $q->result_array();


	return $data;


}

public function hindi_date($val="null") {
	switch($val) {
		case 'day':
				if(date('l') == 'Monday') {
					return 'सोमवार';
				
				}
				if(date('l') == 'Tuesday') {
					return 'मंगलवार';
				
				}
				if(date('l') == 'Wednesday') {
					return 'बुधवार';
				
				}
				if(date('l') == 'Thursday') {
					return 'गुरुवार';
				
				}
				if(date('l') == 'Friday') {
					return 'शुक्रवार';
				
				}
				if(date('l') == 'Saturday') {
					return 'शनिवार';
				
				}
				if(date('l') == 'Sunday') {
					return 'रविवार';				
				}
			break;
		case 'month':
				if(date('m') == '01') {
					return 'जनवरी';				
				}
				if(date('m') == '02') {
					return 'फ़रवरी';				
				}
				if(date('m') == '03') {
					return 'मार्च';				
				}
				if(date('m') == '04') {
					return 'अप्रैल';				
				}
				if(date('m') == '05') {
					return 'मई';				
				}
				if(date('m') == '06') {
					return 'जून';				
				}
				if(date('m') == '07') {
					return 'जुलाई';				
				}
				if(date('m') == '08') {
					return 'आगस्त';				
				}
				if(date('m') == '09') {
					return 'सितम्बर';				
				}
				if(date('m') == '10') {
					return 'अक्तूबर';				
				}
				if(date('m') == '11') {
					return 'नवेम्बर';				
				}
				if(date('m') == '12') {
					return 'दिसम्बर';				
				}
			break;
	
	}

}

public function filter_img($str) {
	//preg_match_all('#(src=".*?")#', $str, $results);
	  $content = preg_replace("/<img[^>]+\>/i", " ", $str); 
    return $content;
 
}

//function to return the heirarchy of the location
public function loc_details($loc_id) {
	$ctr=0;
	$parent_id = $this->getSingleValue('tbl_location','parent_id','id',$loc_id);
	$parent_alias = $this->getSingleValue('tbl_location','alias','id',$parent_id);
	$name = $this->getSingleValue('tbl_location','name','id',$loc_id);
	$alias = $this->getSingleValue('tbl_location','alias','id',$loc_id);
	$arr[$ctr]['id'] = $loc_id;
	$arr[$ctr]['name'] = $name;
	$arr[$ctr]['alias'] = $alias;
	$arr[$ctr]['url'] = $parent_alias.'/'.$alias;
	$loc_id = $parent_id;
	while($parent_id!=0) {
		$ctr++;
		$parent_id = $this->getSingleValue('tbl_location','parent_id','id',$loc_id);
		$parent_alias = $this->getSingleValue('tbl_location','alias','id',$parent_id);
		$name = $this->getSingleValue('tbl_location','name','id',$loc_id);
		$alias = $this->getSingleValue('tbl_location','alias','id',$loc_id);
		$arr[$ctr]['id'] = $loc_id;
		$arr[$ctr]['name'] = $name;
		$arr[$ctr]['alias'] = $alias;
		$arr[$ctr]['url'] = $parent_alias.'/'.$alias;
		$loc_id = $parent_id;
	}
	array_pop($arr); // remove country
	$arr = array_reverse($arr);
	return $arr;
}

// function to increase the read counter of any news 
public function read_art($art_id) {
	$read_count = $this->getSingleValue('tbl_article','read_count','id',$art_id);
	$read_count++;
	$sel_q ="UPDATE tbl_article set read_count= $read_count WHERE id = $art_id";
	$q  = $this->CI->db->query( $sel_q );
	$sel_q ="UPDATE tbl_media set read_count= $read_count WHERE art_id = $art_id";
	$q  = $this->CI->db->query( $sel_q );
}

public function loc_access_ids($user_id=null) {
	if($user_id == null){
		$user_id = $this->CI->session->userdata('id');
	}
	$sel_q ="SELECT loc_id FROM tbl_location_access WHERE user_id = '".$user_id."'";
	$q  = $this->CI->db->query( $sel_q );
	$res = $q->result_array();
	foreach($res as $val) {
		$loc_arr[] = $val['loc_id']; 
	}
	foreach($loc_arr as $val) {
		$arr = $this->get_all_data('tbl_location','parent_id',$val);
		if($arr) {

			foreach($arr as $val1) {
				$loc_arr[] = $val1['id'];
				$arr2 = $this->get_all_data('tbl_location','parent_id',$val1['id']);
				if($arr2) {
					foreach($arr2 as $val2) {
						$loc_arr[] = $val2['id'];
					}
				}
			}
		}
	}
	$loc_ids = array_unique($loc_arr);
	$loc_ids = implode($loc_ids,',');
	return $loc_ids;
	
}
// function get list of users with email which have location access to the current user
function get_connected_users($user_id=null) {
	if($user_id == null){
		$user_id = $this->CI->session->userdata('id');
	}
	$loc_ids = explode(',',$this->loc_access_ids());
	foreach($loc_ids as $loc) {
		$final_loc[] = $loc;
		$parent_id = $this->get_data('parent_id','tbl_location','id',$loc);
		while ($parent_id!=0) {
			$final_loc[] = $parent_id;
			$parent_id = $this->get_data('parent_id','tbl_location','id',$parent_id);
		
		}
	
	}
	$final_loc= array_unique($final_loc);
	print_r(array_unique($final_loc));
	$final_loc = implode($final_loc,',');
	$sel_q ="SELECT tbl_location_access.user_id, tbl_users.email 
	FROM tbl_location_access 
	left join tbl_users 
	on tbl_location_access.user_id = tbl_users.id WHERE tbl_location_access.loc_id in ( $final_loc)";
	$q  = $this->CI->db->query( $sel_q );
	$res = $q->result_array();
	foreach($res as $val) {
		$arr_user_ids[$val['user_id']] = $val['email']; 
	}
	return $arr_user_ids;
}

function country_state_district() {
	$loc_ids = explode(',',$this->loc_access_ids());
	foreach($loc_ids as $loc_id) {
		if($this->getSingleValue('tbl_location','type','id',$loc_id) == 'district') {
			$districts[] = $loc_id;
			$state_id = $this->getSingleValue('tbl_location','parent_id','id',$loc_id);
			$country_id = $this->getSingleValue('tbl_location','parent_id','id',$state_id);
			$states[] = $state_id;
			$countries[] = $country_id;
		}
		else if($this->getSingleValue('tbl_location','type','id',$loc_id) == 'state') {
			$country_id = $this->getSingleValue('tbl_location','parent_id','id',$loc_id);
			$countries[] = $country_id;
		}
		else if($this->getSingleValue('tbl_location','type','id',$loc_id) == 'country') {
			$countries[] = $loc_id;
		}
		
	}
	$districts = array_unique($districts);
	$states = array_unique($states);
	$countries = array_unique($countries);
	
	$loc_hier['districts'] = implode($districts,',');
	$loc_hier['states'] = implode($states,',');
	$loc_hier['countries'] = implode($countries,',');
	return $loc_hier;

}


function heir_country_to_district($loc_id) {
	$final_loc_ids[] = $loc_id;
	$cont = $this->get_all_data('tbl_location','type','continent');
	foreach($cont as $val) {
		$cont_ids[] = $val['id'];
	}
	
	if(in_array($loc_id,$cont_ids)) {
		$countries = $this->CI->db->query("SELECT id FROM tbl_location WHERE continent=$loc_id");
		$countries = $countries->result_array();
		foreach($countries as $val) {
			$country_arr[] = $val['id'];
		}
		$final_loc_ids = array_merge($final_loc_ids,$country_arr);
		for($i=0;$i<2;$i++){
			$test = implode(',',$final_loc_ids);
			$countries = $this->CI->db->query("SELECT id FROM tbl_location WHERE parent_id in ($test) ");
			$countries = $countries->result_array();
			foreach($countries as $val) {
				$country_arr[] = $val['id'];
			}
			$final_loc_ids = array_merge($final_loc_ids,$country_arr);
		
		}
	}
	else {
		for($i=0;$i<2;$i++){
			$test = implode(',',$final_loc_ids);
			$dist = $this->CI->db->query("SELECT id FROM tbl_location WHERE parent_id in ($test) ");
			$dist = $dist->result_array();
			if($dist) {
				foreach($dist as $val) {
					$dist_arr[] = $val['id'];
				}
				$final_loc_ids = array_merge($final_loc_ids,$dist_arr);
			}			
		}
	} 
	return array_unique($final_loc_ids);
}


function heir_country_to_district_country($loc_id,$inc) {
	$final_loc_ids[] = $loc_id;
	$cont = $this->get_all_data('tbl_location','type','continent');
	foreach($cont as $val) {
		$cont_ids[] = $val['id'];
	}
	
	if(in_array($loc_id,$cont_ids)) {
		print_r('cont');
		$countries = $this->CI->db->query("SELECT id FROM tbl_location WHERE continent=$loc_id");
		$countries = $countries->result_array();
		foreach($countries as $val) {
			$country_arr[] = $val['id'];
		}
		$final_loc_ids = array_merge($final_loc_ids,$country_arr);
		for($i=0;$i<2;$i++){
			$test = implode(',',$final_loc_ids);
			$countries = $this->CI->db->query("SELECT id FROM tbl_location WHERE parent_id in ($test) ");
			$countries = $countries->result_array();
			foreach($countries as $val) {
				$country_arr[] = $val['id'];
			}
			$final_loc_ids = array_merge($final_loc_ids,$country_arr);
		}
	}
	else {
		for($i=0;$i<1;$i++){
			$test = implode(',',$final_loc_ids);
			$dist = $this->CI->db->query("SELECT id FROM tbl_location WHERE parent_id in ($test) ");
			$dist = $dist->result_array();
			if($dist) {
				foreach($dist as $val) {
					$dist_arr[] = $val['id'];
				}
				$final_loc_ids = array_merge($final_loc_ids,$dist_arr);
			}			
		}
	}
	if($inc){
		return array_unique($final_loc_ids);
	}
	else {
		$countries = $this->CI->db->query("SELECT id FROM tbl_location WHERE type='country'");
		$countries = $countries->result_array();
		foreach($countries as $val) {
			$country_arr[] = $val['id'];
		}
		foreach ($country_arr as $val) {
			if(in_array($val,$final_loc_ids)){
				continue;
			}
			else {
				$new_arr[] = $val;
				}
		}
		return $new_arr;
	}
}

function sendMail($subject,$body,$email) {
	$get_smtp = new My_Emailconfig();
	$data = $get_smtp->getMailSetting();
	
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = $data['smtp_hostdebug']; 
	// "mail.yourdomain.com"; // SMTP server
	// commenting the following line out to check for popup fix (TS)
	//$mail->SMTPDebug  = $data['smtp_debug']; 
	//2; // enables SMTP debug information (for testing)
	// 1 = errors and messages
	// 2 = messages only
	$mail->SMTPAuth   = $data['smtp_auth']; 
	//true; // enable SMTP authentication
	$mail->SMTPSecure = $data['smtp_secure']; 
	//"ssl";    // sets the prefix to the servier
	$mail->Host       = $data['smtp_host']; 
	//"smtp.gmail.com"; //sets GMAIL as the SMTP server
	$mail->Port       = $data['smtp_port']; 
	//465; // set the SMTP port for the GMAIL server
	$mail->Username   = $data['smtp_user']; 
	//"gfndselva002@gmail.com"; // GMAIL username
	$mail->Password   = $data['smtp_pass']; 
	//"Gfndselvanew2";  // GMAIL password

	$mail->SetFrom($data['set_fromEmail'], $data['set_fromAddress']);

	$mail->AddReplyTo($data['set_replyEmail'],$data['set_replyAddress']);

	$mail->Subject    = $subject;

	$mail->AltBody    = $subject;

	$mail->MsgHTML($body);

	$address = trim($email,'');   
	$mail->AddAddress($address);
	$mail->Send();

} 

//function to increase the advertisement  visit ctr and clicked counter
function inc_view_ctr($ad_id) {
	$ctr = $this->getSingleValue('tbl_adds','show_ctr','id',$ad_id);
	$ctr++;
	$sel_q ="UPDATE tbl_adds set show_ctr= $ctr WHERE id = $ad_id";
	$q  = $this->CI->db->query( $sel_q );
}
function inc_click_ctr($ad_id) {
	$ctr = $this->getSingleValue('tbl_adds','click_ctr','id',$ad_id);
	$ctr++;
	$sel_q ="UPDATE tbl_adds set click_ctr= $ctr WHERE id = $ad_id";
	$q  = $this->CI->db->query( $sel_q );
}




// END Common Class
}
