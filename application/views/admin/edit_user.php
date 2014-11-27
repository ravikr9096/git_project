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
					<?php echo form_open('adminUsers/update_user/'.$user_data['id']);?>
					<div class="form-group">
						<?php echo form_label('Username','user_name');?>
						<?php
							$data = array(
								'name'        => 'user_name',
								'id'          => 'user_name',
								'value'		=> $user_data['user_name'],
								'maxlength'   => '50',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								'readonly'	=> true,
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('user_name'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Password','password');?><span class="errors">*</span>
						<?php
							$data = array(
								'name'        => 'password',
								'id'          => 'password',
								'value'		=> '',
								'maxlength'   => '50',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_password($data);
						?>
						<div class="errors">
							<?php echo form_error('password'); ?>
						</div>
						<span style="font-size:12px;">Leave password blank if dont want to change</span>
					</div>
					<div class="form-group">
						<?php echo form_label('Confirm password','conf_pass');?><span class="errors">*</span>
						<?php
							$data = array(
								'name'        => 'conf_pass',
								'id'          => 'conf_pass',
								'value'		=> '',
								'maxlength'   => '50',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_password($data);
						?>
						<div class="errors">
							<?php echo form_error('conf_pass'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('First name','first_name');?><span class="errors">*</span>
						<?php
							$data = array(
								'name'        => 'first_name',
								'id'          => 'first_name',
								'value'		=> $user_data['first_name'],
								'maxlength'   => '50',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('first_name'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Last name','last_name');?><span class="errors">*</span>
						<?php
							$data = array(
								'name'        => 'last_name',
								'id'          => 'last_name',
								'value'		=> $user_data['last_name'],
								'maxlength'   => '50',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('last_name'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Email','email');?><span class="errors">*</span>
						<?php
							$data = array(
								'name'        => 'email',
								'id'          => 'email',
								'value'		=> $user_data['email'],
								'maxlength'   => '50',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('email'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Gender','gender');?>
						<select name="gender" class="form-control" style="width:200px;">
						<option value="">--Select gender--</option>
						<option value="male" <?php if ($user_data['gender']=='male') echo "selected";?><?php echo set_select('gender', 'male'); ?>>Male</option>
						<option value="female" <?php if ($user_data['gender']=='female') echo "selected";?><?php echo set_select('gender', 'female'); ?>>Female</option>
						</select>
						
					</div>
					<div class="form-group">
						<?php echo form_label('Role','role_id');?><span class="errors">*</span>
						<select name="role_id" class="form-control" style="width:200px;">
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
						<div class="errors">
							<?php echo form_error('role_id'); ?>
						</div>
						
					</div>
					<div class="row">
							<div class="col-md-6">
						<div class="form-group">
						<?php echo form_label('Country name','loc_id');?><span class="errors">*</span>&nbsp;&nbsp;&nbsp;<span class="help">Choose Country>>State>>district</span>
						<select title="Country" style="float:left;" class="form-control" id="country" onchange="get_State('<?php echo base_url();?>',this.value,'revname','sb');">
						 <option value="">- Select Country - </option>
						 <?php foreach($country as $val): ?>
						 <option value="<?php echo $val['id'];?>" <?php if($val['id']==$this->input->post('country')) { echo "selected";}?>><?php echo $val['name']?></option>
						 <?php endforeach; ?>
						   </select>
						   <div class="errors">
								<?php echo form_error('country'); ?>
							</div>

						</div>
						<div style="clear:both;">
						</div>
						
						<div class="form-group" style="display:none;" id="revname">
						</div>
						<div class="form-group" style="display:none;" id="revname1">

						</div>
						</div>
						<div class="col-md-1"><br/><br/><br/>
						<div class="form-group" id="added_locations">
							<input type="hidden" id="loc_acc_id" value="0" />
							<button id="add_location" class="btn btn-primary" onclick="add_location_access();return false;">Add >></button>
							
							
						</div>
						
						
						
						</div>
						<div class="col-md-5"><br/><br/>
						<label>Locations</label>
						<div id="location_list">
							<table id="show_loc_arr">
							<?php
									foreach($access_locations as $val) {
										echo '<tr><td><input type="hidden" class="loc_ids" readonly name="loc_id[]" value="'.$val['loc_id'].'"></td><td><input readonly type="text" class="loc_names" name="loc_name[]" value="'.$this->common->getSingleValue('tbl_location','name','id',$val['loc_id']).'"></td><td><a href="#" id="'.rand().'" onclick="remove_location(this.id);return false;"><i style="color:#3c8dbc" class="glyphicon glyphicon-remove"></i>&nbsp;Remove</a></td></tr>';
									}
								?>
							</table>
						</div>
						</div>
						</div>
					
					<div class="box-footer">
					<?php 
						$data = array(
						'id'          => 'submit',
						'maxlength'   => '16',
						'size'        => '50',
						'class'		=> 'btn btn-primary',
						'value'		=>'Submit',
						);
					echo form_submit($data);?>
					
					</div>
				</form>
				<div class="box-footer" style="margin-left: 80px; margin-top:-55px;"><a href="<?php echo base_url();?>index.php/adminUsers/show_users" tabindex="6"><button class='btn btn-primary'>Cancel</button></a></div>
			</div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
</aside>
