<?php
	get_header();	
	$options = get_option('realm');
?>

<div id="error-page" class="page page-section">
  <section class="container-fluid page-bg-img ">
    <div class="row-fluid">
      <section class="container ">
        <div class="row">
            <div class="page-style span4">
              <h3><?php echo $options['err_title'];?></h3>
              <div class="about-style-img">
                <img src="<?php echo $options['err_icon'];?>" alt="<?php echo get_bloginfo('name'); ?>">
              </div>
            </div>
            <div class="page-style-details span8">
              <h3><?php echo $options['err_promo_heading']; ?></h3>
              <h5><?php echo $options['err_promo_sub_heading']; ?></h5>
              <p><?php echo $options['err_promo_txt']; ?></p>
            </div>
        </div>     
      </section>
    </div>
  </section>
</div>
    
<div class="clear"></div>

<?php
get_footer();
?>