<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="cd-row" id="customer_details">
				<div class="col-cols">
					<div class="col-white">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>

						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>

				<div class="col-cols">
				
					<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
		
					<!-- <h3 id="order_review_heading checkout-titles"><?php esc_html_e( 'Payment', 'woocommerce' ); ?></h3> -->
		
					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				
					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>

					<!-- TAKEN FROM REVIEW ORDER -->
						<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

							<div class="order-total-full-width">
								<div class="heading"><?php esc_html_e( 'ORDER TOTAL', 'woocommerce' ); ?></div>
								<div class="amount"><?php wc_cart_totals_order_total_html(); ?></div>
							</div>

							<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
					<!-- TAKEN FROM REVIEW ORDER -->
					
					<div class="delivery-info">
						<span>We typically delivers within <b>7 to 14 days</b>. We will be in touch if there are any changes to your delivery.</span><span> For urgent orders, please contact our office before making payment.</span>
					</div>

					<div class="complete-order">
						<button class="btn btn-jumbo">COMPLETE ORDER</button>
					</div>


						<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				</div>
			</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<?php endif; ?>


</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
