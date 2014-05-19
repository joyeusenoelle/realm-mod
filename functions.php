<?php
/*--Basic Config calling---*/


//Theme Options
require_once (dirname( __FILE__ ) . "/admin/theme-options.php" );
//Common functions
require_once (dirname( __FILE__ ) . "/admin/common-functions.php" );

//Metaboxes
require_once (dirname( __FILE__ ) . "/admin/custom-metabox.php" );
//Custom Post types
require_once (dirname( __FILE__ ) . "/admin/custom-post-types.php" );
//Theme Styles
require_once (dirname( __FILE__ ) . "/admin/theme-styles.php" );
//Theme scripts
require_once (dirname( __FILE__ ) . "/admin/theme-scripts.php" );

require_once (dirname( __FILE__ ) . "/functions/page_options/theme_page_options.php" );



/*---------------------------------------
---------Realm Initialiszation---------
-----------------------------------------*/
function realm_setup() 
  {
		
		register_nav_menu('primary', __( 'Primary Navigation','realmlang'));
		
		add_theme_support('post-thumbnails' );
		add_theme_support('post-thumbnails', array('portfolio_item','post', 'page') );
		set_post_thumbnail_size( 300, 300, true ); // Standard Size Thumbnails
        //Feed links
		add_theme_support( 'automatic-feed-links' );
		//Nav menu
		
		
		//Sidebar
		$args = array(
		'name'          => __( 'Realm Sidebar', 'realmlang' ),
		'id'            => 'realm_side',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s side_block">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="inner-sub-caps">',
		'after_title'   => '</h4>' );
		register_sidebar( $args ); 
        //Content width
		if ( ! isset( $content_width ) ) $content_width = 900;
		//Initiate custom post types
        add_action( 'init', 'realm_post_types' );
		add_action( 'init', 'realm_team' );
		add_action( 'init', 'realm_slider' );
        
		
        //Load the text domain
		load_theme_textdomain('realmlang', get_template_directory() . '/languages');
  }

add_action( 'after_setup_theme', 'realm_setup' );



/*---------------------------------
Important Plugin Activation Check
-----------------------------------*/
function realm_plugin_error(){
    echo '<div class="error">
       <p>Current theme needs <strong>Realm-Shortcodes</strong> Plugin to work properly.</p>
    </div>';
}
function metabox_plugin_error(){
    echo '<div class="error">
       <p>Current theme needs <strong>Meta-box</strong> Plugin activated to work properly.</p>
    </div>';
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active('realm-shortcodes/shortcodes.php')) 
{
}
else{
     add_action('admin_notices', 'realm_plugin_error');
}

//Post formats
add_theme_support(
	'post-formats', array(
		'image',
		'audio',
		'link',
		'quote',
		'video'
	)
);

function realm_is_home_page(){
	if(is_front_page())
    {
    	if(is_page_template('the-onepage.php'))
    	{	
        	$is_home = true;
    	}
    	else
    	{
    		$is_home = false;
    	}
    }
    else
    {
      $is_home = false;
    }

    return $is_home;
}

function realm_favicon(){
	
	$options = get_option('realm');

	if($options['fav_icon'] != '')
    { 

    	$fav_icon = '<link rel="shortcut icon" href="'.$options['fav_icon'].'">';
 
    }
    else
    {
    	$fav_icon = '';
    }

    return $fav_icon;
}

function realm_highlight_color(){

	/*$options = get_option('realm');
	$null = '';
	if($options['highlight_color'] != '')
    {
        get_template_part('color-scheme');
    }
    else
    {
    	return $null;
    }*/

    get_template_part('color_scheme');
}

function realm_custom_style(){

	$options = get_option('realm');
	$custom_style = '';
	if($options['additional_css'] != '')
	{
	   $custom_style = '<style>'.$options['additional_css'].'</style>';
	}
	
	return $custom_style;
}


function realm_IE_fix()
{
	$ie_fix = '<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	  <link href="'. get_stylesheet_directory_uri() .'/stylesheets/ie8.css" rel="stylesheet">
	<![endif]-->';

	return $ie_fix;
}





/*---------------------------------------
---------Customised Menu-----------------
-----------------------------------------*/
function custom_menu()
{
	$locations = get_nav_menu_locations();
	$is_home = realm_is_home_page();

	if ($is_home == false){ $nav_class = " inner-page";} else{ $nav_class = " front-page";}

	if(!isset($locations['primary']))
	{
		$return = '<ul class="clearfix '.$nav_class.'"> <li>Please configure the menu navigation</li></ul>';
	}
	else
	{
		$menu = wp_get_nav_menu_object($locations['primary']);

		$return = '';

		if(empty($menu))
		{
			$return = '<ul class="clearfix '.$nav_class.'"> <li>Please configure the menu navigation</li></ul>';
		}

		else
		{
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			
			_wp_menu_item_classes_by_context( $menu_items );

			$return = '<ul id="desktop-nav" class="clearfix '.$nav_class.'">' . "\n";
			
			$menunu = array();
			foreach((array)$menu_items as $key => $menu_item )
			{
				$menunu[ (int) $menu_item->db_id ] = $menu_item;
			}
			unset($menu_items);
			
			foreach ( $menunu as $i => $men ){
				if($men->menu_item_parent == '0')
				{
						//Specific additions
						if(( 'page' == $men->object ))
						{
				            $incl_onepage = get_post_meta($men->object_id,'one_page',true);
				            $small_title  = strtolower(preg_replace('/\s+/', '-', $men->post_excerpt));

		                    if($incl_onepage == 'yes' OR $incl_onepage == 'Yes')
		                    {
								$href =  '#'.$small_title;
								$identifyClass = "scroll-link is_onepage";
						    }
						    else
						    {
		                       $href = $men->url;
		                       $identifyClass = "not_onepage";
						    }				
						} 
						else 
						{
							$href =  $men->url;
							$identifyClass = "not_onepage";
							$small_title  = strtolower(preg_replace('/\s+/', '-', $men->title));
						}
						$return .= '<li>';
						$return .= '<a href="'. $href .'" class="'.$identifyClass.'" data-soffset="0">'. $men->title .'</a>';
						
						$has_sub_menu = 0;
						foreach ( $menunu as $submenu ){
							if($submenu->menu_item_parent == $men->ID)
							{
								$has_sub_menu = 1;
								
							}
						}
						
						if($has_sub_menu == 1)
						{
							$return .= '<ul>' . "\n";
						
							foreach ( $menunu as $submenu )
							{
								if($submenu->menu_item_parent == $men->ID)
								{
									$return .= '<li>';
									if(( 'page' == $submenu->object ))
									{
							            $incl_onepage = get_post_meta($submenu->object_id,'one_page',true);
							            $small_title  = strtolower(preg_replace('/\s+/', '-', $submenu->post_excerpt));

					                    if($incl_onepage == 'yes' OR $incl_onepage == 'Yes')
					                    {
											$href =  '#'.$small_title;
											$identifyClass = "scroll-link is_onepage";
									    }
									    else
									    {
					                       $href = $submenu->url;
					                       $identifyClass = "not_onepage";
									    }				
									} 
									else 
									{
										$href =  $submenu->url;
										$identifyClass = "not_onepage";
										$small_title  = strtolower(preg_replace('/\s+/', '-', $submenu->title));
									}
									$return .= '<a href="'. $href .'" class="'.$identifyClass.'" data-soffset="0">'. $submenu->title .'</a>';
									$return .= '</li>' . "\n";
								}
							}
							$return .= '</ul>' . "\n";
						}
						$return .= '</li>' . "\n";
				}
			}
			
			unset($menunu);	
				$return .= '</ul>' . "\n";
		}
	}
	echo $return;
}



function custom_mobile_menu()
{
	$locations = get_nav_menu_locations();
	$is_home = realm_is_home_page();

	if ($is_home == false){ $nav_class = " inner-page";} else{ $nav_class = " front-page";}


	if(!isset($locations['primary']))
	{
		$return = '<ul class="clearfix '.$nav_class.'"> <li>Please configure the menu navigation</li></ul>';
	}
	else
	{
		$menu = wp_get_nav_menu_object($locations['primary']);

		$return = '';

		if(empty($menu))
		{
			$return = '<ul class="clearfix '.$nav_class.'"> <li>Please configure the menu navigation</li></ul>';
		}

		else
		{
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			
			_wp_menu_item_classes_by_context( $menu_items );

			$return = '<ul id="mob-nav" class="clearfix '.$nav_class.'">' . "\n";
			
			$menunu = array();
			foreach((array)$menu_items as $key => $menu_item )
			{
				$menunu[ (int) $menu_item->db_id ] = $menu_item;
			}
			unset($menu_items);
			
			foreach ( $menunu as $i => $men ){
				if($men->menu_item_parent == '0')
				{
						//Specific additions
						if(( 'page' == $men->object ))
						{
				            $incl_onepage = get_post_meta($men->object_id,'one_page',true);
				            $small_title  = strtolower(preg_replace('/\s+/', '-', $men->post_excerpt));

		                    if($incl_onepage == 'yes' OR $incl_onepage == 'Yes')
		                    {
								$href =  '#'.$small_title;
								$identifyClass = "scroll-link is_onepage";
						    }
						    else
						    {
		                       $href = $men->url;
		                       $identifyClass = "not_onepage";
						    }				
						} 
						else 
						{
							$href =  $men->url;
							$identifyClass = "not_onepage";
							$small_title  = strtolower(preg_replace('/\s+/', '-', $men->title));
						}
						$return .= '<li>';
						$return .= '<a href="'. $href .'" class="'.$identifyClass.'" data-soffset="0">'. $men->title .'</a>';
						$return .= '</li>' . "\n";
						$has_sub_menu = 0;
						foreach ( $menunu as $submenu ){
							if($submenu->menu_item_parent == $men->ID)
							{
								$has_sub_menu = 1;
								
							}
						}
						
						if($has_sub_menu == 1)
						{
							foreach ( $menunu as $submenu )
							{
								if($submenu->menu_item_parent == $men->ID)
								{
									$return .= '<li>';
									if(( 'page' == $submenu->object ))
									{
							            $incl_onepage = get_post_meta($submenu->object_id,'one_page',true);
							            $small_title  = strtolower(preg_replace('/\s+/', '-', $submenu->post_excerpt));

					                    if($incl_onepage == 'yes' OR $incl_onepage == 'Yes')
					                    {
											$href =  '#'.$small_title;
											$identifyClass = "scroll-link is_onepage";
									    }
									    else
									    {
					                       $href = $submenu->url;
					                       $identifyClass = "not_onepage";
									    }				
									} 
									else 
									{
										$href =  $submenu->url;
										$identifyClass = "not_onepage";
										$small_title  = strtolower(preg_replace('/\s+/', '-', $submenu->title));
									}
									$return .= '<a href="'. $href .'" class="'.$identifyClass.'">'. $submenu->title .'</a>';
									$return .= '</li>' . "\n";
								}
							}
							
						}
						
				}
			}
			
			unset($menunu);	
				$return .= '</ul>' . "\n";
		}
	}
	echo $return;
}





/* CUSTOM EXCERPTS */

function realm_clean($excerpt, $substr=0) {
		$string = strip_tags(str_replace('[...]', '...', $excerpt));
		if ($substr>0) {
			$string = substr($string, 0, $substr);
		}
		return $string;
	}


/* PAGINATION */
	
	
	function getpagenavi(){
	?>
	<div id="blog_pagination" class="blog_pagination add-bottom">
	<?php if(function_exists('wp_pagenavi')) : ?>
	<?php wp_pagenavi(); ?>
	<?php else : ?>
			<div class="older"><?php next_posts_link(__('Older Entries','realmlang')) ?></div>
			<div class="newer"><?php previous_posts_link(__('Newer Entries','realmlang')) ?></div>
			<div class="clear"></div>
	<?php endif; ?>
	
	</div>
	
	<?php
	}




/*---------------------------------------
---------Format comment Callback-----------
-----------------------------------------*/

function format_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="panel clearfix cmntparent <?php
                        $authID = get_the_author_meta('ID');
                                                    
                        if($authID == $comment->user_id)
                           echo "cmntbyauthor";
                       else
                           echo "";
                        ?>">
			<div class="comment">


            				<div class="avatarbox">
            					<?php 
                                $defimg = get_stylesheet_directory_uri(). "/assets/img/human.png";
                                if(get_avatar($comment)):
                                	echo get_avatar($comment,$size='75');
                                else:
                                ?>
                                <img src="<?php echo $defimg; ?>"  alt="avatar" />
            					<?php endif; ?>
            				</div>
            				<div class="cmntbox">
            					<?php printf(__('<h4 class="">%s</h4>'), get_comment_author_link()) ?>
            					<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
            					
            					<?php edit_comment_link(__('Edit','realmlang'),'<span class="edit-comment">', '</span>'); ?>
                                
                                <?php if ($comment->comment_approved == '0') : ?>
                   					<div class="alert-box success">
                      					<?php _e('Your comment is awaiting moderation.','realmlang') ?>
                      				</div>
            					<?php endif; ?>
                                
                                <?php comment_text() ?>
                                
                                <!-- removing reply link on each comment since we're not nesting them -->
            					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                            </div>


			</div>
		</article>

<?php
}
function awesome_comment_form_submit_button($button) 
{
	$button =
		'<input name="submit" type="submit" class="form-submit" tabindex="5" id="[args:id_submit]" value="[args:label_submit]" />' .
		get_comment_id_fields();
	return $button;
}
add_filter('comment_form_submit_button', 'awesome_comment_form_submit_button');

function get_rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}



function gradient($HexFrom, $HexTo, $ColorSteps) {
  $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
  $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
  $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));

  $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
  $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
  $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));

  $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
  $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
  $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);

  $GradientColors = array();

  for($i = 0; $i <= $ColorSteps; $i++) {
    $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
    $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
    $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));

    $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
    $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
    $HexRGB['b'] = sprintf('%02x', ($RGB['b']));

    $GradientColors[] = implode(NULL, $HexRGB);
  }
  $GradientColors = array_filter($GradientColors, "len");
  return $GradientColors;
}

function len($val){
  return (strlen($val) == 6 ? true : false );
}

function getOptions($id = 0){
	if ($id == 0) :
		global $wp_query;
		$content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
			$id = $content_array->ID;
		}
	endif;   

	$first_array = get_post_custom_keys($id);

	if(isset($first_array)){
		foreach ($first_array as $key => $value) :
			   $second_array[$value] =  get_post_meta($id, $value, FALSE);
				foreach($second_array as $second_key => $second_value) :
						   $result[$second_key] = $second_value[0];
				endforeach;
		 endforeach;
	 }
	
	if(isset($result)){
		return $result;
	}
}
function getThemeOptions(){
	return array_merge(get_theme_mods());	
}
?>