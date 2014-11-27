<?php
if(@$this->session->flashdata('msg_write') || @$this->session->flashdata('msg_wrong')){
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
		   <?php echo 'Roles';?>  &nbsp;&nbsp;&nbsp;&nbsp;
		   <a href="<?php echo base_url();?>index.php/adminRoles/add_role"><button class="btn btn-primary">  <?php echo 'Add role';?> </button></a>
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
						<!--<table class="table table-bordered table-hover">-->
						<table id="example1" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><?php echo 'ID';?></th>
									<th><?php echo 'Role title';?></th>
									<th><?php echo 'Role description';?></th>
									<th><?php echo 'Action';?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=1;
									if($roles_data) {
										foreach($roles_data as $role) {
											//$role_title = utf8_decode($role['post_title']);
											$role_title = $role['role_title'];
										?>
										<tr>
											<td><?php echo $role['id'];?></td>
											<td><?php echo $role_title;?></td>
											<td><?php echo $role['role_desc'];?></td>
											<td>
											<?php 
											if(role_access_check($role['id']) && access_check('pusr_update')):?>
											<a href="<?php echo base_url();?>index.php/adminRoles/edit_role/<?php echo $role['id']; ?>" title="Edit"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a>&nbsp;&nbsp;
											<?php endif;?>
											<?php if(role_access_check($role['id']) && access_check('pusr_delete')):?>
											<a onclick="return checkDelete();" href="<?php echo base_url();?>index.php/adminRoles/delete_role/<?php echo $role['id']; ?>" title="Delete"><img src="<?php echo base_url(); ?>assets/admin/img/delete.png" /></a>
											<?php endif;?>
											
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