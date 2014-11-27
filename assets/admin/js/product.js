function checkMultiple()
{
 alert('dsddd');
/*var hh =  $(".icheckbox_minimal").prop('aria-checked');
alert(hh);*/
 // var take = $('#multiple1').prop('checked');
 // alert(take);//

}


function updateOrder(type)
{
    // alert('fdgdfg');
    var parent = '';
    var order = $('#prodorder').val();
    var catid = $('#prod_id').val();
    var urlfile = '<?php echo base_url();?>/index.php/adminProduct/update_product_order';
    $.ajax({ // ajax call starts
    url: urlfile, // JQuery loads serverside.php
    data: 'parent=' + parent+'&type='+type+'&order='+order+'&catid='+catid,  // Send value of the clicked button
    type: 'POST',
    success : function(data){
    //alert(data);
    if(data!='')
    {
      $('#prodorder').val(data);
    }
    
  }
  });
}

function getProduct_order()
{
   // alert('cxcx');
    var parent = '';
    var urlfile = '<?php echo base_url();?>/index.php/adminProduct/get_product_order';
    $.ajax({ // ajax call starts
      url: urlfile, // JQuery loads serverside.php
      data: 'parent=' + parent,  // Send value of the clicked button
      type: 'POST',
      success : function(data){
      //alert(data);
      $('#prodorder').val(data);
     
    }
    });
}




function GetAllowedProducts(cat_id,name)
{
  //alert(cat_id);
 
  var type = name.slice(-1);
  // alert(type);
  var ssss = $("#prod_category"+type+" option:selected").text();
  //$('#prod_category'+type).text();
  //alert(type);
  var urlfile = '<?php echo base_url();?>/index.php/adminProduct/get_filter_products';
  //alert(urlfile);
  $.ajax({      // ajax call starts
  url: urlfile, // JQuery loads serverside.php
  data: 'prodcat=' + cat_id + '&comtype='+type,  // Send value of the clicked button
  type: 'POST',
  success : function(data){
   //alert(data);
   //alert("proda"+type);

    $("#proda"+type).html(data);
    $("#numtype"+type).attr("placeholder","No. of "+ssss);
    }
  });
 
}

function calltype(a2)
{
    // var a2 = document.getElementById('file_translate').value; 
   //alert('dsdsd');
   var a1 = a2.split('.');
   var totlen = a1.length-1;
   if(a1.length>1){
     var a = a1[totlen].toLowerCase();
     if (a == "jpeg" || a == "jpg" || a == "gif" || a == "png")
     {
        return true;
     }
     else
     {
        $('.jjjjj').css({display: "block"});
        var inn = '<br/><div style="width:1069px;" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        inn += '<b>Please upload only image files</b></div>';
        $(".jjjjj").html(inn);
        parent.scrollTo(0, 0);
        return false;

     }
   }
   else
   {
        $('.jjjjj').css({display: "block"});
        var inn = '<br/><div style="width:1069px;" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        inn += '<b>Please upload files</b></div>';
        $(".jjjjj").html(inn);
        parent.scrollTo(0, 0);
        return false;
   }

}
function checkValidations()
{
    var catsel = $('#catsel').val();
    var prodname = $('#prodname').val();
    var proddesc = $('#proddesc').val();
    var imgval = $('#imgval1').val();
    var prodquantity = $('#prodquantity').val();
    var prodmeta = $('#prodmeta').val();
    var prodkey = $('#prodkey').val();
    var prodprice = $('#prodprice').val();
    var rbselcat = $('#rbselcat').val();
    var shiptimein = $('#shiptimein').val();
    var shiptimeout = $('#shiptimeout').val();
    var prodorder = $('#prodorder').val();
    var prod_type = $('#prod_type').val();
    var pro_ids = $('#prod_id').val();
   /* var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();*/
 
    if(catsel =='' || prodname == '' || proddesc == '' || imgval == '' || prodquantity == '' || prodprice == '' || rbselcat == '' || shiptimein == '' || shiptimeout == '' || prod_type == '')
    {
      
      $('.jjjjj').css({display: "block"});
      var inn = '<br/><div style="width:1069px;" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
      if(catsel == '')
      {
        inn += '<b>Please select category</b><br/>';
        //$('#category_name').focus();
      }

      if(prodname == '')
      {
        inn += '<b>Please enter product name</b><br/>';
        //$('#category_image').focus();
      }
      
      if(proddesc == '')
      {
        inn += '<b>Please enter product description</b><br/>';
        ///$('#category_name').focus();
      }
      
      
      if(imgval == '')
      {
        inn += '<b>Please choose product image</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(prodquantity == '')
      {
        inn += '<b>Please enter product quantity</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(prodprice == '')
      {
        inn += '<b>Please enter product price</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(rbselcat == '')
      {
        inn += '<b>Please select rebate category</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(shiptimein == '')
      {
        inn += '<b>Please enter Shipping time in stock</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(shiptimeout == '')
      {
        inn += '<b>Please enter Shipping time out of stock</b><br/>';
        ///$('#category_name').focus();
      }
      
      /*if(prodorder == '')
      {
        inn += '<b>Please enter product order</b><br/>';
        ///$('#category_name').focus();
      }*/
      
      if(prod_type == '')
      {
        inn += '<b>Please select product type</b></div>';
        ///$('#category_name').focus();
      }
      $(".jjjjj").html(inn);
      parent.scrollTo(0, 0);
      return false;
    }
}



function checkValidationedit()
{
    var prodname = $('#prodname').val();
    var proddesc = $('#proddesc').val();
    var prodquantity = $('#prodquantity').val();
    var prodmeta = $('#prodmeta').val();
    var prodkey = $('#prodkey').val();
    var prodprice = $('#prodprice').val();
    var rbselcat = $('#rbselcat').val();
    var shiptimein = $('#shiptimein').val();
    var shiptimeout = $('#shiptimeout').val();
    var prodorder = $('#prodorder').val();
    var prod_type = $('#prod_type').val();
    /* var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();
    var category_id = $('#prodquantity').val();*/
 
    if( prodname == '' || proddesc == '' || prodquantity == '' || prodprice == '' || rbselcat == '' || shiptimein == '' || shiptimeout == '' || prod_type == '')
    {
      
      $('.jjjjj').css({display: "block"});
      var inn = '<br/><div style="width:1069px;" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
      if(prodname == '')
      {
        inn += '<b>Please enter product name</b><br/>';
        //$('#category_image').focus();
      }
      
      if(proddesc == '')
      {
        inn += '<b>Please enter product description</b><br/>';
        ///$('#category_name').focus();
      }
      
      
      if(prodquantity == '')
      {
        inn += '<b>Please enter product quantity</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(prodprice == '')
      {
        inn += '<b>Please enter product price</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(rbselcat == '')
      {
        inn += '<b>Please select rebate category</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(shiptimein == '')
      {
        inn += '<b>Please enter Shipping time in stock</b><br/>';
        ///$('#category_name').focus();
      }
      
      if(shiptimeout == '')
      {
        inn += '<b>Please enter Shipping time out of stock</b><br/>';
        ///$('#category_name').focus();
      }
      
      /*if(prodorder == '')
      {
        inn += '<b>Please enter product order</b><br/>';
        ///$('#category_name').focus();
      }*/
      
      if(prod_type == '')
      {
        inn += '<b>Please select product type</b></div>';
        ///$('#category_name').focus();
      }
      $(".jjjjj").html(inn);
      parent.scrollTo(0, 0);
      return false;
    }
}



function checkProdType()
{
   //alert('cccc');

   var chktype = document.getElementById('prod_type').value;
  // alert(chktype);

   if(chktype == 'configured')
   {
     // alert(chktype);
     // $('#conf_prod4').css({display: "block"});
      $('#conf_prod').show(1000);
      $('#showlink').show();
     
   }
   if(chktype == 'single')
   {
     // $('#conf_prod').css({display: "none"});
      $('#conf_prod').hide(1000);
   }
}


function addMoreAttrbBox()
{
    var vv = $('#attrval').val();
    if(vv =='')
    {
      //var texts = '<div class="form-group"><label>Attributes</label></div><table style="margin-bottom:10px;"><tr><td>'+"<?php echo  $this->common->getAttributeSelect(2); ?>"+'</td><td style="padding-left:30px;"><input type="text" class="form-control" size="50" name="attrb_value[]" value="" placeholder="Value"/></td></tr></table>';
      var texts = '<div class="form-group"><label>Attributes</label></div><table style="margin-bottom:10px;"><tr><td>'+"<?php echo  $this->common->getAttributeSelect(); ?>"+'</td><td style="padding-left:30px;"><input type="text" class="form-control" size="50" name="attrb_value[]" value="" placeholder="Value"/></td></tr></table>';
      
      $('#attrval').val(2);
      $('#attribute_start').append(texts);

    }
    else
    {
      var new1 = parseInt(vv)+1;
      //var texts = '<div class="form-group"><label>Attributes</label></div><table style="margin-bottom:10px;"><tr><td>'+"<?php echo  $this->common->getAttributeSelect('"+new1+"'); ?>"+'</td><td style="padding-left:30px;"><input type="text" class="form-control" size="50" name="attrb_value[]" value="" placeholder="Value"/></td></tr></table>';
     var texts = '<div class="form-group"><label>Attributes</label></div><table style="margin-bottom:10px;"><tr><td>'+"<?php echo  $this->common->getAttributeSelect(); ?>"+'</td><td style="padding-left:30px;"><input type="text" class="form-control" size="50" name="attrb_value[]" value="" placeholder="Value"/></td></tr></table>';
     
      $('#attrval').val(new1);
      $('#attribute_start').append(texts);
    }   
}

function addMoreComponentBox()
{
    alert('box');

    var prod_id = $('#comp').val();
    var vv = $('#comp').val();
    if(vv =='')
    {
    // var selectedValues = $('#prod_category1').val();
     var noneed = $('#prod_category1').val();
     //alert(noneed);
     //var texts = '<div class="form-group"><label>Product</label></div><table style="margin-bottom:10px;"><tr><td>'+"<?php echo  $this->common->getAttributeSelect(2); ?>"+'</td><td style="padding-left:30px;"><input type="text" class="form-control" size="50" name="attrb_value[]" value="" placeholder="Value"/></td></tr></table>';
    
     var texts = '<div class="form-group"><label>Category</label><br/>'+"<?php echo  $this->common->getComponentCategory(0,2,"+noneed+");?>"+'</div><div class="form-group"><label>Products Allowed</label><br/><table><tr><td id="proda2"><select disabled="disabled" name="prod_comp_category2[]" multiple="" style="width:200px" class="form-control" ><option value="cpu1">CPU 1</option><option value="cpu2">CPU 2</option><option value="cpu3">CPU 3</option></select></td><td style="padding-left:30px;vertical-align:top;"><input type="text" class="form-control" size="50" id="numtype2" name="no_of_type[]" value="" /><br/><input type="checkbox" name="prod_multiple2" id="prod_multiple2" value="1"/>&nbsp;&nbsp;&nbsp; Multiple Selection</td></tr></table></div></div>';

    // var texts = '<div class="form-group"><label>Category</label><br/></div><div class="form-group"><label>Products Allowed</label><br/><table><tr><td id="proda2"><select disabled="disabled" name="prod_comp_category2[]" multiple="" style="width:200px" class="form-control" ><option value="cpu1">CPU 1</option><option value="cpu2">CPU 2</option><option value="cpu3">CPU 3</option></select></td><td style="padding-left:30px;vertical-align:top;"><input type="text" class="form-control" size="50" id="numtype2" name="no_of_type[]" value="" /><br/><input type="checkbox" name="prod_multiple[]">&nbsp;&nbsp;&nbsp; Multiple Selection</td></tr></table></div>';

   // alert(texts);



      $('#comp').val(2);
      $('#add_cmp').html(texts);
      $('#conf_prod').append(texts);

      //$('#add_cmp5').css({display: "block"});
      // $('#add_cmp5').html(texts);
      //$('#dddd').css({display: "none"});
       
    }
    else
    {
      var noneed = $('#prod_category'+vv).val();
      var new1 = parseInt(vv)+1;
      var texts = '<div class="form-group"><label>Category</label><br/>'+"<?php echo  $this->common->getComponentCategory(0,'"+new1+"','"+noneed+"');?>"+'</div><div class="form-group"><label>Products Allowed</label><br/><table><tr><td id="proda'+new1+'"><select name="prod_comp_category'+new1+'[]" multiple="" style="width:200px" class="form-control" ><option value="cpu1">CPU 1</option><option value="cpu2">CPU 2</option><option value="cpu3">CPU 3</option></select></td><td style="padding-left:30px;vertical-align:top;"><input type="text" class="form-control" id="numtype'+new1+'" size="50" name="no_of_type[]" value="" /><br/><input type="checkbox"  name="prod_multiple'+new1+'" id="prod_multiple'+new1+'" value="1" />&nbsp;&nbsp;&nbsp; Multiple Selection</td></tr></table></div></div>';
     
      $('#comp').val(new1);
      $('#conf_prod').append(texts);
      // $('#add_cmp').html(texts);
     
      
    }   
    
    
}

function addMoreImageBox()
{
    var vv = $('#imgval').val();
    if(vv =='')
    {
      var texts = '<span style="margin-bottom:10px;"><input type="file" name="userfile1" /></span><br/>';
      $('#imgval').val(1);
      $('#imgblock').append(texts);
    }
    else
    {
      var new1 = parseInt(vv)+1;
      var texts = '<span style="margin-bottom:10px;"><input type="file" name="userfile'+new1+'" /></span><br/>';
      $('#imgval').val(new1);
      $('#imgblock').append(texts);
    }  
}


function addMoreAttrib()
{
  var cat_id = '';
  var urlfile = '<?php echo base_url();?>/index.php/adminProduct/get_new_attribute';
  $.ajax({      // ajax call starts
  url: urlfile, // JQuery loads serverside.php
  data: 'type =' + cat_id,  // Send value of the clicked button
  type: 'POST',
  success : function(data){
     //alert(data);
      var vv = $('#attrval').val();
      var new1 = parseInt(vv)+1;
      $('#attrval').val(new1);
      $('#newattt').append(data);
    
    }
  });
}


function deleteImage(img)
{
  var kkkk = img;
  var urlfile = '<?php echo base_url();?>/index.php/adminProduct/delete_product_image';
 // alert(kkkk);
 // alert(urlfile);
  $.ajax({      // ajax call starts
  url: urlfile, // JQuery loads serverside.php
  data: 'imgid='+kkkk,  // Send value of the clicked button
  type: 'POST',
  success : function(data){
    //alert(data);
    if(data=='1')
    {
      $("#delimg"+kkkk).hide(1000);
      $("#delimgp"+kkkk).hide();
    }
  }
  });
}


function addMoreComp()
{
  
  var yyy = $('#cat_dd').val();
  var vv = $('#comp').val();
  var urlfile = '<?php echo base_url();?>/index.php/adminProduct/get_new_component';
  var myCars = new Array(yyy);
  //

  if(vv!='')
  {
    var noneed = []; 
    for (var i = 1; i<=vv; i++) {
       noneed[i] = $('#prod_category'+i).val();

    };   
  }
  else
  {
    var noneed = $('#prod_category'+vv).val();
  }
  
  $.ajax({      // ajax call starts
  url: urlfile, // JQuery loads serverside.php
  data: 'oldcat='+myCars+'&ordval='+vv+'&noneed='+noneed,  // Send value of the clicked button
  type: 'POST',
  success : function(data){
     //alert(data);
     // var vv = $('#attrval').val();
     // var new1 = parseInt(vv)+1;
     // $('#attrval').val(new1);
      if(vv == '')
      {
         var new1 = 1;
      }
      else
      {
        var new1 = parseInt(vv)+1;
      }
      
      $('#comp').val(new1);
      $('#dddd').css({ display: "none"});
      $('#compo34').append(data);
      $('#showlink').css({ display: "block"});
      /*if(vv == '1')
      {
         $('#openlink').css({ display: "block"});
      }
      else
      {
        $('#openlink').css({ display: "none"});
        $('#showlink').css({ display: "block"});
      }
      */
    
    }
  });
}