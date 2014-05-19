<?php
/**
 * Template Name: Single Page Layout
 *
 * @author Designova (designova.net)
 * @theme Realm
*/
	get_header();
?>

<?php

  
  $options = get_option('realm');
  $count = 0; 
  $countPages = wp_count_posts('page')->publish;
  $pages = get_pages( 'sort_order=asc&sort_column=menu_order');
//Count published pages
foreach($pages as $pag):

  setup_postdata($pag);
 
  //Anchor point and title
  $newanchorpoint = strtolower(preg_replace('/\s+/', '-', $pag->post_name)); 
  $new_title      = $newanchorpoint;
  $templ_name     = get_post_meta( $pag->ID, '_wp_page_template', true );
  $filename       = preg_replace('"\.php$"', '', $templ_name); 

  //Check wether to include in one page
  $include_onepage =  get_post_meta($pag->ID,'one_page',true);

  if(has_post_thumbnail($pag->ID)) 
    $page_icon = wp_get_attachment_image_src( get_post_thumbnail_id($pag->ID), 'full');
  else
    $page_icon[0] = '';


  $page_heading      =  $pag->post_title;
  $page_promo_heading =  get_post_meta($pag->ID,'page_promo_heading',true);
  $page_promo_subheading =  get_post_meta($pag->ID,'page_promo_subheading',true);
  $page_promo_text =  get_post_meta($pag->ID,'page_promo_text',true);
  $parallax_bg =  get_post_meta($pag->ID,'parallax_bg',true);
  
  
  

  if($filename == 'the-onepage' AND $include_onepage == 'yes')
  {

  }
  elseif($filename == 'splash-page' AND $include_onepage == 'yes')
  {
  ?>  

    <div id="<?php echo $new_title; ?>" class="page page-section spalsh-page">
      <section class="container-fluid">
        <div class="row-fluid">
              <?php
              
                if(!isset($options['spalshpagecontent']))
                {
              ?>
              <article class="span12">
                <div class="realm-heading">
                  
                  <div class="">
                    <h1><?php echo $options['home_page_title']; ?></h1>
                    <h2><span><?php echo $options['home_page_subheading']; ?></span></h2>
                  </div>
                </div>
              </article>
              <?php
                }
                else
                {
                ?>
                <article class="container home-page-view-port">
                  <?php
                    echo do_shortcode($options['splash_page_mega_content']);
                  ?>
                </article>
                <?php
                }
              ?>
        </div>
      </section> 
    </div> 

  <?php
  }
  elseif($filename == 'portfolio_showcase' AND $include_onepage == 'yes')
  {
    $port_categories = get_categories(array('type' => 'portfolio', 'taxonomy' => 'portfolio_category'));
	$pageoptions = getOptions($pag->ID);	
	$categories = empty($pageoptions["tb_webpaint_portfolio_categories"]) ? "" : implode(",", $pageoptions["tb_webpaint_portfolio_categories"]);
  ?>
  <div id="<?php echo $new_title; ?>" class="page page-section">
    <section class="container-fluid page-bg-img ">
      <div class="row-fluid">
        <section class="container ">
          <div class="row">
              <div class="page-style span4">
                <h3><?php echo $page_heading;?></h3>
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
    <section class="container-fluid" style="padding-top: 5px;">
		<?
		//global $post;
		$atts['number'] = 99; //isset($atts['number']) ? $atts['number'] : 4; 
		$atts['cat_slugs'] = isset($categories) ? $categories : ''; //isset($atts['cat_slugs']) ? $atts['cat_slugs'] : '';
		$select_slugs = $atts['cat_slugs'];
		$post_id = $pag->ID;
		
		$html = '<div class="portfolio-wrapper showcase">';
		
		$html .='
			<ul class="filter">';
		
		$atts['cat_slugs'] = explode(",", $atts['cat_slugs']);
	
		if (empty($select_slugs) || in_array("all", $atts['cat_slugs']) ){
			$html .= '<li><a class="active" href="#" data-filter="*">'.__("All","tb_webpaint").'</a></li>';
			$tax_terms = get_terms("category_portfolio");
			foreach($tax_terms as $tax_term){	
				$html .= '<li><a href="#" data-filter=".'.$tax_term->slug.'">'.$tax_term->name.'</a></li>';
			}
		} elseif(sizeof($atts['cat_slugs'])>1){
				$html .= '<li><a class="active" href="#" data-filter="*">'.__("All","tb_webpaint").'</a></li>';
				foreach($atts['cat_slugs'] as $category){
					$term = get_term_by('slug',$category,'category_portfolio');
					$html .= '<li><a href="#" data-filter=".'.$category.'">'.$term->name.'</a></li>';
				}
			} 
		
		$html .= '</ul><ul class="items col4" style="width: 100%; padding-left: 15px;">';
	
		$select_slugs = in_array("all", $atts['cat_slugs']) ? '' : $select_slugs ;
	
		$args = array( 'posts_per_page' => $atts['number'], 
			   'offset'=> 0,
			   'post_type' => 'portfolio',
			   'category_portfolio' => $select_slugs
		);
		$all_posts = new WP_Query($args);
	
		while($all_posts->have_posts()) : $all_posts->the_post();
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
			
			//Permalink addition for Portfolio Backlink
			$permalink = get_permalink();
			if(empty($atts["type"]) || $atts["type"]=="slider" ){
				$link = "#";
				$permalink = strpos($permalink,"?") ? $permalink."&amp;fp=".$post_id : $permalink."?fp=".$post_id;
			} else {
				$permalink = strpos($permalink,"?") ? $permalink."&amp;tp=".$post_id : $permalink."?tp=".$post_id;
				$link = $permalink;
			}
			$subline = isset($atts["subline"]) && $atts["subline"]=="categories" ? implode(", ", $category_names) : implode(", ", $tag_names);
			
			$html .= '<!-- Begin 1st Portfolio Item -->
	  <li class="item '.implode(" ", $category_slugs).'" data-callback="callPortfolioScripts();"
			  data-detailcontent=\''.str_replace("'","\"",do_shortcode(mycustom_wpcf7_form_elements(wpautop(get_the_content())))).'<div class="clear"></div>\'
		  > <a href="#">
		<div class="overlay">
		  <h3>'.get_the_title().'</h3>
		  <span class="meta">'.$subline.'</span> </div>
		<img src="' . aq_resize(wp_get_attachment_url( get_post_thumbnail_id() ),270,220,true) . '" alt="" /></a> </li>';
		endwhile;
	
		$html .= '  </ul></div>';
		if(empty($atts["type"]) || $atts["type"]=="slider" )
			$html .= '<script>
					jQuery(document).ready(function() {
						var contentslideron=true;
						jQuery("body").addClass("useportfolioslider");
				});
			</script>';
		echo $html;
		?>
    </section>
  </div>
    
  <div class="clear"></div>  
  <?php  
  }
  elseif($filename == 'intermediate_page' AND $include_onepage == 'yes')
  {
  ?>
    <div id="<?php echo $new_title; ?>" class="">
      <section class="container-fluid">
        <div class="row-fluid" >
          <div style="background:  url('<?php echo $parallax_bg;?>') repeat; background-size:100%;" data-stellar-background-ratio=".5" >
            <div class="intermediate-page">
              <section class="container">
                <div class="row">
                  <article class="span12">
                    <?php the_content();?>
                  </article>
                </div>
              </section>
            </div>
          </div><!-- row-fuild : ends -->   
        </div>  
      </section> <!-- container-fluid : ends-->
    </div> 
  <?php
  }
  elseif($filename == 'blog_page' AND $include_onepage == 'yes')
  {
  ?>
    <div id="<?php echo $new_title; ?>" class="page page-section">
      <section class="container-fluid page-bg-img ">
        <div class="row-fluid">
          <section class="container ">
            <div class="row">
                <div class="page-style span4">
                  <h3><?php echo $page_heading;?></h3>
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
        <div class="row-fluid">
          <div class="container">
            <div class="row add-top add-bottom">
              <div class="span12">
                <div class="row news-main-space">

                  <article class="span6">
                    <div id="news-main-banner">
                      <div class="news-main-details">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/images/news/01.jpg" alt="trial">
                      </div>
                    </div>
                  </article>

                  <article class="span6"> 
                    <div>
                      <div  class="news-main-details">
                        <h1> Demo Title.</h1>
                        <h3><?php _e('','realmlang'); ?> <span class="posted-date"> </span> / <span class="post-categories"></span></h3>
                        <p>Content</p>
                        <div class="news-main-learn-more"><a class="button realm-button" href="#"><h4><?php _e('Learn More', 'realmlang'); ?></h4></a></div>
                      </div>
                    </div>
                  </article>
                    
                </div>  
                <div class="row">
                  <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    query_posts(array('post_type' => 'post', 'paged' => $paged));
                    $post_count = 0;
                    if (have_posts()) : 
                      while (have_posts()) : the_post();
                        $post_count++;
                        if ($post_count < 5) {
                          
                  ?>
                  <article class="span3">
                    <div class="news-img-section">
                      <div class="imgs img1">
                        <a href="#news-main-banner" class="news-scroll-link"  data-title="<?php the_title(); ?>" data-news-date="<?php the_time('M j, Y'); ?>" data-category=""  data-permalink="<?php the_permalink(); ?>">
                          <?php 
                          if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) 
                          {
                            the_post_thumbnail('blog_thumb', array("class" => "post_thumbnail"));
                          } 
                          ?>
                          <div class="blog-attr">
                            <h4><?php the_title(); ?></h4>
                            <p> <?php _e('Posted on ','realmlang'); the_time('M j, Y');?></p>
                          </div>
                          <div class="hidden blog-post-dummy-content"><?php  echo realm_clean(get_the_content(), 578); ?></div>
                        </a>
                        <div class="dummy-post-categories hidden"><?php the_category(', '); ?></div>
                      </div>
                    </div>
                  </article>
                  <?php 
                         }
                      endwhile; 
                    endif; 
                    wp_reset_query();
                  ?>
                </div><!-- row-fluid : ends -->
                
                <div class="row">

                  <article class="span12">
                    <div class="news-more">
                      <a href="?s="><span class="news-more-text"><?php _e('View more articles', 'realmlang'); ?></span> <span class="news-more-img"><img src="<?php echo get_stylesheet_directory_uri();?>/images/common/more_articles.png" alt="Realm"></span></a>
                    </div>  
                  </article>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <div class="clear"></div>
  <?php   
  }
  elseif($filename == 'contact_page' AND $include_onepage == 'yes' )
  {
     
  ?>
    
    
    <div id="<?php echo $new_title; ?>" class="page page-section">
      <section class="container-fluid page-bg-img ">
        <div class="row-fluid">
          <section class="container ">
            <div class="row">
                <div class="page-style span4">
                  <h3><?php echo $page_heading;?></h3>
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
        <div class="row-fluid contact-padding-top">
          <section class="container">
            <div class="row">

              <article class= "span10 offset1">
                <div class="">
                  <p class="text-center contact-main"><?php echo $options['address_heading'];?></p>
                </div>
              </article>

            </div>
          </section>
        </div>
      </section>

      <section class="container-fluid">
        <div class="row-fluid contact-bgcolor-highlight">
          <section class="container">
            <div class="row">

              <article class="span12">
                <div class="contact-address"><p><?php echo $options['address'];?></p></div>
              </article>

            </div>
          </section>
        </div>
      </section>  
      <section class="container-fluid">
        <div class="row-fluid contact-padding-bottom">
          <section class="container">
            <div class="row">

              <article class="span12">
                <div class="contact-social-link">
                  <ul>
                    <?php 
            if($options['realm_email'] != '') 
                    {
                    ?>
                    <a href="mailto:<?php echo $options['realm_email']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/01.png"/></a>
                    <?php 
                    }
                    if($options['realm_twitter'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_twitter']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/03.png"/></a>
                    <?php 
                    }
                    if($options['realm_dribble'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_dribble']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/04.png"/></a>
                    <?php 
                    }
                    if($options['realm_facebook'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_facebook']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/FB.png"/></a>
                    <?php 
                    }
                    if($options['realm_gplus'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_gplus']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/google.png"/></a>
                    <?php 
                    }
                    if($options['realm_linkedin'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_linkedin']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/link.png"/></a>
                    <?php 
                    }
                    if($options['realm_pintrest'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_pintrest']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/pinterest.png"/></a>
                    <?php 
                    }
                    if($options['realm_behance'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_behance']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/Be.png"/></a>
                    <?php 
                    }
                    if($options['realm_github'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_github']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/github.png"/></a>
                    <?php 
                    }
                    if($options['realm_flickr'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_flickr']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/flickr.png"/></a>
                    <?php 
                    }
                    if($options['realm_tumblr'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_tumblr']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/tumblr.png"/></a>
                    <?php 
                    }
                    if($options['realm_soundcloud'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_soundcloud']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/soundcloud.png"/></a>
                    <?php 
                    }
                    if($options['realm_instagram'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_instagram']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/instagram.png"/></a>
                    <?php 
                    }
                    if($options['realm_vimeo'] != '') 
                    {
                    ?>
                    <a href="<?php echo $options['realm_vimeo']; ?>" target="_blank"><img alt="<?php echo get_bloginfo('name'); ?>"  src="<?php echo get_stylesheet_directory_uri();?>/images/contact/vimeo.png"/></a>
                    <?php 
                    }
                    ?>
                  </ul>
                </div>
              </article><!-- // End of .span12-->
            </div><!-- // End of .row -->

            <div class="row">
              <article class="offset4 span4 text-center">
                  <div id="fname"  class="alert alert-error error">
                  <?php _e('Name must not be empty.','realmlang');?>
                  </div>
                  <div id="fmail" class="alert alert-error  error add-top">
                  <?php _e('Please provide a valid email.','realmlang');?>
                  </div>
                  <div id="fmsg" class="alert alert-error  error add-top">
                  <?php _e('Message should not be empty.','realmlang');?>
                  </div>
                  <div id="infomsg" class="alert alert-error  error add-top hidden"><?php _e('Sorry! Something went wrong!','realmlang');?></div>
              </article>
            </div>

            <div class="row ">
              <form name="myform" id="contactForm" action="<?php echo get_stylesheet_directory_uri();?>/sendmail.php" enctype="multipart/form-data" method="post">  

                <div class="row">
                  <article class="offset4 span4">
                      <input class="cnt-input" size="100" type="text" name="name" id="name" placeholder="<?php echo $options['name_placeholder']; ?>">
                      <input class="cnt-input" type="text"  size="30" id="email" name="email" placeholder="<?php echo $options['email_placeholder']; ?>">

                      <input type="hidden" name="receiver" id="receiver" value="<?php echo $options['contact_email']; ?>" />
                      <input type="hidden" id="subject" name="subject" value="Contact form submission from <?php echo get_bloginfo('name'); ?>"/>
                      <input type="text" name="website_url" id="website_url" class="contact_web_url" value=""/>
                  </article>
                </div>   

                <div class="row">
                  <article class="offset4 span4 btn-realm-alt">
                    <div>
                      <textarea id="msg" rows="3" cols="40" name="message" class="" placeholder="<?php echo $options['message_placeholder']; ?>"></textarea>
                    </div>
                  </article>
                </div>  
                <div class="row">
                    <article class="offset4 span4 btn-realm-alt">
                        <div class="contact-style">
                          <a href="#" class="realm-contact-button realm-button"><?php echo $options['submit_btn_txt']; ?></a>
                          <input type="submit" value="send" class="hidden" id="realm-contact-button-dummy"/>
                        </div>  
                    </article>
                </div>
              </form>
            </div>
          </section><!-- // End of .container -->   
        </div><!-- // End of .row-fluid -->
      </section><!-- // End of .container-fluid -->
    </div>
    
    <div class="clear"></div>
    
  <?php
  }
  elseif($include_onepage == 'yes' )
  {
     
  ?>
    
    
    <div id="<?php echo $new_title; ?>" class="page page-section">
      <section class="container-fluid page-bg-img ">
        <div class="row-fluid">
          <section class="container ">
            <div class="row">
                <div class="page-style span4">
                  <h3><?php echo $page_heading;?></h3>
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
        <div class="row-fluid">
          <div class="container">
            <div class="row">
              <div class="span12">
                <?php the_content();?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <div class="clear"></div>
    
  <?php
  }
  

endforeach;

  get_footer();
?>