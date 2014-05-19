<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('admin_OPTIONS_URL', site_url('path the options folder/'));
if(!class_exists('admin_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}


define('admin_OPTIONS_URL', trailingslashit(get_template_directory_uri()).'admin/options/');
/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'admin-opts'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('admin-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('admin-opts-args-twenty_eleven', 'change_framework_args');









/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;

//google api key MUST BE DEFINED IF YOU WANT TO USE GOOGLE WEBFONTS
//$args['google_api_key'] = '***';

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
$args['intro_text'] = __('', 'admin-opts');

//Setup custom links in the footer for share icons
$args['share_icons']['twitter'] = array(
										'link' => 'http://twitter.com/designovastudio',
										'title' => 'Folow us on Twitter', 
										'img' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_322_twitter.png'
										);
$args['share_icons']['linked_in'] = array(
										'link' => 'http://facebook.com/pixelglimpse',
										'title' => 'Like Us', 
										'img' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_320_facebook.png'
										);

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'realm';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Theme Options', 'admin-opts');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Realm Theme Settings', 'admin-opts');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "admin_theme_options"
$args['page_slug'] = 'realm_theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 27;



//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'admin-opts');



$sections = array();

wp_reset_query();
// Pull all the categories into an array	
$options_categories = array();  
$options_categories_obj = get_categories('title_li=&exclude=&hide_empty=0');

foreach ($options_categories_obj as $category) {
	$options_categories[$category->cat_ID] = $category->cat_name;
}

$options_pages = array();
$options_pages_obj = get_pages();
foreach ( $options_pages_obj as $pages ) {
	$include_onepage =  get_post_meta($pages->ID,'one_page',true);
	if($include_onepage == 'yes')
	{
		$options_pages[$pages->post_name] = $pages->post_title;
	}

  	
}

//Realm General Setting
$sections[] = array(
				'title' => __('General Settings', 'admin-opts'),
				'desc' => __('<p class="description">General settings for theme like logo, highlight color etc</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_280_settings.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array(
					array(
						'id' => 'logo',
						'type' => 'upload',
						'title' => __('Header Logo', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('Upload or Select the logo (width should be 150px).', 'admin-opts')
						),
					array(
						'id' => 'logo2x',
						'type' => 'upload',
						'title' => __('Header Logo (Retina)', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __("Upload your logo for retina display.<br>It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Ex. 'mylogo.png' becomes 'mylogo@2x.png' (width should be 300px).", 'admin-opts')
						),
					array(
						'id' => 'mobile_logo',
						'type' => 'upload',
						'title' => __('Mobile Logo', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('Upload or Select the logo (height should be 50px).', 'admin-opts')
						),
					array(
						'id' => 'mobile_logo2x',
						'type' => 'upload',
						'title' => __('Mobile Logo (Retina)', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __("Upload your logo for retina display.<br>It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Ex. 'mylogo.png' becomes 'mylogo@2x.png' (height should be 100px).", 'admin-opts')
						),
					array(
						'id' => 'fav_icon',
						'type' => 'upload',
						'title' => __('Fav Icon', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('Upload or Select the icon (16px X 16px).', 'admin-opts')
						),
					array(
						'id' => 'highlight_color',
						'type' => 'color',
						'title' => __('Choose The Highlight Color', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('', 'admin-opts'),
						'std' => '#d90e0e'
						),
					array(
						'id' => 'navbar_widget_content',
						'type' => 'editor',
						'title' => __('Nav-bar Widget Content', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('This text will appear inside the navigation bar', 'admin-opts'),
						'std' => ''
					)
					
					)						
				);


//Spalsh Page Settings
$sections[] = array(
				'title' => __('Home Page Settings', 'admin-opts'),
				'desc' => __('<p class="description">Home Page configrations</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_020_home.png',
				//Lets leave this as a blank section, no options just some intro text set above.
                'fields' => array(
                  	array(
						'id' => 'home_page_title',
						'type' => 'text',
						'title' => __('Large Title', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'realm'
						),
                  	array(
						'id' => 'home_page_subheading',
						'type' => 'text',
						'title' => __('Sub Heading', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'the creative agency'
						),
					array(
						'id' => 'spalshpagecontent', //must be unique
						'type' => 'checkbox', //the field type
						'title' => __('Show Custom Page Contents', 'admin-opts'),
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('Check if you want to display the custom page contents<br>(Hides default Home-page contents).', 'admin-opts'),
						'std' => 0, //This is a default value, used to set the options on theme activation, and if the user hits the Reset to defaults Button, default is 0, or not checked.
						),
					array(
						'id' => 'splash_page_mega_content',
						'type' => 'editor',
						'title' => __('Custom Page Contents', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('', 'admin-opts'),
						'std' => ''
					)
					
					)
				);


				
//Contact Page
$sections[] = array(
				'title' => __('Contact Page', 'admin-opts'),
				'desc' => __('<p class="description">Contact Page configrations</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_121_message_empty.png',
				//Lets leave this as a blank section, no options just some intro text set above.
                'fields' => array(
                  	array(
						'id' => 'address_heading',
						'type' => 'text',
						'title' => __('Address Heading', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'We are here'
						),
					array(
						'id' => 'address',
						'type' => 'textarea',
						'title' => __('Address', 'admin-opts'), 
						'sub_desc' => __('Address', 'admin-opts'),
						'desc' => __('This text will appear inside a &lt;p&gt; tag', 'admin-opts'),
						'std' => 'Box #22 - 8 <br> Realm Creative <br> Avenue Plaza <br> Zurich, Switzerland'
					),
                    array(
						'id' => 'name_placeholder',
						'type' => 'text',
						'title' => __('Placeholder For Name', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Name'
						),
					array(
						'id' => 'email_placeholder',
						'type' => 'text',
						'title' => __('Placeholder For Email', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Email'
						),
					array(
						'id' => 'message_placeholder',
						'type' => 'text',
						'title' => __('Placeholder For Message', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Message'
						),
					array(
						'id' => 'submit_btn_txt',
						'type' => 'text',
						'title' => __('Text For Submit Button', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Send Message'
						),
					array(
						'id' => 'thanks_msg_header',
						'type' => 'text',
						'title' => __('Thanks Message Header', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Thanks For Your Comment'
						),
					array(
						'id' => 'thanks_msg',
						'type' => 'textarea',
						'title' => __('Thanks Message', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Lorem ipsum dolor siter amet mundium corpes illon tolves lorem ipsum dolor. Quisque nec est id ante consectetur tristique. Suspendisse potenti.'
						),
					array(
						'id' => 'contact_email',
						'type' => 'text',
						'title' => __('Contact form Email', 'admin-opts'),
						'validate' => 'email', 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Contact form submissions will be mailed to this address', 'admin-opts'),
						'std' => 'mail@domain.tld'
						)

					)
				);

//Social Stream
$sections[] = array(
				'title' => __('Social Stream', 'admin-opts'),
				'desc' => __('<p class="description">Social Stream configrations</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_073_signal.png',
				//Lets leave this as a blank section, no options just some intro text set above.
                'fields' => array(
                  	array(
						'id' => 'twitter_feed_title',
						'type' => 'text',
						'title' => __('Twitter Feed Title', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => '@designovastudio'
						),
                  	array(
						'id' => 'twitter_id',
                        'type' => 'text',
						'title' => __('Twitter ID', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Use short-code [twitter_feed customclass=""] to display the Tweets', 'admin-opts'),
						'std' => 'designovastudio'
						),
					array(
						'id' => 'flickr_feed_title',
						'type' => 'text',
						'title' => __('Flickr Feed Title', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Flickr Photo Stream'
						),
                  	array(
						'id' => 'flickr_id',
						'type' => 'text',
						'title' => __('Flickr ID', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Use short-code [flickr_feed customclass=""] to display the Flickr Feed', 'admin-opts'),
						'std' => '36587311@N08'
						),
					array(
						'id' => 'flickr_item_limit',
						'type' => 'text',
						'title' => __('Flickr images show at most', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => '12'
						),
					
					)
				);


//Social Media
$sections[] = array(
				'title' => __('Social Media', 'admin-opts'),
				'desc' => __('<p class="description">Configure the social media links here.</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_021_snowflake.png',
				//Lets leave this as a blank section, no options just some intro text set above.
                'fields' => array(
                	array(
						'id' => 'realm_email',
						'type' => 'text',
						'title' => __('Mail ID', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Email ID', 'admin-opts'),
						'std' => 'mail@domain.tld'
						),
                	array(
						'id' => 'realm_facebook',
						'type' => 'text',
						'title' => __('Facebook', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Facebook URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_twitter',
						'type' => 'text',
						'title' => __('Twitter', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Twitter url', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_gplus',
						'type' => 'text',
						'title' => __('Google Plus', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Google Plus URL', 'admin-opts'),
						'std' => 'designova'
						),					
					array(
						'id' => 'realm_linkedin',
						'type' => 'text',
						'title' => __('Linked In', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Linked In URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_pintrest',
						'type' => 'text',
						'title' => __('Pintrest', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Pintrest URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_dribble',
						'type' => 'text',
						'title' => __('Dribble', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Dribble URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_behance',
						'type' => 'text',
						'title' => __('Behance', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Behance URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_github',
						'type' => 'text',
						'title' => __('Github', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Github URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_flickr',
						'type' => 'text',
						'title' => __('Flickr', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Flickr URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_tumblr',
						'type' => 'text',
						'title' => __('Tumblr', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Tumblr URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_soundcloud',
						'type' => 'text',
						'title' => __('Soundcloud', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Soundcloud URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_instagram',
						'type' => 'text',
						'title' => __('Instagram', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Instagram URL', 'admin-opts'),
						'std' => 'designova'
						),
					array(
						'id' => 'realm_vimeo',
						'type' => 'text',
						'title' => __('Vimeo', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Vimeo URL', 'admin-opts'),
						'std' => 'designova'
						)
					)
				);						
				
		
//Footer
$sections[] = array(
				'title' => __('Footer Settings', 'admin-opts'),
				'desc' => __('<p class="description">Footer settings for theme like address, credits etc</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_243_anchor.png',
				//Lets leave this as a blank section, no options just some intro text set above.
                'fields' => array(

					array(
						'id' => 'footer_widget_title',
						'type' => 'text',
						'title' => __('Footer Widget Title', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => "Do you love this theme?"
						),
					array(
						'id' => 'footer_widget_txt',
						'type' => 'text',
						'title' => __('Footer Widget Text', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => "Buy it from Themeforest"
						),
					array(
						'id' => 'footer_widget_button_txt',
						'type' => 'text',
						'title' => __('Footer Widget Button Text', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => "Buy it Now"
						),
					array(
						'id' => 'footer_widget_button_link',
						'type' => 'text',
						'title' => __('Footer Widget Button Link', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => "http://themeforest.net/item/realm-unique-one-page-parallax-responsive-html5/5578350"
						),
					array(
						'id' => 'show_custom_footer_content', //must be unique
						'type' => 'checkbox', //the field type
						'title' => __('Show Custom Footer Content', 'admin-opts'),
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('Hides the default footer widget and displays custom footer content.', 'admin-opts'),
						'std' => 0, //This is a default value, used to set the options on theme activation, and if the user hits the Reset to defaults Button, default is 0, or not checked.
						),
					array(
						'id' => 'custom_footer_content',
						'type' => 'editor',
						'title' => __('Custom Footer Contents', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('', 'admin-opts'),
						'std' => ''
						),
					array(
						'id' => 'hide_footer_widget', //must be unique
						'type' => 'checkbox', //the field type
						'title' => __('Hide Footer Widget Area', 'admin-opts'),
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('Check if you want to hide the footer widget.', 'admin-opts'),
						'std' => 0, //This is a default value, used to set the options on theme activation, and if the user hits the Reset to defaults Button, default is 0, or not checked.
						),
					array(
						'id' => 'copy_txt',
                        'type' => 'text',
						'title' => __('Copyright Text', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Text appeares at bottom every page footer', 'admin-opts'),
						'std' => 'Copyright &copy; 2013 Realm Inc.'
						),
					array(
						'id' => 'credit',
                        'type' => 'text',
						'title' => __('Credit Text', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Text appeares at bottom every page footer', 'admin-opts'),
						'std' => 'A premium template from Designova.'
						)				
					)
				);

//404 Error Page Setting Section
$sections[] = array(
				'title' => __('404 Error Settings', 'admin-opts'),
				'desc' => __('<p class="description">404 error page settings for theme.</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_002_dog.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array(
					array(
						'id' => 'err_title',
						'type' => 'text',
						'title' => __('Page Title', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('<br/>Page heading', 'admin-opts'),
						'std' => '404 Error'
						),
					array(
						'id' => 'err_icon',
						'type' => 'upload',
						'title' => __('Page Icon', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('Upload or Select the icon (150px X 150px).', 'admin-opts')
						),
					array(
						'id' => 'err_icon_retina',
						'type' => 'upload',
						'title' => __('Page Icon Retina', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'desc' => __('Upload or Select the icon (300px X 300px).', 'admin-opts')
						),
					array(
						'id' => 'err_promo_heading',
						'type' => 'text',
						'title' => __('Promo Text Heading', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Page Not Found!'
						),
					array(
						'id' => 'err_promo_sub_heading',
						'type' => 'text',
						'title' => __('Promo Text Sub-title', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Oops, This Page Could Not Be Found!'
						),
					array(
						'id' => 'err_promo_txt',
						'type' => 'textarea',
						'title' => __('Promo Text', 'admin-opts'), 
						'sub_desc' => __('', 'admin-opts'),
						'std' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Mauris ac nunc quis augue pellentesque condimentum. Fusce pulvinar lacus et eleifend blandit.'
						)
						
					
					
				  )						
				);

//Additional CSS
$sections[] = array(
				'title' => __('Additional CSS', 'admin-opts'),
				'desc' => __('<p class="description">Add any additional CSS rules if you need. This will appear 
					inside the header. You may use this feature to override the css rules we used inside the theme. You may have to use "!important" along with the rule to make them work</p>', 'admin-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_009_magic.png',
				//Lets leave this as a blank section, no options just some intro text set above.
                'fields' => array(
					array(
						'id' => 'additional_css',
						'type' => 'textarea',
						'title' => __('Add your styles here', 'admin-opts'), 
						'sub_desc' => __('Custom CSS Rules', 'admin-opts'),
						'desc' => __('', 'admin-opts'),
						'std' => ''
						),				
					)
				);
				
	$tabs = array();
			

	$theme_data = wp_get_theme();
	$theme_uri = $theme_data->get('ThemeURI');
	$description = $theme_data->get('Description');
	$author = $theme_data->get('Author');
	$version = $theme_data->get('Version');
	$tags = $theme_data->get('Tags');


	$theme_info = '<div class="admin-opts-section-desc">';
	$theme_info .= '<p class="admin-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'admin-opts').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="admin-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'admin-opts').$author.'</p>';
	$theme_info .= '<p class="admin-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'admin-opts').$version.'</p>';
	$theme_info .= '<p class="admin-opts-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="admin-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'admin-opts').implode(', ', $tags).'</p>';
	$theme_info .= '</div>';



	$tabs['theme_info'] = array(
					'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_195_circle_info.png',
					'title' => __('Theme Information', 'admin-opts'),
					'content' => $theme_info
					);
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => admin_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'admin-opts'),
						'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory_uri()).'Readme.txt'))
						);
	}//if

	global $admin_Options;
	$admin_Options = new nhp_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options',0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>