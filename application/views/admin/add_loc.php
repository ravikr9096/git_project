<?php //print_r($location); 
if(@$this->session->flashdata('msg_write')){
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
		   <?php echo 'Locations';?>  &nbsp;&nbsp;&nbsp;&nbsp;
			
            
			<div class="pull-right"><table><tr>
			<td><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#add-country" title="Add">Add Country</button>
		</td>
		<td><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#add-state"  title="Add" >Add State</button></td>
		<td><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#add-district"  title="Add" >Add District</button></td></tr></table>
    </div>
											
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
									<th><?php echo 'District';?></th>
									
									<th><?php echo 'State';?></th>
									<th><?php echo 'Country';?></th>
									
									
									<th><?php echo 'Action';?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($location as $l_val) { ?>
										<tr>
											<td><?php echo $l_val['id'] ?></td>
											<td><?php echo $l_val['name']; ?></td>
											
											<td><?php echo $this->common->getSingleValue('tbl_location','name','id',$l_val['parent_id']);?></td>

											<td>
												<?php 

											  $state_id = $this->common->getSingleValue('tbl_location','parent_id','id',$l_val['parent_id']);

												echo  $this->common->getSingleValue('tbl_location','name','id',$state_id);
												$con_id =  $this->common->getSingleValue('tbl_location','id','id',$state_id);
                                             ?>

										</td>

											<td><a href="#edit-district<?php echo $l_val['id'] ?>" title="Edit" data-toggle="modal"><img src="<?php echo base_url(); ?>assets/admin/img/edit.png" /></a>&nbsp;&nbsp;
											<?php if(access_check('is_admin')):?>
											<a onclick="return checkDelete();" href="<?php echo base_url();?>index.php/adminLocation/delete/<?php echo $l_val['id'] ?>" title="Delete"><img src="<?php echo base_url(); ?>assets/admin/img/delete.png" /></a>
											<?php endif;?>
											
											</td>
											    <!-- pop up for edit District -->

        <div class="modal fade" id="edit-district<?php echo $l_val['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit District</h4>
						
                    </div>
					<section class="content">
		<div class="row">
					<div class="col-md-12">
				<div class="box">
					<form method="post" action="<?php echo base_url();?>index.php/adminLocation/edit_district" onsubmit="return validateEditDistrict(this,<?php echo $l_val['id'] ?>)">
					<input type="hidden" name="district_edit_id" value="<?php echo $l_val['id'] ?>"/>

					<div class="form-group">
						<label>Country name</label>
						<select class="form-control" id="country" name="country" onchange="get_State2('<?php echo base_url()?>',this.value,'edit_state_outter<?php echo $l_val['id'] ?>','edit_state_inner<?php echo $l_val['id'] ?>','sub<?php echo $l_val['id'] ?>','state<?php echo $l_val['id'] ?>')"  tabindex="1">
                         
                         <?php foreach($country as $val): ?>

                         <option value="<?php echo $val['id'];?>" <?php if($state_id==$val['id']) echo 'selected'; ?>> <?php echo $val['name']?></option>

                     <?php endforeach; ?>
                       </select>
                       </div>
                        
						<div class="form-group">
							<div id="edit_state_outter<?php echo $l_val['id'] ?>"></div>

							<div id="edit_state_inner<?php echo $l_val['id'] ?>"><?php 
                             
							$state = $this->common->get_all_data('tbl_location','parent_id',$con_id);?>
						<label>State name</label>
                        <select class="form-control" id="state<?php echo $l_val['id'] ?>" name="state" tabindex="2">
                         
                         <?php foreach($state as $s_val): ?>

                         <option value="<?php echo $s_val['id'];?>" <?php if($l_val['parent_id']==$s_val['id']) echo 'selected'; ?>> <?php echo $s_val['name']?></option>

                     <?php endforeach; ?>

                       </select>
 						</div>
					</div>
					<div class="form-group">
						<label>District name</label>
                        <input type="text" class="form-control" id="district"  name="district" value="<?php echo $l_val['name'];?>" placeholder="District Name.." tabindex="3">

					</div>
					<div class="form-group">
						<label>Alias</label>
                        <input type="text" class="form-control" id="alias" placeholder="Alias.." name="alias" value="<?php echo $l_val['alias'];?>" tabindex="4">

					</div>
										
					<div class="modal-footer clearfix">

					
                     <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" tabindex="6"><i class="fa fa-times"></i> Discard</button>

                     <button type="submit" id="sub<?php echo $l_val['id'] ?>" class="btn btn-success pull-left" tabindex="5">Update</button>
					</div>
				</form>
			</div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
	
                </div>
            </div>
        </div>

										<!-- pop up end -->


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
	
<!-- pop up models -->

<div class="modal fade" id="add-country" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Country</h4>
						

                    </div>
					<section class="content">
		<div class="row">
					<div class="col-md-12">
				<div class="box">
				<div class="callout callout-info" style="height: 37px;padding: 7px;">
                <h4>Add</h4>
                                        
                  </div>	
					<form method="post" action="<?php echo base_url();?>index.php/adminLocation/save_country" onsubmit="return validateCountry(this)">
					
					<div class="form-group">
						<label>Continent name</label>
						<select class="form-control" id="continent" name="continent" autofocus="autofocus" tabindex="80">
						<option value=''>--Select option--</option>
						<?php
							foreach($continent as $val) {
								echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
							}
						
						?>
						</select>
					</div>
					<div class="form-group">
						<label>Country name</label>
						<input type="text" class="form-control" id="country_ad" placeholder="Enter Country Name.." name="country" autofocus="autofocus" tabindex="80">
					</div>
					<div class="form-group">	
						<label>Alias</label>
                        <input type="text" class="form-control" id="alias_country" placeholder="Enter Alias.." name="alias" tabindex="81">
					</div>
										
					<div class="modal-footer clearfix">

					
                     <!--<button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>-->

                     <button type="submit" class="btn btn-success pull-left" tabindex="82">Add</button>
					</div>
				</form>
			</div>
				
		</div>

<!-- delete country-->
	<div class="col-md-12">
				<div class="box">
				<div class="callout callout-danger" style="height: 37px;padding: 7px;">
                <h4>Delete</h4>
                                        
                  </div>	
					<form method="post" action="<?php echo base_url();?>index.php/adminLocation/delete_country" onsubmit="return country_delete(this);">
					
					<div class="form-group">
					<label>Country Name </label>
					<select class="form-control" id="country_d" name="country_d" onchange="check_con('<?php echo base_url();?>',this.value,'del')" tabindex="83">
                    <option value="">- Select Country - </option>
                    <?php foreach($country as $val): ?>
                    <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                    <?php endforeach; ?>
                    </select>
					</div>
										
					<div class="modal-footer clearfix">

                     <button type="button" class="btn btn-danger pull-right" tabindex="85" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                     <button type="submit" class="btn btn-success pull-left" id="del" tabindex="84">Delete</button>

					</div>
				</form>
			</div>
			</div>
                
       <!-- end -->

	</div>
	
	</section><!-- /.content -->
	
                </div>
              </div>
        </div>

        <!-- pop up for add state -->

        <div class="modal fade" id="add-state" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">States</h4>
						
                    </div>
					<section class="content">
		<div class="row">
					<div class="col-md-12">
						
				<div class="box">
					<div class="callout callout-info" style="height: 37px;padding: 7px;">
                <h4>Add</h4>
                                        
                  </div>
					<form method="post" action="<?php echo base_url();?>index.php/adminLocation/save_state" onsubmit="return validateState(this)">
					
					<div class="form-group">
						<label>Country name</label>
						<select class="form-control" id="country_add_state" autofocus="autofocus" name="country" tabindex="1" >
                         <option value="">- Select Country - </option>
                         <?php foreach($country as $val): ?>
                         <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                     <?php endforeach; ?>
                       </select>

						<label class="control-label text-red" for="inputError" id="er" style="display:none;">Input with error</label>

						</div>
                        
						<div class="form-group">
						<label>State name</label>
                        <input type="text" class="form-control" id="state_ad" placeholder="Enter State Name..." name="state" tabindex="2">

					</div>

					<div class="form-group">
						<label>Alias</label>
                        <input type="text" class="form-control" id="alias_state" placeholder="Enter Alias..." name="alias" tabindex="3">

					</div>
										
					<div class="modal-footer clearfix">

					
                     <!--<button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>-->

                     <button type="submit" class="btn btn-success pull-left" tabindex="4">Add</button>
					</div>
				</form>
			</div>
				
		</div>

<!-- delete state-->

	<div class="col-md-12">

				<div class="box">
					<div class="callout callout-danger" style="height: 37px;padding: 7px;">
<h4>Delete</h4>
                                        
 </div>
					<form method="post" action="<?php echo base_url();?>index.php/adminLocation/delete_state" onsubmit="return country_delete(this);">
					
					<div class="form-group">
					<label> Country name</label>
						<select class="form-control" id="country_d" name="country_d" onchange="get_State3('<?php echo base_url();?>',this.value)" tabindex="5">
                         <option value="">- Select Country - </option>
                         <?php foreach($country as $val): ?>
                         <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                     <?php endforeach; ?>
                       </select>

						</div>
                        <div class="form-group" id="state_div" style="display:none;">
						<label for="state">State name</label>
						<select class="form-control" id="state" name="state" onchange="check_con('<?php echo base_url();?>',this.value,'del_s');" style="display:none;">
                        
						</select>
						</div>
										
					<div class="modal-footer clearfix">

                     <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" tabindex="7"><i class="fa fa-times"></i> Discard</button>

                     <button type="submit" class="btn btn-success pull-left" id="del_s" style="display:none;" tabindex="6">Delete</button>

					</div>
				</form>
			</div>
			</div>
                
       <!-- end delete state code-->



	</div>
	
	</section><!-- /.content -->
	
                </div>
            </div>
        </div>

        <!-- pop up for add district -->

        <div class="modal fade" id="add-district" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">District</h4>
						
                    </div>
					<section class="content">
		<div class="row">
					<div class="col-md-12">
				<div class="box">
					<div class="callout callout-info" style="height: 37px;padding: 7px;">
                <h4>Add</h4>
                                        
                  </div>
					<form method="post" action="<?php echo base_url();?>index.php/adminLocation/save_district" onsubmit="return validateDistrict(this)">
					
					<div class="form-group">
						<label>Country name</label>
						<select class="form-control" id="country" name="country" onchange="get_State('<?php echo base_url();?>',this.value,'revname','sb');" autofocus="autofocus" tabindex="1">
                         <option value="">- Select Country - </option>
                         <?php foreach($country as $val): ?>
                         <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                     <?php endforeach; ?>
                       </select>

						</div>
                        <div class="form-group" id="revname" style="display:none;">
						</div>

						<div class="form-group">
						<label>District name</label>
                        <input type="text" class="form-control" id="district_ad" placeholder="Enter District Name..." name="district" tabindex="3">

					</div>

					<div class="form-group">
						<label>Alias</label>
                        <input type="text" class="form-control" id="alias_district" placeholder="Enter Alias..." name="alias" tabindex="4">

					</div>
										
					<div class="modal-footer clearfix">

					
                     <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" tabindex="6"><i class="fa fa-times"></i> Discard</button>

                     <button type="submit" class="btn btn-success pull-left" id="sb" style="display:none;" tabindex="5">Add</button>
                     <!--<p class="text-green pull-left">Please select country first</p>-->
					</div>
				</form>
			</div>
				
		</div>
	</div>
	
	</section><!-- /.content -->
	
                </div>
            </div>
        </div>