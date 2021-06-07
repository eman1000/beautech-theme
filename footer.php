<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

$footer_title = get_field('footer_title', 'option');
$footer_sub_title = get_field('footer_sub_title', 'option');
$footer_social_text = get_field('footer_social_text', 'option');
$facebook_icon = get_field('facebook_icon', 'option');
$instagram_icon = get_field('instagram_icon', 'option');

$facebook_link = get_field('facebook_link', 'option');
$instagram_link = get_field('instagram_link', 'option');
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?> cont-footer">

		<div class="row">

			<div class="col-md-6">

				<div class="row">
					<div class="col-md-12">
						<?php if($footer_title): ?>
							<h6><?php echo $footer_title ?></h6>
						<?php endif;?>

						<?php if($footer_sub_title): ?>
							<p><?php echo $footer_sub_title ?></p>
						<?php endif;?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="social">
							<?php if($footer_social_text): ?>
								<span class="social-text"><?php echo $footer_social_text ?></span>
							<?php endif;?>

							<?php if($facebook_icon && $facebook_link): ?>
								<a href="<?php echo $facebook_link ?>" class="social-icon">
									<img src="<?php echo $facebook_icon['url'];?>" />
								</a>
							<?php endif;?>

							<?php if($instagram_icon && $instagram_link): ?>
								<a href="<?php echo $instagram_link ?>" class="social-icon">
									<img src="<?php echo $instagram_icon['url'];?>" />
								</a>
							<?php endif;?>

						</div>
					</div>
				</div>

			</div>

			<div class="col-md-6">
				<!-- The WordPress Menu goes here -->
				<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer',
							'container_class' => 'footer',
							'container_id'    => 'footerNav',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'footer-menu',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
						)
					);
				?>
			</div>

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

<script>

jQuery('.multiple-items').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
	accessibility:true,
	arrows:true,
    prevArrow:jQuery('.prev'),
    nextArrow:jQuery('.next'),
});

function addLightBoxClose(params) {
	setTimeout(() => {
		if(jQuery('.lb-nav .lb-closeContainer').length == 0){
			jQuery( ".lb-nav" ).prepend('<div onclick="closelightbox()" class="lb-closeContainer" style="z-index: 99999999;float: right;"><a class="lb-close"></a></div>');
		}
	}, 1000);
}

function closelightbox() {
	jQuery('#lightbox').click()
}
</script>

<script>
  AOS.init({
		disable: 'mobile'
	});
</script>

<script>
	jQuery('.btn-plus, .btn-minus').on('click', function(e) {
		e.preventDefault();
		const isNegative = jQuery(e.target).closest('.btn-minus').is('.btn-minus');
		const input = jQuery(e.target).closest('.input-group').find('input');
		if (input.is('input')) {
			input[0][isNegative ? 'stepDown' : 'stepUp']()
		}
	})

	jQuery('#pa_colour').attr("disabled", true); 

</script>
<script>
  jQuery(".btn-special-cart").click(function() {
    jQuery('.woocommerce-cart').find('button[name="update_cart"]').prop('disabled', false);
  })
    
</script>
</body>

</html>

