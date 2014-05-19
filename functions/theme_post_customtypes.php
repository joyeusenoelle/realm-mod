<?php
	/* ------------------------------------- */
	/* PORTFOLIO POST TYPE */
	/* ------------------------------------- */
	
	//Register Portfolio PostType and Category Taxonomy
		add_action('init', 'create_portfolios');
		register_taxonomy("category_portfolio", array("portfolio"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => true));
	
		function create_portfolios() {
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
		}
?>