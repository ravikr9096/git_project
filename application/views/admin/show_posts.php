<?php //print_r($location); 
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
		   <?php echo 'Articles';?>  &nbsp;&nbsp;&nbsp;&nbsp;
			<?php if(access_check('art_create')):?>
				<a href="<?php echo base_url();?>index.php/adminPosts/add_post"><button class="btn btn-primary">  <?php echo 'Add Article';?> </button></a>
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
						<form id="search" method="POST" action="<?php echo base_url()?>adminPosts/show_posts">
							<span class="pull-right">Search:
							<input type="text" name="search" value="<?php if(@$this->session->userdata("search")) echo $this->session->userdata("search");?>"  /></span>
							<select name="per_page" onchange="this.form.submit()">
								<option value="10" <?php if($this->session->userdata("per_page")==10) echo 'selected';?>>10</option>
								<option value="25" <?php if($this->session->userdata("per_page")==25) echo 'selected';?>>25</option>
								<option value="50" <?php if($this->session->userdata("per_page")==50) echo 'selected';?>>50</option>
								<option value="100" <?php if($this->session->userdata("per_page")==100) echo 'selected';?>>100</option>
							</select> Records per page
							<noscript><input type="submit"/></noscript>
							
						</form><br/>
						<table class="table table-bordered table-hover">
						<!--<table id="example1" class="table table-bordered table-hover">-->
							<thead>
								<tr>
									<th><?php echo 'ID';?></th>
									<th><?php echo 'Title';?></th>
									<th><?php echo 'Author';?></th>
									<th><?php echo 'Publish date';?></th>
									<th><?php echo 'Location';?></th>
									<th><?php echo 'Category';?></th>
									<th><?php echo 'Action';?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=1;
									if($posts_data) {
										foreach($posts_data as $post) {
											
										?>
										<tr>
											<td><?php echo $post['id'];?></td>
											<td><?php 
											if(strlen($post['title']) >90){
												$s = strpos($post['title'],' ',75);
												echo substr($post['title'],0,$s)."...";
											}
											else {
												echo $post['title'];
											}
											
											?></td>
											<td><?php echo $post['author_name'];?></td>
											<td><?php echo $post['publish_date'];?></td>
											<td><?php echo $this->common->getSingleValue('tbl_location','name','id',$post['loc_id']);?></td>
											<td><?php echo $post['category'].'('.$post['cat_alias'].')';?></td>
											<td><a href="<?php echo base_url().$post['cat_alias'].'/'. $post['seo_url'].'-'.$post['id']; ?>" target="_blank" title="Preview"><img src="<?php echo base_url(); ?>assets/admin/img/view.png" /></a>&nbsp;&nbsp;
											<?php
												if(access_check('art_update')){?>
											<a href="<?php echo base_url();?>index.php/adminPosts/edit_post/<?php echo $post['id']; ?>" title="Edit"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a>&nbsp;&nbsp;
											<?php }?>
												<?php
												if(access_check('art_delete')){?>
												<a onclick="return checkDelete();" href="<?php echo base_url();?>index.php/adminPosts/delete_post/<?php echo $post['id']; ?>" title="Delete"><img src="<?php echo base_url(); ?>assets/admin/img/delete.png" /></a>
												<?php } ?>
												<?php
												if(access_check('art_mod')){
												echo '<a onclick="return articleModerate('.$post['id'].');return false;" href="#" id="art_status_'.$post['id'].'">';
												if($post['status']==0) {
													echo '<img title="Unpublished" src="'.base_url().'assets/admin/img/unpublish.png" />';
												}
												else {
													echo '<img title="Published" src="'.base_url().'assets/admin/img/publish.png" />';
												}
												
												echo '</a>';
												} ?>
											</td>
										</tr>
										<?php	
										}
									}
								?>
								
							</tbody>
						</table>
						<div style="height: 30px;">
						<p><?php echo $links; ?></p>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	
	</section><!-- /.content -->
</aside>