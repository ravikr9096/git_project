    <!-- add new calendar event modal -->


	   <!--Fervendra Add Js-->
		 <!--<script src="<?php //echo base_url();?>assets/admin/js/jquery-1.9.1.js" ></script>-->
        <!--Fervendra Add Js-->


		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
		<!--<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
        

        <script src="<?php echo base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        

        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts 
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/plugins/morris/morris.min.js" type="text/javascript"></script>
		-->


        <!-- Sparkline -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
		   <!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		 <!-- CK Editor -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url();?>assets/admin/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url();?>assets/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) 
        <script src="<?php echo base_url();?>assets/admin/js/AdminLTE/dashboard.js" type="text/javascript"></script>     
		-->
		<!--Fervendra Add Js for Date picker-->
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
       <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/prototype.js"></script> 
        <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/AutoComplete.js"></script>-->

        <!--<script src="<?php echo base_url();?>assets/admin/js/jquery.js" type="text/javascript" language="javascript"></script>
        <script src="<?php echo base_url();?>assets/admin/js/jquery.MetaData.js" type="text/javascript" language="javascript"></script>
        <script src="<?php echo base_url();?>assets/admin/js/jquery.rating.js" type="text/javascript" language="javascript"></script>
        <link href="<?php echo base_url();?>assets/admin/css/jquery.rating.css" type="text/css" rel="stylesheet"/>-->

		<!-- page script -->
        <script type="text/javascript">

       /*$('#authorlist').bind('click', function(){
      alert('hi!');
      });*/

     /* $('#authorlist').click(function () {
        
        alert('vvvvv');
  });*/

       /*   $(document).ready(function() {
          $('#authorlist5').keyup(function() {
          alert($(this).val());
          });
          });
*/

         $(document).ready(function(){ 

          // Check /Uncheck asset 
          $('#prod_asset').on('ifChecked', function(event){
            $('#showprod').show(800);
            $('#prod_asset').val(1);
          });

          $('#prod_asset').on('ifUnchecked', function(event){
            $('#showprod').hide(800);
            $('#prod_asset').val(0);
          });

           $('#multipleAdd').on('ifChecked', function(event){
            $('#multipleAdd').val('on');
          });

           $('#multipleAdd').on('ifUnchecked', function(event){
            $('#multipleAdd').val('');
          });
          
           $('#notifyorder').on('ifChecked', function(event){
            $('#notifyorder').val(1);  
          });

           $('#notifyorder').on('ifUnchecked', function(event){
              $('#notifyorder').val(0);
          });

           $('#notifypayment').on('ifChecked', function(event){
           $('#notifypayment').val(1);
          });

           $('#notifypayment').on('ifUnchecked', function(event){
           $('#notifypayment').val(0);
          });


          $('#notify_customer').on('ifChecked', function(event){
              $('#btnproj').show();
              $('#btnproj1').hide();
           $('#notify_customer').val(1);
          });

           $('#notify_customer').on('ifUnchecked', function(event){
              $('#btnproj1').show();
              $('#btnproj').hide();
           $('#notify_customer').val(0);
          });

           $('#attrbunit').on('ifChecked', function(event){
            $('#attrunit').css({display: "block"});
            $('#attrunitgr').css({display: "block"});
            $('#attrbunit').val(1);
            $('#attrbunitgr').val(1);
          });

           $('#attrbunit').on('ifUnchecked', function(event){
             $('#attrunit').css({display: "none"});
             $('#attrunitgr').css({display: "none"});
             $('#attrbunit').val(0);
             $('#attrbunitgr').val(0);
          });

           $('#add').on('ifChecked', function(event){
           $('#add').val(1);
          });
          
           $('#add').on('ifUnchecked', function(event){
           $('#add').val(0);
          });

           $('#edit').on('ifChecked', function(event){
           $('#edit').val(1);
          });
          
           $('#edit').on('ifUnchecked', function(event){
           $('#edit').val(0);
          });

           $('#delete').on('ifChecked', function(event){
           $('#delete').val(1);
          });
          
           $('#delete').on('ifUnchecked', function(event){
           $('#delete').val(0);
          });

           $('#view').on('ifChecked', function(event){
           $('#view').val(1);
          });
          
           $('#view').on('ifUnchecked', function(event){
           $('#view').val(0);
          });








         /* if (!($('input#prod_asset').is(":checked")))
          {
            alert ('Please accept terms and conditions');
           // $('span#accept_error').text('Please accept terms and conditions');
            
            //return false; 
          } 
          else
          {
            alert ('Please  not');
          }*/

        //var dkkd = $('.icheckbox_minimal').prop('aria-checked');
        //alert(dkkd);

        $('#author').keyup(function (){
              //alert('bvcv');
                  var cname = $('#author').val();
                  var ckecklen = $('#author').val().length;
                  if(ckecklen > '2')
                  {
                     var urlfile = '<?php echo base_url();?>/index.php/adminReview/check_author';
                    $.ajax({      // ajax call starts
                    url: urlfile, // JQuery loads serverside.php
                    data: 'parent=' + cname,  // Send value of the clicked button
                    type: 'POST',
                    success : function(data){
                     // alert(data);
                      if(data!='2')
                      {
                        //$('#authname').css({display: "block"});
                        $('#authname').show(800);
                        $("#authname").html(data);
                        //return false;
                      }
                      else
                      {
                        $('#authname').css({display: "none"});
                      }
                    
                      }
                    });
                  }
            });
         });



             $('#authorgr').keyup(function (){
                   var cname = $('#authorgr').val();
                   var ckecklen = $('#authorgr').val().length;
                  if(ckecklen > 2)
                  {
                    var urlfile = '<?php echo base_url();?>/index.php/adminReview/check_authorgr';
                    $.ajax({      // ajax call starts
                    url: urlfile, // JQuery loads serverside.php
                    data: 'parent=' + cname,  // Send value of the clicked button
                    type: 'POST',
                    success : function(data){
                     alert(data);
                      if(data!='2')
                      {
                        $('#authnamegr').show(800);
                        $("#authnamegr").html(data);
                        
                      }
                      else
                      {
                        $('#authnamegr').css({display: "none"});
                      }
                    }
                  });
              }
           });
     

      ///FERVENDRA


    
       // new AutoComplete('my_ac3', '<?php echo base_url();?>/views/admin/templates/assets/ac.php?m=text&s=', { delay: 0.25, resultFormat: AutoComplete.Options.RESULT_FORMAT_TEXT }); 


        //$("#datepicker").datepicker({ dateFormat: 'dd-mm-yy' });

     /*  $(function() {
        $('#datepicker').datepicker({
        beforeShow: function (textbox, instance) {
        instance.dpDiv.css({
        marginTop: ('50') + 'px',
        marginLeft: '534' + 'px'
       
        
              });
             }
            });
         
        });      
        */

        var pickerOpts = { dateFormat: 'dd.mm.yy' }; 
       
        $("#datepicker").datepicker(pickerOpts);


        /*$( "#datepicker" ).datepicker({
        dateFormat: 'dd.mm.yy',
        beforeShow: function (textbox, instance) {
        instance.dpDiv.css({
        marginTop: ('-183') + 'px',
        marginLeft: '534' + 'px'
              });
            }
         });
*/


       // $("#datepicker").datepicker({ dateFormat: 'dd.mm.yy' });

        $("#enddate").datepicker({ dateFormat: 'dd.mm.yy' });
        $("#enddate6").datepicker({ dateFormat: 'dd.mm.yy' });
        $("#datepicker6").datepicker({ dateFormat: 'dd.mm.yy' });
        $("#end_date").datepicker({ dateFormat: 'yy-mm-dd' });
        

/*$(document).ready(function(){
     $('#example').dataTable()
      .columnFilter();
});*/



        $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
            });
        });
			
        $(function() {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });	
        </script>
	</body>
</html>