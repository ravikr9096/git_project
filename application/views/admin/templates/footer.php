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
		<!-- Date/time picker -->
		<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
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
		
		<!-- change color of headings-->
        <script src="<?php echo base_url();?>assets/admin/js/colpick.js" type="text/javascript"></script>
		
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

       

         $(document).ready(function(){
			$('[data-toggle="popover"]').popover({
				trigger: 'hover',
				'placement': 'top',
				html:'true'
			});
			
			$("input[type=text]").on("keypress", function(e) {
				if (e.which === 32 && !this.value.length ){
					e.preventDefault();
				}
				if (this.value.length==1 && this.value==" " ){
					if(e.which !=8 && e.which !=0 && e.which !=13) { 	 
						this.value=e.key;						
					}
					e.preventDefault();

				}						
			});
			$("textarea").on("keypress", function(e) {
				if (e.which === 32 && !this.value.length ){
					e.preventDefault();
				}
				if (this.value.length==1 && this.value==" " ){
					if(e.which !=8 && e.which !=0 && e.which !=13) { 	 
						this.value=e.key;						
					}
					e.preventDefault();

				}	
			});
			
			//for pagelayout
			/* $( "#sortable" ).sortable(
				change:function () {
                var order = $("#sortable").sortable("toArray");
                $('#image_order').val(order.join(","));
                alert($('#image_order').val());

			}); */
			
			$( "#sortable" ).sortable({
				update: function( event, ui ) {
					var order = $("#sortable").sortable("toArray");
					$('#order').val(order.join(","));
					$('#submit_order').show(600);
				}
			});
			$( "#sortable" ).disableSelection();
			$( "#sortable1" ).sortable({
				update: function( event, ui ) {
					var order = $("#sortable1").sortable("toArray");
					$('#order1').val(order.join(","));
					$('#submit_order1').show(600);
				}
			});
			$( "#sortable1" ).disableSelection();

			//add focus for the locatio ui
			$('#add-country').on('shown.bs.modal', function () {
				$('#country_ad').focus();
			});
			$('#add-state').on('shown.bs.modal', function () {
				$('#state_ad').focus();
			});
			$('#add-district').on('shown.bs.modal', function () {
				$('#district_ad').focus();
			});
			$('#edit-district').on('shown.bs.modal', function () {
				$('#district').focus();
			});
			//add focus for the poll ui
			$('#add-poll').on('shown.bs.modal', function () {
				$('#poll_add').focus();
			});
			
			// change the value of seo-url based on alias
			$("#alias").on('focusout',function(){
				var val1 = $("#alias").val();
				val1 = val1.replace(/ /gi,'-');
				$("#seo_url").val(val1);
			});

			
			CKEDITOR.on('instanceReady', function(ev) {
				 check_images();
			});
			CKEDITOR.on('instanceCreated', function (e) {
				e.editor.on('contentDom', function () {
					e.editor.document.on('focus', function (event) {
						/* var str = CKEDITOR.instances['editor1'].getData();
						document.getElementById("mirror1").innerHTML = str; */
						check_images();
					});
					e.editor.document.on('keyup', function (event) {
						/* var str = CKEDITOR.instances['editor1'].getData();
						document.getElementById("mirror1").innerHTML = str; */
						check_images();
					});
				});
			 });
			 
			CKEDITOR.on('instanceCreated', function(e) {
				e.editor.on('change', function (event) {
					check_images();
				});
			}); 
			
		 	function check_images() {
				var value = CKEDITOR.instances['editor1'].getData();
				var url1 = "<?php echo base_url();?>index.php/adminPosts/get_images_from_content/";
				var saved_art_image = $("#saved_art_image").val();
				$.ajax({
					url: url1,
					type: "POST",
					dataType: 'json',
					data: "val="+escape(value),
					success: function(data){
						if(data!=0)
						{
							var i, currentElem;
							$("#uploaded_images").html("<label>Default article image</label></br>");
							for( i = 0, l = data.length; i < l; i++ ) {
							   
							  currentElem = data[i];
							  var arr = currentElem.split('"');
							  var abs_path = arr[1].split('/uploads');
							  var store_image = 'uploads'+abs_path[1];
							  console.log(store_image);
							  console.log(saved_art_image);
							  var flag="";
							  if( store_image == saved_art_image) {
								flag = "checked";
							  }
							  if(flag=="" && i==l-1) {
								flag = "checked";
							  }
							  $("#uploaded_images").append('<input name="art_image" '+flag+' type="radio" onclick="radio_clicked();" value="uploads'+abs_path[1]+'"/><img '+currentElem+'style="height:100px;width:105px;">&nbsp;&nbsp;');
							  //$("#uploaded_images").append('<input name="art_image" checked type="radio" onclick="radio_clicked();" value="'+arr[1]+'"/><img '+currentElem+'style="height:100px;width:105px;">&nbsp;&nbsp;');
							  // Do work with the current element
							   
							}
						}
						else
						{
							$("#uploaded_images").html("");
						}
					}
				});
				
			}
			
			
			$('.sparkpie').sparkline('html', {type: 'pie', height: '4.0em'});
			
			$('.picker').colpick({
				layout:'hex',
				submit:0,
				colorScheme:'dark',
				onChange:function(hsb,hex,rgb,el,bySetColor) {
					$(el).css('border-color','#'+hex);
					if(!bySetColor) $(el).val(hex);
				}
			}).keyup(function(){
				$(this).colpickSetColor(this.value);
			});
			
		});



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
            //CKEDITOR.replace('editor1');
			CKEDITOR.replace( 'editor1',
			{
				filebrowserBrowseUrl : '<?php echo base_url();?>assets/admin/browse.php?dir=<?php echo base_url();?>',
				filebrowserUploadUrl : '<?php echo base_url();?>assets/admin/upload.php?dir=<?php echo base_url();?>',
				extraPlugins: 'onchange',
				/* toolbar :  'basic', */
			});
			
            CKEDITOR.replace('editor2');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
			
		
        });	
		
		 $('.form_datetime').datetimepicker({
			format: "dd MM yyyy - hh:ii",
			autoclose: true,
			todayBtn: true,
			pickerPosition: "bottom-left",
			startDate:  new Date(),
		});
		$('.form_datetime1').datetimepicker({
			minView: 3,
			startView: 'year',
			maxView:3,
			autoclose: true,
			pickerPosition: "bottom-left"

		});
		

		function checkDelete()
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
		
		function articleModerate(post_id) {
			$('#art_status_'+post_id).html('<img src="<?php echo base_url()?>assets/admin/img/loader.gif" />');
			var url1='<?php echo base_url()?>adminPosts/toggle_status';
			$.ajax({
				url: url1,
				type: "POST",
				dataType: 'text',
				data: "post_id="+post_id,
				success: function(data){
					if(data == 'published') {
						$('#art_status_'+post_id).html('<img title="Published" src="<?php echo base_url()?>assets/admin/img/publish.png" />');
						
					}
					if(data == 'unpublished') {
						$('#art_status_'+post_id).html('<img title="Unpublished" src="<?php echo base_url()?>assets/admin/img/unpublish.png" />');
					
					}
				
				}
			
			});
			
		}
		
		function add_location_access() {
			var url1='<?php echo base_url()?>adminUsers/add_location_access';
			var loc_id = $("#loc_acc_id").val();
			var flag=0
			$(".loc_ids").each(function(){
				if(loc_id == $(this).val()) {
					flag=1;
				}
			});
			console.log(flag);
			if(loc_id == 0 || flag==1) {
				return false;
			}
			$.ajax({
				url: url1,
				type: "POST",
				dataType: 'json',
				data: "loc_id="+loc_id,
				success: function(data){
					$("#location_list table").append(data);	
				
				}
				
			
			});	

		}
		$("#country").change(function(){
				$("#loc_acc_id").val($(this).val());
			});



        </script>
	</body>
</html>