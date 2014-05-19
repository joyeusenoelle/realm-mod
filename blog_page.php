<?php
/**
 * Template Name: Blog Page
 *
 * @author Designova (designova.net)
 * @theme Realm
*/
 get_header();	
 $options = get_option('realm');
?>
<div class="clear"></div>

<div class="page page-section">
  <section class="container-fluid">
    <div class="row-fluid">
      <div class="container add-top">
        <div class="row ">
          <div class="span8 blog-list">
            <?php 

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts(array('post_type' => 'post', 'paged' => 1));
                    
            if ( have_posts() ) while ( have_posts() ) : the_post(); 
            	$embed_code = get_post_meta($post->ID,'post_embed_code',true);
              $embed_code = str_replace("&rsquo;","'",$embed_code);
              $embed_code = str_replace("&quot;",'"',$embed_code);

              $post_feature_content = '';

              if(get_post_type( get_the_ID()) == 'post')
                {
                  $format = get_post_format();            
                  switch($format)
                  {
                    case 'audio':
                     $post_icon = get_stylesheet_directory_uri().'/images/post_format/audio.png';
                     $post_feature_content = $embed_code;
                    break;
                    case 'video':
                     $post_icon = get_stylesheet_directory_uri().'/images/post_format/video.png';
                     $post_feature_content = $embed_code;
                    break;  
                    case 'image':
                     $post_icon = get_stylesheet_directory_uri().'/images/post_format/image.png';
                     if(get_post_meta($post->ID,'post_slides',true) != null)
                     {
                     $post_feature_content = ' <div id="slide_item'.$post->ID.'" class="carousel slide">
                          <div class="carousel-inner">';
                            
                            $first_slide = true;
                            $post_slides = get_post_meta($post->ID,'post_slides',true);
                            foreach($post_slides as $post_slide)
                            {
                              if($first_slide == true)
                                $item_active = 'active';
                              else
                                $item_active = '';

                              $post_feature_content .= '<div class="item '.$item_active.'">
                                <img src="'.$post_slide.'" alt="'.get_the_title().'" title="'.get_the_title().'" />
                              </div>';
                              
                              $first_slide = false;
                            }
                            
                          $post_feature_content .='</div>
                          <a class="left carousel-control" href="#slide_item'.$post->ID.'" data-slide="prev"><img src="'.get_template_directory_uri() .'/images/carousel/left.png"/></a>
                          <a class="right carousel-control" href="#slide_item'.$post->ID.'" data-slide="next"><img src="'.get_template_directory_uri() .'/images/carousel/right.png"/></a>
                        </div>';
                     }
                    break;  
                    case 'link':
                     $post_icon = get_stylesheet_directory_uri().'/images/post_format/link.png';
                     $post_feature_content = '<a href="'.get_post_meta($post->ID,'post_ext_url',true).'" target="_blank"><div class="post-type-link">Link: '.get_post_meta($post->ID,'post_ext_url',true).'</div></a>';
                    break;   
                    case 'quote':
                     $post_icon = get_stylesheet_directory_uri().'/images/post_format/quote.png';
                     $post_feature_content = '<div class="post-type-quote">'.get_post_meta($post->ID,'post_quote',true).'</div>';
                    break; 
                    default:
                     $post_icon = get_stylesheet_directory_uri().'/images/post_format/default.png';
                     if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
                       $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', true, '' );
                       $post_feature_content = '<a href="'.$src[0].'" data-gal="prettyPhoto[gallery]" class="blog-featured-img"><img src="'.$src[0].'" alt="'.get_the_title().'"/></a>';
                     }
                    break;                                                      
                  }
              } 

            ?>
            <article class="blog-post">
              <div class="row-fluid">
                <div class="span12">
                  <?php 
                  if ($post_feature_content != '') 
                  {
                  ?>
                    <div class="featured-image"> 
                      <?php echo $post_feature_content; ?>
                    </div>
                    <div class="clear"></div>
                  <?php
                  }
                  ?>
                  
                  <div class="realm-section-heading"><?php echo get_the_title();?></div>
                  <article class="featured_attr"><?php if(is_sticky()){ ?><img src="<?php echo get_stylesheet_directory_uri().'/images/post_format/sticky.png'; ?>" alt="<?php echo get_bloginfo('name'); ?>" /><?php } ?><img src="<?php echo $post_icon; ?>" alt="<?php echo get_bloginfo('name'); ?>" />  <?php _e('By, ','realmlang'); the_author(); _e(' on ','realmlang'); the_time('F j, Y');?> / <?php the_category(', '); ?></article>
                </div>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="inner-page-content"><?php  echo realm_clean(the_excerpt(), 75); ?></div>
                  <div class="clear"></div>
                  <div class="news-main-learn-more"><a class="button realm-button" href="<?php the_permalink(); ?>"><h4><?php _e('Learn More', 'realmlang'); ?></h4></a></div>
                </div>
              </div>
            </article>
            <div class="clear"></div>
            <?php 
        		  endwhile; 
              wp_reset_query();
            ?>
            <div class="clear"></div>
            <?php getpagenavi(); ?>
          </div>
          <div class="span4 sidebar">
            <?php get_sidebar();?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php
  get_footer();
?>