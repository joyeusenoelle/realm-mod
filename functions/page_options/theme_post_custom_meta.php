<?php
// Array that holds all Post Options
// class is used to trigger some jQuery action

$custom_post_meta_fields = array(
		array(
			'label'	=> 'Hide Related Posts?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the related Posts in the post detail view?',
			'id'	=> $prefix.'activate_related_posts',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => ''
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
			'desc'	=> 'Choose the Sidebar to this Page',
			'id'	=>  $prefix.'sidebar',
			'default' => 'Blog Sidebar',
			'type'	=> 'sidebar_list'
		)
);

$custom_post_type_meta_fields = array(
		array (
			'label'	=> 'Post Format',
			'desc'	=> '',
			'id'	=> $prefix.'post_type',
			'type'	=> 'posttype',
			'default' => 'image',
			'options' => array (
				'tp_valiano_post_type_text' => array ('label' => 'Default','value'	=> 'default'),
				'tp_valiano_post_type_image' => array ('label' => 'Image','value'	=> 'image'),
				'tp_valiano_post_type_video' => array ('label' => 'Video','value'	=> 'video')
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
				//'webm' => array ('label' => 'HTML5','value'	=> 'webm')
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
			'label'	=> 'Audio URL Link',
			'desc'	=> 'Link to the MP3 file',
			'id'	=> $prefix.'audio_link',
			'type'	=> 'text',
			'class' => 'post_type audio'
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
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'Please use the "<strong>featured image</strong>" option of WP below to display thumb preview pics.',
			'type'	=> 'desc',
			'class' => ''
		),
		array(
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'In the "Blog I" page template Post-Format "Video" Thumbnails will be replaced by the video itself.',
			'type'	=> 'desc',
			'class' => 'post_type video'
		),
		array(
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'Using Post-Format "Image" will take the <strong>featured image</strong> and display it in the head of the post.',
			'type'	=> 'desc',
			'class' => 'post_type image'
		)
);
?>