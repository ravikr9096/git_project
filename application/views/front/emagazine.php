<?php
ini_set('display_errors', 0);

// Turn off all error reporting
error_reporting(0);

date_default_timezone_set('Asia/Calcutta');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Mirrored from page-flip.info/preview_diamond/full-area.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Nov 2014 06:18:03 GMT -->
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
   
    <!-- viewport -->
    <meta content="width=device-width,initial-scale=1" name="viewport">
       
    <!-- title -->
    <title>Diamond FlipBook in jQuery ( full area )</title>        
        
    <!-- add css and js for flipbook -->
    <link type="text/css" href="<?php echo base_url()?>assets/css/style-mag.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Play:400,700">
    <script src="<?php echo base_url()?>assets/js/jquery-mag.js"></script>
    <script src="<?php echo base_url()?>assets/js/turn.js"></script>              
	<script src="<?php echo base_url()?>assets/js/jquery.fullscreen.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.address-1.6.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/wait.js"></script>
	<script src="<?php echo base_url()?>assets/js/onload.js"></script>


    <!-- style css  -->
	<style>	
	    html,body {
          margin: 0;
          padding: 0;
		  overflow:auto !important;
        }
	</style>
      
	</head>
 
<body>
    
<!-- BEGIN FLIPBOOK STRUCTURE -->  
<div id="fb5-ajax">	         
         
      <!-- BEGIN HTML BOOK -->      
      <div data-current="book5" class="fb5" id="fb5">      
            
               
                  
            <!-- BACKGROUND FOR BOOK -->  
            <div class="fb5-bcg-book"></div>                      
          
            <!-- BEGIN CONTAINER BOOK -->
            <div id="fb5-container-book">
     
                <!-- BEGIN deep linking -->  
                <section id="fb5-deeplinking">
                     <ul>
                          <li data-address="page1" data-page="1"></li>
                          <li data-address="page2-page3" data-page="2"></li>
                          <li data-address="page2-page3" data-page="3"></li>
                          <li data-address="page4-5" data-page="4"></li>
                          <li data-address="page4-5" data-page="5"></li>
                          <li data-address="page6-page7" data-page="6"></li>
                          <li data-address="page6-page7" data-page="7"></li>
                          <li data-address="page8-page9" data-page="8"></li>
                          <li data-address="page8-page9" data-page="9"></li>
                          <li data-address="10-11" data-page="10"></li>
                          <li data-address="10-11" data-page="11"></li>
                          <li data-address="end" data-page="12"></li>
                     </ul>
                 </section>
                <!-- END deep linking -->  
            
                
                <!-- BEGIN ABOUT -->
                <section id="fb5-about">
                <h3>How to read a book?</h3>
        <p>Nulla congue pulvinar pharetra. Cras sed malesuada arcu. Duis eleifend nunc laoreet odio dapibus ac convallis sapien ornare. Nullam a est id diam elementum rhoncus.Ad dicam diceret pri. Cu animal eligendi eam, nam ea alia oratio constituam, ad elit dolore possim est. Usu in nostro delectus, ne definitionem delicatissimi has. Cu sea iriure vivendum dignissim, choro nonumy philosophia ex mea. In usu reque liber fabellas, omnes omittam te per, ei novum percipitur cum. An eum erat facer, persius delectus ei vis.</p>
        <p>&nbsp;</p>
        <h3>Short description</h3>
        <p>Nulla congue pulvinar pharetra. Cras sed malesuada arcu. Duis eleifend nunc laoreet odio dapibus ac convallis sapien ornare. Nullam a est id diam elementum rhoncus.Te amet disputando vel. Cu vim persius consequat consetetur, eam id melius fuisset principes. Clita habemus et vix, ius doming philosophia et. Eos mutat luptatum ad. Ad iudico repudiandae nec, mel an tempor accusata eloquentiam, choro forensibus et eam.</p>
        <p>&nbsp;</p>
        <h3>Start reading!</h3>
        <p>Nulla congue pulvinar pharetra. Cras sed malesuada arcu. Duis eleifend nunc laoreet odio dapibus ac convallis sapien ornare. Nullam a est id diam elementum <a href="javascript:setPage(2)">rhoncus</a>.Te amet disputando vel. Cu vim persius consequat consetetur, eam id melius fuisset principes. Clita habemus et vix, ius doming philosophia et. Eos mutat luptatum ad. Ad iudico repudiandae nec, mel an tempor accusata eloquentiam, choro forensibus et eam.</p>
        <p>&nbsp;</p>
                </section>
                <!-- END ABOUT -->
                
                
                <!-- BEGIN BOOK -->
                <div id="fb5-book">
                            
                <!-- BEGIN PAGE 2-->
				<?php 
				$i=1;
				foreach($slider_images as $val):?>
                <div data-background-image="" class="">
                       
                     <!-- begin container page book --> 
                     <div class="fb5-cont-page-book">
                       
                         <!-- description for page from  --> 
                        <div class="fb5-page-book">
							<img src="<?php echo base_url().$val['path']?>" width="600">
                                                
                        </div> 
                                  
                        <!-- number page and title for page -->                
                        <div class="fb5-meta">
                                <span class="fb5-num"><?php echo $i;?></span>
                                <span class="fb5-description">Hindigaurav 2014</span>
                        </div><!-- END number page and title for page -->  
                        
                        
                     </div> <!-- end container page book --> 
                        
                </div>
				<?php $i++;
				endforeach;?>
                <!-- END PAGE 2 -->                         
                  
              </div>
              <!-- END BOOK -->
                           
                
              <!-- arrows -->
              <a class="fb5-nav-arrow prev"></a>
              <a class="fb5-nav-arrow next"></a>
                
                
             </div>
             <!-- END CONTAINER BOOK -->    
    
            <!-- BEGIN FOOTER -->
            <div id="fb5-footer">
        
            <div class="fb5-bcg-tools"></div>
             
            <a id="fb5-logo" href="<?php echo base_url();?>">
                <img alt="HOME" src="img/logo.jpg">
            </a>
            
            <div class="fb5-menu" id="fb5-center">
                <ul>
                
                    <!-- icon download -->
                    <li>
                        <a title="DOWNLOAD (ZIP)  " class="fb5-download" href="<?php echo base_url();?>uploads/magazines/<?php echo $mag['file']?>"></a>
                    </li>
                                        
                    
                    <!-- icon_zoom_in -->                              
                    <li>
                        <a title="ZOOM IN" class="fb5-zoom-in"></a>
                    </li>                               
                    
                    <!-- icon_zoom_out -->
                     
                    <li>
                        <a title="ZOOM OUT " class="fb5-zoom-out"></a>
                    </li>                                
                    
                    <!-- icon_zoom_auto -->
                    <li>
                        <a title="ZOOM AUTO " class="fb5-zoom-auto"></a>
                    </li>                                
                    
                    <!-- icon_zoom_original -->
                    <li>
                        <a title="ZOOM ORIGINAL (SCALE 1:1)" class="fb5-zoom-original"></a>
                    </li>
                                     
                    
                    <!-- icon_allpages -->
                    <li>
                        <a title="SHOW ALL PAGES " class="fb5-show-all"></a>
                    </li>
                                                    
                    
                    <!-- icon_home -->
                    <li>
                        <a title="SHOW HOME PAGE " class="fb5-home"></a>
                    </li>
                                    
                </ul>
            </div>
            
            <div class="fb5-menu" id="fb5-right">
                <ul> 
                    <!-- icon page manager -->                 
                    <li class="fb5-goto">
                        <label for="fb5-page-number" id="fb5-label-page-number">PAGE</label>
                        <input type="text" id="fb5-page-number">
                        <button type="button">GO</button>
                    </li>  
                                    
                    <!-- icon fullscreen -->                 
                    <li>
                        <a title="FULL / NORMAL SCREEN" class="fb5-fullscreen"></a>
                    </li>                                       
                                    
                </ul>
            </div>
            
            
        
        </div>
            <!-- END FOOTER -->    
    
                
    
            <!-- BEGIN ALL PAGES -->
            <div id="fb5-all-pages" class="fb5-overlay">
    
          <section class="fb5-container-pages">
    
            <div id="fb5-menu-holder">
    
                <ul id="fb5-slider">
						<?php 
						$i=1;
						foreach($slider_images as $val):?>
                         <li class="<?php echo $i;?>">
                           <img alt="" data-src="<?php echo base_url().$val['path']?>">
                         </li>
						<?php
						$i++;
						endforeach;
						?>
                                                                  
    
                  </ul>
            
              </div>
    
          </section>
    
         </div>
            <!-- END ALL PAGES -->

      </div>
      <!-- END HTML BOOK -->     

</div>
<!-- END FLIPBOOK STRUCTURE -->    

    <!-- CONFIGURATION FLIPBOOK -->    
    <script>    
    jQuery('#fb5').data('config',
    {
    "page_width":"550",
    "page_height":"715",
	"email_form":"",
    "zoom_double_click":"1",
    "zoom_step":"0.06",
    "double_click_enabled":"true",
    "tooltip_visible":"true",
    "toolbar_visible":"true",
    "gotopage_width":"30",
    "deeplinking_enabled":"true",
    "rtl":"false",
    'full_area':'true',
	'lazy_loading_thumbs':'false',
	'lazy_loading_pages':'false'
    })    
    </script>

       


</body>

<!-- Mirrored from page-flip.info/preview_diamond/full-area.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Nov 2014 06:18:28 GMT -->
</html>
