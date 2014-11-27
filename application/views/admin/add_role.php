<?php

?>
<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Add role';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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

					<?php echo form_open('adminRoles/save_role');?>
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
								'placeholder'=>'eg. Editor,Reporter...',
								'value'		=> set_value('role_title'),
								'autofocus'	=> 'autofocus',
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
								'value'		=> set_value('role_desc'),
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('role_desc'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Manage Permissions');?>
						<table class="table table-bordered table-hover" id="myTable">
							<!--<table id="example1" class="table table-bordered table-hover">-->
								<thead>
									<tr>
										<th><?php echo 'Components';?></th>
										<th><?php echo 'Create';?></th>
										<th><?php echo 'Read';?></th>
										<th><?php echo 'Update';?></th>
										<th><?php echo 'Delete';?></th>
										<th><?php echo 'Moderate<br>(active/inactive)';?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Articles</td>
										<td><?php echo form_checkbox('art_create', 'accept', $this->input->post('art_create'));?></td>
										<td><?php echo form_checkbox('art_read', 'accept', $this->input->post('art_read'));?></td>
										<td><?php echo form_checkbox('art_update', 'accept', $this->input->post('art_update'));?></td>
										<td><?php echo form_checkbox('art_delete', 'accept', $this->input->post('art_delete'));?></td>
										<td><?php echo form_checkbox('art_mod', 'accept', $this->input->post('art_mod'));?></td>
									</tr>
									<tr>
										<td>Adverisements</td>
										<td><?php echo form_checkbox('ads_create', 'accept', $this->input->post('ads_create'));?></td>
										<td><?php echo form_checkbox('ads_read', 'accept', $this->input->post('ads_read'));?></td>
										<td><?php echo form_checkbox('ads_update', 'accept', $this->input->post('ads_update'));?></td>
										<td><?php echo form_checkbox('ads_delete', 'accept', $this->input->post('ads_delete'));?></td>
										<td><?php echo form_checkbox('ads_mod', 'accept', $this->input->post('ads_mod'));?></td>
									</tr>
									<tr>
										<td>Polls</td>
										<td><?php echo form_checkbox('polls_create', 'accept', $this->input->post('polls_create'));?></td>
										<td><?php echo form_checkbox('polls_read', 'accept', $this->input->post('polls_read'));?></td>
										<td><?php echo form_checkbox('polls_update', 'accept', $this->input->post('polls_update'));?></td>
										<td><?php echo form_checkbox('polls_delete', 'accept', $this->input->post('polls_delete'));?></td>
										<td><?php echo form_checkbox('polls_mod', 'accept', $this->input->post('polls_mod'));?></td>
									</tr>
									<tr>
										<td>Comments</td>
										<td><?php echo form_checkbox('cmnt_create', 'accept', $this->input->post('cmnt_create'));?></td>
										<td><?php echo form_checkbox('cmnt_read', 'accept', $this->input->post('cmnt_read'));?></td>
										<td><?php echo form_checkbox('cmnt_update', 'accept', $this->input->post('cmnt_update'));?></td>
										<td><?php echo form_checkbox('cmnt_delete', 'accept', $this->input->post('cmnt_delete'));?></td>
										<td><?php echo form_checkbox('cmnt_mod', 'accept', $this->input->post('cmnt_mod'));?></td>
									</tr>
									<tr>
										<td>Panel users</td>
										<td><?php echo form_checkbox('pusr_create', 'accept', $this->input->post('pusr_create'));?></td>
										<td><?php echo form_checkbox('pusr_read', 'accept', $this->input->post('pusr_read'));?></td>
										<td><?php echo form_checkbox('pusr_update', 'accept', $this->input->post('pusr_update'));?></td>
										<td><?php echo form_checkbox('pusr_delete', 'accept', $this->input->post('pusr_delete'));?></td>
										<td><?php echo form_checkbox('pusr_mod', 'accept', $this->input->post('pusr_mod'));?></td>
									</tr>
									<tr>
										<td>Site users</td>
										<td><?php echo form_checkbox('susr_create', 'accept', $this->input->post('susr_create'));?></td>
										<td><?php echo form_checkbox('susr_read', 'accept', $this->input->post('susr_read'));?></td>
										<td><?php echo form_checkbox('susr_update', 'accept', $this->input->post('susr_update'));?></td>
										<td><?php echo form_checkbox('susr_delete', 'accept', $this->input->post('susr_delete'));?></td>
										<td><?php echo form_checkbox('susr_mod', 'accept', $this->input->post('susr_mod'));?></td>
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
						'value'		=>'Add',
						);
					echo form_submit($data);?>
					
					</div>
				</form>
				<div class="box-footer" style="margin-left: 60px; margin-top:-55px;"><a href="<?php echo base_url();?>index.php/adminRoles/show_roles" tabindex="6"><button class='btn btn-primary'>Cancel</button></a></div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
</aside>
