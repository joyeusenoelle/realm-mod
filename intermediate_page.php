<?php
/**
 * Template Name: Intermediate Page
 *
 * @author Designova (designova.net)
 * @theme Realm
*/
 get_header();	
 $options = get_option('realm');

 $parallax_bg =  get_post_meta(get_the_ID(),'parallax_bg',true);
?>

<div  class="">
  <section class="container-fluid">
    <div class="row-fluid" >
      <div style="background:  url('<?php echo $parallax_bg;?>') repeat; background-size:100%;" data-stellar-background-ratio=".5" class="home-page-view-port" >
        <div class="intermediate-page">
          <section class="container">
            <div class="row">
              <article class="span12">
                <?php 
			      	if ( have_posts() ) while ( have_posts() ) : the_post(); 
			    	the_content();
			    	endwhile; // end of the loop. 
			    ?>
              </article>
            </div>
          </section>
        </div>
      </div><!-- row-fuild : ends -->   
    </div>  
  </section> <!-- container-fluid : ends-->
</div>

<?php
get_footer();
?>