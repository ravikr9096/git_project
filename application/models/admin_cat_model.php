<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Ravi
 * Description: model related to the categories addition
 */
class Admin_Cat_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	//add category
	function add_cat($result) {
		$this->db->insert('tbl_category',$result);
		$insid = $this->db->insert_id();
		if($this->db->affected_rows())
		{
			$this->session->set_flashdata('msg_write', 'Category added successfully');
			if($result['sort']=='') {
				$this->db->where('id',$insid);
				$this->db->update('tbl_category',array('sort'=>$insid));
			}
			return true;
		}
		else{
			$this->session->set_flashdata('msg_write', 'Unable to add Category.Please try again');
			return false; 
		}
	}
	 //get categories data
	function get_cat() {
		//$this->db->where('status','1');
		$query = $this->db->get('tbl_category');
		$result = $query->result_array();
		return $result;
	} 
	 //get categories data
	function get_cat_front() {
		$this->db->where('status','1');
		$query = $this->db->get('tbl_category');
		$result = $query->result_array();
		return $result;
	} 

 
	//get particular cat details
	function get_cat_details($cat_id) {
		$this->db->where('id',$cat_id);
		$this->db->query('SET character_set_results=utf8');
		$query = $this->db->get('tbl_category');
		return $query->row_array();
	}
	
	//update category
	function update_cat($result,$cat_id) {
		if(!isset($result['show_in_menu'])){
			$result['show_in_menu']=0;
		}
		if(!isset($result['status'])){
			$result['status']=0;
		}
		
		$this->db->where('id',$cat_id);
		$this->db->update('tbl_category',$result);
		if($this->db->affected_rows())
		{
			$this->session->set_flashdata('msg_write', 'Category updated successfully');
			if($result['sort']=='') {
				$this->db->where('id',$insid);
				$this->db->update('tbl_category',array('sort'=>$insid));
			}
			return true;
		}
		else{
			return false; 
		}
	}
	//delete cat
	function delete_cat($cat_id) {
		$this->db->where('id',$cat_id);
		$this->db->delete('tbl_category');
		$this->session->set_flashdata('msg_write', 'Category deleted successfully');	
	}

	// add location country

	function save_country()
	{


		if(ctype_space($this->input->post('country')))
		{
			return false;
		}

		$this->db->where('name',$this->input->post('country'));
		$query = $this->db->get('tbl_location');

		if($query->num_rows > 0)
		{
			$this->session->set_flashdata('msg_wrong','Country already exist.');
			redirect('adminLocation/location');
		}

		$data = array(
               'name' => $this->input->post('country'),
               'type' => 'country',
               'alias' => $this->input->post('alias'),
               'continent' => $this->input->post('continent')
            );

			
		$this->db->insert('tbl_location', $data); 


		if($this->db->affected_rows())

				{
				return true;
				} 
				else
				{
				return false; 
				} 
	}

	// get country 

	public function get_country()
	{
	
	$this->db->order_by("name", "asc");	
	$this->db->where('type','country');
	if($this->session->userdata('id')!=1) {
		$c_id = $this->common->country_state_district();
		$c_id = $c_id['countries'];
		$this->db->where("id in ($c_id)");
	}

	$query = $this->db->get('tbl_location');
	return $query->result_array();
	
	}
	
	// get continents 

	public function get_continents()
	{
	
	$this->db->order_by("name", "asc");	
	$this->db->where('type','continent');
	$query = $this->db->get('tbl_location');
	return $query->result_array();
	
	}


	// add  country State

	function save_state()
	{

		if(ctype_space($this->input->post('state')))
		{
			return false;
		}
		$this->db->where('name',$this->input->post('state'));
		$query = $this->db->get('tbl_location');
		
		if($query->num_rows > 0)
		{
			$this->session->set_flashdata('msg_wrong','State already exist.');
			redirect('adminLocation/location');
		}




		$data = array(
               'name' => $this->input->post('state'),
               'type' => 'state',
               'alias' => $this->input->post('alias'),
               'parent_id' => $this->input->post('country')
            );

			
		$this->db->insert('tbl_location', $data); 
		if($this->db->affected_rows())

				{
				return true;
				} 
				else
				{
				return false; 
				} 
	}


   // add  country State

	function save_district()
	{

		if(ctype_space($this->input->post('district')))
		{
			return false;
		}

		$this->db->where('name',$this->input->post('district'));
		$query = $this->db->get('tbl_location');
		
		if($query->num_rows > 0)
		{
			$this->session->set_flashdata('msg_wrong','District already exist.');
			redirect('adminLocation/location');
		}



		$data = array(
               'name' => $this->input->post('district'),
               'type' => 'district',
               'alias' => $this->input->post('alias'),
               'parent_id' => $this->input->post('state')
            );

			
		$this->db->insert('tbl_location', $data); 
		if($this->db->affected_rows())

				{
				return true;
				} 
				else
				{
				return false; 
				} 
	}



   // get state for country

	function get_state()
	{
		
		$this->db->select('*');
		$this->db->order_by("name", "asc");
		$this->db->where('parent_id',$this->input->post('country'));
		$this->db->where('type','state');
		//populate only locations which are accessable
		if($this->session->userdata('id')!=1) {
		$sid = $this->common->country_state_district();
		$sid = $sid['states'];
		$this->db->where("id in ($sid)");
		}
		$query = $this->db->get('tbl_location');
        $data = $query->result_array();

        $count =  $query->num_rows();
    if($count > 0)
    {
    	if($this->input->post('add_on'))
    	{
    		$drop = '<label>State name</label><select class="form-control" id="state" name="state"  onchange="get_district_for_adds(\''.base_url().'\',this.value,\'revname1_edit_'.$this->input->post('ad_id').'\');change_regions();">';
    	}
    	else
    	{
    		$drop = '<label>State name</label><select class="form-control" id="state" name="state"  onchange="get_district(\''.base_url().'\',this.value,\'revname1\');change_regions();" tabindex="2">';
    	}
      
	  $drop.="<option value=''>--Select State--</option>";
      foreach ($data as $check) 
      {
       
         $drop .= "<option value='".$check['id']."''>".$check['name']."</option>";
      

      }
        $drop .="</select>";
        return $drop;  
     }
      else
      {
         return 0;
      } 


	 }

	 // get state for country at district edit time

	function get_state2()
	{

        $drop = '';
		$this->db->select('*');
		$this->db->order_by("name", "asc");
		$this->db->where('parent_id',$this->input->post('country'));
		$this->db->where('type','state');
		$query = $this->db->get('tbl_location');
        $data = $query->result_array();

        $count =  $query->num_rows();
    if($count > 0)
    {
      //$drop = '<select class="form-control" id="state" name="state">';
    	$drop .= '<option value="">- Select State -</option>';
      foreach ($data as $check) 
      {
       
         
         $drop .= "<option value='".$check['id']."''>".$check['name']."</option>";
      

      }
        //$drop .="</select>";
        return $drop;  
     }
      else
      {
         return 0;
      } 


	 }

	 
	//get district 
	 function get_district()
	{

		 $this->db->select('*');
		 $this->db->order_by("name", "asc");
		$this->db->where('parent_id',$this->input->post('state'));
		$this->db->where('type','district');
		//populate only locations which are accessable
		if($this->session->userdata('id')!=1) {
			$lid = $this->common->country_state_district();
			$lid = $lid['districts'];
			$this->db->where("id in ($lid)");
		}
		$query = $this->db->get('tbl_location');
        $data = $query->result_array();

        $count =  $query->num_rows();
    if($count > 0)
    {
      $drop = '<label>District name</label><select onchange="add_loc_access_id(this.value);" class="form-control" id="district" name="district" >';
	  $drop .= "<option value=''>--Select District--</option>";
      foreach ($data as $check) 
      {
       
         
         $drop .= "<option value='".$check['id']."''>".$check['name']."</option>";
      

      }
        $drop .="</select>";
        return $drop;  
     }
      else
      {
         return 0;
      } 


	 }


	 // get location 

	 function get_location()

	 {
	 	//$query = $this->db->query("SELECT id,name,type,parent_id,alias from tbl_location where type='district' order by name asc" );

	 	$this->db->select('*');
		$this->db->order_by("name", "asc");
		$this->db->where('type','district');
		$query = $this->db->get('tbl_location');
	 	return $query->result_array();


	 }

	 // delete location 

	 function delete($id)
	 {
	 	$this->db->where('id', $id);
        $this->db->delete('tbl_location'); 
         if($this->db->affected_rows())
		    {
		      return true;
		    }
        else 
		    {
		      return false; 
		    }
	 
	 }


	 // edit district

	 function edit_district()
	 {

	 	if(ctype_space($this->input->post('district')))
		{
			return false;
		}


	 	//print_r($this->input->post());
	 	$this->db->where('name',$this->input->post('district'));
		$query = $this->db->get('tbl_location');
		
		if($query->num_rows > 0)
		{
			$this->session->set_flashdata('msg_wrong','District already exist or you did not changed anything.');
			redirect('adminLocation/location');
		}



	 	$data = array('parent_id'=>$this->input->post('state'),'name'=>$this->input->post('district'),'alias'=>$this->input->post('alias'));

	 	$this->db->where('id',$this->input->post('district_edit_id'));
	 	$this->db->update('tbl_location',$data);
	 	
	 	 if($this->db->affected_rows())
			    {
			      return true;
			    }

		 else
		     {
		       return false; 
		     }

	  }
	 

    // function for check country delete 

	function check_for_delete()
	{

		$count = 0;
		$this->db->select('*');
		$this->db->where('parent_id',$this->input->post('id'));
		$query = $this->db->get('tbl_location');
        $data = $query->result_array();

        $count =  $query->num_rows();

        if($count > 0)
         {

         	return $count;
	     }

	     else
	     {
	     	$this->db->select('*');
			$this->db->where('loc_id',$this->input->post('id'));
			$query = $this->db->get('tbl_article');
	        $data  = $query->result_array();

	        $count =  $query->num_rows();

		        if($count > 0)
		        {
		        	return $count;
		        }
	     }

	     return $count;

    }


    // function for delete country 

    function delete_country()
    {

    	
    	    $count = 0;
    	    $this->db->select('*');
			$this->db->where('loc_id',$this->input->post('country_d'));
			$query = $this->db->get('tbl_article');
	        $count =  $query->num_rows();

	        if($count > 0)
	        {
	        	return false;
	        }

	        $this->db->select('*');
		    $this->db->where('parent_id',$this->input->post('country_d'));
		    $query = $this->db->get('tbl_location');
            $count =  $query->num_rows();

            if($count > 0)
	        {
	        	return false;
	        }

    	$this->db->where('id', $this->input->post('country_d'));
        $this->db->delete('tbl_location');

         if($this->db->affected_rows())
		    {
		      return true;
		    }
        else 
		    {
		      return false; 
		    }
    }

    // function for delete state 

    function delete_state()
    {

    	    $count = 0;
    	    $this->db->select('*');
			$this->db->where('loc_id',$this->input->post('state'));
			$query = $this->db->get('tbl_article');
	        $count =  $query->num_rows();

	        if($count > 0)
	        {
	        	return false;
	        }

	        $this->db->select('*');
		    $this->db->where('parent_id',$this->input->post('state'));
		    $query = $this->db->get('tbl_location');
            $count =  $query->num_rows();

            if($count > 0)
	        {
	        	return false;
	        }
    	
    	$this->db->where('id', $this->input->post('state'));
        $this->db->delete('tbl_location');

        if($this->db->affected_rows())
		    {
		      return true;
		    }
        else 
		    {
		      return false; 
		    }
    }


// function for check district delete 

	function chk_dis_delete($id)
	{

		    $count = 0;
		
	     	$this->db->select('*');
			$this->db->where('loc_id',$id);
			$query = $this->db->get('tbl_article');
	        $data  = $query->result_array();

	        $count =  $query->num_rows();

	        return $count;

    }
	
	/* to save order of the menu */
	function update_cat_order($order) {
		$i=1;
		foreach($order as $id) {
			
				$this->db->where('id',$id);
				$this->db->update('tbl_category',array('sort'=>$i));
		$i++;
		}
	
	}

	///////// model ends //////////
}
    