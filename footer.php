<?php  $options = get_option('realm'); ?>

<?php
if(!isset($options['hide_footer_widget']))
{
?>
	<!-- Get ready starts -->
	<div id="get-ready" class="">
		<section class="container-fluid ready-bg">
			<div class="row-fluid">
				<section class="container">
					<?php
					if(!isset($options['show_custom_footer_content']))
					{
					?>
					<div class="row">
			
						<article class= "span8">
							<div>
								<p class="ready-main"><?php echo $options['footer_widget_title'];?></p>
								<p class="ready-sub"><?php echo $options['footer_widget_txt'];?></p>
							</div>
						</article><!-- // End of .span8-->

						<article class= "span4 top-space">
							<div><a class="realm-button" href="<?php echo $options['footer_widget_button_link'];?>"><?php echo $options['footer_widget_button_txt'];?></a></div>
						</article><!-- // End of .span4-->

					</div><!-- // End of .row -->
					<?php
					}
					else
					{
						echo do_shortcode($options['custom_footer_content']);
					}
					?>
				</section><!-- // End of .container -->		
			</div><!-- // End of .row-fluid -->
		</section><!-- // End of .container-fluid -->
	</div><!-- // End of #get-ready -->
	<!-- Get ready ends -->
<?php
}
?>
	<!-- Footer starts -->
	<div id="footer">
	
		<section class="container-fluid">
			<div class="row-fluid">
				<section class="container">
					<div class="row">
				
						<article class= "span4">
							<div class = "copyright">
								<p><?php echo $options['copy_txt'];?></p>
							</div>		
						</article><!-- // End of .span12-->

						<article class= "span8">
							<div class = "credits text-right">
								<p><?php echo $options['credit'];?></p>
							</div>		
						</article><!-- // End of .span12-->

					</div><!-- // End of .row -->
				</section><!-- // End of .container -->		
			</div><!-- // End of .row-fluid -->
		</section><!-- // End of .container-fluid -->
	</div><!-- // End of #footer -->
	<!-- Footer ends -->

	<!-- Dummy Button to trigger modal --> 
    <a href="#myModal" role="button" class="btn launch_modal hide hidden" data-toggle="modal">Launch modal</a> 
    
    <!-- Modal -->
    <div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close modal_close_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div id="myModalLabel" class="heading"><h3 class="sub_heading"><?php if($options['thanks_msg_header']){ echo $options['thanks_msg_header']; }?></h3></div>
        </div>
        <div class="modal-body">
            <p><?php if($options['thanks_msg']){ echo $options['thanks_msg']; }?></p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-inverse modal_close_btn" data-dismiss="modal" aria-hidden="true"><?php _e('Close','realmlang');?></button>
        </div>
    </div>


	<?php
		realm_custom_style();

		$loop = new WP_Query( array( 'post_type' => 'slider', 'orderby' => 'date', 'order' => 'DESC', 'paged'=> false, 'posts_per_page' => '-1' ) ); 
	    $slider_images = array();
	    if ($loop->have_posts()) { //$first = true;
	        while ($loop->have_posts()) : $loop->the_post();

	            $img_url = get_post_meta($post->ID,'slide_image',true);
	            array_push($slider_images, $img_url);

	        endwhile; 

	        wp_localize_script('invoke-backstretch', 'slides', $slider_images); 
	    }
	    else
	    {
	    	array_push($slider_images, get_stylesheet_directory_uri().'/images/bg/01.jpg');
	    	array_push($slider_images, get_stylesheet_directory_uri().'/images/bg/02.jpg');
	    	wp_localize_script('invoke-backstretch', 'slides', $slider_images); 
	    }
	    wp_reset_query();
		
		
		if($options['flickr_id'] != '')
    	{
			$flickrSetings = array('flickr_id' => $options['flickr_id'], 'flickr_item_limit' => $options['flickr_item_limit']);
			wp_localize_script('flickr-init', 'flickrSetings', $flickrSetings);
		}

		if($options['twitter_id'] != '')
    	{
			$twitter_options = array( 'twitter_id' => $options['twitter_id'], 'path' => get_stylesheet_directory_uri());
			wp_localize_script('tweet-init', 'tweetobj', $twitter_options);
		}

		wp_footer();
    ?>
</body>
</html>