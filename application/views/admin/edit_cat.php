
<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Edit Category';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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
			<div class="col-md-6">
				<div class="box">

					<?php echo form_open('adminCategories/update_cat/'.$cat_data['id']);?>
					<div class="form-group">
						<?php echo form_label('Category Title','category');?>
						<?php
							$data = array(
								'name'        => 'category',
								'id'          => 'category',
								'value'		=> $cat_data['category'],
								'maxlength'   => '100',
								'size'        => '50',
								
								'class'		=> 'form-control',
								'placeholder'=>'eg. Entertainment,technology...'
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('category'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Category Alias','alias');?>
						<?php
							$data = array(
								'name'        => 'alias',
								'id'          => 'alias',
								'value'		=> $cat_data['alias'],
								'maxlength'   => '100',
								'size'        => '50',
								
								'class'		=> 'form-control',
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('alias'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Sort','sort');?>
						<?php
							$data = array(
								'name'        => 'sort',
								'id'          => 'sort',
								'value'		=> $cat_data['sort'],
								'maxlength'   => '20',
								'size'        => '60',								
								'class'		=> 'form-control',
								);
							echo form_input($data);
						?>
						<div class="errors">
							<?php echo form_error('sort'); ?>
						</div>
					</div>
					<div class="form-group">
					<table>
					<tr>
						<td><?php echo form_label('Show in menu','show_in_menu');?></td>
						<td><?php 
						if($cat_data['show_in_menu'])
							echo form_checkbox('show_in_menu', '1', TRUE);
						else
							echo form_checkbox('show_in_menu', '1');
						?></td>
					</tr>
					<tr>
						<td><?php echo form_label('Status','status');?></td>
						<td><?php 
						if($cat_data['status'])
							echo form_checkbox('status', '1', TRUE);
						else
							echo form_checkbox('status', '1');
						?></td>
					</tr>
					</table>
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
				<div class="box-footer" style="margin-left: 80px; margin-top:-55px;"><a href="<?php echo base_url();?>index.php/adminCategories/show_cat" tabindex="6"><button class='btn btn-primary'>Cancel</button></a></div>
			</div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
</aside>
