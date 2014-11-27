<?php
//print_r($this->session->userdata);
$user_session_id = $this->session->userdata('admin_validated');
if(empty($user_session_id))
{
	redirect('admin');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta name="author" content="PaweÅ‚ 'kilab' Balicki - kilab.pl" />
        <title>Admin Hindi Gaurav |  <?php echo $this->lang->line('Dashboard');?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!--bootstrap date/time picker-->
        <link href="<?php echo base_url();?>assets/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url();?>assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url();?>assets/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url();?>assets/admin/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url();?>assets/admin/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo base_url();?>assets/admin/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url();?>assets/admin/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
		 <!-- DATA TABLES -->
        <link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url();?>assets/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>assets/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- Custom styles-->
        <link href="<?php echo base_url();?>assets/admin/css/style.css" rel="stylesheet" type="text/css" />
		<!-- change colors for page headings-->
        <link href="<?php echo base_url();?>assets/admin/css/colpick.css" rel="stylesheet" type="text/css" />

        <!-- common js file for all -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/common.js" ></script>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    	<?php
    		$style_roles = '';$style_roles_top = '';
            //$lang_data = $this->session->userdata['lang_used'];
            $user_name=$this->session->userdata['name'];
            $user_id=$this->session->userdata['id'];
            $gender=$this->session->userdata['gender'];
    		$member_since=$this->session->userdata['member_since'];
    		$member_date=explode(' ',$member_since);
			
			
			
            
    	?>

        		
	</head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url();?>admin/view/home" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Hindi Gaurav 
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


                <div class="navbar-right">
               
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        <!-- Notifications: style can be found in dropdown.less -->
                        
                        <!-- Tasks: style can be found in dropdown.less -->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php if($gender == 'female'):?>
								<i class="fa fa-female"></i>
								<?php else:?>
								<i class="fa fa-male"></i>
								<?php endif;?>
                                <span><?php echo $user_name; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <p>
                                        <?php echo $user_name; ?>
                                        <small><?php echo $this->lang->line('Member since');?> <?php echo $member_date[0]; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url();?>adminUsers/edit_user/<?php echo $user_id;?>" class="btn btn-default btn-flat"><?php echo "Profile";?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url();?>admin/logout" class="btn btn-default btn-flat"><?php echo "Sign out";?></a>
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
                    <ul class="sidebar-menu">
						
						<?php if(access_check('art_create')||access_check('art_read')||access_check('art_update')||access_check('art_delete')||access_check('art_mod')):?>
                        <li>
                            <a href="<?php echo base_url();?>adminPosts/show_posts">
                                <i class="fa fa-file"></i> <span> <?php echo 'Articles';?></span>
							</a>
                        </li>
						<?php endif;?>
						
						<!-- Advertisement menu-->
						<?php if(access_check('ads_create')||access_check('ads_read')||access_check('ads_update')||access_check('ads_delete')):?>
                        <li>
                            <a href="<?php echo base_url();?>adminAdds">
                                <i class="fa fa-file"></i> <span> <?php echo 'Advertisement';?></span>								
                            </a>
                        </li>
						<?php endif;?>
						
						<!-- eMagazine menu-->
						<?php if(access_check()):?>
                        <li>
                            <a href="<?php echo base_url();?>EMagazine">
                                <i class="fa fa-file-text"></i> <span> <?php echo 'eMagazine';?></span>								
                            </a>
                        </li>
						<?php endif;?>
						<!-- Polls menu-->

						<?php if(access_check('polls_create')||access_check('polls_read')||access_check('polls_update')||access_check('polls_delete')):?>
                        <li>
                            <a href="<?php echo base_url();?>adminPolls/show_polls">

                                <i class="glyphicon glyphicon-thumbs-up"></i> <span> <?php echo 'Polls';?></span>								
                            </a>
                        </li>
						<?php endif;?>
						
						<!-- Comments menu-->
						<?php if(access_check('cmnt_create')||access_check('cmnt_read')||access_check('cmnt_update')||access_check('cmnt_delete')):?>
                        <li>
                            <a href="<?php echo base_url();?>adminComments/show_comments">
                                <i class="glyphicon glyphicon-comment"></i> <span> <?php echo 'Comments';?></span>								
                            </a>
                        </li>
						<?php endif;?>
						
						<!-- Site users menu-->
						<?php if(access_check('susr_create')||access_check('susr_read')||access_check('susr_update')||access_check('susr_delete')):?>
                        <li class="treeview <?php echo $style_roles_top;?>">
                            <a href="#">
                                <i class="fa fa-fw fa-users"></i> <span> <?php echo 'Site Users';?></span>
								<i class="fa fa-angle-left pull-right"></i>
                            </a>
							<ul class="treeview-menu" >
								<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>adminUsers/show_users/site_user"><i class="fa fa-angle-double-right"></i> <?php echo 'Site users';?></a></li>
								
								<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>adminUsers/show_users/fb_user"><i class="fa fa-angle-double-right"></i> <?php echo 'Facebook users';?></a></li>
											
																	
							</ul>
                        </li>
						<?php endif;?>
						
						<!-- User management-->
                        <?php if(access_check('pusr_create')||access_check('pusr_read')||access_check('pusr_update')||access_check('pusr_delete')||access_check('pusr_mod')):?>
						<li class="treeview <?php echo $style_roles_top;?>">
                            <a href="#">
                                <i class="fa fa-fw fa-users"></i> 
								<span> <?php echo 'Panel Users';?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>	 
							<ul class="treeview-menu" >
								<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>adminUsers/show_users"><i class="fa fa-angle-double-right"></i> <?php echo 'Users';?></a></li>
															
								<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>adminRoles/show_roles"><i class="fa fa-angle-double-right"></i> <?php echo 'Roles';?></a></li>
																	
							</ul>
                            
                        </li>
						<?php endif;?>
						
						<!-- Settings -->
                        <?php if(access_check()):?>
						<li class="treeview <?php echo $style_roles_top;?>">
                            <a href="#">
                                <i class="glyphicon glyphicon-cog"></i> <span> <?php echo 'Settings';?></span>
								 <i class="fa fa-angle-left pull-right"></i>
							</a>	 
								<ul class="treeview-menu" >
								
									<li><a href="<?php echo base_url();?>adminCategories/show_cat"><i class="fa fa-angle-double-right"></i> <?php echo 'Categories';?></a></li>
									
									<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>adminLocation/location"><i class="fa fa-angle-double-right"></i> <?php echo 'Location';?></a></li>
												
									
									<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>admin/menu"><i class="fa fa-angle-double-right"></i> <?php echo 'Menu';?></a></li>
									
									<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>admin/page_layout"><i class="fa fa-angle-double-right"></i> <?php echo 'Homepage layout';?></a></li>
									
									<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>admin/page_layout/news"><i class="fa fa-angle-double-right"></i> <?php echo 'Newspage layout';?></a></li>
									
									<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>admin/image_slider"><i class="fa fa-angle-double-right"></i> <?php echo 'Image slider';?></a></li>
									
									<li  class="<?php echo $style_roles; ?>"><a href="<?php echo base_url();?>admin/manage_color"><i class="fa fa-angle-double-right"></i> <?php echo 'Change colors';?></a></li>
																		
								</ul>
                            </a>
                        </li>
						<?php endif;?>
						
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

        