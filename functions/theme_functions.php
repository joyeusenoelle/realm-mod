<?php

	if ( ! isset( $content_width ) ) $content_width = 960;


//Register Main Navigation
	if ( function_exists( 'register_nav_menu' ) ) {
		register_nav_menu( 'navigation', 'Main Navigation' );
	}
	
//Featured Image Support	
	add_theme_support( 'post-thumbnails' );

//Walker Extension if necessary
	class description_walker extends Walker_Nav_Menu
	{
	      function start_el(&$output, $item, $depth, $args)
	      {
	           global $wp_query;
	           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	           $class_names = $value = '';

	           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

	           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	           $class_names = ' class="'. esc_attr( $class_names ) . '"';

	           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

	           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	           if(($item->type=="custom" && $item->url=="#") || $item->type!="custom"){
	           		$attributes .= ! empty( $item->url )        ? ' href="#'   . esc_attr( sanitize_title($item->title)       ) .'"' : '';
	           }
	           else{
	           		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url ) .'"' : '';
	           }
	           $prepend = '';
	           $append = '';
	           	
	           if($depth == 0)
	           {
	               $description_before = $description_after = $append = $prepend = "";
	           }
	           else{
		           $description_after = '</div>';
		           $description_before = '<div class="menuresizer">';
	           }

	            $item_output = $args->before;
	            $item_output .= $description_before.'<a'. $attributes .'>';
	            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
	            $item_output .= '</a>'.$description_after;
	            
	            $item_output .= $args->after;

	            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	            }
	}


//Custom Excerpts
	function excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	
		return $excerpt;
	}
	
	function content($limit) {
		$excerpt = explode(' ', get_the_content(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	
		if($limit<1) $excerpt = "";
	
		return $excerpt;
	}
	
	function excerpt_by_id($limit,$post_id) {
		global $post;  
		$save_post = $post;
		$post = get_post($post_id);
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		$post = $save_post;
		return $excerpt;
	}
	
	function complete_excerpt($length_callback='', $more_callback='') {

        if(function_exists($more_callback)){
            add_filter('excerpt_more', $more_callback);
        }

        if(function_exists($length_callback)){
            add_filter('excerpt_length', $length_callback);
        }

        $output = get_the_excerpt();

        if( empty( $output ) ){ 
            $excerpt = get_the_content();
            $excerpt = preg_replace('/\[(.*)\]/','',$excerpt);
            $excerpt = esc_attr( strip_tags( stripslashes( $excerpt ) ) );
            $excerpt = wp_trim_words( $excerpt, ( (function_exists($length_callback)) ? call_user_func($length_callback,55) : 55 ), ( (function_exists($more_callback)) ? call_user_func($more_callback) : '' ) );

            $output = $excerpt;
        }

        $output = apply_filters('wptexturize', $output);
        $output = apply_filters('convert_chars', $output);
        return $output;
}

//Get Special Categories */
	function getCategories($id){
		$categories = get_the_category($id);
		$output = '';
		if($categories){
			foreach($categories as $category) {
				$output .= '<div class="blogcategory"><a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'tb_webpaint' ), $category->name ) ) . '">'.$category->cat_name.'</a></div>';
			}
		return $output;
		}
	}

//Get all Page Options as Array
/*	function getOptions($id = 0){
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

//Get all Theme Options as Array
	function getThemeOptions(){
		return array_merge(get_theme_mods());	
	}*/


//ID by Slug
	function idbyslug($page_slug) {
		$page = get_page_by_path($page_slug);
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
	};

//Add classes to the first and last Widget
	function widget_first_last_classes($params) {
		global $my_widget_num; // Global a counter array
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	
	
		if(!$my_widget_num) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}
	
		if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}
	
		if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}
	
		$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options
	
		if($my_widget_num[$this_id] == 1 && $my_widget_num[$this_id] != count($arr_registered_widgets[$this_id])) { // If this is the first widget
			$class .= ' first ';
		} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
			$class .= ' last ';
		}
	
		$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"
	
		return $params;
	}
	add_filter('dynamic_sidebar_params','widget_first_last_classes');


//Special Comment Reply Link
	function special_comment_reply_link($args = array(), $comment = null, $post = null) {
	        global $user_ID;
	
	        $defaults = array('add_below' => 'comment', 'respond_id' => 'respond', 'reply_text' => __('Reply','tb_webpaint'),
	                'login_text' => __('Log in to Reply','tb_webpaint'), 'depth' => 0, 'before' => '', 'after' => '');
	
	        $args = wp_parse_args($args, $defaults);
	
	        if ( 0 == $args['depth'] || $args['max_depth'] <= $args['depth'] )
	                return;
	
	        extract($args, EXTR_SKIP);
	
	        $comment = get_comment($comment);
	        if ( empty($post) )
	                $post = $comment->comment_post_ID;
	        $post = get_post($post);
	
	        if ( !comments_open($post->ID) )
	                return false;
	
	        $link = '';
	
	        if ( get_option('comment_registration') && !$user_ID )
	                $link = '<a rel="nofollow" class="comment-reply-login tpbutton buttondark leftfloat" href="' . esc_url( wp_login_url( get_permalink() ) ) . '">' . $login_text . '</a>';
	        else
	                $link = "<a class='comment-reply-link tpbutton buttondark leftfloat' href='" . esc_url( add_query_arg( 'replytocom', $comment->comment_ID ) ) . "#" . $respond_id . "' onclick='return addComment.moveForm(\"$add_below-$comment->comment_ID\", \"$comment->comment_ID\", \"$respond_id\", \"$post->ID\")'> - $reply_text</a>";
	        return apply_filters('comment_reply_link', $before . $link . $after, $args, $comment, $post);
	}


/**
* Title		: Aqua Resizer
* Description	: Resizes WordPress images on the fly
* Version	: 1.1.4
* Author	: Syamil MJ
* Author URI	: http://aquagraphite.com
* License	: WTFPL - http://sam.zoy.org/wtfpl/
* Documentation	: https://github.com/sy4mil/Aqua-Resizer/
*
* @param string $url - (required) must be uploaded using wp media uploader
* @param int $width - (required)
* @param int $height - (optional)
* @param bool $crop - (optional) default to soft crop
* @param bool $single - (optional) returns an array if false
* @uses wp_upload_dir()
* @uses image_resize_dimensions()
* @uses image_resize()
*
* @return str|array
*/

function aq_resize( $url, $width, $height = null, $crop = null, $single = true, $retina = false ) {

 //validate inputs
 if(!$url OR !$width ) return false;

 //define upload path & dir
 $upload_info = wp_upload_dir();
 $upload_dir = $upload_info['basedir'];
 $upload_url = $upload_info['baseurl'];

 //check if $img_url is local
 if(strpos( $url, $upload_url ) === false) return false;

 //define path of image
 $rel_path = str_replace( $upload_url, '', $url);
 $img_path = $upload_dir . $rel_path;

 //check if img path exists, and is an image indeed
 if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;

 //get image info
 $info = pathinfo($img_path);
 $ext = $info['extension'];
 list($orig_w,$orig_h) = getimagesize($img_path);

 //get image size after cropping
 $dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
 $dst_w = $dims[4];
 $dst_h = $dims[5];

 //use this to check if cropped image already exists, so we can return that instead
 $suffix = "{$dst_w}x{$dst_h}";
 $dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
 $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

 //Retina Image
 if($retina){
  if(!$dst_h) {
   //can't resize, so return original url
   $img_url = $url;
   $dst_w = $orig_w;
   $dst_h = $orig_h;
  }
  //else check if cache exists
  elseif(file_exists(str_replace(".".$ext,"@2x.".$ext,$destfilename)) && getimagesize(str_replace(".".$ext,"@2x.".$ext,$destfilename))) {
   $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}@2x.{$ext}";
  } 
  //else, we resize the image and return the new resized image url
  else {
   // Note: This pre-3.5 fallback check will edited out in subsequent version
   if(function_exists('wp_get_image_editor')) {
    $editor = wp_get_image_editor($img_path);
    if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width*2, $height*2, $crop ) ) )
     return false;
 
    $resized_img_path = $editor->save();
 
   } else {
    $resized_img_path = image_resize( $img_path, $width*2, $height*2, $crop ); // Fallback foo
   }
 
   if(!is_wp_error($resized_img_path)) {
    rename($resized_img_path["path"], str_replace(".".$ext,"@2x.".$ext,$destfilename));
   } else {
    return false;
   }
 
  }
 }
 

 if(!$dst_h) {
  //can't resize, so return original url
  $img_url = $url;
  $dst_w = $orig_w;
  $dst_h = $orig_h;
 }
 //else check if cache exists
 elseif(file_exists($destfilename) && getimagesize($destfilename)) {
  $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
 } 
 //else, we resize the image and return the new resized image url
 else {
  // Note: This pre-3.5 fallback check will edited out in subsequent version
  if(function_exists('wp_get_image_editor')) {
   $editor = wp_get_image_editor($img_path);

   if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
    return false;

   $resized_img_path = $editor->save();

  } else {
   $resized_img_path = image_resize( $img_path, $width, $height, $crop ); // Fallback foo
  }

  if(!is_wp_error($resized_img_path)) {
   $resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
   $img_url = $upload_url . $resized_rel_path;
  } else {
   return false;
  }

 }

 //return the output
 if($single) {
  //str return
  $image = $img_url;
 } else {
  //array return
  $image = array (
   0 => $img_url,
   1 => $dst_w,
   2 => $dst_h
  );
 }


$image = $suffix == "x" ? "{$upload_url}{$dst_rel_path}.{$ext}" : "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}"; 

 return $image;
}



//Color Hex to RGB
	function HexToRGB($hex) {
		$hex = ereg_replace("#", "", $hex);
		$color = array();
 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
 
		return $color;
	}
	
//Parse Uneeded Half Open Tags
	function fix_shortcodes($content){
			$columns = array("one-half","one-third","two-third","one-fourth","three-fourth","one-fifth","two-fifth","three-fifth","four-fifth","one-sixth","five-sixth","intro","divider","button","tabs","tab","dropcap","socialbar","sharebar","toggle","box","codebox","headline","headsubline","contact-form-7","latest_posts","latest_projects","portfolio_info_set","portfolio_info","portfolio","testimonials","quote","checklist","twitter","facebook_page","dribbble","flickr","client","client_list","pricetable_column","pricetable","tbicon","contact_info","darkframe","gmap","spacer","rev_slider","progbar","progress","darkblock","showcase","latest_projects_carousel","parallaxblock","blackblock","portfolio_info_set","portfolio_info");
	        $block = join("|",$columns);

			// opening tag
			$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			
			// closing tag
			$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);
			
			return $rep;
	}
	add_filter('the_content', 'fix_shortcodes');
	
//Allow Contact Form 7 Forms to include shortcodes
	
	add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );	
	
	function mycustom_wpcf7_form_elements( $form ) {
		$array = array (
	                '<p>[' => '[',
	                ']</p>' => ']',
	                ']<br />' => ']'
	        );
	    $form = strtr($form, $array);
		$form = do_shortcode( $form );
		return $form;
	}

//Add shortcode support to widgets
add_filter('widget_text', 'do_shortcode');

//Rebuild Search Form
	function rebuild_search_form($form) {
	
	    $form = '<form class="searchform" method="get" action="'.get_bloginfo("url").'">
	        <input type="text" name="s" value="'. __('type and hit enter', 'tb_webpaint') .'" onfocus="this.value=\'\'" onblur="this.value=\''. __('type and hit enter', 'tb_webpaint') .'\'"/>
	      </form>';
	    return $form;
		
	}
	add_filter( 'get_search_form', 'rebuild_search_form' );

//Get RevSlider Property
	function get_revslider_property($slider,$property){
		global $wpdb;
		global $table_prefix;
		$table_prefix = $wpdb->base_prefix;
		if (!isset($wpdb->tablename)) {
			$wpdb->tablename = $table_prefix . 'revslider_sliders';
		}
		$revolution_sliders = $wpdb->get_results(
			"
			SELECT params
			FROM $wpdb->tablename
			WHERE alias='$slider'
			"
		);
		if(is_array($revolution_sliders[0]))
			foreach($revolution_sliders[0] as $key => $value){
				$vowels = array("{", "}", '"');
			 	$sliderparams = str_replace($vowels,"",$value);
			 	$sliderparams_array = split(",", $sliderparams);
			 	foreach($sliderparams_array as $sliderparam){
				 	$sliderparam_array = split(":",$sliderparam);
				 	if(isset($sliderparam_array[0]) && $sliderparam_array[0]==$property){
					 	$return_value = $sliderparam_array[1];
					 	break;
				 	}
			 	}
			}
		if(!empty($return_value))	
			return $return_value;
	}

//Get all Tags
	function wp_get_all_tags( $args = '' ) {
	  $tags = get_terms('post_tag');
	  foreach ( $tags as $key => $tag ) {
	      if ( 'edit' == 'view' )
	          $link = get_edit_tag_link( $tag->term_id, 'post_tag' );
	      else
	          $link = get_term_link( intval($tag->term_id), 'post_tag' );
	      if ( is_wp_error( $link ) )
	          return false;
	
	      $tags[ $key ]->link = $link;
	      $tags[ $key ]->id = $tag->term_id;
	      $tags[ $key ]->name = $tag->name;
	      echo ' <li><a href="'. $link .'">' . $tag->name . '</a></li>';
	      }
	  return $tags;
	}
	
//Get all Custom Post Types
	function get_registered_post_types() {
	    global $wp_post_types;
	
	    return array_keys( $wp_post_types );
	}
	
//Get the excluded Categories from the Portfolio	
	function get_excluded_portfolio_categories($post_id){
		$page_options = getOptions($post_id);
		$taxonomy = 'category_portfolio';
		$tax_terms = get_terms($taxonomy);
		$categories = "";

		if( !empty($page_options["tb_webpaint_portfolio_categories"]) && !in_array("all", $page_options["tb_webpaint_portfolio_categories"])){
			foreach ($tax_terms as $tax_term) {
				if(!in_array($tax_term->slug,$page_options["tb_webpaint_portfolio_categories"]))
					$categories[] = $tax_term->term_id;
			}
		}
		return $categories;
	}

//Get adjacent Portfolio Posts
	function get_adjacent_portfolio_post( $in_same_cat = false, $excluded_categories = '', $previous = true, $taxonomy = 'category_portfolio' ) {
	global $post, $wpdb;

	if ( empty( $post ) )
		return null;

	$current_post_date = $post->post_date;

	$join = '';
	$posts_in_ex_cats_sql = '';
	if ( $in_same_cat || ! empty( $excluded_categories ) ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

		if ( $in_same_cat ) {
			$cat_array = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
			$join .= " AND tt.taxonomy = '$taxonomy' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
		}

		$posts_in_ex_cats_sql = "AND tt.taxonomy = '$taxonomy'";
		if ( ! empty( $excluded_categories ) ) {
			if ( ! is_array( $excluded_categories ) ) {
				// back-compat, $excluded_categories used to be IDs separated by " and "
				if ( strpos( $excluded_categories, ' and ' ) !== false ) {
					_deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded categories.','tb_webpaint' ), "'and'" ) );
					$excluded_categories = explode( ' and ', $excluded_categories );
				} else {
					$excluded_categories = explode( ',', $excluded_categories );
				}
			}

			$excluded_categories = array_map( 'intval', $excluded_categories );
				
			if ( ! empty( $cat_array ) ) {
				$excluded_categories = array_diff($excluded_categories, $cat_array);
				$posts_in_ex_cats_sql = '';
			}

			if ( !empty($excluded_categories) ) {
				$posts_in_ex_cats_sql = " AND tt.taxonomy = '$taxonomy' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_cat, $excluded_categories );
	$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.* FROM $wpdb->posts AS p $join $where $posts_in_ex_cats_sql $sort";
	//echo $query;
	$query_key = 'adjacent_post_' . md5($query);
	$result = wp_cache_get($query_key, 'counts');
	if ( false !== $result )
		return $result;

	$result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $posts_in_ex_cats_sql $sort");
	if ( null === $result )
		$result = '';

	wp_cache_set($query_key, $result, 'counts');
	return $result;
}


//Change ReadMore [...]
	function new_excerpt_more( $more ) {
		return "...";
	}
	add_filter('excerpt_more', 'new_excerpt_more');

?>
