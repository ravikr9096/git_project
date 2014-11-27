<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Manage colors';?>
		</h1>
		
	</section>

	<!-- Main content -->
	<?php include('templates/message.php');?>   
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
				<form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>admin/update_color">
				<table class="table table-bordered table-hover">
						<!--<table id="example1" class="table table-bordered table-hover">-->
					<thead>
						<tr>
							<th><?php echo 'Title';?></th>
							<th><?php echo 'Background';?></th>
							<th><?php echo 'Text-color';?></th>
							<th><?php echo 'Text-hover';?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($webcolors as $val) {?>
						<tr>
							<td><?php echo ucwords($val['label']);?></td>
							<td>
							<input type="radio" <?php if(!$val['bck_select']){echo 'checked';}?> value="0" name="bck_select[<?php echo $val['title'];?>]"></input><input type="text" class="picker" name="background[<?php echo $val['title'];?>]" value="<?php echo $val['background'];?>"/>
							Current: <span style="background:#<?php echo $val['background'];?>; width:20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
							<input type="radio" <?php if($val['bck_select']){echo 'checked';}?> value="1" name="bck_select[<?php echo $val['title'];?>]"><input type="file" style="display:inline;" name="bckfile_<?php echo $val['title'];?>">
							Current: <span style="background:url('<?php echo base_url().$val['background_img'];?>'); width:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							</td>
							
							<td>
							<?php if($val['title'] != 'body'):?>
							<input type="text" class="picker" name="text[<?php echo $val['title'];?>]"value="<?php echo $val['text'];?>"/>
							<span style="background:#<?php echo $val['text'];?>; width:20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<?php endif;?>
							</td>
							<td>
							<?php if($val['title'] != 'body'):?>
							<input type="text" class="picker" name="text_hover[<?php echo $val['title'];?>]" value="<?php echo $val['text_hover'];?>"/>
							<span style="background:#<?php echo $val['text_hover'];?>; width:20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<?php endif;?></td>
						</tr>						
						<?php
						}?>
					</tbody>
				</table>
				<input class="btn btn-primary" type="submit" value="Save">
				</form>
				</div>
				
			</div>
		</div>
	
	</section><!-- /.content -->
</aside>
