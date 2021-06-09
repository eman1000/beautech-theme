<?php
/**
 * Template Name: Template Contact
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$title = get_field('title');

$hero_background_image = get_field('background_image');
$hero_background_picture = $hero_background_image['sizes']['large'];

$highlight_image_image = get_field('highlight_image');
$highlight_image_picture = $highlight_image_image['sizes']['large'];

$highlight_text = get_field('highlight_text');

$content_text_left = get_field('content_text_left');
$extra_text_left = get_field('extra_text_left');
$title_left = get_field('title_left');
$title_right_top = get_field('title_right_top');
$content_text_right_top = get_field('content_text_right_top');
$title_text_right_bottom = get_field('title_text_right_bottom');
$content_text_right_bottom = get_field('content_text_right_bottom');
?>


<!-- Top Banner -->
<div class="page-banner contact-us-banner" style="background-image: url('<?php echo $hero_background_picture; ?>');">
  <div class="container">
    <?php if($title):?>
      <h1><?php echo $title;?></h1>
    <?php endif;?>

  </div>
</div>
<!--/End Top Banner -->


<!-- Contact Header -->
<div class="page-pannel contact-header" data-aos="fade-in">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="contact-header-wrapper">
            <div class="main-image">
              <img alt="logo" src="<?php echo $highlight_image_picture; ?>"/>
            </div>
              <?php if($highlight_text):?>
                <p class="main-text"><?php echo $highlight_text;?></p>
              <?php endif;?>
          </div>
          
        </div>
        
      </div>
  </div>
</div>
<!-- /End Contact Header -->


<!-- Contact Info -->
<div class="page-pannel contact-panel" data-aos="fade-up">
  <div class="container">
      <div class="row">
        <div class="col-md-6  grad-wrapper">
          <div class="grad-panel pan-blue">
            <div class="small-wrapper">
              <?php if($title_left):?>
                <h2><?php echo $title_left;?></h2>
              <?php endif;?>
              <?php if($content_text_left):?>
                <p><?php echo $content_text_left;?></p>
              <?php endif;?>
                <div class="arrow-wrapper">
                  <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/long-arrow-right.svg" alt="arrow" />
                </div>

              <?php if($extra_text_left):?>
                <p><?php echo $extra_text_left;?></p>
              <?php endif;?>
            </div>
          </div>
        </div>
        <div class="col-md-6  grad-wrapper">
          <div class="grad-panel  pan-green">
            <div class="small-wrapper">
              <?php if($title_right_top):?>
                  <h2><?php echo $title_right_top;?></h2>
                <?php endif;?>
                <?php if($content_text_right_top):?>
                  <p><a href="tel:<?php echo $content_text_right_top;?>"><?php echo $content_text_right_top;?></a></p>
                <?php endif;?>
                <div class="arrow-wrapper">
                  <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/long-arrow-right.svg" alt="arrow" />
                </div>
            </div>
          </div>
          <div class="grad-panel pan-gold">
            <div class="small-wrapper">
              <?php if($title_text_right_bottom):?>
                  <h2><?php echo $title_text_right_bottom;?></h2>
                <?php endif;?>
                <?php if($content_text_right_bottom):?>
                  <p><?php echo $content_text_right_bottom;?></p>
                <?php endif;?>
                <div class="arrow-wrapper">
                  <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/long-arrow-right.svg" alt="arrow" />
                </div>
            </div>
       
          </div>
        </div>
        
      </div>
  </div>
</div>
<!-- /End Contact Info -->


<!-- Contact Form -->
<div class="page-pannel contact-form-pannel" data-aos="fade-in">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Leave us a message</h2>
          <div>
            <?php echo do_shortcode( '[contact-form-7 id="676" title="Contact form 1"]' ); ?>
          </div>
        </div>
        
      </div>
  </div>
</div>
<!-- /End Contact Form -->





<?php
get_footer();

