<?php
/*
Template Name: Portfolio Showcase
*/
	get_header();
	$options = get_option('realm');
	$pageoptions = getOptions();	
	$categories = empty($pageoptions["tb_webpaint_portfolio_categories"]) ? "" : implode(",", $pageoptions["tb_webpaint_portfolio_categories"]);
?>
	<div class="clear"></div>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
	$content = get_the_content();
    ?>
    <div class="page page-section">
      <section class="container-fluid page-bg-img ">
        <div class="row-fluid">
          <section class="container ">
            <div class="row">
                <div class="page-style span4">
                  <h3><?php echo get_the_title();?></h3>
                  <div class="about-style-img">
                  	<?php 
                  	if(has_post_thumbnail(get_the_ID()))
                  	{
                  		$page_icon = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
                  		echo '<img src="'.$page_icon[0].'" alt="'.get_the_title().'" />';
                  	}
    					
                  	?>
                    
                  </div>
                </div>
                <div class="page-style-details span8">
                  <h3><?php echo get_post_meta(get_the_ID(), 'page_promo_heading',true);?></h3>
                  <h5><?php echo get_post_meta(get_the_ID(), 'page_promo_subheading',true);?></h5>
                  <p><?php echo get_post_meta(get_the_ID(), 'page_promo_text',true);?></p>
                </div>
            </div>     
          </section>
        </div>
      </section>
      <section class="container-fluid">
        <div class="row-fluid">
          <div class="container">
            <div class="row">
              <div class="span12">
                
                <div class="inner-page-content">
                			<?php if($pageoptions["tb_webpaint_portfolio_content_display"] == "above") echo do_shortcode($content);
							echo do_shortcode("[showcase number=99 cat_slugs='$categories']"); 
							if($pageoptions["tb_webpaint_portfolio_content_display"] == "below") echo do_shortcode($content); ?>

				</div>
                
                <div class="clear"></div>
                
                <div class="post_footer">
                    <?php comments_template( '', true ); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <div class="clear"></div>
    <?php endwhile; // end of the loop. ?>

<?php
  get_footer();
?>