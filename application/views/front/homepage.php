        <!-- start container -->
        <div class="container">
        	<!-- start leftcol -->
        	<div class="leftcol">
            	<!-- Start photosgallery-vertical -->
				<div class="sliderkit photosgallery-vertical">
					<div class="sliderkit-nav">						
						<div class="sliderkit-nav-clip">
							<ul>
								<?php
								foreach($slider_articles as $art){
									echo '<li><a href="#" rel="nofollow" title="'.$art['title'].'"><span name="[Alternative text]">'.$art['title'].'</span></a></li>';
								}
								?> 
							</ul>
						</div>
						<div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-prev"><a rel="nofollow" href="#" title="Previous line"><span>Previous</span></a></div>
						<div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-next"><a rel="nofollow" href="#" title="Next line"><span>Next</span></a></div>
					</div>
					<div class="sliderkit-panels">
						<?php
						foreach($slider_articles as $art):?>
						<div class="sliderkit-panel">
							<img src="<?php echo $art['art_image']?>" alt="[Alternative text]" width="100%" />
							<div class="sliderkit-panel-textbox">
								<div class="sliderkit-panel-text">
									<h4><a href="<?php echo base_url().$art['url'];?>" title="<?php echo $art['title'];?>"><?php echo $art['title'];?></a></h4>
									<p><a href="<?php echo base_url().$art['url'];?>" title=""><?php 
									if(strlen($this->common->filter_img($art['content']) )>500){
										$s = strpos($this->common->filter_img($art['content']),' ',500);
										echo substr($this->common->filter_img($art['content']),0,$s)."...";
									}
									else {
										echo substr($this->common->filter_img($art['content']),0,500);
									}
									?></a></p>
								</div>
								<div class="sliderkit-panel-overlay"></div>
							</div>
						</div>
						<?php endforeach;?>					
					</div>
				</div>
				<!--  end of photosgallery-vertical -->
                <!-- start col1 -->
                <div class="col1">
                	<!-- start common news -->
                	<div class="common-news">
                    	<!-- start heading2 -->
                        <div class="heading2">
                            <a href="<?php echo base_url().$cat_1['alias'];?>" title="और देखें..." class="readmore">और देखें...</a>
                            <h3><?php echo $cat_1['category'];?></h3>
                        </div>
                        <!-- end heading2 -->

                        <img src="<?php echo base_url().$articles['cat_1'][0]['art_image'];?>" alt="image" />
                        <ul>
							<?php
								
								echo '<li class="active"><a href="'.base_url().$articles['cat_1'][0]['url'].'" title="'.$articles['cat_1'][0]['title'].'">'.$articles['cat_1'][0]['title'].'</a></li>';
								unset($articles['cat_1'][0]);
								foreach($articles['cat_1'] as $val) {
									echo '<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';
								
								}
							?>
                        </ul>
                    </div>
                    <!-- end common news -->
                    <!-- start common news -->
                	<div class="common-news">
                    	<!-- start heading2 -->
                        <div class="heading2">
                            <a href="<?php echo base_url().$cat_3['alias'];?>" title="और देखें..." class="readmore">और देखें...</a>
                            <h3><?php echo $cat_3['category'];?></h3>
                        </div>
                        <!-- end heading2 -->

                        <img src="<?php echo base_url().$articles['cat_3'][0]['art_image'];?>" alt="image" />
                        <ul>
							<?php
								
								echo '<li class="active"><a href="'.base_url().$articles['cat_3'][0]['url'].'" title="'.$articles['cat_3'][0]['title'].'">'.$articles['cat_3'][0]['title'].'</a></li>';
								unset($articles['cat_3'][0]);
								foreach($articles['cat_3'] as $val) {
									echo '<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';
								
								}
							?>
                        </ul>
                    </div>
                    <!-- end common news -->
                </div>
                <!-- end col1 -->
                <!-- start col12 -->
                <div class="col2">
                	<!-- start common news -->
                	<div class="common-news">
                        <!-- start tabs -->
                        <div class="tab2">
                            <!-- start tabnav -->
                            <div class="tab-nav2">
                            	
                                <ul>
                                    <li class="active"><a href="#tab4" title="देश">देश</a></li>
                                    <li><a href="#tab5" title="दुनिया">दुनिया</a></li>
                                    <li><a href="#tab6" title="प्रदेश">प्रदेश</a></li>
                                    <li><a href="#tab7" title="पमहानगर">महानगर</a></li>
                                </ul>
                            </div>
                            <!-- end tabnav -->
                            <!-- start tab content2 -->
                            <div class="tab-content2" id="tab4">
                                <ul>
                                    <?php								
										echo '<li class="active"><a href="'.base_url().$articles['cat_2_1'][0]['url'].'" title="'.$articles['cat_2_1'][0]['title'].'">'.$articles['cat_2_1'][0]['title'].'</a></li>';
										unset($articles['cat_2_1'][0]);
										foreach($articles['cat_2_1'] as $val) {
											echo '<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';		
										}
									?>
                                </ul>
                            </div>
                            <!-- end tab content2 -->
                            <!-- start tab content2 -->
                            <div class="tab-content2" id="tab5">
                                <ul>
                                    <?php								
										echo '<li class="active"><a href="'.base_url().$articles['cat_2_2'][0]['url'].'" title="'.$articles['cat_2_2'][0]['title'].'">'.$articles['cat_2_2'][0]['title'].'</a></li>';
										unset($articles['cat_2_2'][0]);
										foreach($articles['cat_2_2'] as $val) {
											echo '<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';		
										}
									?>
                                </ul>
                            </div>
                            <!-- end tab content2 -->
                            <!-- start tab content2 -->
                            <div class="tab-content2" id="tab6">
                                <ul>
                                    <?php	
										
										if($articles['cat_2_3']){
											echo '<li class="active"><a href="'.base_url().$articles['cat_2_3'][0]['url'].'" title="'.$articles['cat_2_3'][0]['title'].'">'.$articles['cat_2_3'][0]['title'].'</a></li>';
											unset($articles['cat_2_3'][0]);
											foreach($articles['cat_2_3'] as $val) {
												echo '<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';		
											}
										}
										else {
											echo'<li>कोई खबर नहीं</li>';
										}
									?>
                                </ul>
                            </div>
                            <!-- end tab content2 -->
                            <!-- start tab content2 -->
                            <div class="tab-content2" id="tab7">
                                <ul>
                                    <?php
										if($articles['cat_2_4']){
										echo '<li class="active"><a href="'.base_url().$articles['cat_2_4'][0]['url'].'" title="'.$articles['cat_2_4'][0]['title'].'">'.$articles['cat_2_4'][0]['title'].'</a></li>';
										unset($articles['cat_2_4'][0]);
										foreach($articles['cat_2_4'] as $val) {
											echo '<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';		
										}
										}										
										else {
											echo'<li>कोई खबर नहीं</li>';
										}
									?>
                                </ul>
                            </div>
                            <!-- end tab content2 -->
                        </div>
                        <!-- end tab2 -->
                    </div>
                    <!-- end common news -->
                    <!-- start common news -->
                	<div class="common-news">
                    	<!-- start heading2 -->
                        <div class="heading2">
                            <a href="<?php echo base_url().$cat_4['alias'];?>" title="और देखें..." class="readmore">और देखें...</a>
                            <h3><?php echo $cat_4['category'];?></h3>
                        </div>
                        <!-- end heading2 -->

                        <img src="<?php echo base_url().$articles['cat_4'][0]['art_image'];?>" alt="image" />
                        <ul>
							<?php
								
								echo '<li class="active"><a href="'.base_url().$articles['cat_4'][0]['url'].'" title="'.$articles['cat_4'][0]['title'].'">'.$articles['cat_4'][0]['title'].'</a></li>';
								unset($articles['cat_4'][0]);
								foreach($articles['cat_4'] as $val) {
									echo '<li><a href="'.base_url().$val['url'].'" title="'.$val['title'].'">'.$val['title'].'</a></li>';
								
								}
							?>
                        </ul>
                    </div>
                    <!-- end common news -->
                    <!-- start ads5 -->
                    <div class="ads5 ad_clicked ad_clicked">
						<input type="hidden" class="ad_id" value="<?php echo $ads[5]['id']?>">
                    	<?php if($ads[5]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[5]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[5]['script_code']){
						echo $ads[5]['script_code'];
					
					}?>
                    </div>
                    <!-- end ads5 -->
                </div>
                <!-- end col2 -->
                <!-- start local -->
                <div class="local">
                	<!-- start heading2 -->
                	<div class="heading2">
                    	<!-- start select location -->
                    	<div class="select-location">
                        	<label>राज्य चुनें <select class="custom-select" id="state" onChange="get_district('<?php echo base_url();?>');">
								<option value="0">-विकल्प चुने-</option>
								<?php
									foreach($states as $v) {
									echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';
									}
								?>
							</select>
							</label>
                        	<label class="width">शहर चुनें 
							<select class="custom-select" id="city" >
								<option>-विकल्प चुने-</option>
							</select>
							</label>
                        </div>
                        <!-- end select location -->
                        <h3>स्थानीय</h3>
                    </div>
                    <!-- end heading2 -->
                    <!-- start col1 -->
                    <div class="col1">
                    	<!-- start common news -->
                        <div class="common-news" id="city_news_1">
                            <!--<img src="<?php echo base_url();?>assets/images/img_police.jpg" alt="image" />
                            <ul>
                                <li class="active"><a href="#" title="शस्त्र पूजन कर मनाया पीएसी वाहिनी का स्थापना दिवस">शस्त्र पूजन कर मनाया पीएसी वाहिनी का स्थापना दिवस</a></li>
                                <li><a href="#" title=" नए कोर्स में फेल हुआ विवि ">  नए कोर्स में फेल हुआ विवि</a></li>
                                <li><a href="#" title=" तूफान और बारिश से उड़ा 'करंट'">  तूफान और बारिश से उड़ा 'करंट'</a></li>
                                <li><a href="#" title=" डॉक्टर भाइयों ने डाली फेफड़ों में जान"> डॉक्टर भाइयों ने डाली फेफड़ों में जान</a></li>
                                <li><a href="#" title="झोलाछाप के इलाज से छात्र का हाथ गला">झोलाछाप के इलाज से छात्र का हाथ गला</a></li>
                                <li><a href="#" title=" डॉक्टर भाइयों ने डाली फेफड़ों में जान"> डॉक्टर भाइयों ने डाली फेफड़ों में जान</a></li>
                                <li><a href="#" title=" झोलाछाप के इलाज से छात्र का हाथ गला"> झोलाछाप के इलाज से छात्र का हाथ गला</a></li>
                                <li><a href="#" title=" नए कोर्स में फेल हुआ विवि"> नए कोर्स में फेल हुआ विवि</a></li>
                                <li><a href="#" title="तूफान और बारिश से उड़ा 'करंट'">तूफान और बारिश से उड़ा 'करंट'</a></li>
                            </ul>-->
                        </div>
                        <!-- end common news -->
                    </div>
                    <!-- end col1 -->
                    <!-- start col2 -->
                    <div class="col2">
                        <div class="common-news" id="city_news_2">
                            <!--<img src="<?php echo base_url();?>assets/images/img_police.jpg" alt="image" />
                            <ul>
                                <li class="active"><a href="#" title="शस्त्र पूजन कर मनाया पीएसी वाहिनी का स्थापना दिवस">शस्त्र पूजन कर मनाया पीएसी वाहिनी का स्थापना दिवस</a></li>
                                <li><a href="#" title=" नए कोर्स में फेल हुआ विवि ">  नए कोर्स में फेल हुआ विवि</a></li>
                                <li><a href="#" title=" तूफान और बारिश से उड़ा 'करंट'">  तूफान और बारिश से उड़ा 'करंट'</a></li>
                                <li><a href="#" title=" डॉक्टर भाइयों ने डाली फेफड़ों में जान"> डॉक्टर भाइयों ने डाली फेफड़ों में जान</a></li>
                                <li><a href="#" title="झोलाछाप के इलाज से छात्र का हाथ गला">झोलाछाप के इलाज से छात्र का हाथ गला</a></li>
                                <li><a href="#" title=" डॉक्टर भाइयों ने डाली फेफड़ों में जान"> डॉक्टर भाइयों ने डाली फेफड़ों में जान</a></li>
                                <li><a href="#" title=" झोलाछाप के इलाज से छात्र का हाथ गला"> झोलाछाप के इलाज से छात्र का हाथ गला</a></li>
                                <li><a href="#" title=" नए कोर्स में फेल हुआ विवि"> नए कोर्स में फेल हुआ विवि</a></li>
                                <li><a href="#" title="तूफान और बारिश से उड़ा 'करंट'">तूफान और बारिश से उड़ा 'करंट'</a></li>
                            </ul>-->
                        </div>
                    </div>
                    <!-- end col2 -->
                </div>
                <!-- end local -->
                <!-- start ads6 -->
                <div class="ads6 ad_clicked">
					<input type="hidden" class="ad_id" value="<?php echo $ads[6]['id']?>">
                	<?php if($ads[6]['add_img']):?>
					<img src="<?php echo base_url();?>uploads/adds/<?php echo $ads[6]['add_img'];?>" alt="ads" />
					<?php endif;?>
					<?php if($ads[6]['script_code']){
						echo $ads[6]['script_code'];
					
					}?>
                </div>
                <!-- end ads6 -->
                <!-- start social2 -->
                <div class="social2">
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
        	<div class="rightcol">
            	<!-- start tv -->
            	<div class="tv">
                	<!-- start heading -->
                	<div class="heading">
                    	<span class="heading-arrow"></span>
                		<h3>लाइव टीवी</h3>
                    </div>
                    <!-- end heading -->
                    <!-- start imgb -->
                    <div class="imgb">
                    	<img src="<?php echo base_url();?>assets/images/img_tv2.jpg" alt="tv" />
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
						$art_id = $this->common->getSingleValue('tbl_media','art_id','id',$vid['id']);
						$art_title = $this->common->getSingleValue('tbl_article','title','id',$art_id);
						echo "<li><a title='".$art_title."' class='youtube' href=\"http://www.youtube.com/embed/$ytcode\"><img src=\"http://img.youtube.com/vi/$ytcode/2.jpg\" /><img src=\" ".base_url()."assets/images/play_button.png\" class=\"play1\"/></a></li>";
					
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
                <div class="ads3  ad_clicked display">
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
            </div>
            <!-- end rightcol -->
        </div>
        <!-- end container -->
    
