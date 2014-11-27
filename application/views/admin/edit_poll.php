<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Edit Poll';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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
							
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/adminPolls/update_poll/<?php echo $poll_data['id']?>" onsubmit="return validateEditPoll(this)">

								<div class="form-group">
									<label>Poll Title</label>
									<input type="text" title="Poll title" value="<?php echo $poll_data['title']?>" class="form-control" id="poll_edit" name="title">
								</div>
								
								<div class="form-group">
									<label>Add possible answers to your question</label>
									
									<div id="more_ans_div" >
									<?php
									$ctr=0;
									foreach ($poll_data['answers'] as $ans) {
										echo '<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-circle"></i></span>
											<input type="text" value="'.$ans['answer'].'" class="form-control" id="answers'.$ctr.'" name="answers[]">
										</div>';
										$ctr++;
									}?>
									
									</div>
									<a href="#" value="more_ans" onclick="return add_more_ans();"><i class="fa fa-plus"></i>Add more answer</a>
								</div>
															
								<div class="form-group">
									<label for="poll_date" class="control-label">Publish date</label>
									<div class="input-group date form_datetime" data-date-format="d/m/yyyy" data-date="<?php echo @$poll_data['created_on']?>" data-link-field="poll_date">
										<input required class="form-control" size="16" type="text" value="<?php echo @$poll_data['created_on']?>" readonly>
										<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
									</div>
									<input required type="hidden" name="created_on" id="poll_date" value="<?php echo @$poll_data['created_on']?>" /><input required type="hidden" name="modified_on" id="poll_date" value="<?php echo date('Y-M-d H:i:s');?>" /><br/>
									<div class="errors">
										<?php echo form_error('publish_date'); ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label">Status</label><br/>
									<input type="radio" class="form-control" name="status" value="1" <?php if ($poll_data['status']) echo "checked";?>> Enabled 
									&nbsp;&nbsp;&nbsp;<input type="radio" class="form-control" name="status" value="0" <?php if (!$poll_data['status']) echo "checked";?>> Disabled
								</div>

								<div class="box-footer clearfix">
									<button type="submit" class="btn btn-primary pull-left">Add</button>
								</div>
							</form>
							<div style="margin-left: 65px; margin-top:-44px;"><a href="<?php echo base_url();?>index.php/adminPolls/show_polls" tabindex="6"><button class='btn btn-primary'>Cancel</button></a></div>
						</div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
</aside>
<script>
function add_more_ans() {
	var i = $('#more_ans_div div').size();
	$("#more_ans_div").append('<div class="input-group"><span class="input-group-addon"><i class="fa fa-circle"></i></span><input type="text" class="form-control" id="answers'+i+'" name="answers[]"></div>');
	return false;
}

</script>