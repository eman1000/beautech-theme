<?php
/**
 * Template Name: Template Home
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
$hero_tags = get_field('hero_tags');

$hero_tags = preg_replace('/\.$/', '', $hero_tags); //Remove dot at end if exists
$hero_tags = explode(', ', $hero_tags); //split string into array seperated by ', '

$hero_extra_text = get_field('extra_text');
$hero_extra_text = get_field('extra_text');

$hero_button_text_1 = get_field('button_text_1');
$hero_button_text_2 = get_field('button_text_2');

$hero_button_link_1 = get_field('button_link_1');
$hero_button_link_2 = get_field('button_link_2');

$hero_background_image = get_field('background_image');
$hero_background_picture = $hero_background_image['sizes']['large'];


$home_about_title = get_field('about_title');
$home_about_text = get_field('about_text');

$home_about_title = get_field('about_title');
$home_about_text = get_field('about_text');

$home_services_title = get_field('home_services_title');
$service_1 = get_field('service_1');
$service_2 = get_field('service_2');
$service_3 = get_field('service_3');
$service_4 = get_field('service_4');
$service_1_icon = get_field('service_1_icon');
$service_2_icon = get_field('service_2_icon');
$service_3_icon = get_field('service_3_icon');
$service_4_icon = get_field('service_4_icon');

$gallery_title = get_field('gallery_title');
$images = get_field('gallery');


$modal_header_image = get_field('modal_header_image')['sizes']['large'];
$modal_title = get_field('modal_title');
$modal_main_text = get_field('modal_main_text');
$modal_button_link = get_field('modal_button_link');

$taxonomy     = 'product_cat';
//$orderby      = 'date';  
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no  
$title        = '';  
$empty        = 0;

$args = array(
       'taxonomy'     => $taxonomy,
       //'orderby'      => $orderby,
       'show_count'   => $show_count,
       'pad_counts'   => $pad_counts,
       'hierarchical' => $hierarchical,
       'title_li'     => $title,
       'hide_empty'   => $empty
);
$all_categories = get_categories( $args );

$numOfCols = 4;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;

?>





<!-- Top Banner -->
<div class="page-banner" style="background-image: url('<?php echo $hero_background_picture; ?>');">
  <div class="container">
    <?php if($title):?>
    <h1><?php echo $title;?></h1>
    <?php endif;?>
    <div class="tags-holder">
      <?php foreach($hero_tags as $value){?>
        <div data-aos="fade-right">
          <?php echo $value; ?>
        </div>
      <?php } ?>
    </div>

    <?php if($hero_extra_text):?>
      <div  data-aos="fade-up" class="text-extra gold-gradient-text">
        <?php echo $hero_extra_text; ?>
      </div>
    <?php endif;?>


    <div class="buttons-holder" data-aos="fade-up">
      <?php if($hero_button_text_1):?>
        <a href="<?php echo $hero_button_link_1; ?>" class="btn btn-gradient"><?php echo $hero_button_text_1; ?></a>
      <?php endif;?>
      
      <?php if($hero_button_text_2):?>
        <a  href="<?php echo $hero_button_link_2; ?>" class="btn btn-primary"><?php echo $hero_button_text_2; ?></a>
      <?php endif;?>
    </div>
  </div>
</div>
<!--/End Top Banner -->





<!--About Us -->
<div class="page-pannel about-us-panel" data-aos="fade-up">
  <div class="container">
    <?php if($home_about_title):?>
      <h2 class="gold-gradient-text"><?php echo $home_about_title;?></h2>
    <?php endif;?>


    <?php if($home_about_title):?>
      <div class="paragraph-area">
        <?php echo $home_about_text;?>
      </div>
    <?php endif;?>
  </div>
</div>
<!--/End  About Us -->






<!--Our Products -->
<div id="products" class="page-pannel products-panel" data-aos="fade-up">
<div class="container">
    <h2 class="gold-gradient-text">Our</h2>
    <h2 class="gold-gradient-text">Products</h2>


    
    <div class="row card-items">
      <?php  foreach ($all_categories as $cat) {?>

        <?php if($cat->category_parent == 0 && $cat->name != 'Uncategorized'):?>

        <div class="col-xl-4 col-lg-6 card" data-aos="zoom-in">
          <div class="card-top">
            <div class="card-left card-dark">
              <img class="card-icon" src="<?php echo get_field('product_cat_icon_name', 'product_cat_' . $cat->term_id)['url'];?>" />
            </div>
            <div class="card-right">
              <h6><?php echo $cat->name;?></h6>
              <p><?php echo get_field('product_cat_short_description', 'product_cat_' . $cat->term_id);?></p>
            </div>
          </div>

          <div class="card-body">
            <p class="card-text"><?php echo $cat->description;?></p>
  
          </div>

          <div class="card-footer bg-transparent border-transparent">
            <a href="<?php echo get_term_link($cat->slug, 'product_cat');?>" class="btn btn-iconed">
              <span  class="btn-text">Learn More</span>
              <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/arrow-right.svg" alt="arrow" />
            </a>
          </div>
        </div>
        <?php endif;?>
      <?php } ?>

    </div>
  </div>
</div>
<!--/End Our Products -->




<!--Our Services -->
<div id="services" class="page-pannel services-panel"  data-aos="fade-up">
  <div class="container">
    <?php if($home_services_title): ?>
      <h2 class="gold-gradient-text"><?php echo $home_services_title; ?></h2>
    <?php endif; ?>

    <div class="s-card-items">

      <div class="row">
        
        <?php if($service_1): ?>
          <div class="col-sm-6"  data-aos="zoom-in">
            <div class="card">
              <div class="card-left">
                <img class="card-icon" src="<?php echo $service_1_icon['url'];?>" />
              </div>
              <div class="card-right">
                <span><?php echo $service_1; ?></span>
              </div>
            </div>
          </div>
        <?php endif ?>

        <?php if($service_2): ?>
          <div class="col-sm-6"  data-aos="zoom-in">
            <div class="card">
              <div class="card-left">
                <img class="card-icon" src="<?php echo $service_2_icon['url'];?>" />
              </div>
              <div class="card-right">
                <span><?php echo $service_2; ?></span>
              </div>
            </div>
          </div>
        <?php endif ?>



      </div>

      <div class="row">

      <?php if($service_3): ?>
          <div class="col-sm-6"  data-aos="zoom-in">
            <div class="card">
              <div class="card-left">
                <img class="card-icon" src="<?php echo $service_3_icon['url'];?>" />
              </div>
              <div class="card-right">
                <span><?php echo $service_3; ?></span>
              </div>
            </div>
          </div>
        <?php endif ?>

        <?php if($service_4): ?>
          <div class="col-sm-6"  data-aos="zoom-in">
            <div class="card">
              <div class="card-left">
                <img class="card-icon" src="<?php echo $service_4_icon['url'];?>" />
              </div>
              <div class="card-right">
                <span><?php echo $service_4; ?></span>
              </div>
            </div>
          </div>
        <?php endif ?>


      </div>
    </div>
  </div>
</div>
<!--/End Our Services -->





<!--Our Work -->
<div class="page-pannel gallery-panel"  data-aos="fade-up">
  <div class="container">
    <?php if($gallery_title): ?>
      <h2 class="gold-gradient-text"><?php echo $gallery_title;?></h2>
    <?php endif;?>
    <div class="work-area">

      <?php if($images):?>
        <div class="slider multiple-items">
          <?php foreach ($images as $image):?>
            <div class="slide-item">
              <a onclick="addLightBoxClose()" data-lightbox="roadtrip" href="<?php echo $image['sizes']['large'];?>"><img src="<?php echo $image['sizes']['large'];?>"/></a>
            </div>
            <?php endforeach;?>
        </div>
        <div class="slide-icons">
          <div class="prev"><img alt="left" src="<?php echo get_template_directory_uri(); ?>/img/icon/left.svg"/></div>
          <div class="next"><img alt="right" src="<?php echo get_template_directory_uri(); ?>/img/icon/right.svg"/></div>
        </div>
      <?php endif;?>

    </div>
  </div>
</div>
<!--/End Our Work -->




<!-- Modal -->
<div class="modal  fade" style="display: block;" id="homeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-image: url('<?php echo $modal_header_image; ?>');">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">

        <?php if($modal_main_text):?>
          <h2>
            <?php echo $modal_title;?>
        </h2>
        <?php endif;?>

        <?php if($modal_main_text):?>
          <div>
            <?php echo $modal_main_text;?>
          </div>
        <?php endif;?>
        <div class="modal-action">
          <button type="button" class="btn btn-primary">Contact Us Now!</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!--End Modal -->
<script>


  // $('.autoplay').slick({
  //   slidesToShow: 3,
  //   slidesToScroll: 1,
  //   autoplay: true,
  //   autoplaySpeed: 2000,
  // });

  jQuery("#homeModal .close").click(function() {
    
    jQuery("#homeModal").css("display", "none")
    jQuery("#homeModal").css("opacity", "0")
  })
  setTimeout(function() {
    
    jQuery("#homeModal").css("display", "block")
    jQuery("#homeModal").css("opacity", "1")
    
  }, 3000);    
</script>

<?php
get_footer();
