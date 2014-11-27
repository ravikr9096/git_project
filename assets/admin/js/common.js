
var letters = /^[A-Za-z][a-zA-Z ]*$/; 
var alphanum = /^[a-zA-Z0-9 ]*$/; 
var empele = [];
var space = /^[a-zA-Z]*$/; 

/*$( document ).ready(function() {

    console.log( "ready!" );
	

});*/

function validateEmpty(fld) {
    var error = "";
	$(".err"+fld.id).remove();
    if (fld.value.length == 0) {
		var fld_title = $("#"+fld.id).attr('title');
		if(fld_title) {
			error = fld_title+" field is required.\n";
		}
		else {
			error = "Field is required.\n";
		}
		$(".err_txt"+fld.id).remove();
		$("#"+fld.id).after("<span id='errors' class='errors err"+fld.id+"'>"+error+"<br /></span>");
		fld.style.border='1px solid red';
		empele.push(fld.id);

    } 
    else {
        fld.style.background = 'White';
        fld.style.border='1px solid #ccc';
		$(".err"+fld.id).remove();

    }
    return error;   
}

function validateText(fld) {
    var error = "";
	$(".err_txt"+fld.id).remove();
	if (!fld.value.match(letters))
	{
       error = "contains illegal characters.\n";
	   $("#"+fld.id).after("<span id='errors' class='errors err_txt"+fld.id+"'>"+error+"<br /></span>");
       fld.style.border='1px solid red';
    }
   /*  else if (!fld.value.match(space))
	{
		error = "contains illegal characters.\n";
		$("#"+fld.id).after("<span id='errors' class='errors err_txt"+fld.id+"'>"+error+"</span>");
		fld.style.border='1px solid red';

    } */
	else {
			$(".err_txt"+fld.id).remove();
	}
    return error;
}

// check country validation

function validateCountry(theForm) {
var reason =reason1=reason2= "";

/*  reason += validateEmpty(theForm.alias_country);
  reason += validateEmpty(theForm.country);
  
  reason += validateText(theForm.country);
   reason += validateText(theForm.alias_country); */
   
reason += validateEmpty(theForm.country);
	
reason1 += validateEmpty(theForm.alias_country);
	if(reason1==''){
	reason1 += validateText(theForm.alias_country);
	}
reason2 += validateEmpty(theForm.continent);
      
  if (reason != "" || reason1!='' || reason2!='') {

    alert("Some fields need correction:\n");
    return false;

  }

  return true;
}

// check adds validation

function check_adds(theForm) {

  var reason = "";
  var check = $('#set_field').val();

  if(check==1)
  {

    reason += validateEmpty(theForm.add_img);
  }
  else if(check==2)
  {

   reason += validateEmpty(theForm.script_code);
   
  }
  reason += validateEmpty(theForm.title);
  reason += validateEmpty(theForm.country);
  reason += validateEmpty(theForm.state);
  //reason += validateEmpty(theForm.district);

  //reason += validateText(theForm.country);
 
      
  if (reason != "") {

    alert("Some fields need correction:\n" + reason);
    return false;

  }

  return true;
}


// check adds at edit time

function check_adds_edit(theForm) {

  var reason = "";

  var check = $('#set_field').val();

  if(check==1)
  {

    reason += validateEmpty(theForm.add_img);
  }
  else if(check==2)
  {

   reason += validateEmpty(theForm.script_code);
   
  }
  
  //reason += validateEmpty(theForm.district);
  reason += validateEmpty(theForm.title);
  //reason += validateText(theForm.country);
 
      
  if (reason != "") {

    alert("Some fields need correction:\n" + reason);
    return false;

  }

  return true;
}


function check_adds_edit_2(theForm,id) {

  var reason = "";
  reason += validateEmpty(theForm.title);
  var check = $('#set_field1_'+id).val();
  var ex_img = $("#ex_img").val();
  if(ex_img==""){
	if(check==1  )
	{
		reason += validateEmpty(theForm.add_img);
	}
  }
  else if(check==2)
  {

   reason += validateEmpty(theForm.script_code);
   
  }
  
  //reason += validateEmpty(theForm.district);
  //reason += validateText(theForm.country);
 
      
  if (reason != "") {

    alert("Some fields need correction:\n" + reason);
    return false;

  }

  return true;
}



// check state validation

function validateState(theForm) {
var reason = reason1 = "";

 
  reason += validateEmpty(theForm.country);
  reason += validateEmpty(theForm.state);
/*   reason += validateEmpty(theForm.alias_state);
  reason += validateText(theForm.alias_state); */

reason1 += validateEmpty(theForm.alias_state);
	if(reason1==''){
	reason1 += validateText(theForm.alias_state);
	}
	
  
  if (reason != "" ||reason1!="") {

    alert("Some fields need correction:\n");
    return false;

  }

  return true;
}

// check district validation

function validateDistrict(theForm) {
var reason = reason1= "";

 
  reason += validateEmpty(theForm.country);
  reason += validateEmpty(theForm.state);
  reason += validateEmpty(theForm.district);
  /* reason += validateEmpty(theForm.alias_district);
  reason += validateText(theForm.alias_district);   */
	reason1 += validateEmpty(theForm.alias_district);
	if(reason1==''){
	reason1 += validateText(theForm.alias_district);
	}  
  if (reason != "" || reason1!= "") {

    alert("Some fields need correction:\n");
    return false;

  }

  return true;
}


function validateEditDistrict(theForm,state_id) {
var reason = reason1= "";
//var state = "state"+state_id;
  reason += validateEmpty(theForm.country);
  reason += validateEmpty(theForm.state);
  reason += validateEmpty(theForm.district);

	reason1 += validateEmpty(theForm.alias);
	if(reason1==''){
	reason1 += validateText(theForm.alias);
	}
  if (reason != "" || reason1!= "") {

    alert("Some fields need correction:\n");
    return false;

  }

  return true;
}

// get State value from country select

function get_State(url,val,id,sb)
{

	//alert(val);
	$("#revname1").hide();
	var div = id;
	var sb = sb;
	var con = val;
	var url1 = url+"index.php/adminLocation/get_state/";
      $.ajax({
        url: url1,
        type: "POST",
        data: "country="+con,
         success: function(data)

         {
            //alert(data);
            if(data!='0')
        {
	         $("#"+div).show(600);
	         $("#"+div).html(data);
	         $("#"+sb).show(600);
			 $("#add_submit").show(600);

        
        }
      else
       {
	        $("#"+sb).hide(600);
          $("#add_submit").hide(600);
          $("#"+div).show(600);

	        $("#"+div).html('<p class="text-red" style="margin-bottom:-31px;">No state available<p>');

       }
            
       
   } });
}

// get District value  value from state select

function get_district(url,val,id)
{
	$("#loc_acc_id").val(val);
	//alert(val);
	var div = id;
	var con = val;
	var url1 = url+"index.php/adminLocation/get_district/";
      $.ajax({
        url: url1,
        type: "POST",
        data: "state="+con,
         success: function(data)

         {
            //alert(data);
            if(data!='0')
        {
	         $("#"+div).show(600);
	         $("#"+div).html(data);
           $("#warn_inf").hide(500);
           $("#add_submit").show(600);
        }
      else
       {

          $("#"+div).show(600);
          $("#warn_inf").show(400);
	        $("#"+div).html('<p class="text-red" style="margin-bottom:-31px;">No district available<p>');

       }
            
       
   } });
}

// get District value  value from state select

function get_district_for_adds(url,val,id)
{

  //alert(val);
  var div = id;
  var con = val;
  var url1 = url+"index.php/adminLocation/get_district/";
      $.ajax({
        url: url1,
        type: "POST",
        data: "state="+con,
         success: function(data)

         {
            //alert(data);
            if(data!='0')
        {
           $("#"+div).show(600);
           $("#"+div).html(data);
           //$("#warn_inf_edit").hide(500);
           //$("#add_sub_edit").show(600);
        }
      else
       {

          $("#"+div).show(600);
          //$("#add_sub_edit").hide(400);
          //$("#warn_inf_edit").show(400);
          $("#"+div).html('<p class="text-red" style="margin-bottom:-31px;">No district available<p>');

       }
            
       
   } });
}

// get State value from country select at edit district time

function get_State2(url,val,outter,inner,submit,id)
{

  //alert(id);
  var id = id;
  var sub = submit;
  var out = outter;
  var inn = inner;
  var con = val;
  var url1 = url+"index.php/adminLocation/get_state2/";
      $.ajax({
        url: url1,
        type: "POST",
        data: "country="+con,
         success: function(data)

         {
            //alert(data);
            if(data!='0')
        {
           
           //$("#"+inn).remove();
           $("#"+out).hide();
           $("#"+inn).show(600);
           $("#"+id).html(data);
           $('#'+sub).show(600);
           
        
        }
      else
       {
          $('#'+sub).hide(600);
          $("#"+inn).hide(600);
          $("#"+out).show(600);
          $("#"+out).html('<p class="text-red" style="margin-bottom:-31px;">No state available<p>');

       }
            
       
   } });


}


// get State value from country select

function get_State_for_adds(url,val,id,ad_id)
{

  $("#revname1_edit").hide();
  var div = id;
  var addval = 1;
 
  var con = val;
  var url1 = url+"index.php/adminLocation/get_state/";
      $.ajax({
        url: url1,
        type: "POST",
        data: "country="+con+"&add_on="+addval+"&ad_id="+ad_id,
         success: function(data)

         {

            if(data!='0')
        {
           $("#"+div).show(600);
           $("#"+div).html(data);
           //$("#add_sub_edit").hide(200);
        
        }
      else
       {
          //$("#add_sub_edit").hide(600);
          //$("#warn_inf_edit").show(600);
          $("#district").remove();
          $("#"+div).show(600);

          $("#"+div).html('<p class="text-red" style="margin-bottom:-31px;">No state available<p>');

       }
            
       
   } });
}

// check country delete authority

function country_delete(theForm)
{
  var reason = "";
  
  reason = validateEmpty(theForm.country_d);
  if (reason != "") {

    alert("Please select country:\n");
    return false;

  }
  else 
  {
      
      var check = confirm('Are you want to delete?'); 
      
         if(check==true)
         {
           
          return true;
               
         }
         else
         {
            return false;
         }

         
      
  }

}

// check country is available for delete

function check_con(url,id,del_s)
{
  //alert(id);
  var url1 = url+"index.php/adminLocation/check_for_delete/";
  
  var val = id;
  var d = del_s;
  $.ajax({
      
      url:url1,
      type:"POST",
      data: "id="+val,
      success: function(data)
      {
        //alert(data);
        if(data!=0)
        {
          alert("You can not delete.");
          $('#'+d).hide(500);
          return false;
        }
        else
        {
          $('#'+d).show(500);
         return true;
        }
        

      }

      });
}





// get State value for state delete

function get_State3(url,val)
{

  //alert(id);
  
  var con = val;
  var url1 = url+"index.php/adminLocation/get_state2/";
  if(!con) {
    $("#state").hide(600);
    $("#state_div").hide(600);
  }
  else{
      $.ajax({
        url: url1,
        type: "POST",
        data: "country="+con,
         success: function(data)

         {
            //alert(data);
            if(data!='0')
        {
           
           $("#state_div").show(600);
           $("#state").show(600);
           $("#state").html(data);
           //$('#del_s').show(600);
           
        
        }
      else
       {
          
          $('#del_s').hide(600);
        
          $("#state").html('<option value="">- No State available -</option>');
          //$("#"+out).html('<p class="text-red">No state available<p>');

       }
            
       
   } });
   }


}

 // function for showing or hide fields in advertisement add

 function show_image()
  {

    $('#set_field').val(1);  
    $("#s_img").show(400);
    $('#s_sc').hide(400);
  

  }


  function show_textarea()
  {

    $('#set_field').val(2); 
    $("#s_img").hide(400);
    $('#s_sc').show(400);

  }
  function show_image1(i)
  {

    $('#set_field1_'+i).val(1);  
    $("#s_img1_"+i).show(400);
    $('#s_sc1_'+i).hide(400);
  }


  function show_textarea1(i)
  {
    $('#set_field1_'+i).val(2); 
    $("#s_img1_"+i).hide(400);
    $('#s_sc1_'+i).show(400);

  }

  // function for set focus on fields

  function set_focus(id)
  {

    alert(id);
    var val = id;
    $('#'+val).focus();
  }
  
  function check_article(theForm) {
	empele = [];
	var reason=reason1=reason2= reason3= "";
	var value = CKEDITOR.instances['editor1'].getData();
	reason += validateEmpty(theForm.title);
	if(reason==''){
	reason += validateLength(theForm.title,2,500);
	}
	
	reason1 += validateEmpty(theForm.alias);
	if(reason1==''){
	reason1 += validateText1(theForm.alias);
	}
	if(reason1==''){
	reason1 += validateLength(theForm.alias,2,500);
	}
	
	//reason2 += validateEmpty(theForm.editor1);
	reason2 += validateEmpty(theForm.cat_id);
	reason2 += validateEmpty(theForm.country);
	reason3 += validateEmpty(theForm.publish_date);
	if(reason3 !="") {
		$(".form_datetime").css("border", "1px solid red");	
	}
	else {
		$(".form_datetime").css("border", "1px solid #ccc");	
	}
	
	
	var addDiv = $('#addinput');
	var s = $('#addinput div').size();
	for(i=0;i<s;i++) {
		if( !$('#p_new_'+i).val()) {
			$("#p_new_"+i).css("border", "1px solid red");
			reason2+="File field empty";		
			$("#p_new_"+i).after("<span class='errors' >Field can't be blank</span>");
		}
		else {
			$("#p_new_"+i).css("border", "1px solid #ccc");
		}
		
	}
	
	// check if the images are provided if include in slider is checked
	var flag=0;
	if($("#slider").is(":checked")){
		//console.log($("#uploaded_images").html());

		var i = $('#addinput div').size();
		for(var j=0;j<i;j++) {
			if($("#p_new_"+j).val()){
				flag=1;
			}
		}
		if($("#uploaded_images").html()) {
			flag=1;
		}
		if(flag==0) {
			alert('Please upload atleast one image to show in homepage slider');
			return false;
		}
			
	}
	
	/* content empty check */

	if(value=="" && $('#addinput div').size()==0 ) {
		alert('Please add some content');	
		return false;
	}
	

	
	if (reason!="" || reason1!="" || reason2!=""|| reason3!="" ) {

	//alert("Please fill the required fields");
		$("#"+empele[0]).focus();
	return false;

	}
	
	

	return true;
	
  }
  
  function check_edit_article(theForm) {
  empele = [];
	var reason=reason1=reason2= "";
	var value = CKEDITOR.instances['editor1'].getData();
	reason += validateEmpty(theForm.title);
	if(reason==''){
	reason += validateLength(theForm.title,2,500);
	}
	
	reason1 += validateEmpty(theForm.alias);
	if(reason1==''){
	reason1 += validateText1(theForm.alias);
	}
	if(reason1==''){
	reason1 += validateLength(theForm.alias,2,500);
	}

	reason2 += validateEmpty(theForm.cat_id);

	
	if (reason!="" || reason1!="" || reason2!="") {
	$("#"+empele[0]).focus();

	return false;

	}
	
	

	return true;
	
	
  } 
  
function validateAddPoll(theForm) {
  empele = [];
	$(".err_limit").remove();
	var reason=reason1=reason2= "";
	reason += validateEmpty(theForm.title);
	if(reason==''){
	reason += validateLength(theForm.title,2,100);
	}
	reason2 += validateEmpty(theForm.created_on);
	if (reason!="" || reason2!="") {	
		return false;
	}
	$("#"+empele[0]).focus();
	var error = "Add atleast 2 answer";
	var i = $('#more_ans_div div').size();
	var ctr=0;
	for(var j=0;j<=i;j++) {
		if($("#answers"+j).val() !="") {
			ctr++;
		}
	}
	if(ctr<=2){
		$("#more_ans_div").after("<span id='errors' class='errors err_limit'>"+error+"<br /></span>");
		return false;
	}

	return true;

  } 
function validateEditPoll(theForm) {
  empele = [];
	$(".err_limit").remove();
	var reason=reason1=reason2= "";
	reason += validateEmpty(theForm.title);
	if(reason==''){
	reason += validateLength(theForm.title,2,100);
	}
	reason2 += validateEmpty(theForm.created_on);
	if (reason!="" || reason2!="") {
	return false;
	}
	$("#"+empele[0]).focus();
	var error = "Add atleast 2 answer";
	var i = $('#more_ans_div div').size();
	var ctr=0;
	for(var j=0;j<=i;j++) {
		if($("#answers"+j).val() !="") {
			ctr++;
		}
	}
	if(ctr<=2){
		$("#more_ans_div").after("<span id='errors' class='errors err_limit'>"+error+"<br /></span>");
		return false;
	}

	
	return true;

  }
  
function validateText1(fld) {
    var error = "";
	$(".err"+fld.id).remove();
	if (!fld.value.match(alphanum))
	{
		error = "contains illegal characters.\n";
		$("#"+fld.id).after("<span id='errors' class='errors err"+fld.id+"'>Contains illegal characters.</span>");
		fld.style.border='1px solid red';
	}
	else {
			$(".err"+fld.id).remove();	        
	}
    return error;
}
function validateLength(fld,min,max) {
    var error = "";
	$(".err_len"+fld.id).remove();
	if (!(fld.value.length <= max && fld.value.length >= min))
	{
		
		error = "Length should be between "+min+" and "+max;
		$("#"+fld.id).after("<span id='errors' class='errors err_len"+fld.id+"'>Length should be between "+min+" and "+max+"</span>");
		fld.style.border='1px solid red';
	}
	else {
			$(".err_len"+fld.id).remove();	        
	}
    return error;
}

function add_loc_access_id(val1) {
	$("#loc_acc_id").val(val1);

}

function remove_location(e) {
	$('#'+e).closest('tr').remove();
	return false;
}


// handle regions on ad addition page
function homepage_regions() {
	if($("#country").val()){
		$('#region-wrap').show();
	}
	else {
		$('#region-wrap').hide();
	}
	//hide option 7,8,9
	$("#region option:gt(0)").show();
	$("#region option:gt(6)").hide();
	
	
}
function change_regions() {
	if($("#state").val()) {
		//hide option 5 and 6th
		$("#region option:gt(0)").show();
		$("#region option:gt(4)").hide();
		$("#region option:gt(6)").show();
		
	}
	else {
		//hide option 7,8,9
		$("#region option:gt(0)").show();
		$("#region option:gt(6)").hide();
	}

}



