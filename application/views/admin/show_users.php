<?php
if(@$this->session->flashdata('msg_write') || @$this->session->flashdata('msg_wrong') ){
echo '<script>
history.pushState({ page: 1 }, "title 1", "#nbb");
window.onhashchange = function (event) {
window.location.hash = "nbb";
};
</script>';
}
?>
<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Users';?>  &nbsp;&nbsp;&nbsp;&nbsp;
		   <?php if (access_check('pusr_create') && $user_type=='panel_user'):?>
			<a href="<?php echo base_url();?>index.php/adminUsers/add_user"><button class="btn btn-primary">  <?php echo 'Add user';?> </button></a>
			<?php endif;?>
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
                    <div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-hover">
						<!--<table id="example1" class="table table-bordered table-hover">-->
							<thead>
								<tr>
									<th><?php echo 'ID';?></th>
									<th><?php echo 'Username';?></th>
									<th><?php echo 'Name';?></th>
									<th><?php echo 'Email';?></th>
									<th><?php echo 'Role';?></th>
									<th><?php echo 'Created date';?></th>
									<th><?php echo 'Action';?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=1;
									if($users_data) {
										foreach($users_data as $user) {
											
										?>
										<tr>
											<td><?php echo $user['id'];?></td>
											<td><?php echo $user['user_name'];?></td>
											<td><?php echo $user['first_name'].' '.$user['last_name'];?></td>
											<td><?php echo $user['email'];?></td>
											<td><?php 
											if($user['role_id']>0){
											echo @$role_name[$user['role_id']];
											}
											else {
											echo 'None';
											}
											
											?></td>
											<td><?php echo date('d-m-Y',strtotime($user['created_date']));?></td>
											<td>
											
											<?php 
											
												
											if($user['role_id']!=0 ){
													if(access_check('pusr_update') && $user_type=='panel_user'){
											?>
											
											<a href="<?php echo base_url();?>index.php/adminUsers/edit_user/<?php echo $user['id']; ?>" title="Edit"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a>&nbsp;&nbsp;
											<?php
											}
											if(access_check('pusr_delete') || access_check('susr_delete') || $user_type =='panel_user'){
											?>
											<a onclick="return checkDelete();" href="<?php echo base_url();?>index.php/adminUsers/delete_user/<?php echo $user['id']; ?>" title="Delete"><img src="<?php echo base_url(); ?>assets/admin/img/delete.png" /></a>
											<?php

											} 
											
											}?>
											
											</td>
										</tr>
										<?php	
										}
									}
								?>
								
							</tbody>
						</table>
						<p><?php //echo $links; ?></p>
					</div>
				</div>
				
			</div>
		</div>
	
	</section><!-- /.content -->
</aside>
