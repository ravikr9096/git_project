<?php
	$site = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$current_url = str_replace(base_url(),'',$site);
			$this->session->set_userdata('current_url',$current_url);
?>
<div class="container">
        	<!-- start leftcol -->
        	<div class="leftcol">
            	<!-- start breadcrumb -->
            	<div class="breadcrumb">
                	<ul>
                    	<li><a href="<?php echo base_url();?>" title="Home">Home</a></li>
						<?php foreach($breadcrumb as $val) {
							echo '<li><a href="'.base_url().$val['url'].'" title="'.$val['name'].'">'.$val['name'].'</a></li>';
						
						}?>
                        <li><?php echo $main_article['alias'];?></li>
                    </ul>
                </div>
                <!-- end breadcrumb -->
            	<!-- start news-detail -->
            	<div class="news-detail">
                	<!-- start city news -->
                	<div class="city-news">
                    	<h3><?php echo $main_article['title']?><span><a href="<?php echo base_url();?>" title="hindigaurav">hindigaurav.in</a> | <?php echo date('d M Y',strtotime($main_article['publish_date']));?></span></h3>
                        <!-- start row -->
                        <div class="row">
                        	<!-- start social like -->
                        	<div class="social-like">
                            	<a href="#" title="social like"><img src="<?php echo base_url();?>assets/images/img_social_like.png" alt="social like" /></a>
                            </div>
                            <!-- end social like -->
                            <!-- start font -->
							<?php //if(!@$main_article['media']):?>
                            <div class="font">
                            	<ul>
                                	<li class="decrease-font" id="dec_font"><a href="#" onclick="return false;" title="Descrease font">Descrease font</a></li>
                                    <li class="incsease-font" id="inc_font"><a href="#" onclick="return false;" title="Increase font">Increase font</a></li>
                                    <li class="contact-person" id="text_speech"><a href="#" title="Text-to-Speech" onclick="return false;">contact person</a></li>
									
                                </ul>
								<div id="text_speech_output"></div>
                            </div>
							<?php //endif;?>
                            <!-- end font -->
                        </div>
                        <!-- end row -->
                        <!-- start city content -->
						
                        
							<?php if(@$main_article['media']) {
							?>
								<div class="slider2">
                        	
                            <div class="showcase-slide">
                            	<div class="showcase-content">
                                <!-- start slide2 -->
                                <div class="slide2">
                                    <section class="demo_wrapper">
									<article class="demo_block">
										
											<ul id="demo1">
												<?php
												foreach($main_article['media'] as $media){
													
													//echo '<li><a href="#slide1"><img src="'.base_url().'uploads/'.$media['image_large'].'"></a>.'$media['caption'].'</li>';
													echo '<li><a href="#slide2">';
													if($media['type'] == 'image'){
													echo '<img src="'.base_url().'uploads/'.$media['image_large'].'">';
													}
													if($media['type'] == 'video'){
													$ytarray=explode("/", $media['vid_code']);
													$ytendstring=end($ytarray);
													$ytendarray=explode("?v=", $ytendstring);
													$ytendstring=end($ytendarray);
													$ytendarray=explode("&", $ytendstring);
													$ytcode=$ytendarray[0];
													echo "<a class='youtube' href=\"http://www.youtube.com/embed/$ytcode\"><img src=\"http://img.youtube.com/vi/$ytcode/0.jpg\" /><img src=\" ".base_url()."assets/images/play_button.png\" class=\"play\"/></a>";
													
													}
													echo '</a><p>'.$media['caption'].'</p></li>';
													
												}
												
												?>
												
												
											</ul>
											</article>
										</section>
                                </div>
                                <!-- end slide2 -->
                                
                                </div>
                            </div>
                            
                            
                            
							</div>
								
								
								
							<?php
							}
                        	
								echo '<div class="city-content">';
								echo $main_article['content'];
								echo '</div>';
								echo '<input type="hidden" id="content-image" value="'.strip_tags($this->common->filter_img($main_article['content'])).'"/>';

								
							?>
                        
                        <!-- end city content -->
                    </div>
                    <!-- end city news -->
                </div>
                <!-- end news-detail -->
				<!-- start ads6 -->
                <div class="ads6 ad_clicked">
					<input type="hidden" class="ad_id" value="<?php echo $ads[7]['id']?>">
                	<?php if($ads[7]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[7]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[7]['script_code']){
						echo $ads[7]['script_code'];
					
					}?>
                </div>
                <!-- end ads6 -->
                <!-- start local -->
                
                <!-- start row -->
                <div class="row">
                    <!-- start social like -->
					<div class="fb-like" data-href="<?php echo base_url();?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                    <div class="social-like">
                        <a href="#" title="social like"><img src="<?php echo base_url();?>assets/images/img_social_like.png" alt="social like" /></a>
                    </div>
                    <!-- end social like -->
                </div>
                <!-- end row -->
                <!-- start read this -->
                <div class="read-this">
                	<h3>ये भी पढ़िए <span><img src="<?php echo base_url();?>assets/images/news_arrow.png" alt="arrow" /></span></h3>
                    <ul>
						<?php 
							foreach($all_articles as $art) {
								echo '
								<li>
									<div class="imgb"><a href="'.base_url().$art['url'].'" title="'.$art['title'].'"><img src="'.base_url().$art['art_image'].'" alt="'.$art['title'].'" /></a></div>
									<a href="'.base_url().$art['url'].'" title="'.$art['title'].'">'.$art['title'].'</a></li>
								';
								
							}
						
						?>
                    	
                    </ul>
                </div>
                <!-- end read this -->
                <!-- start ads6 -->
                <div class="ads6 ad_clicked">
					<input type="hidden" class="ad_id" value="<?php echo $ads[8]['id']?>">
                	<?php if($ads[8]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[8]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[8]['script_code']){
						echo $ads[8]['script_code'];
					
					}?>
                </div>
                <!-- end ads6 -->
                <!-- start post --> 
                <div class="post">
                	<h3>यहाँ प्रतिक्रिया दे <span><img src="<?php echo base_url();?>assets/images/news_arrow.png" alt="arrow" /></span></h3>	
                    <!-- start language -->
                	<div class="language width">
                    	<label>अपनी भाषा चुनें</label>
						<label><input type="radio" name="radio" class="nlang1"  checked value="0">हिन्दी</input></label>
                        <label><input type="radio" name="radio" class="nlang1" value="1">English</input></label>
                        
                    </div>
                    <!-- end language -->					
						<script language="javascript">
						CreateHindiTextArea("ncomment-hindi","अपनी प्रतिक्रिया यहाँ लिखें",50,5);
						</script>
						<textarea class="textarea" placeholder="Please write the comment here" style="display:none;" id="ncomment-eng"></textarea>
						<textarea class="textarea" style="display:none;" id="nfinal_search" name="nfinal_search"></textarea>
						<input type="hidden" id="art_hid_id" value="<?php echo $main_article['id'];?>"/>
						<p id="nfinal_search_response"></p>
                    <!-- start follow us -->
					<?php if($this->session->userdata('logged_user')==null):?>
					<p>अपने प्रतिक्रिया पोस्ट करने के लिए लॉग इन करें</p>
                    <div class="follow-us">
                        <ul>
                            <li class="hindigaurav"><a onclick="display_login_box();" href="#" title="indi gaurav">Login</a></li>
                        </ul>
                    </div>
					<?php else:?>
                    <!-- end follow us -->
                    <div class="row">
						<input id="num1" class="sum_no" type="text" name="num1" value="<?php echo rand(1,4) ?>" readonly="readonly" /> +
						<input id="num2" class="sum_no" type="text" name="num2" value="<?php echo rand(5,9) ?>" readonly="readonly" /> =
						<input id="captcha" class="sum_res" type="text" name="captcha" maxlength="2" /> (साबित करे कि आप मानव हो)
						<p id="captcha_response"></p><br>
                    	
                    </div>
					<input type="submit" id="post_comment" onclick="save_comment();" value="POST COMMENT" class="post_value" />

					<?php endif;?>
					<p id="post_comment_response"></p>
                </div>
                <!-- end post -->
                <!-- start your post -->
                <div class="your-post">
                	<h3>आपकी प्रतिक्रियायें<span><img src="<?php echo base_url();?>assets/images/news_arrow.png" alt="arrow" /></span></h3>
					<?php foreach($comments as $val){?>
                    <!-- start comments -->
                    <div class="comments">
                    	<span class="arrow"><img src="<?php echo base_url();?>assets/images/comment_arrow.png" alt="comment arrow" /></span>
                        <span><?php  echo $this->common->getSingleValue('tbl_users','first_name','id',$val['user_id']).' '.$this->common->getSingleValue('tbl_users','last_name','id',$val['user_id']);?> <samp><?php echo date('M d,Y H:i:s',strtotime($val['comment_date']));?></samp></span>
                        <p><?php echo $val['comment'];?></p>
                    </div>	
					<?php }?>
                    <!-- end comments -->
                    
                </div> 
                <!-- end your post -->
                <!-- start ads6 -->
                <div class="ads6 ad_clicked">
					<input type="hidden" class="ad_id" value="<?php echo $ads[9]['id']?>">
                	<?php if($ads[9]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[9]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[9]['script_code']){
						echo $ads[9]['script_code'];
					
					}?>
                </div>
                <!-- end ads6 -->
                <!-- start social2 -->
                <div class="social2 display">
                	<span> Follow us:</span>
                	<ul>
                        <li class="facebook"><a href="#" title="facebook">facebook</a></li>
                        <li class="twitter"><a href="#" title="twitter">twitter</a></li>
                        <li class="googleplus"><a href="#" title="googleplus">googleplus</a></li>
                        <li class="youtube"><a href="#" title="youtube">youtube</a></li>
                        <li class="email"><a href="#" title="email">email</a></li>
                        <li class="phone"><a href="#" title="phone">phone</a></li>
                        <li class="iphone"><a href="#" title="iphone">iphone</a></li>
                        <li class="android"><a href="#" title="android">android</a></li>
                        <li class="rss"><a href="#" title="rss">rss</a></li>
                    </ul>
                </div>
                <!-- end social2 -->
            </div>
            <!-- end leftcol -->
            <!-- start rightcol -->
        	<div class="rightcol hg">
            	<!-- start tv -->
            	<div class="location2">
                	<!-- start heading -->
                	<div class="heading">
                    	<span class="heading-arrow"></span>
                		<h3>नक्शे से चुने</h3>
                    </div>
                    <!-- end heading -->
                    <!-- start imgb -->
                    <div class="imgb">
						<a href="#" id="activator2" class="activator" ><img src="<?php echo base_url();?>assets/images/img_map.jpg" alt="map" /></a>
                    	
                    </div>
                    <!-- end imgb -->
                </div>
                <!-- end tv -->
                <!-- start video -->
                <div class="video">
                    <!-- start heading -->
                    <div class="heading">
                        <span class="heading-arrow"></span>
                        <a href="#" title="और देखें..." onclick="more_videos();" class="readmore">और देखें...</a>
                        <h3>वीडियो</h3>
                    </div>
                    <!-- end heading -->
					<ul>
					<?php
					foreach($videos as $vid){
						$ytarray=explode("/", $vid['vid_code']);
						$ytendstring=end($ytarray);
						$ytendarray=explode("?v=", $ytendstring);
						$ytendstring=end($ytendarray);
						$ytendarray=explode("&", $ytendstring);
						$ytcode=$ytendarray[0];
						echo "<li><a class='youtube' href=\"http://www.youtube.com/embed/$ytcode\"><img src=\"http://img.youtube.com/vi/$ytcode/2.jpg\" /><img src=\" ".base_url()."assets/images/play_button.png\" class=\"play1\"/></a></li>";
					
					}
					?>
					</ul>
                    <!--<ul>
                        <li><a href="#" title="video"><img src="<?php echo base_url();?>assets/images/img_video1.jpg" alt="video" /></a></li>
                        <li><a href="#" title="video"><img src="<?php echo base_url();?>assets/images/img_video2.jpg" alt="video" /></a></li>
                        <li><a href="#" title="video"><img src="<?php echo base_url();?>assets/images/img_video3.jpg" alt="video" /></a></li>
                    </ul>-->
                </div>
                <!-- end video -->
                <!-- start pols -->
                <div class="pols">
                	<!-- start heading -->
                	<div class="heading">
                    	<span class="heading-arrow"></span>
                		<h3>जनमत</h3>
                    </div>
                    <!-- end heading -->
                    <!-- start txtb -->
                   	<div class="txtb">
						
						<input type="hidden" name="poll_id" id="poll_id" value="<?php echo $poll_data['id'];?>">
                    	<p><?php echo $poll_data['title'];?></p>
						<div id="poll_area">
						<?php
							foreach($poll_data['answers'] as $ans){
								echo '<p><label><input type="radio" id="poll_answer" name="poll_answer" value="'.$ans['id'].'" /> '.$ans['answer'].'</label></p>';
							}
						?>
						</div><br/>
                        <input type="button" id="vote_here" onclick='record_vote("<?php echo base_url();?>");' value="वोट करें" class="btn" />
						<span id="vote_already" style="display:none">आपके वोट के लिए धन्यवाद</span>
                    </div>
                    <!-- end txtb -->
                </div>
                <!-- end pols -->
                <!-- start ads2 -->
				<?php if($ads[2]):?>
                <div class="ads2 ad_clicked">
					<input type="hidden" class="ad_id" value="<?php echo $ads[2]['id']?>">
                	<?php if($ads[2]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[2]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[2]['script_code']){
						echo $ads[2]['script_code'];
					
					}?>
                
                </div>
				<?php endif;?>
                <!-- end ads2 -->
                <!-- start most popular -->
                <div class="most-popular">
                	<!-- start heading -->
                	<div class="heading">
                    	<span class="heading-arrow"></span>
                		<h3>सबसे लोकप्रिय</h3>
                    </div>
                    <!-- end heading -->
                    <!-- start tabs -->
    				<div class="tabs">
                    	<!-- start tabnav -->
                    	<div class="tab-nav">
                        	<ul>
                            	<li class="active"><a href="#tab1" title="खबरें">खबरें</a></li>
                                <li><a href="#tab2" title="वीडियो">वीडियो</a></li>
                                <li><a href="#tab3" title="तस्वीरें/फ़ोटो">तस्वीरें/फ़ोटो</a></li>
                            </ul>
                        </div>
                        <!-- end tabnav -->
                        <!-- start tab content -->
                        <div class="tab-content" id="tab1">
                        	<ul>
                            	<?php
									foreach( $popular as $art) {
										echo '<li><a href="'.base_url().$art['url'].'" title="'.$art['title'].'">'.$art['title'].'</a></li>';
									
									}
								?>
							</ul>
                        </div>
                        <!-- end tab content -->
                        <!-- start tab content -->
                        <div class="tab-content" id="tab2">
                        	<ul class="med-vid">
							<?php
								foreach($popular_media['videos'] as $vid){
									$ytarray=explode("/", $vid['vid_code']);
									$ytendstring=end($ytarray);
									$ytendarray=explode("?v=", $ytendstring);
									$ytendstring=end($ytendarray);
									$ytendarray=explode("&", $ytendstring);
									$ytcode=$ytendarray[0];
									echo "<li><a class='youtube' href=\"http://www.youtube.com/embed/$ytcode\"><img src=\"http://img.youtube.com/vi/$ytcode/2.jpg\" /><img src=\" ".base_url()."assets/images/play_button.png\" class=\"play1\"/></a></li>";
								
								}
								?>
							</ul>
                        </div>
                        <!-- end tab content -->
                        <!-- start tab content -->
                        <div class="tab-content" id="tab3">
                        	<ul class="med-img">
							<?php
								foreach($popular_media['images'] as $img){
									echo '<li><a class="pop_images" href="'.base_url().'uploads/'.$img['image_large'].'"><img src="'.base_url().'uploads/'.$img['image_thumb'].'" class="play1"/></a></li>';
								
								}
								?>
							</ul>
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end tabs -->	
                </div>
                <!-- end most popular -->
                <!-- start ads3 -->
				<?php if($ads[3]):?>
                <div class="ads3 ad_clicked display">
					<input type="hidden" class="ad_id" value="<?php echo $ads[3]['id']?>">
                	<?php if($ads[3]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[3]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[3]['script_code']){
						echo $ads[3]['script_code'];
					
					}?>
                </div>
				<?php endif;?>
                <!-- end ads3 -->
				<!-- start health -->
                <div class="health">
                	<!-- start heading -->
                	<div class="heading">
                    	<span class="heading-arrow"></span>
                        <a href="<?php echo base_url().$recipe['alias'];?>" title="और देखें..." class="readmore">और देखें...</a>
                		<h3>व्यंजन / स्वास्थ्य</h3>
                    </div>
                    <!-- end heading -->
                    <ul>
                    	<?php
						foreach($articles['recipe'] as $rec) {
							echo '<li><a href="'.base_url().$rec['url'].'" title="food"><img src="'.base_url().$rec['art_image'].'" alt="food" /></a></li>';
						
						}
						
						?>
                    </ul>
                </div>
                <!-- end health -->
                
                <!-- start photo -->
                <div class="photo">
                	<!-- start heading -->
                	<div class="heading">
                    	<span class="heading-arrow"></span>
                        <a href="#" title="और देखें..." class="readmore">और देखें...</a>
                		<h3>तस्वीरें/फ़ोटो</h3>
                    </div>
                    <!-- end heading -->
                    <!-- start photo slide -->
                    <div class="photo-slide">
						<div id="mybgcarousel" class="bgcarousel"></div>
					</div>
                    <!-- end photo slide -->
                </div>
                <!-- end photo -->
                <!-- start ads3 -->
                <div class="ads3 ad_clicked display1">
					<input type="hidden" class="ad_id" value="<?php echo $ads[3]['id']?>">
                	<?php if($ads[3]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[3]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[3]['script_code']){
						echo $ads[3]['script_code'];					
					}?>
                </div>
                <!-- end ads3 -->
				<!-- start social2 -->
                <div class="social2 display1">
                	<span> Follow us:</span>
                	<ul>
                        <li class="facebook"><a href="#" title="facebook">facebook</a></li>
                        <li class="twitter"><a href="#" title="twitter">twitter</a></li>
                        <li class="googleplus"><a href="#" title="googleplus">googleplus</a></li>
                        <li class="youtube"><a href="#" title="youtube">youtube</a></li>
                        <li class="email"><a href="#" title="email">email</a></li>
                        <li class="phone"><a href="#" title="phone">phone</a></li>
                        <li class="iphone"><a href="#" title="iphone">iphone</a></li>
                        <li class="android"><a href="#" title="android">android</a></li>
                        <li class="rss"><a href="#" title="rss">rss</a></li>
                    </ul>
                </div>
                <!-- end social2 -->
            </div>
            <!-- end rightcol -->
			
        </div>
	
		