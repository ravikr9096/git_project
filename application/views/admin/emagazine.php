<?php //print_r($location); ?>
<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		<?php echo 'eMagazines';?>  &nbsp;&nbsp;&nbsp;&nbsp;
		<div class="pull-right">
			<table>
				<tr>
					<td><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#add-magazine"  title="Add" >Add e-Magazine</button>
					</td>
				</tr>
			</table>
		</div>
		</h1>
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
									<th><?php echo 'Title';?></th>
									<th><?php echo 'Edition';?></th>
									<th><?php echo 'Action';?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=1;
									if($mags) {
										foreach($mags as $post) {
											
										?>
										<tr>
											<td><?php echo $post['id'];?></td>
											<td><?php echo substr($post['title'],0,25).'...';?></td>
											<td><?php echo date("M-Y",strtotime($post['publish_date']));?></td>
											<td>
												<!--<a href="#edit-magazine_<?php echo $post['id']; ?>" title="Edit" data-toggle="modal"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a> -->
												
												<a href="<?php echo base_url();?>EMagazine/edit_magazine/<?php echo $post['id']; ?>" title="Edit" data-toggle="modal"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a>&nbsp;&nbsp;

												<a onclick="return checkDelete();" href="<?php echo base_url();?>index.php/EMagazine/delete_mag/<?php echo $post['id']; ?>" title="Delete"><img src="<?php echo base_url(); ?>assets/admin/img/delete.png" /></a>&nbsp;&nbsp;
												
												<a href="<?php echo base_url();?>uploads/magazines/<?php echo $post['file'];?>" title="Download"><img src="<?php echo base_url(); ?>assets/admin/img/download.png" /></a>

											</td>
											<div class="modal fade" id="edit-magazine_<?php echo $post['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title">eMagazine</h4>


														</div>
														<section class="content">
															<div class="row">
																<div class="col-md-12">
																	<div class="box">
																		<div class="callout callout-info" style="height: 37px;padding: 7px;">
																			<h4>Edit</h4>

																		</div>
																		<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/eMagazine/update_mag/<?php echo $post['id']; ?>" onsubmit="return validateMag(this)">

																			<div class="form-group">
																				<input type="text" class="form-control" id="inputError" placeholder="Title" value="<?php echo $post['title']; ?>"name="title">
																				
																			<label class="control-label text-red" for="inputError" id="er" style="display:none;">Input with error</label>
																				<br/>
																			</div>
																			<div class="form-group">
																				<label> Upload eMagazine file </label>
																				<input type="file" name="upload_mag" />
																				<br/>
																			</div>


																			<div class="modal-footer clearfix">
																				<button type="submit" class="btn btn-success pull-left">Save</button>
																			</div>
																		</form>
																	</div>

																</div>

															</div>

														</section>

													</div>
												</div>
											</div>
											
											
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
</div>
	
<!-- pop up models -->

<div class="modal fade" id="add-magazine" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">eMagazine</h4>


			</div>
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="callout callout-info" style="height: 37px;padding: 7px;">
								<h4>Add</h4>

							</div>
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>EMagazine/save_mag" onsubmit="return validateMag(this)">

								<div class="form-group">
									<label> eMagazine Title </label>
									<input type="text" class="form-control" id="inputError" placeholder="Title" name="title">
									
									
									
									<label class="control-label text-red" for="inputError" id="er" style="display:none;">Input with error</label>
									<br/>
								</div>
								
								<div class="form-group">
									<label> Upload eMagazine file </label>
									<input type="file" name="upload_mag" />
									<br/>
								</div>
								
								
								<div class="form-group">
									<label for="dtp_input1" class="control-label">Publish date</label>
									<div class="input-group date form_datetime1" data-date-format="d/m/yyyy" data-link-field="dtp_input1">
										<input required class="form-control" size="16" type="text" value="" readonly>
										<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
									</div>
									<input required type="hidden" name="publish_date" id="dtp_input1" value="" /><br/>
									<div class="errors">
										<?php echo form_error('publish_date'); ?>
									</div>
								</div>

								<div class="modal-footer clearfix">
									<button type="submit" class="btn btn-success pull-left">Add</button>
								</div>
							</form>
						</div>

					</div>

				</div>

			</section>

		</div>
	</div>
</div>
