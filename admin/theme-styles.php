<?php
function realm_styles() 
{
  wp_enqueue_style("bootstrap", get_stylesheet_directory_uri(). "/assets/css/bootstrap.css");
  wp_enqueue_style("bootstrap-responsive", get_stylesheet_directory_uri(). "/assets/css/bootstrap-responsive.css");
  wp_enqueue_style("typography",get_stylesheet_directory_uri()."/assets/css/typography.css");
  wp_enqueue_style("tweet",get_stylesheet_directory_uri()."/stylesheets/jquery.tweet.css");
  wp_enqueue_style("responsive-nav",get_stylesheet_directory_uri()."/stylesheets/responsive-nav.css");
  wp_enqueue_style("flexslider", get_stylesheet_directory_uri(). "/stylesheets/flexslider.css");
  wp_enqueue_style("isotope",get_stylesheet_directory_uri()."/stylesheets/isotope.css");
  wp_enqueue_style("prettyPhoto",get_stylesheet_directory_uri()."/stylesheets/prettyPhoto.css");
  wp_enqueue_style("icomoon",get_stylesheet_directory_uri()."/stylesheets/icomoon.css");
  wp_enqueue_style("style",get_stylesheet_directory_uri()."/style.css");
}
function realm_admin_only()
{
 
  wp_enqueue_style("metastyles", get_stylesheet_directory_uri(). "/assets/css/meta-styles.css");  
  wp_enqueue_style("farbtastic-style", get_stylesheet_directory_uri(). "/admin/options/css/farbtastic.css");  
}

global $pagenow;
if (!is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) )) 
 {  
    add_action( 'init', 'realm_styles' );
 }
 if(is_admin())
 {
   add_action( 'init', 'realm_admin_only' );
 }
?>