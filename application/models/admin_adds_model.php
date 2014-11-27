<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Adds_Model extends CI_Model{
   
    function __construct()
    {
       
        parent::__construct();

    }


    // save advertise value

    function save_add($data)
    {
		// location id save
		if(isset($data['district']) && @$data['district']!='' ) {
			unset($data['country']);
			unset($data['state']);
			$data['loc_id'] = $data['district'];
			unset($data['district']);
		}
		elseif(isset($data['state']) && @$data['state']!='') {
			unset($data['country']);
			$data['loc_id'] = $data['state'];
			unset($data['state']);
			unset($data['district']);
		}
		elseif(isset($data['country'])) {
			$data['loc_id'] = $data['country'];
			unset($data['country']);
			unset($data['state']);
		}
    

    	$this->db->insert('tbl_adds',$data);
    	if($this->db->affected_rows())
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    // get advertise values

    function get_advertise()
    {

        $this->db->order_by("id", "desc");
		/* filter result on the basis of location access*/
		if($this->session->userdata('user_type') == 'panel_user'){
			$loc_ids = $this->common->loc_access_ids();
			$this->db->where("(loc_id IN ($loc_ids))");
		}
        $query = $this->db->get('tbl_adds');
        $data  = $query->result_array();
        return $data;  
    }
	
	function get_ads_region() {
		$query = $this->db->get('tbl_ads_region');
        $data  = $query->result_array();
        return $data; 
	}


   // Delete Advertisement

    function delete($id)
    {

        $this->db->where('id',$id);
        $this->db->delete('tbl_adds');

        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }

    }
	
	function get_add_data($add_id) {
		$this->db->where('id',$add_id);
		$query = $this->db->get('tbl_adds');
        $data  = $query->row_array();
        return $data;
	}
	
	function get_ad_data($loc_id) {
		$this->db->where('loc_id',$loc_id);
		$this->db->order_by('loc_id','DESC');
		$query = $this->db->get('tbl_adds');
        $data  = $query->result_array();
		$final = [];
		foreach( $data as $key=>$val) { 
				$final[$val['region_id']] = $data[$key];		
		}
		for($i=1;$i<=9;$i++) {
			if(empty($final[$i])) {
				$parent_id = $this->common->getSingleValue('tbl_location','parent_id','id',$loc_id);
				if($parent_id>0) {
					$this->db->where('loc_id',$parent_id);
					$this->db->where('region_id',$i);
					$query = $this->db->get('tbl_adds');
					$data  = $query->row_array();
					$final[$i] = $data;
					if(empty($final[$i])) {
						$parent_id = $this->common->getSingleValue('tbl_location','parent_id','id',$parent_id);
						if($parent_id>0) {
							$this->db->where('loc_id',$parent_id);
							$this->db->where('region_id',$i);
							$query = $this->db->get('tbl_adds');
							$data  = $query->row_array();
							$final[$i] = $data;
							
						}
					}
				}
			
			}
		}
        return $final;
	}


    // update adds 

    function update_add()
    {

	$dis='';
	if($this->input->post('district')) {
			$dis =$this->input->post('district');
		}
		elseif($this->input->post('state')) {
			$dis =$this->input->post('state');
		}
		elseif($this->input->post('country')) {
			$dis =$this->input->post('country');
		}
		
     $data = array('title'=>$this->input->post('title'),'url'=>$this->input->post('url'),'region_id'=>$this->input->post('region') );
	if($dis) {
		$data['loc_id'] = $dis;
	}
     if($this->input->post('set_field1_'.$this->input->post('edit_id'))==1)
     {
        

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
                        $data['script_code'] = '';

                    }
                    }
                    else
                    {
                        $data['add_img'] = $this->input->post('ex_img');
                        $data['script_code'] = '';
                    }
                }



     }
     else
     {
        
        $data['script_code'] = $this->input->post('script_code');
        $data['add_img'] = '';

     }
        
        $this->db->where('id',$this->input->post('edit_id'));
        $this->db->update('tbl_adds',$data);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

// ******* model end ****** //
}