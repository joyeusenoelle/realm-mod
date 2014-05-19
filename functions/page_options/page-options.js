jQuery(function(jQuery) {
	
	
	jQuery('#media-items').bind('DOMNodeInserted',function(){
		jQuery('input[value="Insert into Post"]').each(function(){
				jQuery(this).attr('value','Use This Image');
		});
	});
		
	jQuery('.custom_clear_image_button').click(function() {
		var defaultImage = jQuery(this).closest("td").find('.custom_default_image').text();
		jQuery(this).closest("td").find('.custom_media_id').val('');
		jQuery(this).closest("td").find('.custom_media_image').attr('src', defaultImage);
		return false;
	});
	
	jQuery('.custom_media_upload').click(function() {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		wp.media.editor.send.attachment = function(props, attachment) {
	        jQuery('.custom_media_image').attr('src', attachment.url);
	        jQuery('.custom_media_url').val(attachment.url);
	        jQuery('.custom_media_id').val(attachment.id);
	        wp.media.editor.send.attachment = send_attachment_bkp;
	    }
	    wp.media.editor.open();	
	    return false;       
    });

	
	jQuery('.repeatable-add').click(function() {
		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		jQuery('input', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		field.insertAfter(fieldLocation, jQuery(this).closest('td'))
		return false;
	});
	
	jQuery('.repeatable-add-image').click(function() {
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		field = fieldLocation.clone(true,true);
		jQuery('input,textarea', field).each(function(){
			jQuery(this).attr('name', function(index, name) {
				if(name && !jQuery(this).hasClass("button")){
					jQuery(this).val("");
					return name.replace(/(\d+)/, function(fullMatch, n) {
						return Number(n) + 1;
					});
				}

			});

		});
		field.insertAfter(fieldLocation);
		return false;
	});
	
	jQuery('.repeatable-remove').click(function(){
		jQuery(this).parent().parent().remove();
		return false;
	});

	
		
	jQuery('.custom_repeatable').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort',
		stop: function(event, ui) { 
			jQuery('.custom_repeatable').each(function(){
				field_count=0;
				jQuery(this).find("li").each(function(){
					jQuery(this).find("input,textarea").each(function(){
						$this = jQuery(this);
						name_array=($this.attr("name")).split("[");
						$this.attr("name",name_array[0]+"["+field_count+"]");
					});
					field_count++;
				});
			});
		}
	});
		
});


jQuery("document").ready(function(){

	
	//change page template options show/hide
	jQuery("#page_template").change(function(){
			jQuery(".tp_options").each(function(){
				if(!jQuery(this).hasClass(jQuery("#page_template").val().replace(".php", ""))){
					jQuery(this).fadeOut();
				}
				else {
					jQuery(this).fadeIn();	
	
					if(jQuery("#tb_webpaint_activate_sidebar").attr("checked")){
						jQuery(".sidebar").show();
					}
					else{
						jQuery(".sidebar").hide();
					}
					
				}
			});
	
		//show/hide portfolio tab
		if(jQuery("#page_template").val().replace(".php", "").lastIndexOf("ortfolio")>0)
			jQuery("#portfolio-options").fadeIn();
		else {
			jQuery("#portfolio-options").fadeOut();
		}
		
				
		
		
		if(jQuery("#page_template").val().replace(".php", "")!="index" && jQuery("#page_template").val().replace(".php", "")!="blog")
			jQuery("#page-blog-options").fadeOut();
		else {
			jQuery("#page-blog-options").fadeIn();
		}
				
		//show/hide portfolio tab
		if(jQuery("#page_template").length){
			if(jQuery("#page_template").val().replace(".php", "").lastIndexOf("ortfolio")>0){
				jQuery("#page-portfolio-options").show();
			}
			else {
				jQuery("#page-portfolio-options").hide();
			}
		}
		
		
 	});
	
	
	jQuery("#tb_webpaint_portfolio_excerpt_active").click(function() {
		if(jQuery(this).attr("checked")){
			jQuery(".excerpt").fadeIn();
		}
		else{
			jQuery(".excerpt").fadeOut();
		}
	});
	
	
	//show/hide sidebar options
	jQuery("#tb_webpaint_activate_sidebar").click(function() {
		$this=jQuery(this).attr("checked");
		if($this){
			jQuery(".sidebar").fadeIn();
			jQuery(".portfolio-sidebar-inactive").fadeOut();
			jQuery(".portfolio-sidebar-active").fadeIn();
		}
		else{
			jQuery(".sidebar").fadeOut();
			jQuery(".portfolio-sidebar-inactive").show();
			if(jQuery("input[name=tb_webpaint_portfolio_items_row]:checked").val()=="one"){
				jQuery(".portfolio-sidebar-active").show();
			}
			else{

				jQuery(".portfolio-sidebar-active").hide();
			}
		}
	});


	//on load show/hide sidebar options
	if(jQuery("#tb_webpaint_activate_sidebar").attr("checked")) {
		jQuery(".sidebar").fadeIn();
		jQuery(".portfolio-sidebar-inactive").fadeOut();
		jQuery(".portfolio-sidebar-active").fadeIn();
	}
	else{
		jQuery(".sidebar").fadeOut();
		jQuery(".portfolio-sidebar-inactive").fadeIn();
		//jQuery(".portfolio-sidebar-active").fadeOut();
		if(jQuery("input[name=tb_webpaint_portfolio_items_row]:checked").val()=="one"){
	jQuery(".portfolio-sidebar-active").show();
	}
	else{     			
		jQuery(".portfolio-sidebar-active").hide();
	}
	}
	
	//show/hide title options
	jQuery("#tb_webpaint_activate_page_title").click(function(){	
		if(jQuery("#tb_webpaint_activate_page_title").attr("checked")) {
			jQuery(".headline").fadeOut();
		}
		else{
			jQuery(".headline").fadeIn();
		}
	});
	//on load show/hide title options
	if(jQuery("#tb_webpaint_activate_page_title").attr("checked")) {
		jQuery(".headline").hide();
	}
	else{
		jQuery(".headline").show();
	}
	
	//show/hide contact stuff
	if(jQuery("#page_template").length && jQuery("#page_template").val().replace(".php", "")!="contact"){
	jQuery(".gmap").hide();
	jQuery(".headimage").show();
}
else {
	jQuery(".gmap").show();
	jQuery(".headimage").hide();
};

//on load page template options show/hide
	jQuery(".tp_options").each(function(){
		if(jQuery("#page_template").length){
			if(!jQuery(this).hasClass(jQuery("#page_template").val().replace(".php", ""))){
				jQuery(this).hide();
			}
			else {
				jQuery(this).show();	
			}
		}
	});
	
	//on load show/hide portfolio tab
		if(jQuery("#page_template").length){
			if(jQuery("#page_template").val().replace(".php", "").lastIndexOf("ortfolio")<0){
				jQuery("#page-portfolio-options").hide();
			}
			else {
				jQuery("#page-portfolio-options").show();
			}
		}
	
	
	//Blog tab on load	
		if(jQuery("#page_template").length){
			if(jQuery("#page_template").val().replace(".php", "")!="index" && jQuery("#page_template").val().replace(".php", "")!="blog")
				jQuery("#page-blog-options").fadeOut();
			else {
				jQuery("#page-blog-options").fadeIn();
			}
		}
	
	//Portfolio Excerpt Actions
	if(jQuery("#page_template").length){
	 	if(jQuery("#page_template").val().replace(".php", "").lastIndexOf("ortfolio")>0){
	 		if(jQuery("#tb_webpaint_portfolio_excerpt_active").attr("checked")){
	 			jQuery(".excerpt").show();
	 		}
	 		else{
	 			jQuery(".excerpt").hide();
	 		}
	 	} 
 	}
	
	
	//post type options onclick
	jQuery("input[name=\"tb_webpaint_post_type\"]").click(function(){
		postType = jQuery(this).val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
	});

	//post video options onclick
jQuery("input[name=\"tb_webpaint_video_type\"]").click(function(){
		postType = jQuery(this).val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
	});

//post video options onclick
jQuery("input[name=\"tb_webpaint_image_type\"]").click(function(){
		postType = jQuery(this).val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
	});

//onload post type options
	postType = jQuery("input[name=tb_webpaint_post_type]:checked").val();
	jQuery(".post_type").each(function(){
		$this=jQuery(this);
		if($this.hasClass(postType)) $this.show();
		else $this.hide();
	});

	if(postType=="video"){
		postType = jQuery("input[name=tb_webpaint_video_type]:checked").val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
}


//post external link onclick
jQuery("input[name=\"tb_webpaint_portfolio_link\"]").click(function(){
		postType = jQuery(this).val();
		jQuery(".post_link").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
	});

//onload external link
	postType = jQuery("input[name=tb_webpaint_portfolio_link]:checked").val();
	jQuery(".post_link").each(function(){
		$this=jQuery(this);
		if($this.hasClass(postType)) $this.show();
		else $this.hide();
	});

if(jQuery("input[name=tb_webpaint_video_width]").val()==""){
	jQuery("input[name=tb_webpaint_video_width]").val("500");
}

if(jQuery("input[name=tb_webpaint_video_height]").val()==""){
	jQuery("input[name=tb_webpaint_video_height]").val("281");
}

jQuery("#tb_webpaint_activate_slider").click(function() {
	$this=jQuery(this).attr("checked");
	if($this){
			jQuery(".slider_content").fadeIn();
		}
		else{
			jQuery(".slider_content").fadeOut();
	}
});

if(jQuery("#tb_webpaint_activate_slider").attr("checked")){
	jQuery(".slider_content").show();
}
else{
	jQuery(".slider_content").hide();
}


postType = jQuery("input[name=tb_webpaint_video_type]:checked").val();
	jQuery(".video_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
	});



});
