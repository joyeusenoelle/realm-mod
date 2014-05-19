<?php
// Array that holds all Page Options
// class is used to trigger some jQuery action

$custom_page_meta_fields = array(
		array(
			'label'	=> 'Content (Menu)',
			'desc'	=> 'Choose the Menu which contains the pages/posts for the OnePager layout',
			'id'	=>  $prefix.'onepage_menu',
			'default one_page_single' => '',
			'type'	=> 'menu_list',
			'class' => 'tp_options one_page'
		),
		array(
			'label'	=> 'Hide Page Title+Intro Area?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the Page Head?',
			'id'	=> $prefix.'activate_page_title',
			'type'	=> 'checkbox',
			'default one_page_single' => 'checked',
			'class' => 'tp_options content default one_page_single portfolio_showcase portfolio_lightbox portfolio_classic portfolio_carousel videocase gallery index blog contact social_timeline'
		),
		array(
			'label'	=> 'Page Intro',
			'desc'	=> 'Intro Text appearing before the content default one_page_single',
			'id'	=> $prefix.'page_intro',
			'type'	=> 'textarea',
			'class' => 'tp_options content default one_page_single portfolio_showcase portfolio_lightbox portfolio_classic portfolio_carousel index blog gallery headline videocase home_page contact social_timeline'
		),
		array(
			'label'	=> 'Select Sidebar',
			'desc'	=> 'Choose the Sidebar to this Page',
			'id'	=>  $prefix.'sidebar',
			'default one_page_single' => 'Blog Sidebar',
			'type'	=> 'sidebar_list',
			'class' => 'tp_options content default index blog template_blog_sidebar contact'
		),
		array(
			'label'	=> 'Head Slider',
			'desc'	=> 'Choose the Revolution Slider that will be displayed on top of the Page before the Content Boxes',
			'id'	=>  $prefix.'header_slider',
			'default one_page_single' => '',
			'type'	=> 'slider_list',
			'class' => 'tp_options default one_page'
		),
		array (
			'label'	=> 'Background Style',
			'desc'	=> 'What kind of Background should be displayed',
			'id'	=> $prefix.'one_page_background',
			'type'	=> 'radio',
			'default' => 'light-wrapper',
			'options' => array (
				'white' => array ('label' => 'light','value'	=> 'light-wrapper'),
				'dark' => array ('label' => 'dark','value'	=> 'dark-wrapper'),
				'black' => array ('label' => 'black','value'	=> 'black-wrapper'),
				'parallax' => array ('label' => 'parallax','value'	=> 'parallax')
			),
			'class' => 'tp_options one_page_single'
		),
		array(
			'label'	=> 'Parallax Background',
			'desc'	=> 'Parallax Background if selected above',
			'id'	=>  $prefix.'parallax_background',
			'type'	=> 'image',
			'class' => 'tp_options one_page_single'
		)
);

$custom_page_blog_meta_fields = array(
		array(
			'label'	=> 'Blog Posts per Page',
			'text' => '',
			'desc'	=> 'In case you need to overwrite the normal WP input in the main <br>WP menu->Settings->Reading',
			'id'	=> $prefix.'posts_per_page',
			'type'	=> 'text',
			'default one_page_single' => '',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Hide Info Categories?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the category meta infos?',
			'id'	=> $prefix.'activate_blog_categories',
			'type'	=> 'checkbox',
			'default one_page_single' => 'checked',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Hide Info Comment Count?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the comments meta infos?',
			'id'	=> $prefix.'activate_blog_comments',
			'type'	=> 'checkbox',
			'default one_page_single' => 'checked',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Hide Info Author?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the author in meta infos?',
			'id'	=> $prefix.'activate_blog_author',
			'type'	=> 'checkbox',
			'default one_page_single' => 'checked',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Excerpt Words',
			'text' => '',
			'desc'	=> 'How many words in the excerpt (Blank = 55)?',
			'id'	=> $prefix.'page_blog_excerpt',
			'type'	=> 'text',
			'default one_page_single' => 'checked',
			'class' => 'tp_options index blog'
		)
);

$custom_page_portfolio_meta_fields = array(
		array(
			'label'	=> 'Categories',
			'desc'	=> 'Choose all Categories you like to see in this overview (use shift,strg,cmd key for multiple selection)',
			'id'	=> $prefix.'portfolio_categories',
			'type'	=> 'portfolio_category_list',
			'class' => ''
		),
		array (
			'label'	=> 'Display Page Content',
			'desc'	=> 'Where is the content located?',
			'id'	=> $prefix.'portfolio_content_display',
			'type'	=> 'radio',
			'default' => 'below' ,
			'options' => array (
				'above' => array ('label' => 'Above Portfolio','value'	=> 'above'),
				'below' => array ('label' => 'Below Portfolio','value'	=> 'below')
			),
			'class' => ''
		),
		array(
			'label'	=> 'Hide Related Posts?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the related posts in the detail page?',
			'id'	=> $prefix.'activate_related_posts',
			'type'	=> 'checkbox',
			'default one_page_single' => 'checked',
			'class' => 'tp_options portfolio_classic portfolio_carousel'
		),
);
?>