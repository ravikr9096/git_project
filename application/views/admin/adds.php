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
           <?php echo 'Advertisements';?>  &nbsp;&nbsp;&nbsp;&nbsp;
            
            <?php if(access_check('ads_create')){?>
            <div class="pull-right"><table><tr>
            <td><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#add-adds"  title="Add" >New Ad</button>
        </td>
        </tr></table>
    </div>
	<?php
	}?>
                                            
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
                                    <th><?php echo 'Title';?></th>
                                    <th><?php echo 'Location';?></th>
                                    
                                    <!--<th><?php echo 'Page';?></th>-->
                                    <th><?php echo 'Region';?></th>
                                    
                                    
                                    <th><?php echo 'Add Image';?></th>
                                    <th><?php echo 'Script Code';?></th>
                                    <th><?php echo 'Action';?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($adds as $l_val) { ?>
                                        <tr  data-toggle="popover" data-content="Total Views : <?php echo $l_val['show_ctr'];?><br /> Total Clicks : <?php echo $l_val['click_ctr']; ?>">
                                            
                                            <td><?php echo $l_val['id'] ?></span></td>
                                            <td><?php echo $l_val['title'] ?></td>

                                            <td><?php echo $this->common->getSingleValue('tbl_location','name','id',$l_val['loc_id']);?></td>

                                            <!--<td><?php echo $l_val['page_id'] ?></td>-->

                                            <td><?php echo $this->common->getSingleValue('tbl_ads_region','title','id',$l_val['region_id']); ?></td>
                                            <td><?php if($l_val['add_img']):?><img src="<?php echo base_url();?>uploads/adds/<?php echo $l_val['add_img'] ?>" width="45" height="45"/><?php endif;?></td>
                                            <td><?php echo $l_val['script_code'] ?></td>

                                            <td>
											<?php if(access_check('ads_update')):?>
											<a href="<?php echo base_url();?>index.php/adminAdds/edit_add/<?php echo $l_val['id']; ?>" title="Edit" data-toggle="modal"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a>&nbsp;&nbsp;
											<?php endif;?>
                                            <?php if(access_check('ads_delete')):?>
                                            <a onclick="return checkDelete();" href="<?php echo base_url();?>index.php/adminAdds/delete/<?php echo $l_val['id'] ?>" title="Delete"><img src="<?php echo base_url(); ?>assets/admin/img/delete.png" /></a>
                                            <?php endif;?>
                                            
                                            </td>
                                                <!-- pop up for edit District -->

        
           </tr>
                <?php } ?>
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


        <!-- pop up for add advertisement -->

        <div class="modal fade" id="add-adds" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New Ad</h4>
                        
                    </div>
                    <section class="content">
        <div class="row">
                    <div class="col-md-12">
                        
                 <div class="box">
            <form method="post" action="<?php echo base_url(); ?>index.php/adminAdds/save_add" onsubmit="return check_adds(this)" enctype="multipart/form-data">     
                   
                   <input type="hidden" name="set_field" id="set_field" value="1"/>
                
				<div class="form-group">
                    <label>Advertisement Title</label>
                    <input class="form-control" type="text" placeholder="Enter Article title" name="title" />
                </div>
                <div class="form-group">
                    <label>Location:</label>
                    <select class="form-control" id="country" name="country" onchange="get_State('<?php echo base_url();?>',this.value,'revname','sb');homepage_regions();">
                                 <option value="">- Select Country - </option>
                                 <?php foreach($country as $val): ?>
                                 <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                             <?php endforeach; ?>
                               </select>
                </div>
                <div class="form-group" id="revname" style="display:none;">
                            
                    </div>
                    <div class="form-group" id="revname1" style="display:none;">
                            
                    </div>
				<div class="form-group" id="region-wrap" style="display:none;">
                    <label>Region on page</label>
                    <select  class="form-control" id="region" name="region"> 
						<option value="0">-Select area on page-</option>
						<?php
						foreach($ads_region as $val) {
							echo '<option value="'.$val['id'].'">'.$val['title'].'</option>';
						
						}
						?>
						<option>
					</select>
                </div>
				

                &nbsp;&nbsp;<label>Please Select Add Type:</label><br/>
               <div class="form-group">

                <table><tr><td>
				<div onclick="show_image()" style="cursor:pointer;"><span class="glyphicon glyphicon-picture"></span>&nbsp;Upload Image</div></td><td>&nbsp;</td>
                <td><div onclick="show_textarea()" style="cursor:pointer;"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Add Script</div>
                </td>
            </tr></table>
               </div>
                
                <div class="form-group" style="display:block;" id="s_img">
					<label>Url</label>
                    <input class="form-control" type="text" placeholder="Enter add url" name="url" />
                    <label for="exampleInputFile">Select image</label>
                    <input type="file" id="add_img" name="add_img">
                    
                </div>

                <div class="form-group" style="display:none;" id="s_sc">
                    <label>Code For Advertisement </label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="script_code"></textarea>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="add_submit" style="display:none;">Add</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button>

                </div>
                <div class="form-group has-warning"><label class="control-label" for="inputWarning" id="warn_inf">Please fill location fields first to submit advertisement.</label></div>
             </form>   
            </div>
                
        </div>
 </div>
    
    </section><!-- /.content -->
    
                </div>
            </div>
        </div>

      