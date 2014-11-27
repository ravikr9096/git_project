
<aside class="right-side">                
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo 'Image slider';?>  &nbsp;&nbsp;&nbsp;&nbsp;
			<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#add-adds"  title="Add image" >Add image</button>
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
					<div class="row">
						<div class="col-md-6">
					  <div id="myCarousel" class="carousel slide" data-ride="carousel">
					  
					  <div class="carousel-inner" style="height:400px;">
						<?php
							if(@$slider_images[0]) {
							echo '<div class="item active">
						  <img src="'.base_url().$slider_images[0]['path'].'" alt="'.$slider_images[0]['id'].'">
						  
						</div>';
						unset($slider_images[0]);
							foreach($slider_images as $img) {
								echo '<div class="item">
						  <img src="'.base_url().$img['path'].'" alt="'.$img['id'].'">
						  
						</div>';
							}	
						}							
						?>	
						
					  </div>
					  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
					  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
					</div>
					<div class="col-md-6">
						<label>Images</label>
						<form method="post" action="<?php echo base_url()?>admin/image_slider_update">
						<div style="clear:both;"></div>
						<?php
							foreach($slider_images1 as $img) {
								echo '<div class="thumb_img" id="img_div_'.$img['id'].'"><img src="'.base_url().$img['path'].'" alt="'.$img['id'].'"><input type="hidden" name="img_arr[]" value="'.$img['id'].'"><a href="#" onclick="remove_image('.$img['id'].');return false;">Remove</a></div>';
							}
						
						?>
						<div style="clear:both;">
						<input type="submit" class="btn btn-primary" value="Save Changes">
						<a href="<?php echo base_url()?>admin/image_slider" class="btn btn-primary">Reset</a>
						</div>
						</form>
					</div>
					</div>
				</div>
				
			</div>
		</div>
	
	</section><!-- /.content -->
</aside>

<!-- pop up for add advertisement -->

        <div class="modal fade" id="add-adds" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New Image</h4>
                        
                    </div>
                    <section class="content">
        <div class="row">
                    <div class="col-md-12">
                        
                 <div class="box">
            <form method="post" action="<?php echo base_url(); ?>admin/save_slider_image" enctype="multipart/form-data">     
                   
                   <input type="hidden" name="set_field" id="set_field" value="1"/>
                
                
                
                <div class="form-group" style="display:block;" id="s_img">
                    <label for="exampleInputFile">Select image</label>
                    <input type="file" id="add_img" name="add_img">
                    
                </div>

                

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="add_submit" >Add</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button>

                </div>
             </form>   
            </div>
                
        </div>
 </div>
    
    </section><!-- /.content -->
    
                </div>
            </div>
        </div>

<script>
	function remove_image(id) {
		$("#img_div_"+id).hide(300).remove();
	}
</script>
