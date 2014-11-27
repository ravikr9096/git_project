<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo 'Edit Advertisement';?>  &nbsp;&nbsp;&nbsp;&nbsp;
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
            <form  action="<?php echo base_url(); ?>index.php/adminAdds/update_add/<?php echo $add_data['id'] ?>" method="post" onsubmit="return check_adds_edit_2(this,'<?php echo $add_data['id'] ?>');" enctype="multipart/form-data">
			
            <input type="hidden" name="edit_id" value="<?php echo $add_data['id'] ?>">
            <input type="hidden" name="loc_id" value="<?php echo $add_data['loc_id'] ?>">
			
			<input type="hidden" name="set_field1_<?php echo $add_data['id'] ?>" id="set_field1_<?php echo $add_data['id'] ?>" value="<?php 
						if($add_data['script_code']=='') echo 1;
						else echo 2;
						?>"/>
				<div class="form-group">
                    <label>Advertisement title</label>
                    <input class="form-control" type="text" placeholder="Enter Article title" value="<?php echo $add_data['title']?>" name="title" />
                </div>
                <div class="form-group">
                    <label>Location:</label>
                    <select class="form-control" id="country" name="country" onchange="get_State_for_adds('<?php echo base_url();?>',this.value,'revname_edit_<?php echo $add_data['id'] ?>','<?php echo $add_data['id'] ?>');">
                                 <option value="">- Select Country - </option>
                                 <?php foreach($country as $val): ?>
                                 <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                             <?php endforeach; ?>
                               </select>
                               <span class="help">Leave blank if you don't want to change the location</span>
                </div>
                <div class="form-group" id="revname_edit_<?php echo $add_data['id'] ?>" style="display:none;">
                            
				</div>
				<div class="form-group" id="revname1_edit_<?php echo $add_data['id'] ?>" style="display:none;">
						
				</div>
				<div class="form-group">
                    <label>Region on page</label>
                    <select  class="form-control" name="region"> 
						<option value="0">-Select area on page-</option>
						<?php
						foreach($ads_region as $val) {
							$str = '<option';
							if($add_data['region_id'] == $val['id']) {
								$str.=' selected';
							
							}
							$str.= ' value="'.$val['id'].'">'.$val['title'].'</option>';
							echo $str;
						}
						?>
						<option>
					</select>
                </div>
				&nbsp;&nbsp;<label>Please Select Add Type:</label><br/>
               <div class="form-group">

               <div onclick="show_image1(<?php echo $add_data['id']; ?>)" style="cursor:pointer;"><span class="glyphicon glyphicon-picture"></span>&nbsp;Upload Image</div>
                <div onclick="show_textarea1(<?php echo $add_data['id']; ?>)" style="cursor:pointer;float:left;"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Add Script</div>
                
               </div>
                
                <div class="form-group" style="display:<?php 
						if($add_data['script_code']=='') echo 'block';
						else echo 'none';
						?>" id="s_img1_<?php echo $add_data['id']; ?>">
						
						<label>Url</label>
						<input class="form-control" value="<?php echo $add_data['url'] ?>" type="text" placeholder="Enter add url" name="url" />
                        <input type="hidden" id="ex_img" name="ex_img" value="<?php echo $add_data['add_img'] ?>"/>


					<?php if($add_data['add_img']):?><img src="<?php echo base_url();?>uploads/adds/<?php echo $add_data['add_img'] ?>" width="100" height="100"/><?php endif;?></br>
                    <label for="exampleInputFile">Select image</label>
					
                    <input type="file" id="add_img" name="add_img">
                    <span class="help">Upload new image if you want to change</span>
                </div>
				<div class="form-group" style="display:<?php 
						if($add_data['script_code']=='') echo 'none';
						else echo 'block';?>" id="s_sc1_<?php echo $add_data['id']; ?>">
                    <label>Code For Advertisement </label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="script_code"><?php echo $add_data['script_code']?></textarea>
                </div>
				
                <!--<div class="form-group">
                    <label for="exampleInputFile">Gif image/code</label>
                    <input type="file" id="add_img" name="add_img">
                    <span class="help">Leave blank if you don't want to change the image</span>
                </div>

                <div class="form-group">
                    <label>Code For Advertisement </label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="script_code"><?php echo $add_data['script_code']?></textarea>
                </div>-->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="add_sub_edit">Edit</button>

                </div>
                <div class="form-group has-warning"><label class="control-label" for="inputWarning" id="warn_inf_edit" style="display:none;">Please fill location fields first to submit advertisement.</label></div>
             <!--end_check-->
			</form>
			<div class="box-footer" style="margin-left: 55px; margin-top:-90px;"><a href="<?php echo base_url();?>index.php/adminAdds" tabindex="6"><button class='btn btn-primary'>Cancel</button></a></div>			
            </div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
</aside>
