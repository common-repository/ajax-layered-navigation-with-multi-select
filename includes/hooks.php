<?php
/**
 * List of hooks in WC Ajax Layered Navigation with Multi-Select Filters plugin.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

$wchweb = new WCHWEB();

add_action('woocommerce_before_shop_loop', array('WCHWEB', 'beforeProductsHolder'), 0);
add_action('woocommerce_after_shop_loop', array('WCHWEB', 'afterProductsHolder'), 200);
add_action('woocommerce_before_template_part', array('WCHWEB', 'beforeNoProducts'), 0);
add_action('woocommerce_after_template_part', array('WCHWEB', 'afterNoProducts'), 200);

add_action('paginate_links', array('WCHWEB', 'paginateLinks'));

// frontend sctipts
add_action('wp_enqueue_scripts', array($wchweb, 'frontendScripts'));

// filter products
add_action('woocommerce_product_query', array($wchweb, 'setFilter'));

// clear old transients
add_action('create_term', 'wchweb_clear_transients');
add_action('edit_term', 'wchweb_clear_transients');
add_action('delete_term', 'wchweb_clear_transients');

add_action('save_post', 'wchweb_clear_transients');
add_action('delete_post', 'wchweb_clear_transients');