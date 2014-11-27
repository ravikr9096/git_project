<?php 
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 //verify access based on role 
function access_check($check_value="null") {
	$CI = &get_instance();
	
	//check for admin user
	/* if($check_value == "is_admin") {
		return true;	
	} */
	//check for admin user hardcoded for admin
	if($CI->session->userdata('user_role') == 0) {
		return true;
	}
	$role_access = $CI->session->userdata('role_access');
	//check for other users
	if(@$role_access[$check_value] ){
		return true;
	}
	else {
		return false;
	}
}

function post_access_check($post_id) {
	$CI = &get_instance();
	//check for admin user
	if($CI->session->userdata('user_role') == 0) {
		return true;
	}
	elseif($CI->common->getSingleValue('tbl_article','author','id',$post_id) == $CI->session->userdata('id')) {
		return true;
	
	}
	else {
		$test = in_array($CI->common->getSingleValue('tbl_article','loc_id','id',$post_id), explode(',',$CI->common->loc_access_ids()));
		return $test;
	}
}
function role_access_check($role_id) {
	$CI = &get_instance();
	//check for admin user
	if($CI->session->userdata('user_role') == 0) {
		return true;
	}
	else {
		$has_own = $CI->common->getSingleValue('tbl_roles','created_by','id',$role_id);
		if( $has_own == $CI->session->userdata('id')) {
			return true;
		}
		else {
		return false;
		}
		
	}
}
function user_access_check($user_id) {
	$CI = &get_instance();
	//check for admin user
	if($CI->session->userdata('user_role') == 0) {
		return true;
	}
	else {
		$has_own = $CI->common->getSingleValue('tbl_users','created_by','id',$user_id);
		if( $has_own == $CI->session->userdata('id')) {
			return true;
		}
		else {
		return false;
		}
		
	}
}

?>