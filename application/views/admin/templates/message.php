		
		<!-- message start-->
		<?php if($this->session->flashdata('msg_write')){?>
		<!--<p class="msginfo" id="success"><span class="info_inner"><?php //echo $this->session->flashdata('msg_write');?></span></p>-->
		<br/>
		<div class="alert alert-success alert-dismissable" style="width:1050px;margin-left:30px;margin-bottom:-1px">
        <i class="fa fa-check"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <b><?php echo $this->session->flashdata('msg_write');?></b>
        </div>
		<?php } ?>
		
		<?php if($this->session->flashdata('msg_wrong')){?>
		<!--<p class="msginfo" id="error"><span class="info_inner"></span></p>-->
		<br/><div class="alert alert-danger alert-dismissable" style="width:1050px;margin-left:30px;margin-bottom:-1px"><i class="fa fa-ban"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b><?php echo $this->session->flashdata('msg_wrong');?></b></div>
		<?php } ?>
		<!-- message start end-->