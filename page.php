<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Treeline
 */

get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fancy-box/jquery.fancybox.min.css">
<div class="main-content">
<?php $gallery_images = get_field( 'treeline_gallery_gallery' ); 
             $thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'blog-future-image', false );
			$thumb_url = $thumb_url_array[0];
?>
<?php if ( $gallery_images ) {  ?>
<section class="food-topslider window-height">	
    <div id="foodslider" class="owl-carousel owl-theme" >
		<?php foreach ( $gallery_images as $gallery_image ): ?>
			<div class="item" style="background-image:url(<?php echo $gallery_image['sizes']['gallery-full']; ?>);"></div>
		<?php endforeach; ?>    
    </div>
	<?php /* if ( get_field( 'treeline_show_thumb_gallery' ) == 1 ) { ?>
    <div id="sync2" class="owl-carousel owl-theme">
		<?php foreach ( $gallery_images as $gallery_image ): ?>
        <div class="item"><span><img src="<?php echo $gallery_image['sizes']['gallery-thumb']; ?>" alt="<?php echo $gallery_image['alt']; ?>"></span></div>
		<?php endforeach; ?>
  </div>
	<?php } */  ?>
    <a href="#top" class="bottom-arriw"><img src="<?php echo get_template_directory_uri(); ?>/images/bottom-arrow.png" alt="" title=""></a> 
</section>
<?php }else { 
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'gallery-full', false );
			$thumb_url = $thumb_url_array[0];
		if (!empty($thumb_url))
			{  ?>		
	<section class="food-topslider window-height">	
    <div id="foodslider" class="owl-carousel owl-theme" >
		
			<div class="item" style="background-image:url(<?php echo $thumb_url; ?>);"></div>
		
    </div>
	<?php /* if ( get_field( 'treeline_show_thumb_gallery' ) == 1 ) { ?>
    <div id="sync2" class="owl-carousel owl-theme">
		<?php foreach ( $gallery_images as $gallery_image ): ?>
        <div class="item"><span><img src="<?php echo $gallery_image['sizes']['gallery-thumb']; ?>" alt="<?php echo $gallery_image['alt']; ?>"></span></div>
		<?php endforeach; ?>
  </div>
	<?php } */  ?>
    <a href="#top" class="bottom-arriw"><img src="<?php echo get_template_directory_uri(); ?>/images/bottom-arrow.png" alt="" title=""></a> 
</section>
		<?php } else { ?>
				<div class="no-banner">
				</div>
			<?php } ?>
<?php } ?>
<section class="food-body 1" id="top">
    
    <div class="sec-title">			
        <h1><?php the_title();?></h1>        
    </div>
        
    <div class="wrapper">
		<?php 
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>        
    </div>    
    
</section>
<section class="food-menu food-body">
    <?php if ( have_rows( 'content' ) ): ?>
		
    
	    <?php while ( have_rows( 'content' ) ) : the_row(); ?>
		
		<?php if ( get_row_layout() == 'flexible_content_title_name' ){ ?>
			<?php if ( get_sub_field( 'flexible_content_title_background_color' ) == 1 ) { ?>
				<div class="riders-sec fullpage-sample-menusec">
					<div class="sec-title">		
						<div class="wrapper">
							<<?php the_sub_field( 'flexible_content_title_weight' ); ?> style="text-align:<?php the_sub_field( 'flexible_content_title_align' ); ?>"><?php the_sub_field( 'flexible_content_title_title' ); ?></<?php the_sub_field( 'flexible_content_title_weight' ); ?>>        
						</div>
					</div>
				</div>
			<?php }else{ ?>
				<div class="wrapper-above-div">
					<div class="wrapper">
						<div class="sec-title">		
							<<?php the_sub_field( 'flexible_content_title_weight' ); ?> style="text-align:<?php the_sub_field( 'flexible_content_title_align' ); ?>"><?php the_sub_field( 'flexible_content_title_title' ); ?></<?php the_sub_field( 'flexible_content_title_weight' ); ?>>        
						</div>
					</div>
				</div>	
				<?php } ?>
        <?php } elseif ( get_row_layout() == 'flexible_content_1_column_text_name' ) { ?>
	<div class="wrapper-above-div">
		<div class="wrapper">
			<div class="full-width">
		
		<?php the_sub_field( 'flexible_content_1_cloumn_texteditor' ); ?>
			</div>
		</div>
	</div>
		<?php } elseif ( get_row_layout() == 'flexible_content_2_column_text_name' ) { ?>
	<div class="wrapper-above-div">
			<div class="wrapper">
				<div class="top-tow-col-sec">
					<div class="food-sec-lh aos-init aos-animate" data-aos="zoom-in-right">	
							<?php the_sub_field( 'flexible_content_2_column_1st_content_texteditor' ); ?>
					</div>
					<div class="food-sec-rh aos-init aos-animate" data-aos="zoom-in-left">	
						<?php the_sub_field( 'flexible_content_2_column_2nd_content_texteditor' ); ?>
					</div>
				</div>
		</div>
	</div>
		<?php } elseif ( get_row_layout() == 'flexible_content_3_column_text_name' ){ ?>
		<div class="wrapper-above-div">
			<div class="wrapper">
				<div class="top-three-col-sec">
					<div class="food-sec-1column aos-init aos-animate" data-aos="zoom-in-right">
						<?php the_sub_field( 'flexible_content_3_cloumn_1st_content_texteditor' ); ?>
					</div>
					<div class="food-sec-2column aos-init aos-animate" data-aos="zoom-in-up">
						<?php the_sub_field( 'flexible_content_3_cloumn_2nd_content_texteditor' ); ?>
					</div>
					<div class="food-sec-3column aos-init aos-animate" data-aos="zoom-in-left">
						<?php the_sub_field( 'flexible_content_3_cloumn_3rd_content_texteditor' ); ?>
					</div>
				</div>
			</div>
			</div>	
		<?php }elseif ( get_row_layout() == 'flexible_content_text__image' ) { ?>
		<div class="wrapper-above-div">
		<div class="wrapper">
			<div class="fmenu-box-main">
								<?php 
								  if(get_sub_field( 'flexible_content_image_left_right_image_position' )!='Left'){
								  	$image_effect="fade-left";
									  $content_effect="fade-right";
								  }
								  else{
										
									  
									  $image_effect="fade-right";
									  $content_effect="fade-left";
								  }
								
								?>
			
				<div class="fmenu-box <?php if(get_sub_field( 'flexible_content_image_left_right_image_position' )!='Left'){ ?> incerse-block<?php } ?>">	
					<?php if ( get_sub_field( 'flexible_content_image_left_right_image' ) ) { ?>
						<div class="fmenu-left" data-aos="<?php echo $image_effect;?>">
							<img src="<?php the_sub_field( 'flexible_content_image_left_right_image' ); ?>" alt="" title=""/>
						</div>
					<?php } ?>
					<div class="fmenu-right" data-aos="<?php echo $content_effect;?>">
						<div class="dis-table">
							<div class="vcenter">
							<<?php the_sub_field( 'weight_title' ); ?>><?php the_sub_field( 'flexiable_content_left_right_title_title' ); ?></<?php the_sub_field( 'weight_title' ); ?>>
							<p class="darktext"><?php the_sub_field( 'flexiable_content_left_right_sub_title_title' ); ?></p>
							<?php the_sub_field( 'flexible_content_left_right_content_texteditor' ); ?>
							</div>
						</div>    
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php } 
			elseif ( get_row_layout() == 'flexible_content_4_grid_layout' ) { ?>
				<?php if ( have_rows( 'rep_add_grid_layout' ) ) : ?>
			<div class="morzine-box-main">
            	<div class="wrapper">	
                    <div class="morzine-sec-row msrItems">
								<?php while ( have_rows( 'rep_add_grid_layout' ) ) : the_row(); ?>
                            <div class="morzine-box msrItem"  data-aos="zoom-in-up">
								<?php if ( get_sub_field( 're_flex_4_image' ) ) { ?>
                                <div class="morzine-img"><img src="<?php the_sub_field( 're_flex_4_image' ); ?>" alt="" title=""></div>
								<?php } ?>
                                <div class="morzine-cont">
                                    <h4><?php the_sub_field( 're_flex_4_title' ); ?> </h4>
                                    <?php the_sub_field( 're_flex_4_content' ); ?>
                                </div>
                            </div>
								<?php endwhile; ?>
								
                    </div>		
                </div>    
            </div> 
				<?php endif; ?>
		<?php } elseif ( get_row_layout() == 'flex_three_column_menu_items' ) { ?>
								<?php if ( have_rows( 'flex_re_menu_items' ) ) : ?>
		<div class="menu-list-3-col-main">
                    <div class="wrapper">
								<?php 
							$counter=1;   
						   while ( have_rows( 'flex_re_menu_items' ) ) : the_row(); 
								if($counter==1){
									$animation="fade-right";
									$counter++; 
								}
								else if($counter==2){
									$animation="fade-up";
									$counter++; 
								}
								else if($counter==3){
									$animation="fade-left";
									$counter=1;
								}
								?>
								
                        <div class="menu-list-3-col"  data-aos="<?php echo $animation;?>">
                            <div class="menu-itm-main">
								
                                <div class="menu-itm-ico">
								<?php if ( get_sub_field( 're_flex_menu_icon_three' ) ) { ?>
                                    <img src="<?php the_sub_field( 're_flex_menu_icon_three' ); ?>" alt="" title="">
								<?php } ?>
                                </div>
                                <div class="menu-itm-des">
                                    <h4><?php the_sub_field( 're_flex_menu_title' ); ?></h4>
                                    <p><?php the_sub_field( 're_flex_menu_content' ); ?></p>
                                </div>
                            </div>
                        </div>
								<?php 
							  
						   endwhile; ?>
                        
                        
                    </div>
                </div>
								<?php endif; ?>
		<?php } 
			elseif ( get_row_layout() == 'flex_two_column_menu_items' ) { ?>
				<?php if ( have_rows( 'flex_re_menu_items_two' ) ) : ?>
				<div class="menu-list-2-col-main">
                    <div class="wrapper">
					<?php $counter2=0;
						 while ( have_rows( 'flex_re_menu_items_two' ) ) : the_row(); 
								if($counter2%2==0){
									$animation="fade-right";
									
								}
								else {
									$animation="fade-left";
									
								}
								?>
                        <div class="menu-list-2-col"  data-aos="<?php echo $animation;?>">
                            <div class="menu-itm-main">
                                <div class="menu-itm-ico">
								<?php if ( get_sub_field( 're_flex_menu_icon' ) ) { ?>
                                    <img src="<?php the_sub_field( 're_flex_menu_icon' ); ?>" alt="" title="">
								<?php } ?>
                                </div>
                                <div class="menu-itm-des">
                                    <h4><?php the_sub_field( 're_flex_menu_title' ); ?></h4>
                                    <p><?php the_sub_field( 're_flex_menu_content' ); ?></p>
                                </div>
                            </div>
                        </div>
					<?php 
					 $counter2++;
					 endwhile; ?>
                        
                        
                    </div>
                </div>
				<?php endif; ?>
			<?php } elseif ( get_row_layout() == 'flex_full_width_image_block' ) { ?>
					<?php $flex_full_image = get_sub_field( 'flex_full_image' ); ?>
					<?php if ( $flex_full_image ) { ?>
							<div class="blog-det-img-row">
									<?php echo wp_get_attachment_image( $flex_full_image, 'gallery-full' ); ?>
								</div>
					<?php } ?>
			<?php }elseif ( get_row_layout() == 'chalet_search' ) { ?>		
				<section class="chalet-dtl-1 chalat-search-box 1">
					<div class="wrapper">
					  <?php
					  function callAPI($method, $url, $data)
					  {
						   $curl = curl_init();
						   switch ($method){
							  case "POST":
								 curl_setopt($curl, CURLOPT_POST, 1);
								 if ($data)
									curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
								 break;
							  case "PUT":
								 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
								 if ($data)
									curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
								 break;
							  default:
								 if ($data)
									$url = sprintf("%s?%s", $url, http_build_query($data));
						   }
						   //echo $url;
						   // OPTIONS:
						   curl_setopt($curl, CURLOPT_URL, $url);
						   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
							  'ChaletManager-Key: TACk4MfBQK4Pa7r9u4d6yLfifMsKN0ncQjhmW0QSltnFAKzzpDGSV8wSjY5W1QZy',
							   'ChaletManager-API: 2021.1',
							  'Content-Type: application/json',
						   ));
						   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
						   // EXECUTE:
						   $result = curl_exec($curl);
						   if(!$result){die("Connection Failure");}
						   curl_close($curl);
						   return $result;
					}
					$chaletidArr = array();
					$errormsg = '';
					if(isset($_REQUEST['sleeps']) && isset($_REQUEST['start_date'])) {
						$sleeps = $_REQUEST['sleeps'];
						$start_date = date("Y-m-d",strtotime($_REQUEST['start_date']));
						//$data = array('firstNight'=>$start_date, 'guests'=>$sleeps);
						$data = array('firstNight'=>$start_date, 'guests'=>$sleeps);
						$get_data = callAPI('POST', 'https://www.chaletmanager.com/api/public/treelinechalets/query', json_encode($data));
						$response = json_decode($get_data, true);
						//echo "<pre>";
						//print_r($response);
						//exit;
						if(isset($response['error'])) {
							$errormsg = $response['error'];
						} else {
							foreach($response['availability'] as $chalet) {
								$chaletidArr[] = $chalet['chalet'];
							}
						}
						
					} else {
						$get_data = callAPI('GET', 'https://www.chaletmanager.com/api/public/treelinechalets/chalets', false);
						$response = json_decode($get_data, true);
						//echo "<pre>";
						//print_r($response);
						//exit;
						if(isset($response['error'])) {
							$errormsg = $response['error'];
						} else {
							foreach($response['chalets'] as $chalet) {
								$chaletidArr[] = $chalet['hash'];
							}
						}
						
					}
					
					//global $wpdb;
					$taxarr = array();
					$tarr = array();
					$sDates = DateTime::createFromFormat('m-d', '05-01');
					$sDatee = DateTime::createFromFormat('m-d', '11-31');
					
					$sort = isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : '';
					
					$cdate = DateTime::createFromFormat('m-d',date('m-d',strtotime($sort)));

					
					if($cdate->format('md') >= $sDates->format('md') && $cdate->format('md') <= $sDatee->format('md')) {
						$tarr[] = 'summer';
					}

					if(isset($_REQUEST['chalet_type'])) {
						if($_REQUEST['chalet_type']!='') {
							$tarr[] = $_REQUEST['chalet_type'];
						}
					}
					if(count($tarr)>0) {

						if(count($tarr) == 1) {

							$taxarr = array(
								array (
									'taxonomy' => 'chalets_type',
									'field' => 'slug',
									'terms' => $tarr,
								)
							);
						} else {
							$tta = array();
							foreach($tarr as $ta) {
								$tta[] = array (
									'taxonomy' => 'chalets_type',
									'field' => 'slug',
									'terms' => $ta[0],
									'operator'  => 'IN'
								);
							}
							$taxarr = array(
								'relation' => 'AND',
								$tta
							);
						}
					}
					//print_r($chaletidArr);
					
					$argsP = array(
						'post_type' => 'chalets',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'DESC',
						'meta_query' => array(
							array(
								'key' => 'chalet_manager_id',
								'value' => $chaletidArr,
								'compare' => 'IN'
							)
						),
						'tax_query' => $taxarr
					);
					//echo "<pre>";
					//print_r($argsP);
					
					$postsPages = new WP_Query( $argsP ); //get_posts($argsP);
					//echo "<pre>";
					//echo $postsPages->request;
					//exit;
					 ?>
						<form action="" method="get" >
							<div class="main-guest-cls" >
								<label for="sleeps">Guests:</label>

								<select name="sleeps" id="sleeps">
									<option <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="1") { ?> selected="" <?php } ?> value="1">1</option>
									<option value="2" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="2") { ?> selected="" <?php } ?>>2</option>
									<option value="3" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="3") { ?> selected="" <?php } ?>>3</option>
									<option value="4" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="4") { ?> selected="" <?php } ?>>4</option>
									<option value="5" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="5") { ?> selected="" <?php } ?>>5</option>
									<option value="6" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="6") { ?> selected="" <?php } ?>>6</option>
									<option value="7" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="7") { ?> selected="" <?php } ?>>7</option>
									<option value="8" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="8") { ?> selected="" <?php } ?>>8</option>
									<option value="9" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']=="9") { ?> selected="" <?php } ?>>9</option>
									<option value="10" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==10) { ?> selected="selected" <?php } ?>>10</option>
									<option value="11" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==11) { ?> selected="selected" <?php } ?>>11</option>
									<option value="12" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==12) { ?> selected="selected" <?php } ?>>12</option>
									<option value="13" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==13) { ?> selected="selected" <?php } ?>>13</option>
									<option value="14" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==14) { ?> selected="selected" <?php } ?>>14</option>
									<option value="15" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==15) { ?> selected="selected" <?php } ?>>15</option>
									<option value="16" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==16) { ?> selected="selected" <?php } ?>>16</option>
									<option value="17" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==17) { ?> selected="selected" <?php } ?>>17</option>
									<option value="18" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==18) { ?> selected="selected" <?php } ?>>18</option>
									<option value="19" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==19) { ?> selected="selected" <?php } ?>>19</option>
									<option value="20" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==20) { ?> selected="selected" <?php } ?>>20</option>
									<option value="21" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==21) { ?> selected="selected" <?php } ?>>21</option>
									<option value="22" <?php if(isset($_REQUEST['sleeps']) && $_REQUEST['sleeps']==22) { ?> selected="selected" <?php } ?>>22</option>
								</select>
							</div>


							<div class="main-start_date-cls">
								<label for="start_date">Start Date:</label>

								<input type="text" id="start_date" name="start_date" <?php if(isset($_REQUEST['start_date'])) { ?> value="<?php echo $_REQUEST['start_date']; ?>"<?php } ?> required="" />
							</div>
							<div class="main-guest-cls" >
								<label for="chalet_type">Chalets Type:</label>

								<select name="chalet_type" id="chalet_type">
									<option value="" >Select</option>
									<option <?php if(isset($_REQUEST['chalet_type']) && $_REQUEST['chalet_type']=="catered") { ?> selected="" <?php } ?> value="catered">Catered</option>
									<option value="self-catered" <?php if(isset($_REQUEST['chalet_type']) && $_REQUEST['chalet_type']=="self-catered") { ?> selected="" <?php } ?>>Self-Catered</option>
									<?php /*<option value="32" <?php if(isset($_REQUEST['chalet_type']) && $_REQUEST['chalet_type']=="32") { ?> selected="" <?php } ?>>Summer</option>
									<option value="flexi-catered" <?php if(isset($_REQUEST['chalet_type']) && $_REQUEST['chalet_type']=="flexi-catered") { ?> selected="" <?php } ?>>Flexi-Catered</option>*/ ?>
								</select>
							</div>
							<button type="submit" class="button black">Search</button>
						</form>
					</div>
				</section>
				<section class="hm-one" id="top">		
				<div class="sec-title"></div>
				<div class="hm-chalet-main" id="chalets_data_result">
					<?php 
						if(count($chaletidArr)>0) {
						if ( $postsPages->found_posts > 0 ) {
								$counter=1;
							while ( $postsPages->have_posts() ) {
								$postsPages->the_post();
								if($counter==1){
									$data_aos="fade-right";	
								}
								else if($counter==2){
									$data_aos="fade-down";	
								}
								else if($counter==3){
									$data_aos="fade-left";
									$counter=1;
								}
								 
								?>
							
								<div class="hm-chalet-box aos-item aos-init" data-aos="<?php //echo $data_aos;?>">
									<?php $gallery_images = get_field( 'treeline_gallery_gallery' ); 
									$placholder_image = wp_get_attachment_image_src("7117","chalet-thumb");
								 
									if(count($gallery_images)>0){
										
										 $image_url=$gallery_images[0]['sizes']['chalet-thumb'];
										 
											if($image_url!=""){
									?>
									<img src="<?php echo $image_url; ?>" alt="" />
											<?php }else{ ?>
											<img src="<?php echo $placholder_image[0]; ?>" alt="" />
											<?php } ?>
									<?php }else{ 
									?>
									
										 <?php 
									?>
									<img src="<?php echo $placholder_image[0]; ?>" alt="" />
									<?php }  ?>
									
									<?php $ch_people_sleeps=get_field( 'ch_people_sleeps' ); 
									if(!empty($ch_people_sleeps)){
									?>
									<div class="chalet-capacity"><?php _e("Sleeps","treeline"); ?><br /> <?php echo $ch_people_sleeps;?><br /> <?php _e("People","treeline"); ?></div>
									<?php } ?>
									<div class="hm-overlay">
										<?php  /*<a href="<?php the_permalink();?>"></a>*/ ?>
										<div class="dis-table">
											<div class="dis-cell">
												<h3><?php the_title();?></h3>
											   <?php  if ( has_excerpt() ) { echo truncate_str(strip_tags(get_the_excerpt()),375);}else{ echo truncate_str( strip_tags(get_the_content()) , 375 ); } ?>
												<div class="view-chalet">
												<a href="<?php the_permalink();?>"><?php _e("View Chalet","treeline"); ?></a>
												<?php
												$bookurl = get_permalink();
												$bookurl.="#booking";
												?>
												<a href="javascript:;" onclick="javascript:window.location.href='<?php echo $bookurl; ?>';"><?php _e("Book Now","treeline"); ?></a>
												</div>
											</div>
										</div>
									</div>
								</div>
						   
							<?php
							$counter++;
							} 
							wp_reset_query();
							
								?>
							
								
						   
							<?php
							
						}
						else{ ?>
							<h5 style="text-align:center;">Please contact us for suggestions using the form below.</h5>
						<?php }  } else { ?>
							<h5 style="text-align:center;">Please contact us for suggestions using the form below.</h5>
						<?php } ?>
				</div>
			</section>
			<?php } ?>
		<?php  endwhile; ?>
	<?php endif; ?>
    
</section>



<?php $add_images_sider_images = get_field( 'add_images_sider' ); ?>
<?php if ( $add_images_sider_images ) :  ?>
<section class="food-gallery">
	<div id="foodgalleryslider" class="owl-carousel owl-theme" >
	<?php 
								/*echo "<pre>";
								print_r($add_images_sider_images);exit;*/
								foreach ( $add_images_sider_images as $add_images_sider_image ): ?>
        <div class="item">
			<a href="<?php echo $add_images_sider_image['url']; ?>" data-fancybox="group">
				<img src="<?php echo $add_images_sider_image['sizes']['tree-page-slide-thumb']; ?>" alt="<?php echo $add_images_sider_image['alt']; ?>" title="">
			</a>
		</div>
     <?php endforeach; ?> 
    </div>
</section>
<?php endif; ?>
<section class="hm-two parallax">
	<div class="wrapper">
    	<div class="sbscribe-box">
        	<div class="sb-left">
	            <h3><?php the_field( 'sign_title', 'option' ); ?></h3>
                <?php the_field( 'sign_up_content', 'option' ); ?>
            </div>
            <div class="sb-right">
            	<?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
            </div>
        </div>
    </div>
</section>   
</div>					
<?php
get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/fancy-box/jquery.fancybox.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/masonry.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(function(){
                //if(!Modernizr.inputtypes.date) {
                    console.log("The 'date' input type is not supported, so using JQueryUI datepicker instead.");
                    $("#start_date").datepicker();
                //}
            });
$(document).load($(window).bind("resize", checkPosition));

function checkPosition()
{
		if($(window).width() > 767)
		{
                		var time = undefined;
				
				//init
				$('.msrItems').msrItems({
					'colums': 2, //columns number
					'margin': 0, //right and bottom margin
					'animationOptions': {
						  duration: 700,
						  easing: 'linear',
						  queue: false
					 }
				});
		
				//update columns size on window resize
				$( window ).on('resize', function(e) {
					clearTimeout(time);
					time = setTimeout(function(){
						$('.msrItems').msrItems('refresh');
					}, 200);
				})
		
			
    } else {
	//location.reload();  // refresh page
    //return false;  
	                		var time = undefined;
				
				//init
				$('.msrItems').msrItems({
					'colums':1, //columns number
					'margin': 0, //right and bottom margin
					'animationOptions': {
						  duration: 700,
						  easing: 'linear',
						  queue: false
					 }
				});
		
				//update columns size on window resize
				$( window ).on('resize', function(e) {
					clearTimeout(time);
					time = setTimeout(function(){
						$('.msrItems').msrItems('refresh');
					}, 200);
				})  
    }
}
//$( document ).ready(function() {
//			 setTimeout(function(){
//						$(window).trigger('resize');
//						//$('.msrItems').msrItems('refresh');
//					}, 4000);
//			 
//    
//});
</script>	