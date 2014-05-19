<?php 
/*=================================================
	Setting up the default thumbnail sizes
================================================== */


//Setting default thumbnail size for portfolio
add_image_size('blog_thumb', 460, 460, true);

//Setting default featured image size for blog
//add_image_size('blog_featured_img', 630, 420, true);

//Function to crop all thumbnails
if(false === get_option("thumbnail_crop")) {
add_option("thumbnail_crop", "1");
} else {
update_option("thumbnail_crop", "1");
}

?>