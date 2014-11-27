<?php

?>
<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Edit user';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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
					<?php echo form_open('adminUsers/update_user/'.$user_data['id']);?>
					<div class="form-group">
						<?php echo form_label('Username','user_name');?>
						<?php
							$data = array(
								'name'        => 'user_name',
								'id'          => 'user_name',
								'value'		=> $user_data['user_name'],
								'maxlength'   => '100',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								'readonly'	=> true,
								);
							echo form_input($data);
						?>
					</div>
					<div class="form-group">
						<?php echo form_label('Password','password');?>
						<?php
							$data = array(
								'name'        => 'password',
								'id'          => 'password',
								'value'		=> '',
								'maxlength'   => '100',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_password($data);
						?>
						<span style="font-size:12px;">Leave password blank if dont want to change</span>
					</div>
					<div class="form-group">
						<?php echo form_label('Confirm password','conf_pass');?>
						<?php
							$data = array(
								'name'        => 'conf_pass',
								'id'          => 'conf_pass',
								'value'		=> '',
								'maxlength'   => '100',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_password($data);
						?>
					</div>
					<div class="form-group">
						<?php echo form_label('First name','first_name');?>
						<?php
							$data = array(
								'name'        => 'first_name',
								'id'          => 'first_name',
								'value'		=> $user_data['first_name'],
								'maxlength'   => '100',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_input($data);
						?>
					</div>
					<div class="form-group">
						<?php echo form_label('Last name','last_name');?>
						<?php
							$data = array(
								'name'        => 'last_name',
								'id'          => 'last_name',
								'value'		=> $user_data['last_name'],
								'maxlength'   => '100',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_input($data);
						?>
					</div>
					<div class="form-group">
						<?php echo form_label('Email','email');?>
						<?php
							$data = array(
								'name'        => 'email',
								'id'          => 'email',
								'value'		=> $user_data['email'],
								'maxlength'   => '100',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_input($data);
						?>
					</div>
					<div class="form-group">
						<?php echo form_label('Gender','gender');?>
						<select name="gender">
						<option value="">--Select gender--</option>
						<option value="male" <?php if ($user_data['gender']=='male') echo "selected";?><?php echo set_select('gender', 'male'); ?>>Male</option>
						<option value="female" <?php if ($user_data['gender']=='female') echo "selected";?><?php echo set_select('gender', 'female'); ?>>Female</option>
						</select>
						
					</div>
					<div class="form-group">
						<?php echo form_label('Role','role_id');?>
						<select name="role_id">
						<option value="">--Select Role--</option>
						<?php foreach($roles_data as $role){
							if($user_data['role_id'] == $role[id]){
								echo '<option value="'.$role['id'].'" selected >'.$role['role_title'].'</option>';
							}
							else {
								echo '<option value="'.$role['id'].'" '.set_select('role_id', $role['id']).' >'.$role['role_title'].'</option>';
							}
						}?>
						</select>
						
					</div>
					<div class="form-group">
					
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
