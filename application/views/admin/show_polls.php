<?php //print_r($location); 
if(@$this->session->flashdata('msg_write')|| @$this->session->flashdata('msg_wrong')){
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
		<?php echo 'Polls';?>  &nbsp;&nbsp;&nbsp;&nbsp;
		<?php if(access_check('polls_create')):?>
		<div class="pull-right">
			<table>
				<tr>
					<td><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#add-poll"  title="Add" >Add poll</button>
					</td>
				</tr>
			</table>
		</div>
		<?php endif;?>
		</h1>
	</section>

	<!-- Main content -->
	<?php include('templates/message.php');?>   
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
                    <div class="box-body table-responsive">
						
						<table id="example1" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><?php echo 'Poll id';?></th>
									<th><?php echo 'Questions';?></th>
									<th><?php echo 'Status';?></th>
									<th><?php echo 'Action';?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=1;
									if($polls_data) {
										foreach($polls_data as $poll) {
											
										?>
										<tr>
											<td><?php echo $poll['id'];?></td>
											<td><?php echo $poll['title'];?></td>
											<td><?php if($poll['status'] == "0") { echo "Disabled"; }
												else{ echo "Enabled"; }
											?></td>
											<td>
											<?php if(access_check('polls_read') || access_check('polls_update') ):?>
											<a href="#preview_poll<?php echo $poll['id']; ?>" title="Preview" data-toggle="modal"><img src="<?php echo base_url(); ?>assets/admin/img/view.png" /></a>&nbsp;&nbsp;
											<?php endif;?>
											<?php if(access_check('polls_update')):?>
											<a href="<?php echo base_url();?>index.php/adminPolls/edit_poll/<?php echo $poll['id']; ?>" title="Edit"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a>&nbsp;&nbsp;
											<?php endif;?>
											<?php if(access_check('polls_delete')):?>
												<a onclick="return checkDelete();" href="<?php echo base_url();?>index.php/adminPolls/delete_poll/<?php echo $poll['id']; ?>" title="Delete"><img src="<?php echo base_url(); ?>assets/admin/img/delete.png" /></a>
											<?php endif;?>

											
						

					<!-- preview the poll-->
						<div class="modal fade" id="preview_poll<?php echo $poll['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Preview Poll</h4>
						
                    </div>
					<section class="content">
		<div class="row">
					<div class="col-md-12">
				<div class="box">
					
                        
						
					<div class="form-group">
                        <label><?php echo $poll['title'];?></label>

					</div>
					<div class="form-group" style="display: block;" id="result">
					<ul>
					<?php
						$total_votes = 0;
						foreach ($poll['answers'] as $ans) {
							$total_votes +=$ans['counter'];
						}
						foreach ($poll['answers'] as $ans) {
							if($total_votes>0){
								$per = ($ans['counter']/$total_votes)*100;
							}
							else {
								$per = 0;
							}
							//echo "<li>".$ans['answer']."</li>";
							echo '<div class="clearfix">
									<span class="pull-left">'.$ans['answer'].'</span>
									<small class="pull-right">'.$ans["counter"].' votes</small>
								</div>
								<div class="progress xs">
									<div style="width: '.$per.'%;" class="progress-bar progress-bar-green"></div>
								</div>';
						}
						
					?>
					</ul>
					</div>
					
					
					
					<div class="modal-footer clearfix">
						<button type="button" class="btn btn-primary pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
					</div>
							
				
			</div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
	
                </div>
            </div>
        </div>
					</td>
										</tr>
										<?php	
										}
									}
								?>
								
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
		</div>
	
	</section><!-- /.content -->
</aside>


<!--  add poll modal-->
<div class="modal fade" id="add-poll" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Polls</h4>


			</div>
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="callout callout-info" style="height: 37px;padding: 7px;">
								<h4>Add</h4>

							</div>
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/adminPolls/save_poll" onsubmit="return validateAddPoll(this)">

								<div class="form-group">
									<label>Poll Title</label>
									<input type="text" id="poll_add" class="form-control" title="Poll title" name="title">
								</div>
								
								<div class="form-group">
									<label>Add possible answers to your question</label>
									
									<div id="more_ans_div" >
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-circle"></i></span>
											<input type="text" class="form-control" id="answers0" name="answers[]">
										</div>
									
									</div>
									<a href="#" value="more_ans" onclick="return add_more_ans();"><i class="fa fa-plus"></i>Add more answer</a>
								</div>
															
								<div class="form-group">
									<label for="poll_date" class="control-label">Publish date</label>
									<div class="input-group date form_datetime" data-date-format="d/m/yyyy" data-link-field="poll_date">
										<input required class="form-control" size="16" type="text" value="" readonly>
										<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
									</div>
									<input required title="Poll date" type="hidden" name="created_on" id="poll_date" value="" /><br/>
									<div class="errors">
										
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Status</label><br/>
									<input type="radio" class="form-control" name="status" value="1"> Enabled
									&nbsp;&nbsp;&nbsp;<input type="radio" class="form-control" name="status" value="0" checked> Disabled
								</div>

								<div class="modal-footer clearfix">
									<button type="submit" class="btn btn-primary pull-left">Add</button>
									<button type="submit" data-dismiss="modal" class="btn btn-primary pull-left">Cancel</button>
								</div>
							</form>
						</div>

					</div>

				</div>

			</section>

		</div>
	</div>
</div>

<script>
function add_more_ans() {
	var i = $('#more_ans_div div').size();
	$("#more_ans_div").append('<div class="input-group"><span class="input-group-addon"><i class="fa fa-circle"></i></span><input type="text" class="form-control" id="answers'+i+'" name="answers[]"></div>');
	return false;
}

</script>