<?php
ini_set('display_errors', 0);

// Turn off all error reporting
error_reporting(0);

date_default_timezone_set('Asia/Calcutta');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<title> Hindi Gaurav</title>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/crasual.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/demo.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/colorbox.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/slippry.css">
<!-- Slider Kit styles -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sliderkit-core.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sliderkit-demos.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100italic,100,500,400italic,500italic,700,900italic,900,700italic' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.colorbox.js"></script>

<script src="<?php echo base_url();?>assets/js/slippry.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.sliderkit.1.9.2.pack.js"></script>
<!-- for typing in hindi-->
<script src="http://www.hinkhoj.com/common/js/keyboard.js"></script>
<link rel="stylesheet" type="text/css"
href="http://www.hinkhoj.com/common/css/keyboard.css" />


<link type="text/css" rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/css/map-css.css">

<script type="text/javascript" src="<?php echo base_url();?>assets/js/findReseller.js"></script>

<!-- for playing videos in popup
<script src="<?php echo base_url();?>assets/js/jquery.colorbox.js"></script>-->


<style type="text/css">
	.select-wrapper{
		float: left;
		display: inline-block;
		border: 1px solid #000;            
		background: url(assets/images/bg_select.png) no-repeat 115px center #fff;
		cursor: pointer;
		padding-right:5px;
	}
	.select-wrapper, .select-wrapper select{
		width: 128px;
		height:20px;
		line-height: 20px;
		float:none;
	}
	.select-wrapper .holder{
		display: block;
		white-space: nowrap;            
		/*overflow: hidden;
		cursor: pointer;
		position: relative;*/
		color:#000;
		padding-left:7px;
		z-index: -1;
	}
	.select-wrapper select{
		margin: 0;
		position: absolute;
		z-index: 2;            
		cursor: pointer;
		outline: none;
		opacity: 0;
		/* CSS hacks for older browsers */
		_noFocusLine: expression(this.hideFocus=true); 
		-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
		filter: alpha(opacity=0);
		-khtml-opacity: 0;
		-moz-opacity: 0;
	}
    /* Let's Beautify Our Form */
	
</style>
<script src="<?php echo base_url();?>assets/js/bgcarousel.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/script.js" type="text/javascript"></script>
<!-- start custom radio -->
<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select").each(function(){
            $(this).wrap("<span class='select-wrapper'></span>");
            $(this).after("<span class='holder'></span>");
        });
        $(".custom-select").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        }).trigger('change');
    })
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/scripts.js"></script>
<script type="text/javascript">
    function customRadio(radioName){
        var radioButton = $('input[name="'+ radioName +'"]');
        $(radioButton).each(function(){
            $(this).wrap( "<span class='custom-radio'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(radioButton).click(function(){
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
            $(radioButton).not(this).each(function(){
                $(this).parent().removeClass("selected");
            });
        });
    }
    $(document).ready(function (){
        customRadio("radio");
    })
</script>

<script type="text/javascript">
    function customRadio(radioName){
        var radioButton = $('input[name="'+ radioName +'"]');
        $(radioButton).each(function(){
            $(this).wrap( "<span class='custom-radio1'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(radioButton).click(function(){
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
            $(radioButton).not(this).each(function(){
                $(this).parent().removeClass("selected");
            });
        });
    }
    $(document).ready(function (){
        customRadio("radio1");
    })
</script>
<!-- end custom radio -->

<!--News Start-->
<style>
#slider-wrapper-news {
    float: left;
    height: 30px;
    position: relative;
    width:684px;
}
#slider-my-news {
    float: left;
    height: 30px;
	
    padding-left: 21px;
    position: relative;
    width: 660px;
}
.sp {
    height: 15px;
    line-height: 14px;
    padding-top:3px;
    position: absolute;
    width: 650px;
	color:#fff;
}
#nav {
    margin-top: 0;
    position: absolute;
    top: 0;
    width: 100%;
}
#button-previous {
    float: left;
    left: 4px;
    position: absolute;
    top: 7px;
	cursor:pointer;
}
#button-next {
    float: right;
    position: absolute;
    right: 4px;
    top: 7px;
	cursor:pointer;
}
</style>
<!--News End-->

<!--News Start-->
<style>
#slider-wrapper-news1 {
    float: left;
    height: 30px;
    position: relative;
    width:550px;
}
#slider-my-news1 {
    float: left;
	
    padding-left: 21px;
    position: relative;
    width:504px;
}
.sp1 {
    height: 15px;
    line-height: 14px;
    padding-top:5px;
    position: absolute;
    width: 505px;
	color:#fff;
	
}
#nav1 {
    margin-top: 0;
    position: absolute;
    top: 0;
    width: 100%;
}
#button-previous1 {
    float: left;
    left: 4px;
    position: absolute;
    top: 7px;
	cursor:pointer;
}
#button-next1 {
    float: right;
    position: absolute;
    right: 4px;
    top: 7px;
	cursor:pointer;
}
</style>

<!--News End-->

<!-- start custom radio -->
<style type="text/css">
.custom-radio{
	width: 24px;
	height: 18px;
	display: inline-block;
	position: relative;
	z-index: 1;
	top: 3px;
	background: url(assets/images/radio.png) no-repeat;
}
.custom-radio:hover{            
	background: url(assets/images/selected_radio.png) no-repeat;
}
.custom-radio.selected{
	background: url(assets/images/selected_radio.png) no-repeat;
}
.custom-radio input[type="radio"]{
	margin: 1px;
	position: absolute;
	z-index: 2;            
	cursor: pointer;
	outline: none;
	opacity: 0;
	/* CSS hacks for older browsers */
	_noFocusLine: expression(this.hideFocus=true); 
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
	-khtml-opacity: 0;
	-moz-opacity: 0;
}
.custom-radio1{
	width: 24px;
	height: 18px;
	display: inline-block;
	position: relative;
	z-index: 1;
	top: 3px;
	background: url(<?php echo base_url();?>assets/images/radio.png) no-repeat;
}
.custom-radio1:hover{            
	background: url(<?php echo base_url();?>assets/images/selected_radio.png) no-repeat;
}
.custom-radio1.selected{
	background: url(<?php echo base_url();?>assets/images/selected_radio.png) no-repeat;
}
.custom-radio1 input[type="radio"]{
	margin: 1px;
	position: absolute;
	z-index: 2;            
	cursor: pointer;
	outline: none;
	opacity: 0;
	/* CSS hacks for older browsers */
	_noFocusLine: expression(this.hideFocus=true); 
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
	-khtml-opacity: 0;
	-moz-opacity: 0;
}
</style>
<!-- end custom radio -->
<link type="text/css" rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/css/style-test.css" />

<!--  change the color of bars dynamically-->
<style>

<?php
foreach ($webcolors as $val) {
if($val['bck_select'] == 0) {
	if($val['title'] == 'body') {
		if($val['background']=="") {
			echo $val['title'].'{
			background:transparent;
			color:#'.$val['text'].';
			}';
		}
		else {
			echo $val['title'].'{
			background:#'.$val['background'].';
			color:#'.$val['text'].';
			}';
		}
	
	}
	else {
		if($val['background']=="") {
			echo '.'.$val['title'].'{
			background:transparent;
			color:#'.$val['text'].';
			}';
		}
		else {
			echo '.'.$val['title'].'{
			background:#'.$val['background'].';
			color:#'.$val['text'].';
			}';
		}
	}
}
else {
	if($val['title'] == 'body') {
		if($val['background_img']=="") {
			echo $val['title'].'{
			background:transparent;
			color:#'.$val['text'].';
			}';
		}
		else {
			echo $val['title'].'{
			background:url('.base_url().$val['background_img'].');
			color:#'.$val['text'].';
			}';
		}
	
	}
	else {
		if($val['background_img']=="") {
			echo '.'.$val['title'].'{
			background:transparent;
			color:#'.$val['text'].';
			}';
		}
		else {
			echo '.'.$val['title'].'{
			background:url('.base_url().$val['background_img'].');
			color:#'.$val['text'].';
			}';
		}
	}
	

}
echo '.'.$val['title'].' a{
	color:#'.$val['text'].' !important;
}';

echo '.'.$val['title'].' a:hover{
	color:#'.$val['text_hover'].' !important;
}';

}

?>
</style>
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1505955159634870&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- start topbar -->
<div class="topbar">
	<!-- start box -->
	<div class="box">
    	<!-- start login info -->
    	<div class="login-info">
			<input type="hidden" id="base" value="<?php echo base_url();?>" />
			<?php if($this->session->userdata('logged_user') == null):?>
        	<div class="login"><a onclick="display_login_box();" href="#" title="Login">Login</a></div>
			<div class="signup"><a onclick="display_signup_box();" href="#" title="Sign up">Sign up</a></div>
			<?php else:?>
			<div class="login"><a href="<?php echo base_url();?>/site_logout" class="btn btn-lg btn-primary btn-block" role="button">Logout</a></div>
			<div class="signup"><a href="#" title="User details"><?php $user_data = $this->session->userdata('logged_user');echo $user_data['user_name'];?></a></div>
			
			<?php endif;?>
			
            
        </div>
		<div id="login-box" class="login-box" style="display:none;"> 
			<div id="close_login_box" onclick="close_login();"><a href="#"><img src="<?php echo base_url();?>assets/images/img_cross1.png"></a></div>
			<div class="fb-login-box">
				<?php if(@$login_url):?>
				<a href="<?php echo $login_url ?>" class="btn btn-lg btn-primary btn-block" role="button"><img src="<?php echo base_url()?>/assets/images/fb-login-button.png" alt="FB Login" /></a>
			<?php endif;?>
            <p><a href="#" title="">Login From Social Media Facebook</a></p>
			</div>
			<div class="site-login-box">
            	<div class="site-login-detail">
                    <form action="#" onsubmit="sign_in();return false;" method="POST">
                    <label>Username / Email</label>
                    <input type="text" name="signin_username" id="signin_username" / >
                    <label>Password</label>
                    <input type="password" name="signin_password" id="signin_password" / >
                    <input type="submit" value="LOGIN" class="login-btn">
					<span class="errors" id="login_response" ></span>
                    </form>

					<br>
                </div>
				<p>Don't have account? Please <a onclick="display_signup_box();" href="#" title="Sign up">Sign up</a></p>
				
			</div>
			
		</div>
		<div id="signup-box" class="login-box" style="display:none;"> 
			<div id="close_login_box" onclick="close_signup();"><a href="#"><img src="<?php echo base_url();?>assets/images/img_cross1.png"></a></div>
			<div id="signup-box-inner" class="signup-content">
				<form action="#" onsubmit="sign_up();return false;" method="POST">
					<label>First name</label>
					<input type="text" name="signup_first_name" id="signup_first_name" / >
					<label>Last name</label>
					<input type="text" name="signup_last_name" id="signup_last_name" / >
					<label>Username</label>
					<input type="text" name="signup_username" id="signup_username" / >
					<label>Email</label>
					<input type="text" name="signup_email" id="signup_email" / >
					<label>Gender</label>
					<select name="signup_gender" id="signup_gender" class="selectbox">
						<option value=''>-select-</option>
						<option value='male'>Male</option>
						<option value='female'>Female</option>
					</select>
					
					<label>Password</label>
					<input type="password" name="signup_password" id="signup_password" / >
					<label>Confirm Password</label>
					<input type="password" name="signup_conf_password" id="signup_conf_password" / ><br />
					<span id="signup_error"></span><br/>
					<input type="submit" value="Signup" class="login-btn" >
				</form>
			</div>
			
		</div>
        <!-- end login info -->
        <span>Your current location is :<a id="activator1" class="activator" href="#"><?php echo $this->session->userdata('main_loc_name');?></a></span>
		<!-- start social -->
        <div class="social">
        	<ul>
            	<li class="facebook-like">
				<div class="fb-like" data-href="http://192.168.0.73/hindigaurav" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
				<!--<a href="#" title="facebook likes">facebook likes</a>-->
				</li>
                <li class="count-box"><a href="#" title="">facebook like</a></li>
                <li class="facebook"><a href="#" title="facebook">facebook </a></li>
                <li class="twitter"><a href="#" title="twitter">twitter</a></li>
                <li class="rss"><a href="#" title="Rss">Rss</a></li>
            </ul>
			
        </div>
        <!-- end social -->
    </div>
    <!-- end box -->
</div>
<!-- end topbar -->
<!-- start wrap -->
<div class="wrap">
	<!-- start box -->
	<div class="box">
    	<!-- start header -->
    	<div class="header">
        	<!-- start header top -->
        	<div class="header-top">
            	<!-- start city list -->
            	<div class="city-list">
                	<ul>
						<?php
						$total_dist = 0;
						foreach($state_list as $val){ 
							
						?>
						<li><a href="<?php echo base_url().$val['alias'];?>" title="<?php echo $val['name'];?>"><?php echo $val['name'];?></a>
							<?php if($val['districts']){
								?>
                        	<div class="drop-down">
                                
									<?php 
									$ctr = 1;
								
									foreach ($val['districts'] as $val1){
										if($ctr==1) {
											echo '<ul>';
										}
										echo '<li><a href="'.base_url().$val['alias'].'/'.$val1['alias'].'" title="'.$val1['name'].'">'.$val1['name'].'</a></li>';
										$ctr++;
										
										if($ctr==5) {
											echo '</ul>';
											$ctr =1;
										}

										if($total_dist>10){
											break;
										}
									}
										
									?>
                                
                            </div>
							<?php 
							
							}?>
                        </li>
						
						<?php
						$total_dist++;							
						if(	$total_dist ==12) {break;	}
						
						}?>
                    	
                        <li class="arrow"><a href="#" onclick="more_cities();" title="और शहर">और शहर </a></li>
                    </ul>
                </div>
                <!-- end city list -->
            </div>
            <!-- end header top -->
            <!-- start header bottom -->
            <div class="header-bottom">
            	<!-- start left part -->
            	<div class="left-part">
                	<div class="logo"><a href="<?php echo base_url().$this->session->userdata('main_loc_alias');?>" title="Hindi Gaurav"><img src="<?php echo base_url();?>uploads/<?php echo $regions['logo'];?>" alt="logo" style="max-height: 75px;" /></a></div>
                    <div class="date">
						<?php 
							echo $this->common->hindi_date('day').', '.date('d').' '.$this->common->hindi_date('month').' '.date('Y').', '.date('H:i').' IST';
						?>
					</div>
                </div>
                <!-- end left part -->
                <!-- start right part -->
                <div class="right-part">
                	<div class="ads ad_clicked">
						<input type="hidden" class="ad_id" value="<?php echo $ads[1]['id']?>">
					<?php if($ads[1]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[1]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[1]['script_code']){
						echo $ads[1]['script_code'];
					
					}?>
					</div>
                </div>
                <!-- end right part -->
            </div>
            <!-- end header bottom -->
        </div>
        <!-- end header -->
        <!-- start gray-box -->
        <div class="gray-box">
        	<!-- start countary name -->
        	<div class="country-name"><a href="#" title="भारत">
			<?php
				if($this->session->userdata('main_loc_name')){
					echo $this->session->userdata('main_loc_name');
				}
				else {
					echo "भारत";
				}
			?></a></div>
            <!-- end countary name -->
            <!-- start weather -->
            <div class="weather">
            	<span class="weather-img"><img src="<?php echo base_url();?>assets/images/img_weatger.png" alt="weather" /></span>
                <!-- start weather news -->
                <div class="weather-news">
					<div id="slider-wrapper-news">

						<div id="slider-my-news">
							<?php foreach($city_weather as $city) {
							
							?>
							<div class="sp">
									<div class="city">
                                        <p><?php echo $city['loc_name'];?><span>(<?php 
										echo $this->common->hindi_date('day').', '.date('d').' '.$this->common->hindi_date('month');
										?>)</span> <img src="<?php echo base_url();?>assets/images/arrow7.png" alt="arrow" /></p>
                                    </div>
                                    <!-- end city -->
                                    <!-- start temprature -->
                                    <div class="temprature">
                                        <a href="#" title="up"><img src="<?php echo base_url();?>assets/images/temp.png" alt="top" /></a>
                                        <span><?php echo $city['temp'].' °C';?></span>
                                    </div>
                                   <!-- end temprature --> 
                                   <!-- start sunrise -->
                                   <div class="sun-riesing">
                                        <img src="<?php echo base_url();?>assets/images/sun_rise.png" alt="sun rise" />
                                        <span><?php echo $city['sunrise'];?></span>
                                   </div>
                                   <!-- end sunrise -->
                                   <!-- start sunrise -->
                                   <div class="sun-riesing">
                                        <img src="<?php echo base_url();?>assets/images/sun_set.png" alt="sun set" />
                                        <span><?php echo $city['sunset'];?></span>
                                   </div>
                                   <!-- end sunrise -->
                           </div>
						   <?php }?>
						   
						</div>
						<div id="nav"></div>
						<div id="button-previous"><img src="<?php echo base_url();?>assets/images/prev3.png" /></div>  
						<div id="button-next"><img src="<?php echo base_url();?>assets/images/next3.png" /></div>  
					</div>
				
                </div>
                <!-- end weather news -->
            </div>
            <!-- end weather -->
        </div>
        <!-- end gray-box -->
        <!-- start navigation -->
        <div class="navigation">
        	<span class="nav-arrow"></span>
        	<ul class="navigation2">
            	<li><a href="<?php echo base_url();?>" title="home"><img src="<?php echo base_url();?>assets/images/ico_home.png" alt="home"  /></a></li>
				<?php
					$i=1;
					foreach($cat_data as $cat) {
						if($cat['show_in_menu']){
							echo '<li><a href="'.base_url().$cat['alias'].'">'.$cat['category'].'</a></li>';
							$i++;
						}
						if($i>8){
							break;
						}									
					}								
				?>
            </ul>
            <!-- start megganie -->
            <div class="megganie">
            	<a href="#" onclick="show_mags();" title="ई-मॅगज़ीन">ई-मॅगज़ीन</a>
            </div>
            <!-- end megganie -->
            <!-- start live tv -->
            <div class="live-tv">
            	<a href="#" title="लाइव टीवी">लाइव टीवी</a>
            </div>
            <!-- end live tv -->
        </div>
		<!-- end navigation -->
        <!-- start hot news -->
        <div class="hot-news">
        	<ul class="hot-news2">
            	<?php
					$i=1;
					foreach($cat_data as $cat) {
						if(!$cat['show_in_menu']){
							echo '<li><a href="'.base_url().$cat['alias'].'">'.$cat['category'].'</a></li>';
							$i++;
						}
						if($i>10){
							break;
						}									
					}								
				?>
            </ul>
        </div>
        <!-- end hot news -->
		<!-- start blur-bar -->
        <div class="blue-bar">
        	<!-- start latest news -->
        	<div class="latest-news">
            	<span class="arrow2"></span>
                <span class="latest-news2"><a href="#" title="ताज़ा समाचार">ताज़ा समाचार</a></span>
				
                <!-- start latest news content -->
                <div class="latest-news-content">
					<div id="slider-wrapper-news1">
						<div id="slider-my-news1">
							<?php foreach($ticker_articles as $art):?>
								<div class="sp1"><a href="<?php echo base_url().$art['url'];?>"><?php
								if(strlen($art['title'] )>150){
										$s = strpos($art['title'],' ',150);
										if($s){
											echo substr($art['title'],0,$s)."...";
										}
										else {
											echo $art['title'];	
										}
									}
									else {
										echo substr($art['title'],0,150);
									}
								?></a></div>
							<?php endforeach;?>
						</div>
						<div id="nav1"></div>
						<div id="button-previous1"><img src="<?php echo base_url();?>assets/images/prev5.png" /></div>  
						<div id="button-next1"><img src="<?php echo base_url();?>assets/images/next5.png" /></div>  
					</div>
                </div>
                <!-- end latest news content -->
            </div>
            <!-- end latest news -->
            <!-- start bluebar-right -->
            <div class="bluebar-right">
				<form autocomplete="off" method="POST" id="search-form" name="search-form" action="<?php echo base_url();?>">
                	<!-- start language -->
                	<div class="language">
						
						<input type="radio" name="radio" class="lang1" checked value="0">हिन्दी</input>
						<input type="radio" name="radio" class="lang1" value="1">English</input>
                    </div>
					<!-- end language -->
                    <!-- start search box -->
                    <div class="search-box">
                    	<input type="submit" value="" class="search" />
						<script language="javascript">
						CreateHindiTextBox("comment-hindi");
						</script>
						<input type="text" rows="1" cols="50" style="display:none;" id="comment-eng"/>
						<input type="text" style="display:none;" id="final_search" name="final_search" rows="3" cols="50"/>
                    </div>
                    <!-- end search box -->
                </form>
            </div>
            <!-- end bluebar-right -->
        </div>
        <!-- end blur-bar -->