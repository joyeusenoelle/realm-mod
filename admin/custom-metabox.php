<?php
/*--Add a meta box for pages--*/
add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script('wp-color-picker');
}
function realm_define_page_metabox($post) 
{ 
  global $post,$realm_meta;
  //Existing Meta value
  $meta_one_page              = get_post_meta($post->ID,'one_page',true);
  $meta_page_promo_heading    = get_post_meta($post->ID,'page_promo_heading',true);
  $meta_page_promo_subheading = get_post_meta($post->ID,'page_promo_subheading',true);
  $meta_page_promo_text       = get_post_meta($post->ID,'page_promo_text',true);
  $meta_parallax_bg           = get_post_meta($post->ID,'parallax_bg',true);

  // Use nonce for verification
  wp_nonce_field(plugin_basename( __FILE__ ), 'realm_noncename' );

  //The title boost field
  

  if($meta_one_page =='yes')
  {
    $yes = 'checked="checked"';
    $no  = '';
  }
  elseif($meta_one_page =='no')
  {
    $no = 'checked="checked"';
    $yes = '';
  }
  else
  {
    $yes = 'checked="checked"';
    $no = '';
  }

  if($meta_page_promo_heading == null)
  {
    $pagePromoHeading = '';
  }
  else
  {
    $pagePromoHeading = $meta_page_promo_heading;
  }

  if($meta_page_promo_subheading == null)
  {
    $pagePromoSubheading = '';
  }
  else
  {
    $pagePromoSubheading = $meta_page_promo_subheading;
  }

  if($meta_page_promo_text == null)
  {
    $pagePromoText = '';
  }
  else
  {
    $pagePromoText = $meta_page_promo_text;
  }

  if($meta_parallax_bg == null)
  {
    $parallax_bg = '';
  }
  else
  {
    $parallax_bg = $meta_parallax_bg;
  }

  

  //Include in One page
  $html = "<div class='title_boost' style=\"border-top: solid 0px #DFDFDF;\">";
  $html .= '<div class="title_boost">';  
  $html .= "<h4 class='labelclass'>Include to Onepage?</h4>";
  $html .= '<input type="radio" id="amaze_hht" name="include_onepage" value="yes" '.$yes.' /> Yes &nbsp;&nbsp;';
  $html .= '<input type="radio" id="amaze_hht" name="include_onepage" value="no"  '.$no.'/> No';  
  $html .= '<br><small>';
  $html .= "If checked 'No' page will be excluded from single page layout.";
  $html .= '</small>'; 
  $html .= '</div>';
  $html .= '</div><br><hr>';

  //PAGE PROMO HEADING
  $html .= "<div class='title_boost' style=\"border-top: solid 0px #DFDFDF;\">";
  $html .= '<div class="title_boost">';  
  $html .= "<h4 class='labelclass'>Promo Heading</h4>";
  $html .= '<input type="text" style="width:300px;" id="page_promo_heading" name="page_promo_heading" value="'.$pagePromoHeading.'"/>';
  $html .= '</div>';
  $html .= '</div><br>';

  //PAGE PROMO SUB-HEADING
  $html .= "<hr><div class='title_boost' style=\"border-top: solid 0px #DFDFDF;\">";
  $html .= '<div class="title_boost">';  
  $html .= "<h4 class='labelclass'>Promo Sub-heading</h4>";
  $html .= '<input type="text" id="page_promo_subheading" style="width:300px;" name="page_promo_subheading" value="'.$pagePromoSubheading.'"/>';
  $html .= '</div>';
  $html .= '</div><br>';

  //PAGE PROMO TEXT
  $html .= "<hr><div class='title_boost' style=\"border-top: solid 0px #DFDFDF;\">";
  $html .= '<div class="title_boost">';  
  $html .= "<h4 class='labelclass'>Promo Text</h4>";
  $html .= '<textarea id="page_promo_text" style="width:300px; height:100px;" name="page_promo_text" >'.$pagePromoText.'</textarea>';
  $html .= '</div>';
  $html .= '</div><br>';

  $html .= '<hr>
            <div class="title_boost">
              <br>
              <div class="labelclass">Parallax Backgroud Image</div>
              <input readonly="readonly" id="img_url" value="'.$parallax_bg.'" name="parallax_bg"  class="kp_input_box" type="hidden"/>
              <input title="Upload" onclick="register_upload_button_event(jQuery(this));" class="kp_button_upload button" value="Add Image" type="button">
              <span style="padding-left:10px;"></span>
              <input title="Remove" onclick="register_remove_button_event(jQuery(this));" class="kp_button_remove button" value="Remove Image" type="button">
              <img class="image_preview" style="max-width:300px; display:block; clear:both; margin-top:10px;" src="'.$parallax_bg.'" title="Image URL" alt=""/>
            </div><br><br>';

  echo'<input type="hidden" name="submit_chk" value="" />';
  echo '<small>';
       _e("",'realmlang' );
  echo '</small>'; 
  

  echo $html;  

}
/*Invoke the box*/
function realm_create_page_metabox() 
{
  if ( function_exists('add_meta_box') ) 
  {
    add_meta_box( 'page', 'Options', 'realm_define_page_metabox', 'page', 'normal', 'high' );
	
  }
}

add_action('admin_init', 'menu_initialize_theme_options'); 

function menu_initialize_theme_options() {  
    add_settings_section(  
        'menu_settings_section',
        'menu Options',                  
        'menu_general_options_callback',
        'nav-menus.php'                            
    );  

    add_settings_field(  
        'test_field',                        
        'Test',                             
        'menu_test_field_callback',  
        'nav-menus.php',                            
        'menu_settings_section',         
        array(                             
            'Activate this setting to TEST.'  
        )  
    );

    register_setting(  
        'nav-menus.php',  
        'test_field'  
    );
}

function menu_test_field_callback($args) {  
    
}


/*-for saving the meta--*/
function realm_save_metaboxdata($post_id)
{
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
if(isset( $_POST['realm_noncename'])) 
{
    if ( !wp_verify_nonce( $_POST['realm_noncename'], plugin_basename( __FILE__ ) ) )
      return;
}
  // Check permissions
if(isset( $_POST['post_type'])) 
{
    if ( 'page' == $_POST['post_type'] ) 
    {
      if ( !current_user_can( 'edit_page', $post_id ) )
          return;
    }
    else
    {
      if ( !current_user_can( 'edit_post', $post_id ) )
          return;
    }

    
    
    
}
if(isset($_POST['submit_chk']))
  { 
    
    $onepage     = $_POST['include_onepage'];
    $page_promo_heading   = $_POST['page_promo_heading'];
    $page_promo_sub_heading   = $_POST['page_promo_subheading'];
    $page_promo_text = $_POST['page_promo_text'];
    $parallax_bg = $_POST['parallax_bg'];

    
    update_post_meta($post_id,'one_page',$onepage);
    update_post_meta($post_id,'page_promo_heading',$page_promo_heading);
    update_post_meta($post_id,'page_promo_subheading',$page_promo_sub_heading);
    update_post_meta($post_id,'page_promo_text',$page_promo_text);
    update_post_meta($post_id,'parallax_bg',$parallax_bg);
    

  } 

}

//Initialize
add_action('admin_menu', 'realm_create_page_metabox'); /*--Plug the metabox*/
add_action( 'save_post', 'realm_save_metaboxdata' ); /*--save metabox content*/



/*---------------------------------------------
-------------Portfolio Metaboxes---------------
----------------------------------------------*/
function realm_define_portfolio_metabox($post) 
{ 
  global $post,$realm_meta;

  //Existing Meta value
  $meta_project_caption = get_post_meta( $post->ID,'project_caption',true);
  $meta_project_url = get_post_meta( $post->ID,'project_url',true);
  $meta_project_thumb_size = get_post_meta( $post->ID,'project_thumb_size',true);
  $meta_expansion_image = get_post_meta( $post->ID,'expansion_image',true);

  

  $small_sqaure_select = '';
  $large_sqaure_select = '';
  $vert_rect_select = '';
  $hor_rect_select = '';

  if($meta_project_thumb_size == '1xsquare')
    $small_sqaure_select = 'selected="selected"';
  elseif($meta_project_thumb_size == '2xsquare')
    $large_sqaure_select = 'selected="selected"';
  elseif($meta_project_thumb_size == 'vert_rect')
    $vert_rect_select = 'selected="selected"';
  elseif($meta_project_thumb_size == 'hor_rect')
    $hor_rect_select = 'selected="selected"';

  
  if($meta_expansion_image == null || $meta_expansion_image == '')
    $expansion_image_style = 'style="display:none;"';
  else
    $expansion_image_style = '';

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'realm_portfolio_noncename' );




  
//PROJECT SUB HEADING
  $html  = '<div class="title_boost">';
  $html .= '<br><div class="labelclass">';
  $html .=  "Caption";
  $html .= '</div> ';
  $html .= '<input type="text" id="realm_project_caption" name="realm_project_caption" value="'.$meta_project_caption.'" size="45"/>'; 
  $html .= '</div>';

  //PROJECT URL
  $html .= '<br><div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><div class="labelclass">';
  $html .=  "External URL";
  $html .= '</div> ';
  $html .= '<input type="text" id="realm_project_url" name="realm_project_url" value="'.$meta_project_url.'" size="45"/>'; 
  $html .= '</div>';

//Thumbnail Size
  $html .= '<br><div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><div class="labelclass">';
  $html .=  "Choose the Thumbnail Size";
  $html .= '</div> ';
  $html .= '<select name="realm_project_thumb_size" style="min-width:100px;">
              <option value="1xsquare" '.$small_sqaure_select.'>230 X 230 (Small Square)</option>
              <option value="2xsquare" '.$large_sqaure_select.'>460 X 460 (Large Square)</option>
              <option value="vert_rect" '.$vert_rect_select.'>230 X 460 (Vertical Rectangle)</option>
              <option value="hor_rect" '.$hor_rect_select.'>460 X 230 (Horizontal Rectangle)</option>
            </select>'; 
  $html .= '</div>';

  //Expansion Image
  $html .= "<br><div class='title_boost'>";
  $html .= "<div class='labelclass'>Zoom image <small>(optional)</small></div>";
  $html .= "<input readonly='readonly' id='img_url' value='".$meta_expansion_image."' name='realm_expansion_image'  class='kp_input_box' type='hidden'>";
  $html .= "<input title='Upload' onclick='register_upload_button_event(jQuery(this));' class='kp_button_upload button' value='Add' type='button'>";
  $html .= "&nbsp;&nbsp;<input title='Remove' onclick='register_remove_button_event(jQuery(this));' class='kp_button_remove button' value='Remove' type='button'>";
  $html .= '<img class="image_preview" src="'.$meta_expansion_image.'" '.$expansion_image_style.' title="Image URL" alt="" width="300px">';
  $html .= "</div>";



  echo $html;

}
/*Invoke the box*/
function realm_create_portfolio_metabox() 
{
  if ( function_exists('add_meta_box') ) 
  {
    add_meta_box( 'project_caption', 'Portfolio Additions', 'realm_define_portfolio_metabox', 'portfolio_item', 'normal', 'high' );
    
  }
}
/*-for saving the meta--*/
function realm_save_portfolio_metabox($post_id)
{
  global $post;

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  if(isset( $_POST['realm_portfolio_noncename'])) 
  {
      if (!wp_verify_nonce( $_POST['realm_portfolio_noncename'], plugin_basename( __FILE__ ) ) )
        return;
  }
  // Check permissions
  if(isset($_POST['post_type']) AND isset($_POST['realm_project_caption']))
  if(isset($_POST['post_type']))
   {

      if ( 'portfolio_item' == $_POST['post_type'] ) 
      {
        if ( !current_user_can( 'edit_page', $post_id ) ) return;
      }
      else
      {
        if ( !current_user_can( 'edit_post', $post_id ) ) return;
      }

      $up_project_caption = $_POST['realm_project_caption'];
      $up_project_thumb_size = $_POST['realm_project_thumb_size'];
      $up_project_url = $_POST['realm_project_url'];
      $up_expansion_img = $_POST['realm_expansion_image'];


      update_post_meta($post_id, 'project_caption', $up_project_caption);
      update_post_meta($post_id, 'project_thumb_size', $up_project_thumb_size);
      update_post_meta($post_id, 'project_url', $up_project_url);
      update_post_meta($post_id, 'expansion_image', $up_expansion_img);
      
    }

      
}
//Initialize
add_action('admin_menu', 'realm_create_portfolio_metabox'); /*--Plug the metabox*/
add_action( 'save_post', 'realm_save_portfolio_metabox' ); /*--save metabox content*/

/*---------------------------------------------
-------------Team Metaboxes---------------
----------------------------------------------*/

function realm_define_team_metabox($post) 
{ 
  global $post,$realm_meta;

  //Existing Meta value
  $meta_member_image          = get_post_meta( $post->ID,'member_image',true);
  $meta_member_designation    = get_post_meta( $post->ID,'member_designation',true);
  $meta_member_description    = get_post_meta( $post->ID,'member_description',true);
  $meta_member_twitter        = get_post_meta( $post->ID,'member_twitter',true);
  

  


  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'realm_team_noncename' );

  
//Brief Image
  $html = "<div class='title_boost'>";
  $html .= "<div class='labelclass'>Profile Image <small>(554px X 554px Only)</small></div>";
  $html .= "<input value='".$meta_member_image."' name='realm_member_image'  class='kp_input_box' type='hidden'>";
  $html .= "<input title='Upload' onclick='register_upload_button_event(jQuery(this));' class='kp_button_upload button' value='Add' type='button'>";
  $html .= "&nbsp;<input title='Remove' onclick='register_remove_button_event(jQuery(this));' class='kp_button_remove button' value='Remove' type='button'>";
  $html .= "<br><br><img class='image_preview' src='".$meta_member_image."' title='Image URL' alt=''>";
  $html .= "<br><br></div>";
 //Designation 
  $html .= '<div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><div class="labelclass">';
  $html .=  "Member designation";
  $html .= '</div> ';
  $html .= '<input type="text" id="member_designation" name="member_designation" value="'.$meta_member_designation.'" size="35" />'; 
  $html .= '</div>';
  //Decription
  $html .= '<br><div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><div class="labelclass">';
  $html .=  "Short Bio";
  $html .= '</div> ';
  $html .= '<textarea cols="75" rows="10" id="member_description" name="member_description">'.$meta_member_description.'</textarea>'; 
  $html .= '<small>';
  $html .= "<br>Description for team member";
  $html .= '</small>';
  $html .= '</div>';
  
  //Twitter 
  $html .= '<br><div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><div class="labelclass">';
  $html .=  "Twitter ID";
  $html .= '</div> ';
  $html .= '<input type="text" id="member_twitter" name="member_twitter" value="'.$meta_member_twitter.'" size="30" />'; 
  $html .= '</div><br><br>';
 
  



  echo $html;

}
/*Invoke the box*/
function realm_create_team_metabox() 
{
  if ( function_exists('add_meta_box') ) 
  {
    add_meta_box( 'team_member', 'Team', 'realm_define_team_metabox', 'team', 'normal', 'high' );
  }
}
/*-for saving the meta--*/
function realm_save_team_metabox($post_id)
{
  global $post;

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  if(isset( $_POST['realm_team_noncename'])) 
  {
      if (!wp_verify_nonce( $_POST['realm_team_noncename'], plugin_basename( __FILE__ ) ) )
        return;
  }
  // Check permissions
  if(isset($_POST['post_type']) AND isset($_POST['realm_member_image']))
  if(isset($_POST['post_type']))
   {

      if ( 'team' == $_POST['post_type'] ) 
      {
        if ( !current_user_can( 'edit_page', $post_id ) ) return;
      }
      else
      {
        if ( !current_user_can( 'edit_post', $post_id ) ) return;
      }

      $image                = $_POST['realm_member_image'];
      $designation          = $_POST['member_designation'];
      $member_description   = $_POST['member_description'];
      $member_twitter       = $_POST['member_twitter'];
      
      update_post_meta($post_id, 'member_image', $image);
      update_post_meta($post_id, 'member_description', $member_description);
      update_post_meta($post_id, 'member_designation', $designation);
      update_post_meta($post_id, 'member_twitter', $member_twitter);
      
    }


        
}
//Initialize
add_action('admin_menu', 'realm_create_team_metabox'); /*--Plug the metabox*/
add_action( 'save_post', 'realm_save_team_metabox' ); /*--save metabox content*/




/*---------------------------------------------
-------------Spalsh Slider Metaboxes---------------
----------------------------------------------*/

function realm_define_slider_metabox($post) 
{ 
  global $post,$realm_meta;

  //Existing Meta value
  $meta_slide_image          = get_post_meta( $post->ID,'slide_image',true);
  
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'realm_slider_noncename' );

  
//Slide Image
  $html = "<br><div class='title_boost'>";
  $html .= "<input value='".$meta_slide_image."' name='realm_spalsh_slide_image'  class='kp_input_box' type='hidden'>";
  $html .= "<input title='Upload' onclick='register_upload_button_event(jQuery(this));' class='kp_button_upload button' value='Add' type='button'>";
  $html .= "&nbsp;<input title='Remove' onclick='register_remove_button_event(jQuery(this));' class='kp_button_remove button' value='Remove' type='button'>";
  $html .= "<br><br><img class='image_preview' src='".$meta_slide_image."' title='Image URL' alt='' style='max-width:90%;'>";
  $html .= "<br><br></div><br><br>";
 
  echo $html;

}
/*Invoke the box*/
function realm_create_slider_metabox() 
{
  if ( function_exists('add_meta_box') ) 
  {
    add_meta_box( 'sliders', 'Slider', 'realm_define_slider_metabox', 'slider', 'normal', 'high' );
  }
}
/*-for saving the meta--*/
function realm_save_slider_metabox($post_id)
{
  global $post;

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  if(isset( $_POST['realm_slider_noncename'])) 
  {
      if (!wp_verify_nonce( $_POST['realm_slider_noncename'], plugin_basename( __FILE__ ) ) )
        return;
  }
  // Check permissions
  if(isset($_POST['post_type']) AND isset($_POST['realm_spalsh_slide_image']))
  if(isset($_POST['post_type']))
   {

      if ( 'slider' == $_POST['post_type'] ) 
      {
        if ( !current_user_can( 'edit_page', $post_id ) ) return;
      }
      else
      {
        if ( !current_user_can( 'edit_post', $post_id ) ) return;
      }

      $image                = $_POST['realm_spalsh_slide_image'];
      
      
      update_post_meta($post_id, 'slide_image', $image);
      
      
    }


        
}
//Initialize
add_action('admin_menu', 'realm_create_slider_metabox'); /*--Plug the metabox*/
add_action( 'save_post', 'realm_save_slider_metabox' ); /*--save metabox content*/





/*---------------------------------------------
-------------Post Metaboxes---------------
----------------------------------------------*/
function realm_define_post_metabox($post) 
{ 
  global $post,$realm_meta;

  //Existing Meta value
 
  $meta_post_url = get_post_meta( $post->ID,'post_ext_url',true);
  $meta_post_embed_code = get_post_meta( $post->ID,'post_embed_code',true);
  $meta_post_quote = get_post_meta( $post->ID,'post_quote',true);
  $meta_post_slide_count = get_post_meta( $post->ID,'post_slide_count',true);
  $meta_post_slides = get_post_meta( $post->ID,'post_slides',true);

  //$meta_embed_code = str_replace("&rsquo;","'",$meta_embed_code);
  //$meta_embed_code = str_replace("&quot;",'"',$meta_embed_code);

  if($meta_post_slide_count == null)
    $meta_post_slide_count = 0;

  $post_slide_markup = '';

  if($meta_post_slide_count != 0)
  {
    $count = 0;
    $slide_counter = 1;
    foreach($meta_post_slides as $slides)
    {
      $post_slide_markup .= "<br>
                        <div class='title_boost'>
                          <br>
                          <div class='labelclass'>Slide <span class='slide_number'>".$slide_counter."</span></div>
                          <input readonly='readonly' id='img_url' value='".$slides."' name='realm_slide_image".$slide_counter."'  class='kp_input_box' type='hidden'>
                          <input title='Upload' onclick='register_upload_button_event(jQuery(this));' class='kp_button_upload button' value='Add Image' type='button'>
                          <span style='padding-left:10px;'></span>
                          <input title='Remove' onclick='register_remove_button_event(jQuery(this));' class='kp_button_remove button' value='Remove Image' type='button'>
                          <img class='image_preview' style='max-width:300px; display:block; clear:both; margin-top:10px;' src='".$slides."' title='Image URL' alt=''/>
                        </div>";
      $count++;
      $slide_counter++;
    }
  }

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'realm_post_noncename' );




  
//POST URL
  $html  = '<br><div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><div class="labelclass">';
  $html .=  "Link / External URL";
  $html .= '</div> ';
  $html .= '<input type="text" id="realm_post_url" name="realm_post_url" value="'.$meta_post_url.'" size="45"/>'; 
  $html .= '</div>';

//POST Embed Code
  $html .= '<br><div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><div class="labelclass">';
  $html .=  "Embed Code / iframe [For Video and Audio Posts]";
  $html .= '</div> ';
  $html .= '<input type="text" id="realm_post_embed_code" name="realm_post_embed_code" value="'.$meta_post_embed_code.'" size="45"/>'; 
  $html .= '</div>';
  $html .= '<small>Only iframes are allowed</small><br/>';

//POST Description
  $html .= '<br><div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><div class="labelclass">';
  $html .=  "Blockquote Content";
  $html .= '</div> ';
  $html .= '<textarea id="realm_post_quote" name="realm_post_quote" style="width:500px; height:200px;">'.$meta_post_quote.'</textarea>'; 
  $html .= '</div>';

  //Slide Images
  $html .= '<div class="slide_images">'.$post_slide_markup.'</div>';
  

  //ADD SLIDE BUTTON
  $html .= '<br><div class="title_boost" style="border-top: solid 1px #DFDFDF;">';
  $html .= '<br><a href="#" class="docopy-slides button">Add Image slide</a>'; 
  $html .= '</div><br>';

  $html .= '<input type="hidden" name="post_slide_count" id="slide_count" value="'.$meta_post_slide_count.'" />';

  echo $html;

}
/*Invoke the box*/
function realm_create_post_metabox() 
{
  if ( function_exists('add_meta_box') ) 
  {
     add_meta_box( 'page', 'Options', 'realm_define_post_metabox', 'post', 'normal', 'high' );
    
  }
}
/*-for saving the meta--*/
function realm_save_post_metabox($post_id)
{
  global $post;

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  if(isset( $_POST['realm_post_noncename'])) 
  {
      if (!wp_verify_nonce( $_POST['realm_post_noncename'], plugin_basename( __FILE__ ) ) )
        return;
  }
  // Check permissions
  if(isset($_POST['post_type']) AND isset($_POST['realm_post_noncename']))
  if(isset($_POST['post_type']))
   {

      if ( 'post' == $_POST['post_type'] ) 
      {
        if ( !current_user_can( 'edit_page', $post_id ) ) return;
      }
      else
      {
        if ( !current_user_can( 'edit_post', $post_id ) ) return;
      }

      
      $up_post_url = $_POST['realm_post_url'];
      $up_post_embed_code = $_POST['realm_post_embed_code'];
      $up_post_quote = $_POST['realm_post_quote'];
      $up_post_slide_count = $_POST['post_slide_count'];

      $up_post_embed_code = str_replace("'","&rsquo;",$up_post_embed_code);
      $up_post_embed_code = str_replace('"',"&quot;",$up_post_embed_code);

      $up_post_slides = array();

      if($up_post_slide_count != 0)
      {
        for($k=1; $k<=$up_post_slide_count; $k++)
        {
          if($_POST['realm_slide_image'.$k] != '')
          {
            array_push($up_post_slides,$_POST['realm_slide_image'.$k]);
          }
        }
      }

      $up_post_slide_count = sizeof($up_post_slides);
      
      update_post_meta($post_id, 'post_ext_url', $up_post_url);
      update_post_meta($post_id, 'post_embed_code', $up_post_embed_code);
      update_post_meta($post_id, 'post_quote', $up_post_quote);
      update_post_meta($post_id, 'post_slide_count', $up_post_slide_count);
      update_post_meta($post_id, 'post_slides', $up_post_slides);
    }

      
}
//Initialize
add_action('admin_menu', 'realm_create_post_metabox'); /*--Plug the metabox*/
add_action( 'save_post', 'realm_save_post_metabox' ); /*--save metabox content*/
?>