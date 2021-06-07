<?php
/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once $understrap_inc_dir . $file;
}
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Contact / Social',
		'menu_title'	=> 'Contact / Social Info',
		'menu_slug' 	=> 'contact-social-info',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));	
}

add_action('woocommerce_before_add_to_cart_form', 'selected_variation_price_replace_variable_price_range');
function selected_variation_price_replace_variable_price_range(){
    global $product;

    if( $product->is_type('variable') ):
    ?><style> .woocommerce-variation-price {display:none;} </style>
    <script>
    jQuery(function($) {
        var p = 'p.price'
            q = $(p).html();

        $('form.cart').on('show_variation', function( event, data ) {
            if ( data.price_html ) {
                $(p).html(data.price_html);
            }
        }).on('hide_variation', function( event ) {
            $(p).html(q);
        });
    });
    </script>
    <?php
    endif;
}

add_action( 'woocommerce_before_single_product', 'beautech_change_single_product_layout' );

function beautech_change_single_product_layout() {
    // Disable the hooks so that their order can be changed.
    // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


    // Include the category/tags info.
    // add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );
    // Then the product short description.
    // add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );
    // // Move the title to near the end.
    // add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 50 );
    // // And finally include the 'Add to cart' section.
    // add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 60 );

    // Put the price last.
    // add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 30);
}


/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    // unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}


if (class_exists('acf')) {
	add_action('acf/init', function() {
		$fields = [
			[
				'key' => 'field_custom_tabs_repeater',
				'label' => __('Custom tabs', 'txtdomain'),
				'name' => 'custom_tabs_repeater',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => __('Add new tab', 'txtdomain'),
				'sub_fields' => [
					[
						'key' => 'field_tab_title',
						'label' => __('Tab title', 'txtdomain'),
						'name' => 'tab_title',
						'type' => 'text',
					],
					[
						'key' => 'field_tab_contents',
						'label' => __('Tab content', 'txtdomain'),
						'name' => 'tab_contents',
						'type' => 'wysiwyg',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					],
				],
			],
		];
 
		acf_add_local_field_group([
			'key' => 'group_custom_woocommerce_tabs',
			'title' => __('Custom Tabs', 'txtdomain'),
			'fields' => $fields,
			'label_placement' => 'top',
			'menu_order' => 0,
			'style' => 'default',
			'position' => 'normal',
			'location' => [
				[
					[
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'product'
					]
				]
			],
		]);
	});
}



if (class_exists('acf') && class_exists('WooCommerce')) {
	add_filter('woocommerce_product_tabs', function($tabs) {
		global $post, $product;  // Access to the current product or post
		
		$custom_tabs_repeater = get_field('custom_tabs_repeater', $post->ID);
 
		if (!empty($custom_tabs_repeater)) {
			$counter = 0;
			$start_at_priority = 10;
			foreach ($custom_tabs_repeater as $custom_tab) {
				$tab_id = $counter . '_' . sanitize_title($custom_tab['tab_title']);
				
				$tabs[$tab_id] = [
					'title' => $custom_tab['tab_title'],
					'callback' => 'awp_custom_woocommerce_tabs',
					'priority' => $start_at_priority++
				];
				$counter++;
			}
		}
		return $tabs;
	});
 
	function awp_custom_woocommerce_tabs($key, $tab) {
		global $post;
 
		?><h2><?php echo $tab['title']; ?></h2><?php
 
		$custom_tabs_repeater = get_field('custom_tabs_repeater', $post->ID);
		
		$tab_id = explode('_', $key);
		$tab_id = $tab_id[0];
 
		echo $custom_tabs_repeater[$tab_id]['tab_contents'];
	}
}



add_filter("woocommerce_checkout_fields", "custom_override_checkout_fields", 1);
function custom_override_checkout_fields($fields) {

	$fields['billing']['billing_company']['priority'] = 1;
    $fields['billing']['billing_first_name']['priority'] = 2;
    $fields['billing']['billing_last_name']['priority'] = 3;
    $fields['billing']['billing_phone']['priority'] = 4;

		
    $fields['billing']['billing_country']['priority'] = 5;
    $fields['billing']['billing_state']['priority'] = 6;
    $fields['billing']['billing_address_1']['priority'] = 7;
    $fields['billing']['billing_address_2']['priority'] = 8;
    $fields['billing']['billing_city']['priority'] = 9;
    $fields['billing']['billing_postcode']['priority'] = 10;
    $fields['billing']['billing_email']['priority'] = 11;
    return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'custom_override_default_locale_fields' );
function custom_override_default_locale_fields( $fields ) {
    $fields['state']['priority'] = 5;
    $fields['address_1']['priority'] = 6;
    $fields['address_2']['priority'] = 7;
    return $fields;
}
