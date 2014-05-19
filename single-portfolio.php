<?php
	//Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;

	$template_uri = get_template_directory_uri();

	//Page Options
		$pageoptions = getOptions();	

	//Theme Options	
		$themeoptions = getThemeOptions(); 

	//Page Head Area
		if(isset($pageoptions['tb_webpaint_activate_page_title'])){ 
			$headline = false;
		} 
		else {
			$headline = true;
		}
		
		if(isset($_GET["fp"])) $parent = $_GET["fp"];
		else $parent = "";

	get_header();
?>

	<?php if (!empty($pageoptions["tb_webpaint_header_slider"])){?>
	<!-- Begin Revolution Slider -->
		   <div class="bannercontainer">
			   <?php echo do_shortcode('[rev_slider '.$pageoptions["tb_webpaint_header_slider"].']'); ?>
		   </div>
	<!-- End Revolution Slider -->
	<?php } ?>

  <!-- Begin Light Wrapper -->
  <div class="light-wrapper"> 
    <!-- Begin Inner -->
    <div class="inner">
  <?php if($headline){ ?>
  			<h1 class="aligncenter"><?php the_title(); ?></h1>
  			<?php if(!empty($pageoptions["tb_webpaint_page_intro"])){ ?>	
					<p class="description aligncenter"><?php echo do_shortcode($pageoptions["tb_webpaint_page_intro"]); ?></p>
			<?php } ?>
			<br />
  <?php } ?>
     
		<?php if(isset($pageoptions["tb_webpaint_sidebar"]) && $pageoptions["tb_webpaint_sidebar"]!="nosidebar"){ 
		?>
			 <section class="content">
		<?php }//Sidebar ?>
	<!-- Content -->	
		<?php if(have_posts()) : 
		    	while(have_posts()) : the_post();	
		    		the_content();	
		    	endwhile;  //have_posts 
		    	
		   endif;?>   
		   <div class="clear"></div>
	
	<!-- Related Posts -->
		<?php	if(isset($_GET["fp"])){
					$categories = getOptions($_GET["fp"]);
					if(!isset($categories["tb_webpaint_activate_related_posts"])) :
							$categories["tb_webpaint_portfolio_categories"] = !is_array($categories["tb_webpaint_portfolio_categories"]) || in_array("all", $categories["tb_webpaint_portfolio_categories"]) ? "" : implode(",", $categories["tb_webpaint_portfolio_categories"]) ;
				   			$args=array(
									'post_type' => get_post_type( $post_id),
									'post__not_in' => array($post_id),
									'showposts'=> 4, 
									'ignore_sticky_posts'=>1,
									'category_portfolio' => $categories["tb_webpaint_portfolio_categories"]
									
							);
							$temp = $wp_query; 
							$my_query = new wp_query($args);
							if( $my_query->have_posts() ) {						
							?>
							 <hr />
						      <h3><?php _e("Related Posts","tb_webpaint");?></h3>
						      <div class="grid-wrapper">
						        <div class="related-portfolio">
						          <ul class="items col4">
									<?php
										while ($my_query->have_posts()) {
											$my_query->the_post();
											
											unset($category_names);
											unset($category_slugs);
											unset($tag_names);
											
											$tag_names = array();
											$category_slugs = array();
											$category_names = array();
											
											foreach(wp_get_post_terms($post->ID, 'category_portfolio') as $category) {
												$category_slugs[] = $category->slug;
												$category_names[] = $category->name;
											}
											
											$tags = wp_get_post_tags($post->ID);
											$count = 0;
											foreach($tags as $tag){
												if($count < 4) $tag_names[] = $tag->name;
												$count++;
											}
											$subline = isset($atts["subline"]) && $atts["subline"]=="categories" ? implode(", ", $category_names) : implode(", ", $tag_names);
											
											$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),270,220,true);
									?>
										
										<?php if(!empty($blogimageurl)){
													//Permalink addition for Portfolio Backlink
													$permalink = get_permalink();
													if(!empty($parent)){
														$link  = strpos($permalink,"?") ? $permalink."&amp;fp=".$parent : $permalink."?fp=".$parent;
													} else {
														$link = $permalink;
													}
											
										?>	
								          	<li class="item web"> <a href="<?php echo $link; ?>">
								              <div class="overlay">
								                <h3><?php the_title(); ?></h3>
								                <span class="meta"><?php echo $subline; ?></span> </div>
								              <img src="<?php echo $blogimageurl;?>" alt="" /></a> 
								             </li>
								          <?php } ?>
								        <?php
										}
											$wp_query = null; 
											$wp_query = $temp;
											wp_reset_query();
										?>
									</ul>
								</div>
							</div>
								<!-- End Related Posts -->
								<?php } //if have_posts()
				endif; } //if related posts		
		?>
	
	<!-- Portfolio Navigation -->	   
		<hr />
		   <div class="navigation"> 
		   		 <?php 
					if(!empty($parent)){?>
						<a href="<?php echo get_permalink($parent);?>" title="<?php _e("All Items","tb_webpaint"); ?>" class="button back"><?php _e("Back to Portfolio","tb_webpaint"); ?></a> 
					<?php
						$excluded_categories = get_excluded_portfolio_categories($parent);
				
						$next_post = get_adjacent_portfolio_post( false, $excluded_categories,false );
						if($next_post) : 
							$next_id = $next_post->ID;
							$next_title = $next_post->post_title;
							$next_link = get_permalink($next_id);
							$next_link = strpos($next_link,"?") ? $next_link."&fp=".$parent : $next_link."?fp=".$parent;
							echo '<a href="'.$next_link.'" title="'.$next_title.'" class="button next-post">'.__("Next Post","tb_webpaint").'</a>';
						endif; 
						
						$prev_post = get_adjacent_portfolio_post( false, $excluded_categories ,true );
						if($prev_post) : 
							$prev_id = $prev_post->ID;
							$prev_title = $prev_post->post_title;
							$prev_link = get_permalink($prev_id);
							$prev_link = strpos($prev_link,"?") ? $prev_link."&fp=".$parent : $prev_link."?fp=".$parent;
							echo '<a href="'.$prev_link.'" title="'.$prev_title.'" class="button prev-post">'.__("Previous Post","tb_webpaint").'</a>';
						endif; 
				}?>
	       		<div class="clear"></div>
	      </div>

		<?php if(isset($pageoptions["tb_webpaint_sidebar"]) && $pageoptions["tb_webpaint_sidebar"]!="nosidebar"):?>
			 </section>
			<aside class="sidebar">
		    <!-- Begin Sidebar --> 
		    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($pageoptions["tb_webpaint_sidebar"]) ) : ?>
				    <div class="sidebox">
				      <h3>Sidebar Widget</h3>
				      Please configure this Widget Area in the Admin Panel under Appearance -> Widgets
				    </div>
			<?php endif; ?>
			</div>
		    <div class="clear"></div>
		    <!-- End Sidebar --> 
			 </aside>
		<?php endif; //Sidebar ?>	 
      <div class="clear"></div>
    </div>
    <!-- End Inner --> 
  </div>
  <!-- End Light Wrapper --> 
  <?php get_footer(); ?>