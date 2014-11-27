    <!-- add new calendar event modal -->


	   <!--Fervendra Add Js-->



		<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->

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
		 <!-- page script -->
        <script type="text/javascript">

		$(function() {
		// $("#datepicker").datepicker();
		 $('#datepicker').datepicker({
		 beforeShow: function (textbox, instance) {
						instance.dpDiv.css({
								marginTop: ('263') + 'px',
								marginLeft: '263' + 'px',
								dateFormat: "yy-mm-dd"
						});
				}
			});

		  });
		// $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val();
		
		 $(function() {

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
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });	
        </script>
	

    </body>
</html>