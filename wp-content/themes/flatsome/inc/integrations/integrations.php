<?php
/**
 * Entry point for plugin integrations
 *
 * @author     UX Themes
 * @category   Integration
 * @package    Flatsome/Integrations
 */

function flatsome_integration_url() {
	return get_template_directory() . '/inc/integrations';
}

function flatsome_integration_uri() {
	return get_template_directory_uri() . '/inc/integrations';
}

global $integrations_url;
global $integrations_uri;
$integrations_url = get_template_directory() . '/inc/integrations';
$integrations_uri = get_template_directory_uri() . '/inc/integrations';

function flatsome_integrations_scripts() {
	global $integrations_uri;

	wp_dequeue_style( 'nextend_fb_connect_stylesheet' );
	wp_deregister_style( 'nextend_fb_connect_stylesheet' );
	wp_dequeue_style( 'nextend_google_connect_stylesheet' );
	wp_deregister_style( 'nextend_google_connect_stylesheet' );

	// Ninja forms.
	if ( function_exists( 'Ninja_Forms' ) && ! is_admin() ) {
		remove_action( 'ninja_forms_display_css', 'ninja_forms_display_css' );
		wp_enqueue_style( 'flatsome-ninjaforms', $integrations_uri . '/ninjaforms/ninjaforms.css', [], flatsome()->version() );
	}

}

add_action( 'wp_enqueue_scripts', 'flatsome_integrations_scripts' );

// WPML Integration.
if ( function_exists( 'pll_get_post' ) || function_exists( 'icl_object_id' ) ) {
	require $integrations_url . '/wpml/flatsome-wpml.php';
}

// WCML Integration.
if ( defined( 'WCML_VERSION' ) ) {
	require $integrations_url . '/wcml/class-wcml.php';
}

// Contactform7.
if ( class_exists( 'WPCF7' ) ) {
	require $integrations_url . '/contact-form-7/contact-form-7.php';
}

if ( function_exists( 'ubermenu' ) ) {
	require $integrations_url . '/ubermenu/flatsome-ubermenu.php';
}

// WP Rocket.
if ( function_exists( 'get_rocket_option' ) && ! is_admin() ) {
	require $integrations_url . '/wp-rocket/wp-rocket.php';
}

// Sensei Integration.
if ( class_exists( 'Sensei_Main' ) ) {
	require $integrations_url . '/sensei/sensei.php';
}

// Yoast Integration.
if ( class_exists( 'WPSEO_Options' ) ) {
	require $integrations_url . '/wp-seo/class-wp-seo.php';
}

// Rank Math Integration.
if ( class_exists( 'RankMath' ) ) {
	require $integrations_url . '/rank-math/class-rank-math.php';
}

// All in one SEO Integration.
if ( class_exists( 'AIOSEO\Plugin\AIOSEO' ) ) {
	require $integrations_url . '/all-in-one-seo/class-aioseo.php';
}

// SEOPress Integration.
if ( defined( 'SEOPRESS_VERSION' ) ) {
	require $integrations_url . '/wp-seopress/class-wp-seopress.php';
}


// WooCommerce Integrations.
if ( is_woocommerce_activated() ) {

	function flatsome_woocommerce_integrations_scripts() {

		global $integrations_uri;
		$version = flatsome()->version();

		if ( is_extension_activated( 'woocommerce_booking' ) ) {
			wp_enqueue_style( 'flatsome-woocommerce-bookings-style', $integrations_uri . '/wc-bookings/bookings.css', [], $version );
		}

		// Extra Product Options.
		if ( is_extension_activated( 'THEMECOMPLETE_Extra_Product_Options' ) ) {
			wp_enqueue_style( 'flatsome-woocommerce-extra-product-options', $integrations_uri . '/wc-extra-product-options/extra-product-options.css', [], $version );
		}

		if ( is_extension_activated( 'Easy_booking' ) ) {
			wp_enqueue_style( 'flatsome-woocommerce-easy-booking', $integrations_uri . '/wc-easy-booking/wc-easy-bookings.css', [], $version );
		}

		if ( is_extension_activated( 'WC_Bulk_Variations' ) ) {
			wp_enqueue_style( 'flatsome-woocommerce-bulk-variations', $integrations_uri . '/wc-bulk-variations/bulk-variations.css', [], $version );
		}

		if ( is_extension_activated( 'Fancy_Product_Designer' ) ) {
			wp_enqueue_style( 'flatsome-fancy-product-designer', $integrations_uri . '/wc-product-designer/product-designer.css', [], $version );
		}

		if ( is_extension_activated( 'Woocommerce_Advanced_Product_Labels' ) ) {
			wp_enqueue_style( 'flatsome-woocommerce-advanced-labels', $integrations_uri . '/wc-advanced-product-labels/advanced-product-labels.css', [], $version );
		}

		if ( is_extension_activated( 'WooCommerce_Product_Filter_Plugin\Plugin' ) ) {
			wp_enqueue_style( 'flatsome-woocommerce-product-filters', $integrations_uri . '/wc-product-filters/product-filters.css', [], $version );
		}
	}

	add_action( 'wp_enqueue_scripts', 'flatsome_woocommerce_integrations_scripts' );


	// Add Yith Wishlist integration.
	if ( class_exists( 'YITH_WCWL' ) ) {
		require $integrations_url . '/wc-yith-wishlist/yith-wishlist.php';
	}

	// YITH WooCommerce Ajax navigation integration.
	if ( defined( 'YITH_WCAN' ) ) {
		require $integrations_url . '/wc-yith-ajax-navigation/yith-ajax-navigation.php';
	}

	// Add Composite products integration.
	if ( class_exists( 'WC_Composite_Products' ) ) {
		require $integrations_url . '/wc-composite-products/composite-products.php';
	}

	// WooCommerce Ajax Navigation.
	add_filter( '_ajax_layered_nav_containers', 'ux_add_custom_container' );
	function ux_add_custom_container( $containers ) {
		$containers[] = '.woocommerce-pagination';
		$containers[] = '.woocommerce-result-count';

		return $containers;
	}

	// Yith Ajax Navigation.
	add_filter( 'sod_ajax_layered_nav_product_container', 'aln_product_container' );
	function aln_product_container( $product_container ) {
		// Enter either the class or id of the container that holds your products.
		return '.products';
	}

	// Infinitive scroll fix
	function flatsome_woocommerce_extensions_after_setup() {
		if ( defined( 'YITH_INFS_VERSION' ) ) {
			$options = get_option( 'yit_infs_options' );

			if ( ! empty( $options ) || $options['yith-infs-navselector'] == '.woocommerce-pagination' ) {
				return;
			}

			if ( empty( $options ) ) {
				$options = array();
			}

			$new_options = array(
				'yith-infs-navselector'     => '.woocommerce-pagination',
				'yith-infs-nextselector'    => '.woocommerce-pagination li a.next',
				'yith-infs-itemselector'    => '.products',
				'yith-infs-contentselector' => '#wrapper',
			);

			$options = array_merge( $options, $new_options );

			update_option( 'yit_infs_options', $options );
		}
	}

	add_action( 'after_switch_theme', 'flatsome_woocommerce_extensions_after_setup', 15 );
}
