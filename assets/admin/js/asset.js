function checkValid()
{
  

  /*if(document.getElementById('prod_asset').checked)
  {
     document.getElementById('prod_asset').value = 1;
  }
  else
  {
     document.getElementById('prod_asset').value = 0;
  }*/

  
   /* var hhk =  $('#prod_asset').val();
    if(hhk == '1')
    {
      var attrbcat = $('#catsel').val();
      if(attrbcat == '')
      {
          $('.jjjjj').css({display: "block"});
          var inn = '<br/><div style="width:1069px;" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
          if(attrbcat == '')
          {
            inn += '<b>Please select product category.</b></div>';
          }
          $(".jjjjj").html(inn);
          parent.scrollTo(0, 0);
          return false;
      }

    }*/

  var assetname = $('#assetname').val();
  var assetdesc = $('#description').val();
  var categorytype = $('#categorytype').val();
  var section = $('#section').val();
  var asset_type = $('#asset_type').val();
  var asset_file = $('#asset_file').val();
  var asset_id = $('#asset_id').val();

  //attrbcat == '' ||
  if(asset_id!='')
  {
      if(assetname =='' ||  categorytype == '' || section =='' || assetdesc == '' || asset_type == '' || asset_file == '' )
      {
        
        $('.jjjjj').css({display: "block"});
        var inn = '<br/><div style="width:1069px;" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        if(assetname == '')
        {
          inn += '<b>Please enter asset name.</b><br/>';
          //$('#category_name').focus();
        }

        if(assetdesc == '')
        {
          inn += '<b>Please enter asset description.</b><br/>';
        }
        
        if(attrbcat == '')
        {
        
            inn += '<b>Please select product category.</b><br/>';
           
        }
      
        
        if(section == '')
        {
            inn += '<b>Please select section.</b><br/>';
            ///$('#category_name').focus();
        }

        if(categorytype == '')
        {
            inn += '<b>Please select category type.</b><br/>';
            ///$('#category_name').focus();
        }

        if(asset_type == '')
        {
          inn += '<b>Please select asset type.</b><br/>';
        }

        if(asset_file == '')
        {
           inn += '<b>Please choose asset file.</b></div>';
        }

        $(".jjjjj").html(inn);
        parent.scrollTo(0, 0);
        return false;*/
      }

     

     
  }
  else
  {
     alert('yyyy');

      
   /* var hhk =  $('#prod_asset').val();
    if(hhk == '1')
    {
      var attrbcat = $('#catsel').val();
      var attrprod = $('#prod_asset7').val();
      if(attrbcat == '' || attrprod == '')
      {
          $('.jjjjj').css({display: "block"});
          var inn = '<br/><div style="width:1069px;" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
          if(attrbcat == '')
          {
            inn += '<b>Please select product category.</b><br/>';
          }
          if(attrprod == '')
          {
            inn += '<b>Please select product.</b></div>';
          }
          $(".jjjjj").html(inn);
          parent.scrollTo(0, 0);
          return false;
      }
    }


*/
   



/*

      if(assetname =='' || attrbcat == '' || categorytype == '' || section =='' || assetdesc == '' || asset_type == '' || asset_file == '')
      {

        $('.jjjjj').css({display: "block"});
        var inn = '<br/><div style="width:1069px;" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        if(assetname == '')
        {
          inn += '<b>Please enter asset name.</b><br/>';
          //$('#category_name').focus();
        }

        if(assetdesc == '')
        {
          inn += '<b>Please enter asset description.</b><br/>';
        }
        
        if(attrbcat == '')
        {
        
            inn += '<b>Please select product category.</b><br/>';
            //$('#category_image').focus();
        }

        
        if(section == '')
        {
            inn += '<b>Please select section.</b><br/>';
            ///$('#category_name').focus();
        }

        if(categorytype == '')
        {
            inn += '<b>Please select category type.</b><br/>';
            ///$('#category_name').focus();
        }

        if(asset_type == '')
        {
          inn += '<b>Please select asset type.</b><br/>';
        }

        if(asset_file =='')
        {
          inn += '<b>Please choose asset file.</b></div>';
        }


        $(".jjjjj").html(inn);
        parent.scrollTo(0, 0);
        return false;
      }*/

  }
}





function testing()
{
  if(document.getElementById('prod_asset').checked)
  {
     document.getElementById('prod_asset').value = 1;
  }
  else
  {
     document.getElementById('prod_asset').value = 0;
  }
}

function checkstar()
{
  $('.test').html('');
  $('.star').each(function(){
   if(this.checked) $('.test').append(this.value+'');
   });
    var get = $('.test').html();
    $('#rate').val(get);
   return false;
}