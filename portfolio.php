<?php
/**
 * Template Name: Portfolio Page
 *
 * @author Designova (designova.net)
 * @theme Realm
*/
	get_header();	
	$options = get_option('realm');

	$port_categories = get_categories(array('type' => 'portfolio_item', 'taxonomy' => 'portfolio_category'));

	if(has_post_thumbnail($pag->ID)) 
    	$page_icon = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
	else
		$page_icon[0] = '';
	$page_promo_heading =  get_post_meta(get_the_ID(),'page_promo_heading',true);
	$page_promo_subheading =  get_post_meta(get_the_ID(),'page_promo_subheading',true);
	$page_promo_text =  get_post_meta(get_the_ID(),'page_promo_text',true);
?>


<div class="page page-section">
	<section class="container-fluid page-bg-img ">
	  <div class="row-fluid">
	    <section class="container ">
	      <div class="row">
	          <div class="page-style span4">
	            <h3><?php echo get_the_title();?></h3>
	            <div class="about-style-img">
	              <img src="<?php echo $page_icon[0];?>" alt="<?php echo $page_heading;?>">
	            </div>
	          </div>
	          <div class="page-style-details span8">
	            <h3><?php echo $page_promo_heading; ?></h3>
	            <h5><?php echo $page_promo_subheading; ?></h5>
	            <p><?php echo $page_promo_text; ?></p>
	          </div>
	      </div>     
	    </section>
	  </div>
	</section>
	<section class="container-fluid">
	  <div class="row-fluid bg-white">
	    <section class="container">
	      <div class="row custom-portfolio-padding"><!-- Isotope starts -->

	        <article class="span12">
	          <section id="options" class="clearfix">
	              <ul id="filters" class="option-set clearfix" data-option-key="filter">
	                <li class="inner-link"><a href="#filter" data-option-value="*" class="selected ">all</a></li>
	                <?php                      
	                 foreach($port_categories as $port_category): 
	                    $categoryClass = strtolower($port_category->slug);
	                    echo '<li class="inner-link"><a href="#filter" data-option-value=".'.$categoryClass.'">'.$port_category->name.'</a></li>';      
	                 endforeach;
	                ?>
	              </ul>
	          </section> <!-- #options -->
	          <div id="container" class="clearfix portfolio">
	            <?php 

	              //Get Portfolio loop
	              $html = '';
	              $item_count = 1;
	              $loop = new WP_Query( array( 'post_type' => 'portfolio_item', 'orderby' => 'date', 'order' => 'DESC', 'paged'=> false, 'posts_per_page' => '-1' ) );

	              while ( $loop->have_posts() ) : $loop->the_post();
	              $item_categories = wp_get_post_terms($post->ID, $taxonomy = 'portfolio_category');
	              $prjt_categories = '';
	              foreach ($item_categories as $prjt_cat) {
	                $prjt_categories = $prjt_categories.' '.strtolower($prjt_cat->slug);
	              }
	              $project_caption = get_post_meta($post->ID,'project_caption',true);
	              $project_url = get_post_meta($post->ID,'project_url',true);
	              $project_thumb_size = get_post_meta($post->ID,'project_thumb_size',true);

	              if($project_thumb_size == '1xsquare')
	                $height_class = 'height-01';
	              elseif($project_thumb_size == '2xsquare')
	                $height_class = 'height-03';
	              elseif($project_thumb_size == 'vert_rect')
	                $height_class = 'height-02';
	              elseif($project_thumb_size == 'hor_rect')
	                $height_class = 'height-04';
	            ?>
	            <div>
	              <div class="element <?php  echo $prjt_categories .' '. $height_class; ?>" data-symbol="Hg" data-category="web">
	                  <div class="element-image <?php echo $height_class; ?>">
	                    <?php 
	                      if(has_post_thumbnail()): 
	                        $thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true, '' );
	                        echo '<img src="'.$thumb_src[0].'" class="portfolio-thumb" alt="'.get_the_title().'"/>';
	                      else: 
	                         echo '<img src="'.get_stylesheet_directory_uri().'/images/portfolio/default-featured-image.png" class="portfolio-thumb" alt="'.get_the_title().'"/>';
	                      endif;
	                    ?>
	                  </div>
	                  <div class="portfolio-visibility">
	                    <div class="element-text">
	                      <h2><?php echo the_title(); ?></h2>
	                      <h3><?php echo $project_caption; ?></h3>
	                    </div>
	                    <div class="element-anchor">
	                      <a class="gallery-block" href="<?php
	                      //Get the Thumbnail URL
	                      $src         = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true, '' );
	                      $alternative = get_post_meta($post->ID,'expansion_image',true);
	                      if(!$alternative):
	                      echo $src[0];
	                      else:
	                      echo $alternative;
	                      endif;
	                      ?>" data-gal="prettyPhoto[portfolio]">
	                        <img class="anchor-image" src="<?php echo get_stylesheet_directory_uri();?>/images/zoom1.png" alt="<?php echo get_the_title(); ?>">
	                      </a>
	                      <?php
	                      if($project_url != null && $project_url != '')
	                      {
	                      ?>
	                        <a href="<?php echo $project_url; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri();?>/images/zoom2.png" alt="<?php echo get_the_title(); ?>"></a>
	                      <?php
	                      }
	                      ?>
	                    </div>
	                  </div>
	              </div>
	            </div>
	            <?php
	              $item_count++;
	              endwhile;

	              wp_reset_query();
	            ?>
	          </div>
	        </article>
	      </div>
	    </section>
	  </div>
	</section>
	</div>

	<div class="clear"></div> 


<?php
get_footer();
?>