<?php
function realm_post_types() 
{
	/*---Portfolio custom post ----*/
/*	register_post_type( 'portfolio_item',
		array(
			'labels' => array(
				'name' => __( 'Portfolio' ,'realmlang'),
				'singular_name' => __( 'Project' ,'realmlang'),
				'add_new' => __( 'Add New Project' ,'realmlang'),
				'add_new_item' => __( 'Add New Project' ,'realmlang'),
				'edit' => __( 'Edit Project','realmlang' ),
				'edit_item' => __( 'Edit Project','realmlang' ),
			),
			'description' => __( 'Portfolio Items.','realmlang' ),
			'public' => true,
			'supports' => array( 'title', 'thumbnail' ),
			'rewrite' => array( 'slug' => 'realm-portfolio', 'with_front' => false ),
			'has_archive' => true,
			'show_in_menu' => true,
			'menu_position' => 100,
			'menu_icon' => get_template_directory_uri() . '/admin/options/img/custom/glyphicons_155_show_thumbnails.png',
		)
	);
	register_taxonomy( 'portfolio_category', array( 'portfolio_item' ),
	array( 'hierarchical' => true, 'label' => "Categories","singular_label" => "Category" ) );	*/
	
	/* ------------------------------------- */
	/* WEBPAINT PORTFOLIO POST TYPE 		 */
	/* ------------------------------------- */
	
	//Register Portfolio PostType and Category Taxonomy
//		add_action('init', 'create_portfolios');
//		function create_portfolios() {
			$portfolio_args = array(
				'label' => "Portfolio",
				'singular_label' => 'Portfolio',
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => 'portfolio', 'with_front' => true),
				'supports' => array('title', 'editor', 'thumbnail', 'author'),
				'taxonomies' => array('post_tag')
			);
			register_post_type('portfolio',$portfolio_args);
//		}

		register_taxonomy("category_portfolio", array("portfolio"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => true));
		add_theme_support( 'post-thumbnails' );
		add_post_type_support('portfolio',array('thumbnail'));

		

}

function realm_team()
{

		/*---Team custom post ----*/
	register_post_type('team',
		array(
			'labels' => array(
				'name' => __( 'Team' ,'realmlang'),
				'singular_name' => __( 'Team' ,'realmlang'),
				'add_new' => __( 'Add Member' ,'realmlang'),
				'add_new_item' => __( 'Add Member' ,'realmlang'),
				'edit' => __( 'Edit Member','realmlang' ),
				'edit_item' => __( 'Edit Member','realmlang' ),
			),
			'description' => __( 'Team Members.','realmlang' ),
			'public' => true,
			'supports' => array( 'title', 'thumbnail'),
			'rewrite' => array( 'slug' => 'realm-team', 'with_front' => false ),
			'has_archive' => true,
            'show_in_menu' => true,
            'menu_position' => 100,
            'menu_icon' => get_template_directory_uri() . '/admin/options/img/custom/glyphicons_043_group1x1.png',
		)
	);
}



function realm_slider()
{

		/*---Slider custom post ----*/
	register_post_type('slider',
		array(
			'labels' => array(
				'name' => __( ' Splash Slider' ,'realmlang'),
				'singular_name' => __( 'Slide' ,'realmlang'),
				'add_new' => __( 'Add New Slide' ,'realmlang'),
				'add_new_item' => __( 'Add New Slide' ,'realmlang'),
				'edit' => __( 'Edit Slide','realmlang' ),
				'edit_item' => __( 'Edit Slide','realmlang' ),
			),
			'description' => __( 'Slides','realmlang' ),
			'public' => true,
			'supports' => array( 'title', 'thumbnail'),
			'rewrite' => array( 'slug' => 'realm-slider', 'with_front' => false ),
			'has_archive' => true,
            'show_in_menu' => true,
            'menu_position' => 100,
            'menu_icon' => get_template_directory_uri() . '/admin/options/img/custom/glyphicons_159_picture.png',
		)
	);
}

?>
