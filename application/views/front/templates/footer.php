</div>
    <!-- end box -->
    <div class="clear"></div>
</div>
<!-- end wrap -->
<!-- start footer -->
<div class="footer">
	<p id="back-top">
		<a href="#top"><span></span></a>
	</p>
    <!-- start connect us -->
    <div class="connect-us">
    	<a href="#" title=""></a>
    </div>
    <!-- end connect us -->
	<!-- start footer top -->
	<div class="footer-top">
    	<!-- start box -->
    	<div class="box">
        	<!-- start footer news -->
        	<div class="footer-news">
            	
				<ul>
						<?php
						$total_dist = 0;
						foreach($state_list as $val){ 
							
						?>
						<li><a href="<?php echo base_url().$val['alias'];?>" title="<?php echo $val['alias'];?>"><?php echo ucwords($val['alias'].' news');?></a>
							
                        </li>
						
						<?php
						$total_dist++;							
						if(	$total_dist ==12) {break;	}
						
						}?>
                    	
                    </ul>
            </div>
            <!-- end footer news -->
            <!-- start ads4 -->
            <div class="ads4 ad_clicked">
				<input type="hidden" class="ad_id" value="<?php echo $ads[4]['id']?>">
            	<?php if($ads[4]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[4]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[4]['script_code']){
						echo $ads[4]['script_code'];
					
					}?>
            </div>
            <!-- end ads4 -->
            <!-- start footer nav -->
            <div class="footer-nav">
            	<ul>
                	<li><a href="#" title="About Us">About Us</a></li>
                    <li><a href="#" title="Investor">Investor</a></li>
                    <li><a href="#" title="Contact Us">Contact Us</a></li>
                    <li><a href="#" title="Adverties With Us">Adverties With Us</a></li>
                    <li><a href="#" title="Terms of Use">Terms of Use</a></li>
                    <li><a href="#" title="Feedback">Feedback</a></li>
                    <li><a href="#" title="Sitemap">Sitemap</a></li>
                    <li><a href="#" title="Cookie Policy">Cookie Policy</a></li>
                </ul>
            </div>
            <!-- end footer nav -->
        </div>
        <!-- end box -->
    </div>
    <!-- end footer top -->
    <!-- start footer bottom -->
    <div class="foter-bottom">
    	<!-- start box -->
    	<div class="box">
        	<p>Copyright © 2014 <a href="index.html" title="Hindi Gaurav">Hindi Gaurav Pvt. Ltd.</a></p>
        </div>
        <!-- end box -->
    </div>
    <!-- end footer bottom -->
</div>
<!-- end footer -->
<style>
div.bgcarousel{ /* CSS for main carousel container */
	background: black url(ajaxload.gif) center center no-repeat; /* loading gif while caoursel is loading */
	width:100%; /* default dimensions of carousel */
	height:193px;
}
img.navbutton{ /* CSS for the nav buttons */
	margin:0px;
	opacity:0.7;
}
div.slide{ /* CSS for each image's DIV container within main container */
	background-color: black;
	background-position: center center; /* center image within carousel */
	background-repeat: no-repeat;
	background-size: cover; /* CSS3 property to scale image within container? "cover" or "contain" */
	color: black;
}
div.selectedslide{ /* CSS for currently selected slide */
}

div.slide div.desc{ /* DIV that contains the textual description inside .slide */
	position: absolute;
	color: white;
	left: 40px;
	top: 100px;
	width:200px;
	padding: 10px;
	font: bold 16px sans-serif, Arial;
	text-shadow: 0 -1px 1px #8a8a8a; /* CSS3 text shadow */
	z-index:5;
}
div.selectedslide div.desc{ /* CSS for currently selected slide's desc div */
}
div.slide div.desc h2{
	font-size:150%;
	margin:0;
}
div.slide div.desc a{
	color:yellow;
	text-decoration:none;
}

</style>
<!-- start photo slide -->
<script type="text/javascript">
/* 
var firstbgcarousel=new bgCarousel({
	wrapperid: 'mybgcarousel', //ID of blank DIV on page to house carousel
	imagearray: [
		['<?php echo base_url();?>assets/images/img_slide_photo.jpg'], //["image_path", "optional description"]
		['<?php echo base_url();?>assets/images/img_slide_photo.jpg'],
		['<?php echo base_url();?>assets/images/img_slide_photo.jpg'],
		['<?php echo base_url();?>assets/images/img_slide_photo.jpg'] //<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:200, cycles:'', stoponclick:false, pauseonmouseover:true},
	navbuttons: ['<?php echo base_url();?>assets/images/img_prev1.png', '<?php echo base_url();?>assets/images/img_next1.png', '', ''], // path to nav images
	activeslideclass: 'selectedslide', // CSS class that gets added to currently shown DIV slide
	orientation: 'h', //Valid values: "h" or "v"
	persist: true, //remember last viewed slide and recall within same session?
	slideduration: 500 //transition duration (milliseconds)
}) */
var firstbgcarousel=new bgCarousel({
	wrapperid: 'mybgcarousel', //ID of blank DIV on page to house carousel
	imagearray: [
		<?php 
		foreach($slider_images as $slider) {
			echo '["'.base_url().$slider['path'].'"],';
		}
		?>
		//<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:200, cycles:'', stoponclick:false, pauseonmouseover:true},
	navbuttons: ['<?php echo base_url();?>assets/images/img_prev1.png', '<?php echo base_url();?>assets/images/img_next1.png', '', ''], // path to nav images
	activeslideclass: 'selectedslide', // CSS class that gets added to currently shown DIV slide
	orientation: 'h', //Valid values: "h" or "v"
	persist: true, //remember last viewed slide and recall within same session?
	slideduration: 500 //transition duration (milliseconds)
})

</script>
<!-- end photo slide -->
<!-- start Slider Kit launch -->
<script type="text/javascript">
jQuery.noConflict()
	$(window).load(function(){ //$(window).load() must be used instead of $(document).ready() because of Webkit compatibility	
	var $=jQuery
		// Photo gallery > Vertical
		$(".photosgallery-vertical").sliderkit({
			circular:true,
			mousewheel:true,
			shownavitems:4,
			verticalnav:true,
			navclipcenter:true,
		
		});
	});	
</script>
<script>
$(document).ready(function(){
$('.sp').first().addClass('active22');
$('.sp').hide();    
$('.active22').show();
function test() {
 $('.active22').removeClass('active22').addClass('oldactive22');    
                   if ( $('.oldactive22').is(':last-child')) {
        $('.sp').first().addClass('active22');
        }
        else{
        $('.oldactive22').next().addClass('active22');
        }
    $('.oldactive22').removeClass('oldactive22');
    $('.sp').fadeOut();
    $('.active22').fadeIn();
	}
var refreshId = setInterval(test, 3000);

    $('#button-next').click(function(){

    $('.active22').removeClass('active22').addClass('oldactive22');    
                   if ( $('.oldactive22').is(':last-child')) {
        $('.sp').first().addClass('active22');
        }
        else{
        $('.oldactive22').next().addClass('active22');
        }
    $('.oldactive22').removeClass('oldactive22');
    $('.sp').fadeOut();
    $('.active22').fadeIn();
        
        
    });
    
       $('#button-previous').click(function(){
    $('.active22').removeClass('active22').addClass('oldactive22');    
           if ( $('.oldactive22').is(':first-child')) {
        $('.sp').last().addClass('active22');
        }
           else{
    $('.oldactive22').prev().addClass('active22');
           }
    $('.oldactive22').removeClass('oldactive22');
    $('.sp').fadeOut();
    $('.active22').fadeIn();
    });
    
    
    
    
});
</script>
<script>
$(document).ready(function(){
$('.sp1').first().addClass('active1');
$('.sp1').hide();    
$('.active1').show();
function test1() {
 $('.active1').removeClass('active1').addClass('oldActive1');    
                   if ( $('.oldActive1').is(':last-child')) {
        $('.sp1').first().addClass('active1');
        }
        else{
        $('.oldActive1').next().addClass('active1');
        }
    $('.oldActive1').removeClass('oldActive1');
    $('.sp1').fadeOut();
    $('.active1').fadeIn();
	}
var refreshId = setInterval(test1, 5000);

    $('#button-next1').click(function(){

    $('.active1').removeClass('active1').addClass('oldActive1');    
                   if ( $('.oldActive1').is(':last-child')) {
        $('.sp1').first().addClass('active1');
        }
        else{
        $('.oldActive1').next().addClass('active1');
        }
    $('.oldActive1').removeClass('oldActive1');
    $('.sp1').fadeOut();
    $('.active1').fadeIn();
        
        
    });
    
       $('#button-previous1').click(function(){
    $('.active1').removeClass('active1').addClass('oldActive1');    
           if ( $('.oldActive1').is(':first-child')) {
        $('.sp1').last().addClass('active1');
        }
           else{
    $('.oldActive1').prev().addClass('active1');
           }
    $('.oldActive1').removeClass('oldActive1');
    $('.sp1').fadeOut();
    $('.active1').fadeIn();
    });
    
    
    
    
});
</script>

<!-- end Slider Kit launch -->
<!-- start scroll top -->
<script>
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 500);
			return false;
		});
	});

});
</script>
<!-- end scroll top -->
		
<!--Test Menu Start-->
<script>
		(function () {
		
		    // Create mobile element
		    var mobile = document.createElement('div');
		    mobile.className = 'menu';
		    document.querySelector('.hot-news').appendChild(mobile);
		
		    // hasClass
		    function hasClass(elem, className) {
		        return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
		    }
		
		    // toggleClass
		    function toggleClass(elem, className) {
		        var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, ' ') + ' ';
		        if (hasClass(elem, className)) {
		            while (newClass.indexOf(' ' + className + ' ') >= 0) {
		                newClass = newClass.replace(' ' + className + ' ', ' ');
		            }
		            elem.className = newClass.replace(/^\s+|\s+$/g, '');
		        } else {
		            elem.className += ' ' + className;
		        }
		    }
		
		    // Mobile nav function
		    var mobileNav = document.querySelector('.menu');
		    var toggle = document.querySelector('.navigation2');
		    mobileNav.onclick = function () {
		        toggleClass(this, 'nav-mobile-open');
		        toggleClass(toggle, 'nav-active');
		    };
		})();
</script>
<!--Test Menu End-->
<!--Test Menu Start-->
<script>
		(function () {

		    // Create mobile element
		    var mobile = document.createElement('div');
		    mobile.className = 'menu2';
		    document.querySelector('.navigation').appendChild(mobile);
		
		    // hasClass
		    function hasClass(elem, className) {
		        return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
		    }
		
		    // toggleClass
		    function toggleClass(elem, className) {
		        var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, ' ') + ' ';
		        if (hasClass(elem, className)) {
		            while (newClass.indexOf(' ' + className + ' ') >= 0) {
		                newClass = newClass.replace(' ' + className + ' ', ' ');
		            }
		            elem.className = newClass.replace(/^\s+|\s+$/g, '');
		        } else {
		            elem.className += ' ' + className;
		        }
		    }
		
		    // Mobile nav function
		    var mobileNav = document.querySelector('.menu2');
		    var toggle = document.querySelector('.hot-news2');
		    mobileNav.onclick = function () {
		        toggleClass(this, 'nav-mobile-open');
		        toggleClass(toggle, 'nav-active');
		    };
		})();
</script>

<!--Test Menu End-->
<!-- for playing videos in popup-->
<div class="overlay" id="overlay1" style="display:none;"></div>
         <div class="box1" id="box1">
         <a class="boxclose1" id="boxclose1"></a>
<div class="maps">
  
        <ul class="ulCols cols6 continentSelection clear">
            <li class="America"><a onclick="map_get_country(112,'north_america');" href="#" class="NorthAmerica"><small></small> <em></em> <span>North America</span></a></li>
            <li class="CSAmerica"><a onclick="map_get_country(113,'south_america');" href="#" class="SouthCentralAmerica"><small></small> <em></em> <span>South America</span></a></li>
            <li class="Europe"><a onclick="map_get_country(111,'europe');" href="#" class="EU"><small></small> <em></em> <span>Europe</span></a></li>
            <li class="Asia"><a onclick="map_get_country(108,'asia');" href="#" class="Asia"><small></small> <em></em> <span>Asia</span></a></li>
            <li class="Africa"><a onclick="map_get_country(109,'africa');" href="#" class="Africa"><small></small> <em></em> <span>Africa</span></a></li>
            <li class="Australia"><a onclick="map_get_country(110,'australia');" href="#" class="AU"><small></small> <em></em> <span>Australia</span></a></li>
        </ul>
	<input type="hidden" id="sel_cont" value=""/>
 <div class="map-form">
 <ul>
 <li><span>Select Country :&nbsp;</span><div class="select-style" id="map_country">
  <select disabled>
	<option value="">-विकल्प चुने-</option>
  </select>
</div>
<input type="hidden" id="sel_country" value=""/></li>
  <li><span>Select State :&nbsp;</span><div class="select-style" id="map_state">
  <select disabled>
	<option value="">-विकल्प चुने-</option>
  </select>
</div>
<input type="hidden" id="sel_state" value=""/></li>
  <li><span>Select District :&nbsp;</span><div class="select-style" id="map_district">
  <select disabled>
	<option value="">-विकल्प चुने-</option>
  </select>
</div></li>

	<li>
		<span>&nbsp;</span><div id="map_go"><img src="<?php echo base_url();?>/assets/images/go-map.png" alt="GO"></div>
	</li>
 </ul>
 
 
 </div>  
</div>
</div>


 <script>

	$(function() {
	
	
		$('#activator1').click(function(){
			$('#overlay1').fadeIn('fast',function(){
				$('#box1').animate({'top':'28px'},500);
				
			});
		});
		$('#activator2').click(function(){
			$('#overlay1').fadeIn('fast',function(){
				$('#box1').animate({'top':'28px'},500);
				
			});
		});
		$('#boxclose1').click(function(){
			$('#box1').animate({'top':'-1500px'},500,function(){
				$('#overlay1').fadeOut('fast');
				
			});
		});
		
		});
		</script>
</body>
</html>

