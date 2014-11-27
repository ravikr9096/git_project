$(document).ready(function() {
	$(".tab-content").hide(); //Hide all content
	$(".tab-nav li:first").addClass("active").show(); //Activate first tab
	$(".tab-content:first").show(); //Show first tab content
	var width = (jQuery(window).width()*80)/100;
	var height = (jQuery(window).height()*80)/100;
	$(".youtube").colorbox({iframe:true, innerWidth:width, innerHeight:height});
	$(".pop_images").colorbox({rel:'pop_images'});
	//On Click Event
	$(".tab-nav li").click(function() {

		$(".tab-nav li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab-content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	

});
$(document).ready(function() {
		   
	$(".tab-content2").hide(); //Hide all content
	$(".tab-nav2 li:first").addClass("active").show(); //Activate first tab
	$(".tab-content2:first").show(); //Show first tab content

	//On Click Event
	$(".tab-nav2 li").click(function() {

		$(".tab-nav2 li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab-content2").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	$("form#search-form").submit(function(){
		var search_text = $("#final_search").val();
		if(!search_text) {
			alert("खोज करने के लिए कुछ लिखें");
			return false;
		}
		$(".leftcol").empty();
		var url = $("#base").val();
		
		var url1 = url+'admin/search_news';
		$.ajax({
			url: url1,
			type: "POST",
			data: "search_text="+search_text,
			success: function(data){
				$(".leftcol").html(data);			
			}	 
		});
		return false;
	});
	$("#city").change(function(){
		
		$("#city_news_1").empty().html('Loading...');
		$("#city_news_2").empty().html('Loading...');
		var url = $("#base").val();
		var loc_id = $("#city").val();
		var url1 = url+'admin/city_related_news';
		$.ajax({
			url: url1,
			type: "POST",
			data: "loc_id="+loc_id,
			success: function(data){
				var parsed = JSON.parse(data);

				var arr = [];

				for(var x in parsed){
				  arr.push(parsed[x]);
				}
				
				$("#city_news_1").empty().html(arr[0]+'<ul></ul>');
				$("#city_news_1 ul").html(arr[1]);
				$("#city_news_2").empty().html(arr[2]+'<ul></ul>');
				$("#city_news_2 ul").html(arr[3]);

				
			}	 
		});

	});
	$("#state").change(function(){
		$("#city_news_1").empty().html('Loading...');
		$("#city_news_2").empty().html('Loading...');
		var url = $("#base").val();
		var loc_id = $("#state").val();
		var url1 = url+'admin/city_related_news';
		$.ajax({
			url: url1,
			type: "POST",
			data: "loc_id="+loc_id,
			success: function(data){
				var parsed = JSON.parse(data);

				var arr = [];

				for(var x in parsed){
				  arr.push(parsed[x]);
				}
				
				$("#city_news_1").empty().html(arr[0]+'<ul></ul>');
				$("#city_news_1 ul").html(arr[1]);
				$("#city_news_2").empty().html(arr[2]+'<ul></ul>');
				$("#city_news_2 ul").html(arr[3]);

				
			}	 
		});

	});
	
	$("#dec_font").click(function(){
		 var fsize = parseInt($(".city-content p").css('font-size'));
		 var lheight = parseInt($(".city-content p").css('line-height'));
		fsize--;
		lheight--;
		if(fsize > 8) {
			$(".city-content p").css('font-size',fsize+'px');
			$(".city-content p").css('line-height',lheight+'px');
		}
	});
	$("#inc_font").click(function(){
		 var fsize = parseInt($(".city-content p").css('font-size'));
		 var lheight = parseInt($(".city-content p").css('line-height'));
		fsize++;
		lheight++;
		if(fsize < 32) {
			$(".city-content p").css('font-size',fsize+'px');
			$(".city-content p").css('line-height',lheight+'px');
		}
	});
	$("#text_speech").click(function() {
	$("#text_speech").remove();
	$("#text_speech_output").html('Loading...');
	var url = $("#base").val();
	var url1 = url+'admin/text_speech';
	var str = $("#content-image").val();
	$.ajax({
		url: url1,
		type: "POST",
		data: "str="+str,
		success: function(data){
				$("#text_speech_output").html(data);
			}
		});
	
	});
	
	var demo1 = $("#demo1").slippry({
					transition: 'fade',
					useCSS: true,
					speed: 1000,
					pause: 10000,
					auto: true,
					preload: 'visible'
				});

				$('.stop').click(function () {
					demo1.stopAuto();
				});

				$('.start').click(function () {
					demo1.startAuto();
				});

				$('.prev').click(function () {
					demo1.goToPrevSlide();
					return false;
				});
				$('.next').click(function () {
					demo1.goToNextSlide();
					return false;
				});
				$('.reset').click(function () {
					demo1.destroySlider();
					return false;
				});
				$('.reload').click(function () {
					demo1.reloadSlider();
					return false;
				});
				$('.init').click(function () {
					demo1 = $("#demo1").slippry();
					return false;
				});
	
		$(".ad_clicked").click(function(){
			var ad_id = $(this).find(".ad_id").val();
			var url = $("#base").val();
			var url1 = url+"admin/inc_click_ctr"
			$.ajax({
				url: url1,
				type: "POST",
				data: "ad_id="+ad_id,
				success: function(data){
					console.log(data);				
				}	 
			});
		
		});
		
	
});

function record_vote(url) {

	var url1 = url+"index.php/admin/record_vote/";
	var poll_id = $("#poll_id").val();
	var poll_ans = $('input[name=poll_answer]:checked').val();
	console.log(poll_ans);
	if(!poll_ans) {
		$("#vote_error").remove();
		$("#vote_here").after('&nbsp;<span class="errors" id="vote_error">एक विकल्प का चयन करें</span>');
		return false;
	
	}
    $.ajax({
		url: url1,
		type: "POST",
		data: "poll_id="+poll_id+"&poll_ans="+poll_ans,
		success: function(data){
			console.log(data);
			if(data) {
				$('#vote_here').hide(1000);
				$("#vote_error").remove();
				$('#vote_already').show(300);
				$('#poll_area').html(data);
			}
			
		}	 
	});

}

function get_district(url) {
	var state = $("#state option:selected").val();
	if(state == 0) {
		$(".holder").text("-विकल्प चुने-");
	}
	var url1 = url+"admin/get_district/";
	$.ajax({
		url: url1,
		type: "POST",
		data: "state="+state,
		success: function(data){
			$("#city").empty().append(data);			
		}	 
	});	
}

function get_news_initially(){
	$("#city_news_1").empty().html('Loading...');
	$("#city_news_2").empty().html('Loading...');
	var url = $("#base").val();
	var loc_id = 0;
	var url1 = url+'admin/city_related_news';
	$.ajax({
		url: url1,
		type: "POST",
		data: "loc_id="+loc_id,
		success: function(data){
			var parsed = JSON.parse(data);

			var arr = [];

			for(var x in parsed){
			  arr.push(parsed[x]);
			}
			
			$("#city_news_1").empty().html(arr[0]+'<ul></ul>');
			$("#city_news_1 ul").html(arr[1]);
			$("#city_news_2").empty().html(arr[2]+'<ul></ul>');
			$("#city_news_2 ul").html(arr[3]);

			
		}	 
	});

}


$(document).ready(function(){
	get_news_initially();
	$('#comment-hindi').on('keyup',function(){
		console.log($(this).val());
		$("#final_search").val($(this).val());
	});
	$('#comment-eng').on('keyup',function(){
		console.log($(this).val());
		$("#final_search").val($(this).val());
	});
	
	$(".lang1").click(function() {
	if($(this).val()==0) {
		$("#comment-hindi").val($("#final_search").val());
		$("#comment-hindi").show();
		$("#comment-eng").hide();
	}
	if($(this).val()==1) {
		$("#comment-eng").val($("#final_search").val());
		$("#comment-hindi").hide();	
		$("#comment-eng").show();
	}
	});
	//real comment
	$('#ncomment-hindi').addClass('textarea');
	$('#ncomment-hindi').attr('placeholder',"अपनी प्रतिक्रिया यहाँ लिखें");
	$('#ncomment-hindi').on('keyup',function(){
		console.log($(this).val());
		$("#nfinal_search").val($(this).val());
	});
	$('#ncomment-eng').on('keyup',function(){
		console.log($(this).val());
		$("#nfinal_search").val($(this).val());
	});
	
	$(".nlang1").click(function() {
	if($(this).val()==0) {
		$("#ncomment-hindi").val($("#nfinal_search").val());
		$("#ncomment-hindi").show();
		$("#ncomment-eng").hide();
	}
	if($(this).val()==1) {
		$("#ncomment-eng").val($("#nfinal_search").val());
		$("#ncomment-hindi").hide();	
		$("#ncomment-eng").show();
	}
});
	
});

function more_cities(){
	$(".leftcol").empty();
	var url = $("#base").val();
	var url1 = url+'admin/display_all_location';
	$.ajax({
		url: url1,
		type: "POST",
		success: function(data){
			
			console.log(data);
			$(".leftcol").html(data);

			
		}	 
	});
	return false;
}
function more_videos(){
	$(".leftcol").empty();
	var url = $("#base").val();
	var url1 = url+'admin/display_all_videos';
	$.ajax({
		url: url1,
		type: "POST",
		success: function(data){
			
			console.log(data);
			$(".leftcol").html(data);

			
		}	 
	});
	return false;
}

function display_login_box() {
	$("#overlay1").show();
	$("#login-box").show();
}
function display_signup_box() {
	$("#overlay1").show();	
	$("#login-box").hide();
	$("#signup-box").show();
}
function close_login() {
	$("#overlay1").hide();
	$("#login-box").hide();
}
function close_signup() {
	$("#overlay1").hide();
	$("#signup-box").hide();
}

/* ajax function to signup */
function sign_up() {
	var url = $("#base").val();
	var url1 = url+'admin/site_signup';
	$.ajax({
		url: url1,
		type: "POST",
		data:"user_name="+$("#signup_username").val()+"&first_name="+$("#signup_first_name").val()+"&last_name="+$("#signup_last_name").val()+"&password="+$("#signup_password").val()+"&email="+$("#signup_email").val()+"&gender="+$("#signup_gender").val(),
		success: function(data){
			if(data) {				
				$("#signup_error").empty().html("Thanks for sigining up. An email has been sent to you regarding your details.");
				location.reload().delay(100);
			}
			else {				
				$("#signup_error").empty().html("Email already exists");
			}
		}	 
	});
	return false;

}
/* ajax function to sign-in */
function sign_in() {
	var url = $("#base").val();
	var url1 = url+'admin/site_signin';
	$.ajax({
		url: url1,
		type: "POST",
		data:"user_name="+$("#signin_username").val()+"&password="+$("#signin_password").val(),
		success: function(data){
			if(data) {				
				$("#overlay1").hide();
				$("#login-box").hide();
				 location.reload();
			}
			else {	
				$("#login_response").empty().html("Username & Password didn't match.Please try again");
			}
		}	 
	});
	return false;

}

/* ajax to get country list */
function map_get_country(val,alias) {
	var def = '<select disabled><option value="">-विकल्प चुने-</option></select>';
	$("#map_country").empty();
	// make the vlaues in state and district default
	$("#map_state").html(def);
	$("#map_district").html(def);
	var url = $("#base").val();
	$("#sel_cont").val(alias);	
	var url1 = url+'admin/map_get_country';
	$.ajax({
		url: url1,
		type: "POST",
		data: "cont_id="+val,
		success: function(data){
			$("#map_country").html(data);
			$("#map_go").html('<a href="'+url+$("#sel_cont").val()+'"><img src="'+url+'/assets/images/go-map.png" alt="GO"></a>');
		}	 
	});
	return false;
}

function map_get_state() {
	var def = '<select disabled><option value="">-विकल्प चुने-</option></select>';
	$("#map_state").empty();
	// make the vlaues in state and district default
	$("#map_district").html(def);
	
	var country = $("#map_country option:selected").val();
	var url = $("#base").val();
	$("#sel_country").val(country);	
	var url1 = url+'admin/map_get_state';
	$.ajax({
		url: url1,
		type: "POST",
		data: "country_id="+country,
		success: function(data){
			$("#map_state").html(data);
			$("#map_go").html('<a href="'+url+$("#sel_country").val()+'"><img src="'+url+'/assets/images/go-map.png" alt="GO"></a>');
		}	 
	});
	return false;
}

function map_get_district() {
	$("#map_district").empty();
	var state = $("#map_state option:selected").val();
	var url = $("#base").val();
	$("#sel_state").val(state);	
	var url1 = url+'admin/map_get_district';
	$.ajax({
		url: url1,
		type: "POST",
		data: "state_id="+state,
		success: function(data){
			$("#map_district").html(data);
			$("#map_go").html('<a href="'+url+$("#sel_country").val()+'/'+$("#sel_state").val()+'"><img src="'+url+'/assets/images/go-map.png" alt="GO"></a>');
		}	 
	});
	return false;
}
function change_go_url() {
	var district = $("#map_district option:selected").val();
	var url = $("#base").val();
	console.log(district);
	$("#map_go").html('<a href="'+url+$("#sel_state").val()+'/'+district+'"><img src="'+url+'/assets/images/go-map.png" alt="GO"></a>');

	return false;
}

/* ajax function to signup */
function save_comment() {
	//check content
	$result = $("#nfinal_search").val() ;
    if($result=='') {
		$("#nfinal_search_response").empty().html('<span class="errors">Please enter some comments</span>');
		return false;
	}
	else {
		$("#nfinal_search_response").empty();
	}
	//check captcha
	$result = ( parseInt($('#num1').val()) + parseInt($('#num2').val()) == parseInt($('#captcha').val()) ) ;
    if(!$result) {
		$("#captcha_response").empty().html('<span class="errors">Captch incorrect</span>');
		return false;
	}
    else{
		$("#captcha_response").empty();
	}
	
	var url = $("#base").val();
	var url1 = url+'admin/save_comment';
	var content = $("#nfinal_search").val();
	var art_id = $("#art_hid_id").val();
	$.ajax({
		url: url1,
		type: "POST",
		data:"content="+content+"&art_id="+art_id,
		success: function(data){
			console.log(data);
			if(data) {				
				$("#post_comment_response").empty().html('<span class="errors">Thanks for your comment. It will be published below after moderation</span>').delay(3000);
				location.reload();
			}
			else {				
				$("#post_comment_response").html("Please try again");
			}
		}	 
	});
	return false;

}

//ajax to show magazines

function show_mags(){
	$(".leftcol").empty();
	var url = $("#base").val();
	var url1 = url+'admin/show_emags';
	$.ajax({
		url: url1,
		type: "POST",
		success: function(data){
			$(".leftcol").html(data);

			
		}	 
	});
	return false;
}



