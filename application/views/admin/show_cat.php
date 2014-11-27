<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
		   <?php echo 'Categories';?>  &nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?php echo base_url();?>index.php/adminCategories/add_cat"><button class="btn btn-primary">  <?php echo 'Add Category';?> </button></a>
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
									<th><?php echo 'Category title';?></th>
									<th><?php echo 'Alias';?></th>
									<th><?php echo 'Main menu display';?></th>
									<th><?php echo 'Sort order';?></th>
									<th><?php echo 'Status';?></th>
									<th class="remove_sorting"><?php echo 'Action';?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=1;
									if($cat_data) {
										foreach($cat_data as $cat) {
											//$cat_title = utf8_decode($cat['post_title']);
											$cat_title = $cat['category'];
										?>
										<tr>
											<td><?php echo $cat['id'];?></td>
											<td><?php echo $cat_title;?></td>
											<td><?php echo $cat['alias'];?></td>
											<td><?php echo $cat['show_in_menu'];?></td>
											<td><?php echo $cat['sort'];?></td>
											<td><?php echo $cat['status'];?></td>
											<td><a href="<?php echo base_url();?>index.php/adminCategories/edit_cat/<?php echo $cat['id']; ?>" title="Edit"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a>&nbsp;&nbsp;
											<?php if(access_check('is_admin')):?>
											<a onclick="return checkDelete();" href="<?php echo base_url();?>index.php/adminCategories/delete_cat/<?php echo $cat['id']; ?>" title="Delete"><img src="<?php echo base_url(); ?>assets/admin/img/delete.png" /></a>
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