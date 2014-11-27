<?php

?>
<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Delete role';?>  &nbsp;&nbsp;&nbsp;&nbsp;
		</h1>
		<!--<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">News</a></li>
			<li class="active">News</li>
		</ol>-->
	</section>

	<!-- Main content -->
	<?php include('templates/message.php');?>   
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="errors">
					<?php echo validation_errors(); ?>
					</div>
					<?php echo form_open('adminRoles/delete_role_data/'.$role_id);?>
					<div class="form-group">
						<?php echo form_label('Enter the role given to the user after this role is deleted','role_id');?>
						<select name="role_id">
						<option value="">--Select Role--</option>
						<?php foreach($roles_data as $role){
							echo '<option value="'.$role['id'].'" '.set_select('role_id', $role['id']).' >'.$role['role_title'].'</option>';
						}?>
						</select>
						
					</div>
					
					<div class="box-footer">
					<?php 
						$data = array(
						'id'          => 'submit',
						'maxlength'   => '100',
						'size'        => '50',
						'class'		=> 'btn btn-primary',
						'value'		=>'submit',
						);
					echo form_submit($data);?>
					</div>
				</form>
			</div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
</aside>
