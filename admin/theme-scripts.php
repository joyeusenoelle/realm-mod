<?php
function realm_scripts() 
{ 

    $options = get_option('realm');

	
    wp_enqueue_script('jquery');
    wp_enqueue_script("bootstrap", get_stylesheet_directory_uri(). "/assets/js/bootstrap.min.js",array(),false,true);
    wp_enqueue_script("responsive-nav", get_stylesheet_directory_uri(). "/javascripts/responsive-nav.js",array(),false,true);
    wp_enqueue_script("jquery-easing", get_stylesheet_directory_uri(). "/javascripts/jquery.easing.1.3.js",array(),false,true);
//    wp_enqueue_script("backstretch", get_stylesheet_directory_uri(). "/javascripts/jquery.backstretch.js",array(),false,true);
//    wp_enqueue_script("invoke-backstretch", get_stylesheet_directory_uri(). "/javascripts/invoke-backstretch.js",array(),false,true);
    wp_enqueue_script("isotope", get_stylesheet_directory_uri(). "/javascripts/jquery.isotope.min.js",array(),false,true);
    wp_enqueue_script("flexslider", get_stylesheet_directory_uri(). "/javascripts/jquery.flexslider.js",array(),false,true);
    wp_enqueue_script("stellar", get_stylesheet_directory_uri(). "/javascripts/jquery.stellar.js",array(),false,true);
    wp_enqueue_script("flickr", get_stylesheet_directory_uri(). "/javascripts/jquery.flickr.js",array(),false,true);
    if($options['flickr_id'] != '')
    {
        wp_enqueue_script("flickr-init", get_stylesheet_directory_uri(). "/javascripts/init-flickr.js",array(),false,true);
    }
    wp_enqueue_script("prettyPhoto", get_stylesheet_directory_uri(). "/javascripts/jquery.prettyPhoto.js",array(),false,true);
    wp_enqueue_script("flexslider", get_stylesheet_directory_uri(). "/javascripts/flexslider.js",array(),false,true);
    wp_enqueue_script("waypoints", get_stylesheet_directory_uri(). "/javascripts/waypoints.min.js",array(),false,true);
    wp_enqueue_script("tweet", get_stylesheet_directory_uri(). "/javascripts/jquery.tweet.js",array(),false,true);
    if($options['twitter_id'] != '')
    {
        wp_enqueue_script("tweet-init", get_stylesheet_directory_uri(). "/javascripts/init-tweet.js",array(),false,true);
    }
    wp_enqueue_script("retina", get_stylesheet_directory_uri(). "/javascripts/retina.js",array(),false,true);
    //wp_enqueue_script("scroll", get_stylesheet_directory_uri(). "/javascripts/scroll.js",array(),false,true);
    wp_enqueue_script("form-validation", get_stylesheet_directory_uri(). "/javascripts/form-validation.js",array(),false,true);
    wp_enqueue_script("main-script", get_stylesheet_directory_uri(). "/javascripts/script.js",array(),false,true);
	// Webpaint scripts
    wp_enqueue_script("webpaint-script", get_stylesheet_directory_uri(). "/style/js/scripts.js",array(),false,true);
    wp_enqueue_script("webpaint-fancybox", get_stylesheet_directory_uri() . "/style/js/jquery.fancybox.pack.js",array(),false,true);
    wp_enqueue_script("webpaint-boostrap", get_stylesheet_directory_uri() . "/style/js/boostrapslider.js",array(),false,true);
    //wp_enqueue_script("webpaint-ddsmooth", get_stylesheet_directory_uri() . "/style/js/ddsmoothmenu.js",array(),false,true);
    wp_enqueue_script("webpaint-html5", get_stylesheet_directory_uri() . "/style/js/html5.js",array(),false,true);
    wp_enqueue_script("webpaint-easytabs", get_stylesheet_directory_uri() . "/style/js/jquery.easytabs.js",array(),false,true);
    wp_enqueue_script("webpaint-easytabsmin", get_stylesheet_directory_uri() . "/style/js/jquery.easytabs.min.js",array(),false,true);
    wp_enqueue_script("webpaint-fitvids", get_stylesheet_directory_uri() . "/style/js/jquery.fitvids.js",array(),false,true);
    wp_enqueue_script("webpaint-isotope", get_stylesheet_directory_uri() . "/style/js/jquery.isotope.min.js",array(),false,true);
    ///wp_enqueue_script("webpaint-sharrre", get_stylesheet_directory_uri() . "/style/js/jquery.sharrre-1.3.3.js",array(),false,true);
    wp_enqueue_script("webpaint-slickforms", get_stylesheet_directory_uri() . "/style/js/jquery.slickforms.js",array(),false,true);
    wp_enqueue_script("webpaint-themepunch-plug", get_stylesheet_directory_uri() . "/style/js/jquery.themepunch.plugins.min.js",array(),false,true);
    wp_enqueue_script("webpaint-themepunch-revo", get_stylesheet_directory_uri() . "/style/js/jquery.themepunch.revolution.min.js",array(),false,true);
    wp_enqueue_script("webpaint-touchcarousel", get_stylesheet_directory_uri() . "/style/js/jquery.touchcarousel-1.2.min.js",array(),false,true);
    //wp_enqueue_script("webpaint-menu-multi", get_stylesheet_directory_uri() . "/style/js/scripts_menu_multi.js",array(),false,true);
    wp_enqueue_script("webpaint-selectnav", get_stylesheet_directory_uri() . "/style/js/selectnav.js",array(),false,true);
    wp_enqueue_script("webpaint-twitter", get_stylesheet_directory_uri() . "/style/js/twitter.min.js",array(),false,true);

    
	
}

function realm_admin_scripts()
{  
	wp_enqueue_script("uploader", get_stylesheet_directory_uri(). "/admin/options/js/uploader.js");
    wp_enqueue_script("farbtastic", get_stylesheet_directory_uri(). "/admin/options/js/farbtastic.js");
    wp_enqueue_script("farbtastic-invoke", get_stylesheet_directory_uri(). "/admin/options/js/color_picker_invoke.js");
    wp_enqueue_script("add-portfolio-slide", get_stylesheet_directory_uri(). "/javascripts/add-portfolio-slide.js",array(),false,true);
}

global $pagenow;
if (!is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) )) 
{ 

    add_action( 'init', 'realm_scripts' );
}
if(is_admin())
{

    add_action( 'init', 'realm_admin_scripts' );
}
if ( is_singular() ) wp_enqueue_script( "comment-reply" );
?>