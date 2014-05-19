<?php
/* ------------------------------------- */
/* PAGE/POST/PORTFOLIO OPTIONS */
/* ------------------------------------- */

// Prefix for Page/Post/Portfolio Options
$templatepath = get_template_directory();
define('T_FUNCTIONS', $templatepath . '/functions/');
$prefix="tb_webpaint_";

// Load the Page Option Meta Fields
$custom_meta_fields=array();
require_once(T_FUNCTIONS . '/page_options/theme_page_custom_meta.php');
require_once(T_FUNCTIONS . '/page_options/theme_post_custom_meta.php');
require_once(T_FUNCTIONS . '/page_options/theme_portfolio_custom_meta.php');

// Generate Page/Post/Portfolio Options
add_action('admin_init', 'init_page_options');
function init_page_options() {
	add_meta_box("page-options", "Page Options", "show_custom_page_meta_box", "page", "normal", "high");
	add_meta_box("page-portfolio-options", "Portfolio Options", "show_custom_page_portfolio_meta_box", "page", "side", "high");
	add_meta_box("page-blog-options", "Blog Options", "show_custom_page_blog_meta_box", "page", "side", "high");
	
	add_meta_box("portfolio-post-options", "Portfolio Item Options", "show_custom_portfolio_meta_box", "portfolio", "normal", "high");
	add_meta_box("post-options", "Post Options", "show_custom_post_meta_box", "post", "normal", "high");

	add_meta_box("post-type-options", "Post Type Options", "show_custom_post_type_meta_box", "post", "side", "high");
	
	add_meta_box("portfolio-post-options", "Portfolio Item Options", "show_custom_portfolio_meta_box", "portfolio", "normal", "high");	
	//add_meta_box("portfolio-post-type-options", "Portfolio Type Options", "show_custom_post_portfolio_type_meta_fields", "portfolio", "side", "high"); 	
}

// Include the Page Option Framework Functions
require_once(T_FUNCTIONS . '/page_options/theme_page_options_functions.php');
?>