<?php
/**
 * Template Name: Splash Page
 *
 * @author Designova (designova.net)
 * @theme Realm
*/
 get_header();	
 $options = get_option('realm');
?>

<div class="page page-section spalsh-page">
  <section class="container-fluid">
    <div class="row-fluid">
          <?php
          
            if(!isset($options['spalshpagecontent']))
            {
          ?>
          <article class="span12">
            <div class="realm-heading">
              
              <div class="">
                <h1><?php echo $options['home_page_title']; ?></h1>
                <h2><span><?php echo $options['home_page_subheading']; ?></span></h2>
              </div>
            </div>
          </article>
          <?php
            }
            else
            {
            ?>
            <article class="container home-page-view-port">
              <?php
                echo do_shortcode($options['splash_page_mega_content']);
              ?>
            </article>
            <?php
            }
          ?>
    </div>
  </section> 
</div> 

<?php
get_footer();
?>