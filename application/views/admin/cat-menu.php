<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Menu';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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
					<h4>Main Menu</h4>
					<form method="POST" action="<?php echo base_url(); ?>index.php/admin/save_menu_order">
					<div class="form-group">
					<input type="hidden" id="order" name="order" value="" />
					<label>Change the order below:</label>
					<br/><span class="help">Simply drag the menu element and place it whereever you want.</span>
					<ul id="sortable" >
						<?php
						foreach($cat_data as $cat) {
							if($cat['show_in_menu']){
								echo '<li id="'.$cat['id'].'">'.$cat['category'].'</li>';
							}
							
						}
						
						?>

					</ul>
					</div>
					<br/>
					
					<div class="form-group">
					<span class="help">If the category is not listed here. Go to <a href="<?php echo base_url();?>adminCategories/show_cat">category list</a>, edit and enable "Show in menu"</span><br/>
					<input id="submit_order" style="display:none;" type="submit" class="btn btn-primary" value="REORDER"/>
					</div>
					</form>
					<!-- sub menu-->
					<h4>Sub Menu</h4>
					<form method="POST" action="<?php echo base_url(); ?>index.php/admin/save_menu_order">
					<div class="form-group">
					<input type="hidden" id="order1" name="order" value="" />
					<label>Change the order below:</label>
					<br/><span class="help">Simply drag the menu element and place it whereever you want.</span>
					<ul id="sortable1" >
						<?php
						$i=1;
						foreach($cat_data as $cat) {
							if(!$cat['show_in_menu']){
								echo '<li id="'.$cat['id'].'">'.$cat['category'].'</li>';
								$i++;
							}
							
						}
						
						?>

					</ul>
					</div>
					<br/>
					
					<div class="form-group">
					<span class="help">If the category is not listed here. Go to <a href="<?php echo base_url();?>adminCategories/show_cat">category list</a>, edit and enable "Show in menu"</span><br/>
					<input id="submit_order1" style="display:none;" type="submit" class="btn btn-primary" value="REORDER"/>
					</div>
					</form>
				</div>
				
			</div>
		</div>
	
	</section><!-- /.content -->
</aside>
