<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Home page';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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
			<!--<div class="col-xs-1">
				<div class="col-md-12 region"><div class="mid" style="height:200px;">Header</div></div>
				<div class="col-md-12 region"><div class="mid" style="height:350px;">body</div></div>
				<div class="col-md-12 region"><div class="mid" style="height:160px;">footer</div></div>

			</div>-->
			<div class="col-xs-12">
				<div class="box">
						<form method="POST" action="<?php echo base_url(); ?>admin/savepagelayout/<?php echo $page_name; ?>" enctype="multipart/form-data">
						<!--header starts-->
						<div class="col-md-4 region" >
							Logo<br/>						
							<input type="file" name="logo" /><br/>
							<?php 
								echo $this->common->hindi_date('day').', '.date('d').' '.$this->common->hindi_date('month').' '.date('Y').', '.date('H:i').' IST';
								
							?>
						</div>

						<div class="col-md-8 region">Advertisement 1<br />
							<select class="form-control" name="ad_1">
									<?php
										foreach($ads as $ad) {
											if($ad['id']==$regions['ad_1'])
														echo '<option selected value="'.$ad['id'].'">'.$ad['title'].'</option>';
													else
														echo '<option value="'.$ad['id'].'">'.$ad['title'].'</option>';
										}
									?>
							</select>
						</div>
						<div class="col-md-12 region">Temperature/sunrise/sunset </div>
						<div class="col-md-12 region">Menu
							<ul id="sortablecopy" >
								<?php
								$i=1;
								foreach($cat_data as $cat) {
									if($cat['show_in_menu']){
										echo '<li id="'.$cat['id'].'">'.$cat['category'].'</li>';
										$i++;
									}
									
								}
								
								?>

							</ul>
							<div style="clear: both;">
							<a href="#" class="btn btn-info" data-toggle="modal" data-target="#change_menu_order"  title="Add" >change menu</a>
							</div>
						</div>
						<div class="col-md-12 region">Latest news ticker 
							<div class="input-group pull-right" style="width: 220px;">
                                <span class="input-group-addon"></span>
                                <input type="text" placeholder="Search" class="form-control">
                            </div>
							<div class="pull-right"><input type="radio" selected>English</input></div>
							<div class="pull-right"><input type="radio" >Hindi</input></div>
							
						</div>
						<!-- header ends-->
						<!-- body starts-->
						<div class="col-md-8">
							<div class="col-md-12 region">News slider </div>
							<div class="col-md-6 region">category news 1<br/>
								<select class="form-control" name="cat_1">
									<?php
										foreach($cats as $cat) {
											if($cat['id']==$regions['cat_1'])
													echo '<option selected value="'.$cat['id'].'">'.$cat['category'].'</option>';
												else
													echo '<option value="'.$cat['id'].'">'.$cat['category'].'</option>';
										}
									?>
								</select>
							</div>
							<div class="col-md-6 region">category news 2<br/>
								<select class="form-control" name="cat_2">
									<?php
										foreach($cats as $cat) {
											if($cat['id']==$regions['cat_2'])
													echo '<option selected value="'.$cat['id'].'">'.$cat['category'].'</option>';
												else
													echo '<option value="'.$cat['id'].'">'.$cat['category'].'</option>';
										}
									?>
								</select>
							</div>
							<div class="col-md-6 region">category news 3<br/>
								<select class="form-control" name="cat_3">
									<?php
										foreach($cats as $cat) {
											if($cat['id']==$regions['cat_3'])
													echo '<option selected value="'.$cat['id'].'">'.$cat['category'].'</option>';
												else
													echo '<option value="'.$cat['id'].'">'.$cat['category'].'</option>';
										}
									?>
								</select>
							</div>
							<div class="col-md-6 region">
								<div class="col-md-12 ">category news 4<br/>
									<select class="form-control" name="cat_4">
										<?php
											foreach($cats as $cat) {
												if($cat['id']==$regions['cat_4'])
													echo '<option selected value="'.$cat['id'].'">'.$cat['category'].'</option>';
												else
													echo '<option value="'.$cat['id'].'">'.$cat['category'].'</option>';
											}
										?>
									</select>
								</div>
								<div class="col-md-12">Advertisement 5<br />
									<select class="form-control" name="ad_5">
											<?php
												foreach($ads as $ad) {
													if($ad['id']==$regions['ad_5'])
														echo '<option selected value="'.$ad['id'].'">'.$ad['title'].'</option>';
													else
														echo '<option value="'.$ad['id'].'">'.$ad['title'].'</option>';
												}
											?>
									</select>
								</div>
							</div>
							<div class="col-md-12 region">Location based news</div>
							<div class="col-md-12 region">Advertisement 6<br />
								<select class="form-control" name="ad_6">
										<?php
											foreach($ads as $ad) {
												if($ad['id']==$regions['ad_6'])
														echo '<option selected value="'.$ad['id'].'">'.$ad['title'].'</option>';
													else
														echo '<option value="'.$ad['id'].'">'.$ad['title'].'</option>';
											}
										?>
								</select>
							</div>
							<div class="col-md-12 region">Follow Us</div>

						</div>
						<div class="col-md-4 ">
							<div class="col-md-12 region">Live tv </div>
							<div class="col-md-12 region">Video Gallery </div>
							<div class="col-md-12 region">Poll 
								<select class="form-control" name="poll">
										<?php
											foreach($polls_data as $poll) {
												if($poll['id']==$regions['poll'])
														echo '<option selected value="'.$poll['id'].'">'.$poll['title'].'</option>';
													else
														echo '<option value="'.$poll['id'].'">'.$poll['title'].'</option>';
											}
										?>
								</select>
							</div>
							<div class="col-md-12 region">Advertisement 2<br />
								<select class="form-control" name="ad_2">
										<?php
											foreach($ads as $ad) {
												if($ad['id']==$regions['ad_2'])
														echo '<option selected value="'.$ad['id'].'">'.$ad['title'].'</option>';
													else
														echo '<option value="'.$ad['id'].'">'.$ad['title'].'</option>';
											}
										?>
								</select>
							</div>
							<div class="col-md-12 region">Recipe</div>
							<div class="col-md-12 region">Advertisement 3<br />
								<select class="form-control" name="ad_3">
										<?php
											foreach($ads as $ad) {
												if($ad['id']==$regions['ad_3'])
														echo '<option selected value="'.$ad['id'].'">'.$ad['title'].'</option>';
													else
														echo '<option value="'.$ad['id'].'">'.$ad['title'].'</option>';
											}
										?>
								</select>
							</div>
							<div class="col-md-12 region">Popular news</div>
							<div class="col-md-12 region">Image gallery</div>

						</div>
						<!--<div class="col-md-4 ">
							<ul id="sortable1">
								<li id="1" class="col-md-12 region">Live tv </li>
								<li id="2" class="col-md-12 region">Video Gallery </li>
								<li id="3" class="col-md-12 region">Poll </li>
								<li id="4" class="col-md-12 region">Adverisement 2</li>
								<li id="5" class="col-md-12 region">Recipe</li>
								<li id="6" class="col-md-12 region">Advertisement 4</li>
								<li id="7" class="col-md-12 region">Featured news</li>
								<li id="8" class="col-md-12 region">Image gallery</li>
							</ul>
							<input name="order" id="order"/>
						</div>-->
						<!--body ends-->
						
						<!--Footer starts-->
						<div class="col-md-12">
							<div class="col-md-12 region">States list to view the news</div>
							<div class="col-md-12 region">Advertisement 4<br />
							<select class="form-control" name="ad_4">
									<?php
										foreach($ads as $ad) {
											if($ad['id']==$regions['ad_4'])
														echo '<option selected value="'.$ad['id'].'">'.$ad['title'].'</option>';
													else
														echo '<option value="'.$ad['id'].'">'.$ad['title'].'</option>';
										}
									?>
							</select>
							</div>
							<div class="col-md-12 region">Footer menu</div>
							<div class="col-md-12 region">Copyright</div>

						</div>
						<div class="box-footer col-md-12 ">
						<button type="submit" class="btn btn-primary" id="add_submit">Save</button>
						</div>
						<!--Footer ends-->
					</form>
					
				</div>
				
			</div>
		</div>
	
	</section><!-- /.content -->
</aside>

<div class="modal fade" id="change_menu_order" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
<form method="POST" action="<?php echo base_url(); ?>index.php/admin/save_menu_order/<?php echo $page_name; ?>">
<div class="form-group">
<input type="hidden" id="order" name="order" value="" />
<label>Change the order below:</label>
<br/><span class="help">Simply drag the menu element and place it whereever you want.</span>
<ul id="sortable" >
	<?php
	$i=1;
	foreach($cat_data as $cat) {
		if($cat['show_in_menu']){
			echo '<li id="'.$cat['id'].'">'.$cat['category'].'</li>';
			$i++;
		}
		
	}
	
	?>

</ul>
</div>


<div class="form-group" style="clear:both;">
<span class="help">If the category is not listed here. Go to <a href="<?php echo base_url();?>adminCategories/show_cat">category list</a>, edit and enable "Show in menu"</span><br/>
<input id="submit_order" style="display:none;" type="submit" class="btn btn-primary" value="REORDER"/>
</div>
</form>
</div>
</div>
</div>