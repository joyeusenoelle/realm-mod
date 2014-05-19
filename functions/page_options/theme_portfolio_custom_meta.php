<?php
// Array that holds all Post Options
// class is used to trigger some jQuery action

	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once( $path_to_wp.'/wp-includes/functions.php');


$custom_portfolio_meta_fields = array(
		array(
			'label'	=> 'Hide Page Title+Intro Area?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the Page Head?',
			'id'	=> $prefix.'activate_page_title',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => ''
		),
		array(
			'label'	=> 'Page Intro',
			'desc'	=> 'Intro Text appearing before the content default',
			'id'	=> $prefix.'page_intro',
			'type'	=> 'textarea',
			'class' => 'headline'
		),
		array(
			'label'	=> 'Hide Related Posts?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the related Posts in the post detail view?',
			'id'	=> $prefix.'activate_related_posts',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options index'
		),
		array (
			'label'	=> 'Related Posts Attribute',
			'desc'	=> '',
			'id'	=> $prefix.'related_posts_attribute',
			'type'	=> 'posttype',
			'default' => 'tags',
			'options' => array (
				'tags' => array ('label' => 'Tags','value'	=> 'tags'),
				'category' => array ('label' => 'Category','value'	=> 'category')
			),
			'class' => ''
		),
		array(
			'label'	=> 'Select Sidebar',
			'desc'	=> 'Choose the Sidebar to this Post',
			'id'	=>  $prefix.'sidebar',
			'default' => 'Blog Sidebar',
			'type'	=> 'sidebar_list'
		),
		array(
			'label'	=> 'Lightbox Image',
			'desc'	=> 'Image to show in the lightbox when Portfolio Lightbox is used',
			'id'	=>  $prefix.'lightbox_image',
			'type'	=> 'image',
			'class' => ''
		)
);

$custom_post_portfolio_type_meta_fields = array(
		array (
			'label'	=> 'Post Format',
			'desc'	=> '',
			'id'	=> $prefix.'post_type',
			'type'	=> 'posttype',
			'default' => 'image',
			'options' => array (
				'tp_valiano_post_type_text' => array ('label' => 'Default','value'	=> 'text'),
				'tp_valiano_post_type_image' => array ('label' => 'Featured Image','value'	=> 'image'),
				'tp_valiano_post_type_video' => array ('label' => 'Video','value'	=> 'video'),
				'tp_valiano_post_type_slider' => array ('label' => 'Slider','value'	=> 'slider')
			),
			'class' => ''
		),
		array (
			'label'	=> 'Video Type',
			'desc'	=> 'Where is the video located?',
			'id'	=> $prefix.'video_type',
			'type'	=> 'radio',
			'default' => '',
			'options' => array (
				'youtube' => array ('label' => 'Youtube','value'	=> 'youtube'),
				'vimeo' => array ('label' => 'Vimeo','value'	=> 'vimeo'),
				'webm' => array ('label' => 'HTML5','value'	=> 'webm')
			),
			'class' => 'post_type video youtube vimeo webm'
		),
		array(
			'label'	=> 'Youtube ID',
			'desc'	=> 'ID of the Youtube Video',
			'id'	=> $prefix.'youtube_id',
			'type'	=> 'text',
			'class' => 'post_type youtube'
		),
		array(
			'label'	=> 'Vimeo ID',
			'desc'	=> 'ID of the Vimeo Video',
			'id'	=> $prefix.'vimeo_id',
			'type'	=> 'text',
			'class' => 'post_type vimeo'
		),
		array(
			'label'	=> 'MP4 URL Link',
			'desc'	=> 'Link to the MP4 (MP4 file)',
			'id'	=> $prefix.'mp4_link',
			'type'	=> 'text',
			'class' => 'post_type webm'
		),
		array(
			'label'	=> 'Video Width',
			'desc'	=> 'Width of the Video',
			'id'	=> $prefix.'video_width',
			'type'	=> 'text',
			'class' => 'post_type youtube vimeo webm'
		),
		array(
			'label'	=> 'Video Height',
			'desc'	=> 'Height of the Video',
			'id'	=> $prefix.'video_height',
			'type'	=> 'text',
			'class' => 'post_type youtube vimeo webm'
		),
		array(
			'label'	=> 'Head Image Height (px)',
			'desc'	=> 'Cut the Featured Image Height, please enter a pixel value (the width will be 100%)',
			'id'	=> $prefix.'post_detail_image_height',
			'type'	=> 'text',
			'class' => 'post_type image'
		),
		array(
			'label'	=> 'Select Slider',
			'desc'	=> 'Choose the Slider to this Page (<strong>Easiest is a FULLWIDTH</strong> Slider in the RevSlider Admin to fit the container, otherwise please check our example sliders)',
			'id'	=>  $prefix.'slider',
			'default' => '',
			'type'	=> 'slider_list',
			'class' => 'post_type slider'
		),
		array(
			'label'	=> 'Lightbox Image',
			'desc'	=> 'Image to show in the lightbox when Portfolio Lightbox is used',
			'id'	=>  $prefix.'lightbox_image',
			'type'	=> 'image',
			'class' => ''
		)
);
?>