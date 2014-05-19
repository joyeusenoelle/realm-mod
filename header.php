<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?> <?php wp_title("|",true); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo get_bloginfo('description'); ?>"/>
	<meta name="keywords" content="<?php bloginfo('categories'); ?>"/>

	<?php

        realm_highlight_color();

        $options = get_option('realm');

        add_theme_support( 'custom-header'); 
        add_theme_support( 'custom-background');
        add_editor_style();
		$functions_file = getcwd()."/wp-content/themes/realm-mod/functions/theme_functions.php";

		if(file_exists($functions_file)) {
	        include($functions_file);
			echo "\n<!-- Loaded functions. -->\n";
			$shortcode_file = getcwd()."/wp-content/themes/realm-mod/functions/theme_shortcodes.php";
	
			if(file_exists($shortcode_file)) {
				include($shortcode_file);
				echo "\n<!-- Loaded shortcodes. -->\n";
			} else {
				echo "\n<!-- Could not load shortcodes at $shortcode_uri . -->\n";
			}
		} else {
			echo "\n<!-- Could not load functions at $shortcode_file . -->\n";
		}

		
        wp_head();  
     ?>
</head>

<body <?php body_class(); ?>>

<!-- Mobile Only Navigation - 2 types each for (480px to 640px) and (640px to 960px) wide device screens -->
<header id="mobile-header" class="hidden-desktop clearfix">
    <div id="nav">
      <?php custom_mobile_menu(); ?>
    </div>
</header>

<div class="header-fixed-nav hidden-phone hidden-tablet">
    <div class="nav">
    <?php 
    if($options['logo'] != '')
    { 
    ?>
    <img alt="<?php echo get_bloginfo('name'); ?>" id="site-logo" data-site-url="<?php echo site_url();?>" title="<?php echo get_bloginfo('name'); ?>" class="head-logo" src="<?php echo $options['logo']; ?>" />
    <?php 
    }
    else
    {
        echo '<h1>'.get_bloginfo('name').'</h1>';
    }
    ?>
    <!-- <h1>realm</h1> -->
      <?php 
        custom_menu();
      ?>
    </div>
    <div class="nav2 navbar-widget">
        <?php
            echo do_shortcode($options['navbar_widget_content']);
        ?>
    </div>                              
</div>