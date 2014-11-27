<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Edit Article';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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
			<div class="col-xs-12 col-sm-12 col-md-12 ">
				<div class="box">
					<div class="box-body table-responsive">
						<?php
							//echo form_open_multipart('adminPosts/update_article/'.$post_data['id']);	
						?>  
							<form method="post" action="<?php echo base_url(); ?>index.php/adminPosts/update_article/<?php echo $post_data['id'];?>" onsubmit="return check_edit_article(this);" enctype="multipart/form-data">
							<div class="row">
								<!--first div-->
								<div class="col-md-6">
									<div class="form-group">
								<?php echo form_label('Article Title','title');?><span class="errors">*</span>
								<?php
								$data = array(
									'name'        => 'title',
									'id'          => 'title',
									'title'		=>'Article title',
									'maxlength'   => '500',
									'size'        => '50',
									'autofocus' =>'autofocus',
									'class'		=> 'form-control',
									'value'		=> $post_data['title'],
									);
								echo form_input($data);
								?>
							</div>
							
							<!-- text input -->
							<div class="form-group">
								<?php echo form_label('Alias','alias');?><span class="errors">*</span>&nbsp;&nbsp;<span class="help">Title in english</span>

								<?php
								$data = array(
									'name'        => 'alias',
									'id'          => 'alias_edit',
									'title'		=>'Alias',
									'maxlength'   => '500',
									'size'        => '50',
									'class'		=> 'form-control',
									'value'		=> $post_data['alias']
									);
								echo form_input($data);
								?>
							</div>
							
							
						  
							<!-- textarea -->
							<div class="form-group">
								<?php echo form_label('Content','content');?>
								<?php
								$data = array(
									'name'        => 'content',
									'id'          => 'editor1',
									'rows'   => '10',
									'cols'        => '50',
									'style'       => 'width:50%',
									'value'		=> $post_data['content']
								);
								echo form_textarea($data);
								?>
													
							</div>
							<div class="form-group">
							<input type="hidden" id="saved_art_image" value="<?php echo $post_data['art_image'];?>">
								<div id="uploaded_images"></div>	
							</div>
							
							
							<div class="form-group">
								<label><?php echo 'Add Media'?></label>
								<div id="addinput">
									
									<?php
										$i=0;
										foreach($media as $val) {
										$i++;
											if($val['type'] == 'image') {
												echo '<div class="table-responsive add-content" style="border-bottom:1px solid #ccc;"><table><tr><td><label>Uploaded file</label></td><td><label>Caption</label></td></tr><tr><td><img src="'.base_url().'uploads/'.$val['image_thumb'].'" /><input type="file" id="p_new_'.$i.'" size="40" name="media_files_'.$i.'" value=""/><span class="help">Upload new file if you want to change the current image</span></td><td><textarea class="form-control"  id="img_desc_'.$i.'"  name="media['.$i.'][caption]" rows="1" cols="40">'.$val['caption'].'</textarea><td><input type="hidden" name="media['.$i.'][type]" value="image" /><input type="hidden" name="media['.$i.'][id]" id="media_'.$i.'_id" value="'.$val['id'].'" /><a href="#" id="remove_'.$i.'" onclick="remove_new(this.id);return false;"><i class="glyphicon glyphicon-remove" style="color:#3c8dbc"></i>&nbsp; Remove</a></td></td></tr></table></div>';
											}
											elseif($val['type'] == 'video') {
												echo '<div class="table-responsive add-content" style="border-bottom:1px solid #ccc;"><table><tr><td><label>Video code</label></td><td><label>Caption</label></td></tr><tr><td><textarea required class="form-control" id="p_new_'.$i.'" name="media['.$i.'][video_code]" rows="1" cols="40">'.$val['vid_code'].'</textarea></td><td><textarea  class="form-control" id="caption_'.$i.'" name="media['.$i.'][caption]" rows="1" cols="40">'.$val['caption'].'</textarea></td><td><input type="hidden" name="media['.$i.'][type]" value="video" /><input type="hidden" name="media['.$i.'][id]" id="media_'.$i.'_id" value="'.$val['id'].'" /><a href="#" id="remove_'.$i.'" onclick="remove_new(this.id);return false;"><i class="glyphicon glyphicon-remove" style="color:#3c8dbc"></i>&nbsp; Remove</a></td></tr> </table></div>';
												
											}
											
										}
									?>
								</div>
								<p>
									<a href="#" onclick="add_more_images();return false;" id="addNew"><i class="glyphicon glyphicon-picture" style="color:#3c8dbc"></i>&nbsp;Add image</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="#" onclick="add_more_videos();return false;" id="addNew"><i class="glyphicon glyphicon-facetime-video
" style="color:#3c8dbc"></i>&nbsp;Add video</a>
									
									</p>
								
							</div>
								</div>
								<!--first div ends-->
								<!--second div-->
								<div class="col-md-6">
								<div class="form-group">
								<label><?php echo 'Category';?></label><span class="errors">*</span>
								<div>
								<select class="form-control" title="Category" id="cat_id" name="cat_id" >
								<option value="" >-- Select category --</option>
								<?php 
									foreach($cat_list as $row)
									{
										 $mm = $row['category']; 
										 if($post_data['cat_id'] == $row['id']){
											echo '<option selected value="'.$row['id'].'"> '.$mm.'</option>';
										 }
										 else {
											echo '<option value="'.$row['id'].'"> '.$mm.'</option>';
										 }
										
									}
								?>																			  
								</select>
								</div>
							</div>
							<div class="form-group">
								<?php echo form_label('Country name','loc_id');?>&nbsp;&nbsp;&nbsp;<span class="help">Choose Country>>State>>district</span>
								<select class="form-control" title="Country" id="country" name="country" onchange="get_State('<?php echo base_url();?>',this.value,'revname','sb');">
								 <option value="">- Select Country - </option>
								 <?php foreach($country as $val): ?>
								 <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
							 <?php endforeach; ?>
							   </select>
								<span class="help">Leave blank if you dont want to change the location</span>
							</div>
							<div class="form-group" id="revname" style="display:none;">
							
							</div>
							<div class="form-group" id="revname1" style="display:none;">
							
							</div>
							
							<div class="form-group">
								<label for="dtp_input1" class="control-label">Publish date</label>
								<div class="input-group date form_datetime" data-date-format="d/m/yyyy" data-date="<?php echo @$post_data['publish_date']?>" data-link-field="dtp_input1">
									<input required class="form-control" size="16" type="text" value="<?php echo @$post_data['publish_date']?>" readonly>
									<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
									
								</div>
								<span class="help">Leave blank if you dont want to change the publish date</span>
								<input required type="hidden" title="Publish date" name="publish_date" id="dtp_input1" value="<?php echo @$post_data['publish_date']?>" /><input required type="hidden" name="modified_date" value="<?php echo date('Y-M-d H:i:s');?>" /><br/>
								
							</div>
							<div class="form-group">
								<table>
								<tr>
								<td>
								<?php
									$data = array(
									'name'        => 'slider',
									'id'          => 'slider',
									'value'       => '1',
									'style'       => 'margin:10px',
									'class'		=>'form-control',
									'checked'		=> $post_data['slider']
									);

								echo form_checkbox($data);
								?>
								</td>
								<td>
								<?php echo form_label('Include in slider','slider');?>
								</td>
								
								</tr>
								<tr>
								<td>
								<?php
									$data = array(
									'name'        => 'ticker',
									'id'          => 'ticker',
									'value'       => '1',
									'style'       => 'margin:10px',
									'class'		=>'form-control',
									'checked'		=> $post_data['ticker']
									);

								echo form_checkbox($data);
								?>
								</td>
								<td>
								<?php echo form_label('Include in ticker','ticker');?>
								</td>
								</tr>
								</table>
							</div>
							
							<!-- text input -->
							<?php echo form_fieldset('SEO');?>
							<div class="form-group">
								<?php echo form_label('Seo url','seo_url');?>
								<?php
								$data = array(
									'name'        => 'seo_url',
									'id'          => 'seo_url',
									'maxlength'   => '100',
									'size'        => '50',
									'class'		=> 'form-control',
									'value'		=> $post_data['seo_url'],
									'readonly'	=>true
									);
								echo form_input($data);
								?>
							</div>
							
							<!-- text input -->
							<div class="form-group">
								<?php echo form_label('Seo description','seo_desc');?>
								<?php
								$data = array(
									'name'        => 'seo_desc',
									'id'          => 'seo_desc',
									'maxlength'   => '100',
									'rows'        => '2',
									'cols'        => '10',
									'class'		=> 'form-control',
									'value'		=> $post_data['seo_desc']
									);
								echo form_textarea($data);
								?>
							</div>
							
							<!-- text input -->
							<div class="form-group">
								<?php echo form_label('Seo Keywords','seo_keyword');?>
								<?php
								$data = array(
									'name'        => 'seo_keyword',
									'id'          => 'seo_keyword',
									'maxlength'   => '100',
									'rows'        => '2',
									'cols'        => '10',
									'class'		=> 'form-control',
									'value'		=> $post_data['seo_keyword']
									);
								echo form_textarea($data);
								?>
							</div>
							
							
							<?php echo form_fieldset_close(); ?>	
								</div>
								<!--second div ends-->
							</div>
							
							
							
							
							<!-- text input -->
							
							
							
							
									
							<div class="box-footer">
								<button type="submit" class="btn btn-primary"> <?php echo 'Save';?></button>
							</div>
							

						</form>
						<div class="box-footer" style="margin-left: 60px; margin-top:-55px;"><a href="<?php echo base_url();?>index.php/adminPosts/show_posts" tabindex="6"><button class='btn btn-primary'>Cancel</button></a></div>
					</div>
				
				
				</div>
				
			</div>
		</div>
	
	</section><!-- /.content -->
</aside>
<script>
	//handle dynamic media
	function add_more_images() {
	var addDiv = $('#addinput');
	var i = $('#addinput div').size()+1;
	$('<div class="table-responsive add-content" style="border-bottom:1px solid #ccc;"><table><tr><td><label>Upload file</label></td><td><label>Caption</label></td></tr><tr><td><input required type="file" id="p_new_'+i+'" size="40" name="media_files_'+i+'" value=""/></td><td><textarea class="form-control"  id="img_desc_'+i+'" name="media['+i+'][caption]" rows="1" cols="40"></textarea><td><input type="hidden" name="media['+i+'][type]" value="image" /><a href="#" id="remove_'+i+'" onclick="remove_new(this.id);return false;"><i class="glyphicon glyphicon-remove" style="color:#3c8dbc"></i>&nbsp;Remove</a></td></td></tr></table></div>').appendTo(addDiv);
	i++;
	}
		
	function add_more_videos() {
	var addDiv = $('#addinput');
	var i = $('#addinput div').size()+1;
	$('<div class="table-responsive add-content" style="border-bottom:1px solid #ccc;"><table><tr><td><label>Video code</label><br/><span class="help">eg. https://www.youtube.com/watch?v=jarhoEnhlGY&feature=youtu.be</span></td><td><label>Caption</label></td></tr><tr><td><textarea required class="form-control" id="p_new_'+i+'" name="media['+i+'][video_code]" rows="1" cols="40"></textarea></td><td><textarea class="form-control" id="caption_'+i+'" name="media['+i+'][caption]" rows="1" cols="40"></textarea></td><td><input type="hidden" name="media['+i+'][type]" value="video" /><a href="#" id="remove_'+i+'" onclick="remove_new(this.id);return false;"><i class="glyphicon glyphicon-remove" style="color:#3c8dbc"></i>&nbsp;Remove</a></td></tr> </table></div>').appendTo(addDiv);
	i++;
	}
	
	function remove_new(e) {
		var addDiv = $('#addinput');
		var i = $('#addinput div').size();
		var removed_ele = e.split("_");
		removed_ele = removed_ele[1];
		console.log(i);
		console.log(removed_ele);
		var j=parseInt(removed_ele)+1;
		console.log(j);
		
		/* test */
		var media_id = $("#media_"+removed_ele+"_id").val();
		console.log(media_id);
		var url1 = "<?php echo base_url();?>index.php/adminPosts/remove_media/";
		 $.ajax({
			url: url1,
			type: "POST",
			dataType: 'json',
			data: "media_id="+media_id,
			success: function(data){
				if(data)
				{	console.log(data);
					//$("#addinput div:last").remove();
					//$('#'+e).closest('div').remove();
					$('#'+e).closest('div').hide('slow', function(){ $('#'+e).closest('div').remove(); });

				}
				else
				{

				}
			}
		});
		/* test ends */
		//$('#'+e).closest('div').remove();
		while(j<=i){
			var type = document.getElementsByName("media["+j+"][type]")[0].value;
			var k=j-1;
			if(type == 'video'){
			
				$("#p_new_"+j).attr('name','media['+k+'][video_code]');
				$("#caption_"+j).attr('name','media['+k+'][caption]');
				$("#caption_"+j).attr('id','caption_'+k);
				$("#p_new_"+j).attr('id','p_new_'+k);
			}
			if(type == 'image'){
				$("#p_new_"+j).attr('name','media_files_'+k);
				$("#img_desc_"+j).attr('name','media['+k+'][caption]');
				$("#img_desc_"+j).attr('id','img_desc_'+k);
				$("#p_new_"+j).attr('id','p_new_'+k);

			}
			var str = "media["+j+"][type]";
			$('[name="'+str+'"]').attr('name',"media["+k+"][type]");
			$('#remove_'+j).attr('id',"remove_"+k);
			
			//change media_id
			$('#media_'+j+'_id').attr('name','media['+k+'][id]');
			$('#media_'+j+'_id').attr('id','media_'+k+'_id');
			
		j++;
		}
		
	}
	
	/* function remove_added(){
		var i = $('#addinput div').size();
		var media_id = $("#media_"+i+"_id").val();
		console.log(media_id);
		var url1 = "<?php echo base_url();?>index.php/adminPosts/remove_media/";
		 $.ajax({
			url: url1,
			type: "POST",
			dataType: 'json',
			data: "media_id="+media_id,
			success: function(data){
				if(data)
				{	console.log(data);
					//$("#addinput div:last").remove();
					$("#addinput div:last").hide('slow', function(){ $("#addinput div:last").remove(); });
				}
				else
				{

				}
			}
		}); 
	}	 */
</script>
