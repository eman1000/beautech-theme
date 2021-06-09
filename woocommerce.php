<?php
/**

 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$terms = get_the_terms( get_the_ID(), 'product_cat' );
$product_category = $terms[0];

$args = array(
  'posts_per_page' => -1,
  'tax_query' => array(
      'relation' => 'AND',
      array(
          'taxonomy' => 'product_cat',
          'field' => 'slug',
          // 'terms' => 'white-wines'
          'terms' => $product_category->slug
      )
  ),
  'post_type' => 'product',
  'orderby' => 'title,'
);

$products = new WP_Query( $args );


$title = get_field('title', 'product_cat_' . $product_category->term_id);

$hero_tags = get_field('hero_tags', 'product_cat_' . $product_category->term_id);

$hero_tags = preg_replace('/\.$/', '', $hero_tags); //Remove dot at end if exists
$hero_tags = explode(', ', $hero_tags); //split string into array seperated by ', '

$hero_extra_text = get_field('extra_text', 'product_cat_' . $product_category->term_id);
$hero_extra_text = get_field('extra_text', 'product_cat_' . $product_category->term_id);

$hero_button_text_1 = get_field('button_text_1', 'product_cat_' . $product_category->term_id);
$hero_button_text_2 = get_field('button_text_2', 'product_cat_' . $product_category->term_id);

$hero_button_link_1 = get_field('button_link_1', 'product_cat_' . $product_category->term_id);
$hero_button_link_2 = get_field('button_link_2', 'product_cat_' . $product_category->term_id);
$jumbo_text = get_field('jumbo_text', 'product_cat_' . $product_category->term_id);

$style = get_field('style', 'product_cat_' . $product_category->term_id);


$hero_background_image = get_field('background_image', 'product_cat_' . $product_category->term_id);
$hero_background_picture = $hero_background_image['sizes']['large'];

$current_id = $post->ID;
?>


<!-- Top Banner -->
<div  data-aos="fade-in" class="page-banner banner-<?php echo $style; ?>" style="background-image: url('<?php echo $hero_background_picture; ?>');">
  <div class="container">
    <?php if($title):?>
    <h1><?php echo $title;?></h1>
    <?php endif;?>

    <?php if($jumbo_text):?>
    <h1 class="jumbo-text"><?php echo $jumbo_text;?></h1>
    <?php endif;?>

    <div class="tags-holder">
      <?php foreach($hero_tags as $value){?>
        <div>
          <?php echo $value; ?>
        </div>
      <?php } ?>
    </div>

    <?php if($hero_extra_text):?>
      <div class="text-extra gold-gradient-text">
        <?php echo $hero_extra_text; ?>
      </div>
    <?php endif;?>


    <div class="buttons-holder">
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


<!--usp belt -->
<div  id="usp-belt" class="usp-belt">
  <div class="container usp-wrapper">
    <div class="usp">
      <div class="icon">
        <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/van-black.svg" alt="van" />
      </div>
      <div class="text-wrapper">
        <span>Delivery</span>
        <span>We deliver with a fair fee</span>
      </div>
    </div>

    <div class="usp">
      <div class="icon">
        <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/hand-shake-black.svg" alt="van" />
      </div>
      <div class="text-wrapper">
        <span>Your Most Trusted</span>
        <span>Supplier in the region</span>
      </div>
    </div>

    <div class="usp">
      <div class="icon">
        <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/money-value-black.svg" alt="van" />
      </div>
      <div class="text-wrapper">
        <span>Fair Price</span>
        <span>Product of quality with fair price</span>
      </div>
    </div>
  </div>
</div>
<!--/End usp belt -->


<!--Header -->
<div class="page-pannel top-category-panel">
  <div class="container border-bottom">
    <div class="row">
      <div class="col-md-6">
      <!-- <?php if(is_shop()){ 
          echo '<h1 class="entry-title">Shop</h1>'; } 
        else if (is_product_category()) {
          single_term_title( '<h1 class="entry-title">', '</h1>' );
        } else { 
          // the_title( '<hl class="entry-title">', '</h1>' ); 
          $terms = get_the_terms( get_the_ID(), 'product_cat' );
          if ( $terms && ! is_wp_error( $terms ) ){
            if ( ! empty( $terms ) ) {
              echo '<h1 class="entry-title"> ' . $terms[0]->name .'</h1>';
            }
          }
        } ?> -->

        <h1 class="entry-title  break-text"   data-aos="fade-up">Available Products</h1>
      </div>
      <div class="col-md-6">
        <ul class="category-products">
          <?php 
            while ( $products->have_posts() ) {
              $products->the_post();
              if ($current_id == $post->ID) {
                  $active = 'class="active"';
              } else {
                  $active = '';
              }
          ?>
                  <li <?php echo $active; ?>   data-aos="fade-up">
                      <a href="<?php the_permalink(); ?>">
                          <?php the_title(); ?>
                      </a>
                  </li>
              <?php
            }
          ?>
        </ul>
      </div>
    </div>

  </div>
</div>
<!--/End Header Us -->


<!-- Main -->

<div class="page-pannel" data-aos="fade-in">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php woocommerce_content(); ?>
      </div>
    </div>
  </div>
</div>


<!--usp belt -->
<div class="usp-belt">
  <div class="container usp-wrapper">
    <div class="usp">
      <div class="icon">
        <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/van-black.svg" alt="van" />
      </div>
      <div class="text-wrapper">
        <span>Delivery</span>
        <span>We deliver with a fair fee</span>
      </div>
    </div>

    <div class="usp">
      <div class="icon">
        <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/hand-shake-black.svg" alt="van" />
      </div>
      <div class="text-wrapper">
        <span>Your Most Trusted</span>
        <span>Supplier in the region</span>
      </div>
    </div>

    <div class="usp">
      <div class="icon">
        <img class="img-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon/money-value-black.svg" alt="van" />
      </div>
      <div class="text-wrapper">
        <span>Fair Price</span>
        <span>Product of quality with fair price</span>
      </div>
    </div>
  </div>
</div>
<!--/End usp belt -->



<script>
	var elmnt = document.getElementById("usp-belt");
	elmnt.scrollIntoView();
</script>
<?php
get_footer();
