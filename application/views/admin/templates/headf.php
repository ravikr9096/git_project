<?php
//print_r($this->session->userdata);
$user_session_id = $this->session->userdata('admin_validated');
if(empty($user_session_id))
{
	redirect('admin');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin NEC Store |  <?php echo $this->lang->line('Dashboard');?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
       <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url();?>assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    	<?php
    		
            $style_menu_top = '';$style_cat = ''; $style_rebate = '';$style_product = '';$style_review='';$style_attrib = '';$style_user = '';$style_page = ''; $style_asset='';$style_page_top = '';$style_news = '';
    		$style_news_top = ''; $style_ncat = '';$style_offer='';$style_roles = '';$style_roles_top = '';$style_order_user='';$style_project='';$style_email=''; $style_rights_top = ''; $style_rights_top = ''; $style_rights='';
            //$lang_data = $this->session->userdata['lang_used'];
            $user_name=$this->session->userdata['admin_name'];
    		$member_since=$this->session->userdata['member_since'];
    		$member_date=explode(' ',$member_since);

            $check_tag = $this->uri->segment(1);
            $check_tag2 = $this->uri->segment(2);
            $check_tag3 = $this->uri->segment(3);
            if( ($check_tag == 'adminCategory' && $check_tag2 == 'category_list') || ($check_tag == 'adminCategory' && $check_tag2 == 'add_category') || ($check_tag == 'adminCategory' && $check_tag2 == 'edit_category'))
            {
              $style_menu_top = 'active'; 
              $style_cat = 'active';
            }
            if( ($check_tag == 'adminCategory' && $check_tag2 == 'rebate_category_list') || ($check_tag == 'adminCategory' && $check_tag2 == 'edit_rebate_category') || ($check_tag == 'adminCategory' && $check_tag2 == 'add_rebate_category') )
            {
              $style_menu_top = 'active'; 
              $style_rebate = 'active';
            }
            if( ($check_tag == 'adminProduct' && $check_tag2 =='product_list') || ($check_tag == 'adminProduct' && $check_tag2 =='edit_product') || ($check_tag == 'adminProduct' && $check_tag2 =='add_product') )
            {
              $style_menu_top = 'active'; 
              $style_product = 'active';
            }
            if( ($check_tag == 'adminReview' && $check_tag2 =='review_list') || ($check_tag == 'adminReview' && $check_tag2 =='add_review') || ($check_tag == 'adminReview' && $check_tag2 =='edit_review'))
            {
              $style_menu_top = 'active'; 
              $style_review = 'active';
            }

            if( ($check_tag == 'adminAttribute' && $check_tag2 =='attribute_list') || ($check_tag == 'adminAttribute' && $check_tag2 =='add_attribute') || ($check_tag == 'adminAttribute' && $check_tag2 =='edit_attribute') || ($check_tag == 'adminAttribute' && $check_tag2 =='add_attribute_group') || ($check_tag == 'adminAttribute' && $check_tag2 =='edit_attribute_group'))
            {
              $style_menu_top = 'active'; 
              $style_attrib = 'active';
            }

            if( ($check_tag == 'adminUser' && $check_tag2 =='reseller_list') || ($check_tag == 'adminUser' && $check_tag2 =='add_reseller') || ($check_tag == 'adminUser' && $check_tag2 =='edit_reseller') )
            {
             //$style_menu_top = 'active'; 
              $style_user = 'active';
            }
			// code for active link of order
			if(($check_tag == 'adminOrders' && $check_tag2 =='order_list'))
            {
             //$style_menu_top = 'active'; 
              $style_order_user = 'active';
            }
			// code for orders ends here
			
			// code for active link of project
			if(($check_tag == 'adminProject' && $check_tag2 =='project_list'))
            {
             //$style_menu_top = 'active'; 
              $style_project = 'active';
            }
			// code for orders ends here
			
			// code email template menu
			 if( ($check_tag == 'adminEmailTemplates' && $check_tag2 == 'show_email_templates') || ($check_tag == 'admin' && $check_tag3 == 'add_email_template') || ($check_tag == 'adminEmailTemplates' && $check_tag2 == 'show_edit_emailtemplate'))
            {
                $style_email = 'active';
            }
			// email template ends here
            if( ($check_tag == 'adminAsset' && $check_tag2 == 'asset_list') || ($check_tag == 'adminAsset' && $check_tag2 == 'add_asset') || ($check_tag == 'adminAsset' && $check_tag2 == 'edit_asset'))
            {
              $style_page_top = 'active'; 
              $style_asset = 'active';
            }
            if( ($check_tag == 'admin' && $check_tag2 == 'show_page_data') || ($check_tag == 'admin' && $check_tag2 == 'show_edit_page') || ($check_tag == 'admin' && $check_tag3 == 'add_page'))
            {
              $style_page_top = 'active'; 
              $style_page = 'active';
            }
            if( ($check_tag == 'adminNews' && $check_tag2 == 'show_news') || ($check_tag == 'adminNews' && $check_tag2 == 'show_edit_news') || ($check_tag == 'adminNews' && $check_tag3 == 'add_news'))
            {
              $style_news_top = 'active'; 
              $style_news = 'active';
            }
            if(($check_tag == 'adminNews' && $check_tag2 == 'show_news_categories') || ($check_tag == 'adminNews' && $check_tag2 == 'show_edit_category') || ($check_tag == 'adminNews' && $check_tag3 == 'add_news_category'))
            {
                $style_news_top = 'active'; 
                $style_ncat = 'active';
            }
            if(($check_tag == 'adminOffer' && $check_tag2 == 'add_offer') || ($check_tag == 'adminOffer' && $check_tag2 == 'edit_offer') || ($check_tag == 'adminOffer' && $check_tag2 == 'offer_list'))
            {
                //$style_offer_top = 'active'; 
                $style_offer = 'active';
            }
			
			if(($check_tag == 'adminRoleManagement' && $check_tag2 == 'add_roles') || ($check_tag == 'adminRoleManagement' && $check_tag2 == 'show_edit_role') || ($check_tag == 'adminRoleManagement' && $check_tag2 == 'show_roles') || ($check_tag == 'adminRoleManagement' && $check_tag2 == 'add_view') || ($check_tag == 'adminRoleManagement' && $check_tag2 == 'show_staff') || ($check_tag == 'adminRoleManagement' && $check_tag2 == 'show_edit_staff'))
            {
                $style_roles_top = 'active'; 
                $style_roles = 'active';
            }

            if(($check_tag == 'adminRoleManagement' && $check_tag2 == 'rights_list') || ($check_tag == 'adminRoleManagement' && $check_tag2 == 'add_rights') || ($check_tag == 'adminRoleManagement' && $check_tag2 == 'edit_rights'))
            {
                $style_roles_top = 'active'; 
                $style_rights = 'active';
            }
           

    	?>

        		
	</head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                NEC Store Admin 
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <!-- <div style="padding-left:20px;">    
                <span>&nbsp;&nbsp;</span>
                </div>    <span>&nbsp;&nbsp;</span>
                
                <span style="margin-top:50px;border:1px solid blue;margin-bottom:20px;">
                <a href="<?php echo base_url(); ?>index.php/langswitch/switchLanguage/european" style="color:red;">
                <img src="<?php echo base_url(); ?>assets/admin/img/Germany.png" height="32" width="32" alt="European"/></a>
                </span>
                <span style="margin-top:50px;border:1px solid blue;">
                <a href="<?php echo base_url(); ?>index.php/langswitch/switchLanguage/english" style="color:red;">
                <img src="<?php echo base_url(); ?>assets/admin/img/usa.png"  height="32" width="32" alt="English"/></a> || 
                </span> -->
                  
                <div class="bound_with_flag"style="float:right;">
                <div class="flages" style="float:left; padding: 14px;">
                 <!-- <a href="<?php echo base_url(); ?>" target="_blank">
                 <img src="<?php echo base_url(); ?>assets/images/visit1.jpg"  alt="visit website" title="visit website"/>
                 </a> -->
                 <a href="<?php echo base_url(); ?>index.php/langswitch/switchLanguage/european">
                <img src="<?php echo base_url(); ?>assets/images/germny-flg.png"  alt="European" title="Deutsch"/></a>  
                </div>

                <div class="flages" style="float:left; padding: 14px;">
                 <a href="<?php echo base_url(); ?>index.php/langswitch/switchLanguage/english">
                <img src="<?php echo base_url(); ?>assets/images/eng-flg.png" alt="English" title="English"/></a> 
                </div>



                <div class="navbar-right">
               
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        <!-- Notifications: style can be found in dropdown.less -->
                        
                        <!-- Tasks: style can be found in dropdown.less -->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $user_name; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url();?>assets/admin/img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $user_name; ?> - <?php echo $this->lang->line('Administrator');?>
                                        <small><?php echo $this->lang->line('Member since');?> <?php echo $member_date[0]; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat"><?php echo $this->lang->line('Profile');?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url();?>index.php/admin/logout" class="btn btn-default btn-flat"><?php echo $this->lang->line('Sign out');?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                
                </div>
                </div>
            </nav>
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url();?>assets/admin/img/avatar3.png" class="img-circle" alt="User Image" />
                        <!-- <a href="<?php echo base_url(); ?>index.php/langswitch/switchLanguage/english" style="color:red;">English</a> || 
                        <a href="<?php echo base_url(); ?>index.php/langswitch/switchLanguage/european" style="color:red;">European</a> -->
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $user_name; ?> </p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                           <!--  <a href="<?php echo base_url();?>index.php/admin/set_language/2">Translate</a> -->
                        </div>
                    </div>
                    <!-- search form -->
                    <!--<form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -- >
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="treeview <?php echo $style_roles_top;?>">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span> <?php echo $this->lang->line('Dashboard');?></span>
								 <i class="fa fa-angle-left pull-right"></i>
								 
								<ul class="treeview-menu" >
									<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>index.php/adminRoleManagement/show_roles"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Roles');?></a></li>
									<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>index.php/adminRoleManagement/show_staff"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Staff');?></a></li>
									<li  class="<?php echo $style_rights; ?>"><a href="<?php echo base_url();?>index.php/adminRoleManagement/rights_list"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Role Rights');?></a></li>
                                    
								</ul>
                            </a>
                        </li>
                        <li class="treeview <?php echo $style_menu_top;?>">
                            <a href="#">
                                <i class="fa fa-th"></i> <span><?php echo $this->lang->line('Catelog');?></span> 
								 <i class="fa fa-angle-left pull-right"></i>
                            </a>
							 <ul class="treeview-menu">
                             <!--<?php //echo base_url();?>index.php/adminProduct/product_list-->
                                <li class="<?php echo $style_cat;?>" ><a href="<?php echo base_url();?>index.php/adminCategory/category_list"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Categories');?></a></li>
                                <li class="<?php echo $style_rebate;?>" ><a href="<?php echo base_url();?>index.php/adminCategory/rebate_category_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Rebate Categories');?></a></li>
                                <li class="<?php echo $style_product;?>"><a href="<?php echo base_url();?>index.php/adminProduct/product_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Products');?></a></li>
								<!-- <li class="<?php echo $style_attrib;?>"><a href="<?php echo base_url();?>index.php/adminAttribute/attribute_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Attributes');?></a></li> -->
								<li class="<?php echo $style_review;?>"><a href="<?php echo base_url();?>index.php/adminReview/review_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Reviews');?></a></li>
                            </ul>
                        </li>
						
						<li class="<?php echo $style_user;?>">
                            <a href="<?php echo base_url();?>index.php/adminUser/reseller_list">
								<i class="fa fa-users warning"></i> <span><?php echo $this->lang->line('Reseller');?></span> 								
                            </a>							
                        </li>
						
						<li class="<?php echo $style_order_user; ?>">
                            <a href="<?php echo base_url();?>index.php/adminOrders/order_list">
                                <i class="fa fa-fw fa-shopping-cart"></i> <span><?php echo $this->lang->line('Orders');?></span> 								
                            </a>							
                        </li>
						
						<li class="<?php echo $style_project; ?>">
                            <a href="<?php echo base_url();?>index.php/adminProject/project_list">
                                <i class="fa fa-folder"></i> <span><?php echo $this->lang->line('Projects');?></span> 								
                            </a>							
                        </li>
						
                        <li class="treeview <?php echo $style_page_top; ?>">
                            <a href="#">
                                <i class="fa fa-fw fa-book"></i>
                                <span><?php echo $this->lang->line('Contents');?></span>   
								<i class="fa fa-angle-left pull-right"></i>		
                            </a>
                            <ul class="treeview-menu" >
                                <li  class="<?php echo $style_page; ?>"><a href="<?php echo base_url();?>index.php/admin/show_page_data"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Pages');?> </a></li>
                                <li  class="<?php echo $style_asset; ?>"><a href="<?php echo base_url();?>index.php/adminAsset/asset_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Assets');?> </a></li>
                            </ul>
                        </li>
						
						<li class="<?php echo $style_offer; ?>">
                        <!--<?php //echo base_url();?>index.php/adminOffer/offer_list
                        <?php //echo base_url();?>index.php/adminAsset/asset_list
                        <?php //echo base_url();?>index.php/adminAsset/test_upload
                        <?php //echo base_url();?>index.php/adminAsset/test_upload
                        -->
                            <a href="<?php echo base_url();?>index.php/adminOffer/offer_list">
                                <i class="fa fa-fw fa-volume-up"></i> <span><?php echo $this->lang->line('Coupon/Offers');?></span> 								
                            </a>							
                        </li>
						
						<li class="treeview <?php echo $style_news_top;?>">
                            <a href="#">
                                <i class="fa fa-fw fa-list-alt"></i> <span><?php echo $this->lang->line('News');?></span> 	
								<i class="fa fa-angle-left pull-right"></i>		
                            </a>	
							<ul class="treeview-menu">
                                <li class="<?php echo $style_ncat;?>"><a href="<?php echo base_url();?>index.php/adminNews/show_news_categories"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Categories');?></a></li>
                                <li class="<?php echo $style_news;?>"><a href="<?php echo base_url();?>index.php/adminNews/show_news"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('News');?></a></li>
                             </ul>	
                        </li> 
						
						<li class="<?php echo $style_email; ?>">
                            <a href="<?php echo base_url();?>index.php/adminEmailTemplates/show_email_templates">
                                 <i class="fa fa-envelope"></i> <span><?php echo $this->lang->line('Email Templates');?></span> 								
                            </a>							
                        </li>
                        <li class="">
                            <a href="<?php echo base_url();?>index.php/adminTracking">
                               <span class="glyphicon glyphicon-screenshot"></span><span>Tracking</span>                               
                            </a>                            
                        </li>
                        <li class="">
                            <a href="<?php echo base_url();?>index.php/adminTracking/orderHistory">
                            <i class="fa fa-fw fa-group"></i> <span>Order History</span>                               
                            </a>                            
                        </li>

                        <li class="">
                            <a href="<?php echo base_url();?>index.php/adminTracking/statistics">
                            <i class="fa fa-fw fa-group"></i> <span>Statistics</span>                               
                            </a>                            
                        </li>
                       
                       
						
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

        