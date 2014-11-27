<?php

?>
<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Edit role';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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
			<?php if(access_check('pusr_update') || access_check('pusr_update')):?>	
				<div class="box">
					<?php echo form_open('adminRoles/update_role/'.$role_data['id']);?>
					<div class="form-group">
						<?php echo form_label('Role','role_title');?><span class="errors">*</span>
						<?php
							$data = array(
								'name'        => 'role_title',
								'id'          => 'role_title',
								'maxlength'   => '100',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								'value'		=>$role_data['role_title'],
								'readonly'	=> true,
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('role_title'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Description','role_desc');?><span class="errors">*</span>
						<?php
							$data = array(
								'name'        => 'role_desc',
								'id'          => 'role_desc',
								'maxlength'   => '100',
								'size'        => '50',
								'style'       => 'width:50%',
								'class'		=> 'form-control',
								'value'		=>$role_data['role_desc'],
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('role_desc'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Manage permissions');?>
						<table class="table table-bordered table-hover">
							<!--<table id="example1" class="table table-bordered table-hover">-->
								<thead>
									<tr>
										<th><?php echo 'Components';?></th>
										<th><?php echo 'Create';?></th>
										<th><?php echo 'Read';?></th>
										<th><?php echo 'Update';?></th>
										<th><?php echo 'Delete';?></th>
										<th><?php echo 'Moderate';?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Articles</td>
										<td><?php echo form_checkbox('art_create', 'accept',$role_data['art_create']);?></td>
										<td><?php echo form_checkbox('art_read', 'accept',$role_data['art_read']);?></td>
										<td><?php echo form_checkbox('art_update', 'accept',$role_data['art_update']);?></td>
										<td><?php echo form_checkbox('art_delete', 'accept',$role_data['art_delete']);?></td>
										<td><?php echo form_checkbox('art_mod', 'accept',$role_data['art_mod']);?></td>
									</tr>
									<tr>
										<td>Adverisements</td>
										<td><?php echo form_checkbox('ads_create', 'accept' ,$role_data['ads_create']);?></td>
										<td><?php echo form_checkbox('ads_read', 'accept' ,$role_data['ads_read']);?></td>
										<td><?php echo form_checkbox('ads_update', 'accept' ,$role_data['ads_update']);?></td>
										<td><?php echo form_checkbox('ads_delete', 'accept' ,$role_data['ads_delete']);?></td>
										<td><?php echo form_checkbox('ads_mod', 'accept' ,$role_data['ads_mod']);?></td>
									</tr>
									<tr>
										<td>Polls</td>
										<td><?php echo form_checkbox('polls_create', 'accept' ,$role_data['polls_create']);?></td>
										<td><?php echo form_checkbox('polls_read', 'accept' ,$role_data['polls_read']);?></td>
										<td><?php echo form_checkbox('polls_update', 'accept' ,$role_data['polls_update']);?></td>
										<td><?php echo form_checkbox('polls_delete', 'accept' ,$role_data['polls_delete']);?></td>
										<td><?php echo form_checkbox('polls_mod', 'accept' ,$role_data['polls_mod']);?></td>
									</tr>
									<tr>
										<td>Comments</td>
										<td><?php echo form_checkbox('cmnt_create', 'accept' ,$role_data['cmnt_create']);?></td>
										<td><?php echo form_checkbox('cmnt_read', 'accept' ,$role_data['cmnt_read']);?></td>
										<td><?php echo form_checkbox('cmnt_update', 'accept' ,$role_data['cmnt_update']);?></td>
										<td><?php echo form_checkbox('cmnt_delete', 'accept' ,$role_data['cmnt_delete']);?></td>
										<td><?php echo form_checkbox('cmnt_mod', 'accept' ,$role_data['cmnt_mod']);?></td>
									</tr>
									<tr>
										<td>Panel users</td>
										<td><?php echo form_checkbox('pusr_create', 'accept' ,$role_data['pusr_create']);?></td>
										<td><?php echo form_checkbox('pusr_read', 'accept' ,$role_data['pusr_read']);?></td>
										<td><?php echo form_checkbox('pusr_update', 'accept' ,$role_data['pusr_update']);?></td>
										<td><?php echo form_checkbox('pusr_delete', 'accept' ,$role_data['pusr_delete']);?></td>
										<td><?php echo form_checkbox('pusr_mod', 'accept' ,$role_data['pusr_mod']);?></td>
									</tr>
									<tr>
										<td>Site users</td>
										<td><?php echo form_checkbox('susr_create', 'accept' ,$role_data['susr_create']);?></td>
										<td><?php echo form_checkbox('susr_read', 'accept' ,$role_data['susr_read']);?></td>
										<td><?php echo form_checkbox('susr_update', 'accept' ,$role_data['susr_update']);?></td>
										<td><?php echo form_checkbox('susr_delete', 'accept' ,$role_data['susr_delete']);?></td>
										<td><?php echo form_checkbox('susr_mod', 'accept' ,$role_data['susr_mod']);?></td>
									</tr>
									
								</tbody>
							</table>
							<input type="hidden" name="access_rights" value='0'/>
							<div class="errors">
								<?php echo form_error('access_rights'); ?>
							</div>
					</div>
					
					<div class="box-footer">
					<?php 
						$data = array(
						'id'          => 'submit',
						'maxlength'   => '100',
						'size'        => '50',
						'class'		=> 'btn btn-primary',
						'value'		=>'Submit',
						);
					echo form_submit($data);?>
					
					</div>
				</form>
					<div class="box-footer" style="margin-left: 80px; margin-top:-55px;"><a href="<?php echo base_url();?>index.php/adminRoles/show_roles" tabindex="6"><button class='btn btn-primary'>Cancel</button></a></div>
			</div>
			<?php else:?>
			<div class="box">
				You are not authorized!!!
			</div>
			<?php endif;?>
				
		</div>
	</div>
	
	</section><!-- /.content -->
</aside>
