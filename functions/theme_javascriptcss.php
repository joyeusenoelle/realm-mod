<?php
/* ------------------------------------- */
/* ENQUEUE JAVASCRIPTS + CSS */
/* ------------------------------------- */
function loadJSCSS() {
	if (!is_admin()) {
		wp_enqueue_script( 'jquery' );
	
	// Load Theme Options
		$themeoptions = getThemeOptions();	
		
	
	// Enqueue the Theme Styles

		//Basic 
		wp_enqueue_style( 'tb_base_style',get_stylesheet_directory_uri().'/style.css');
		if ((is_page() && basename(get_page_template())=="one_page.php")) wp_enqueue_style( 'tb_red_style',T_CSS.'/style_onepage.css');
		
		//Responsive?
		if(get_theme_mod( 'tb_webpaint_responsive', 'yes' )=="yes"){
			if (!is_page() || (is_page() && basename(get_page_template())!="one_page.php"))
				wp_enqueue_style( 'tb_mediaquery_style',T_CSS.'/media-queries.css');
			else
				wp_enqueue_style( 'tb_mediaquery_style',T_CSS.'/media-queries-onepage.css');
		}
		
		wp_enqueue_style( 'tb_fancybox_style',T_JS.'/fancybox/jquery.fancybox.css');
		wp_enqueue_style( 'tb_fancyboxthumbs_style',T_JS.'/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.2');

		//Google Font
		$google_font = get_theme_mod( "tb_wetpaint_body-headline-font-url",'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic');
	    if(!empty($google_font)) wp_enqueue_style( 'tb_googlefont_style',$google_font);
	    
	    //Fontello Icons
	    wp_enqueue_style( 'tb_fontello_style',T_TYPE.'/fontello.css');

	    
	// Enqueue the Theme JS  
		
		//Navigation
		wp_enqueue_script('tb_ddsmoothmenu_script', T_JS."/ddsmoothmenu.js", array('jquery'),false,true);
		wp_enqueue_script('tb_selectnav_script', T_JS."/selectnav.js", array('jquery'),false,true);
		
		//Basics
		wp_enqueue_script('tb_isotope_script', T_JS."/jquery.isotope.min.js", array('jquery'),false,true);
		wp_enqueue_script('tb_easytabs_script', T_JS."/jquery.easytabs.js", array('jquery'),false,true);
		wp_enqueue_script('tb_fitvids_script', T_JS."/jquery.fitvids.js", array('jquery'),false,true);
		wp_enqueue_script('tb_fancyboxpack_script', T_JS."/jquery.fancybox.pack.js", array('jquery'),false,true);
		wp_enqueue_script('tb_fancyboxthumbs_script', T_JS."/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.2", array('jquery'),false,true);
		wp_enqueue_script('tb_fancyboxmedia_script', T_JS."/fancybox/helpers/jquery.fancybox-media.js?v=1.0.0", array('jquery'),false,true);
		wp_enqueue_script('tb_touchcarousel_script', T_JS."/jquery.touchcarousel-1.2.min.js", array('jquery'),false,true);
		wp_enqueue_script('tb_twitter_script', T_JS."/twitter.min.js", array('jquery'),false,true);
		wp_enqueue_script('tb_bootstrapslider_script', T_JS."/boostrapslider.js", array('jquery'),false,true);
		wp_enqueue_script('tb_sharrre_script', T_JS."/jquery.sharrre-1.3.3.php", array('jquery'),false,true);	
		
					
		//Main Script
		wp_enqueue_script('tb_wetpaint_script', T_JS."/scripts.js", array('jquery'),false,true);
		//if (!is_page() || (is_page() && basename(get_page_template())!="one_page.php")) 
		wp_enqueue_script('tb_wetpaint_menu_multi_script', T_JS."/scripts_menu_multi.js", array('jquery'),false,true);

		
		//Comments
		if(is_singular() && get_option("thread_comments")) wp_enqueue_script("comment-reply");
		
		//IE8
		add_filter( 'wp_enqueue_scripts', 'wpseie8_enqueue_scripts' );
		function wpseie8_enqueue_scripts() {
		    wp_enqueue_style( 'ie8', T_CSS.'ie8.css', array(), '1.0.0' );
		    global $wp_styles;
		    $wp_styles->registered['ie8']->add_data( 'conditional', 'IE 8' );
		}
		
		//IE9
		add_filter( 'wp_enqueue_scripts', 'wpseie9_enqueue_scripts' );
		function wpseie9_enqueue_scripts() {
		    wp_enqueue_style( 'ie9', T_CSS.'ie9.css', array(), '1.0.0' );
		    global $wp_styles;
		    $wp_styles->registered['ie9']->add_data( 'conditional', 'IE 9' );
		}
	}
}
add_action('wp_enqueue_scripts', 'loadJSCSS');
?>
