<?php
/**
 * Template Name: Contact Page
 *
 * @author Designova (designova.net)
 * @theme Realm
*/
	get_header();	
	$options = get_option('realm');

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
get_footer();
?>