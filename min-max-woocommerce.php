<?php
/**
 * Plugin Name: Min Max For WooCommerce
 * Version: 1.0.0
 * Author: Aftabul Islam
 * Author Email: toaihimel@gmail.com
 * Requires at least: 5.8
 * Requires PHP: 7.2
 * Requires Plugins: woocommerce
 * Text Domain: min-max-for-woocommerce
 * Description: Minimum & maximum cart amount restriction for WooCommerce
 * License: GPLv3 or later
 * WC requires at least: 6.6
 * WC tested up to: 8.7
 */

defined( 'ABSPATH' ) || exit;

// Constant definitions
defined( 'MIN_MAX_ROOT_DIR' )
	|| define( 'MIN_MAX_ROOT_DIR', __DIR__ );

require_once 'vendor/autoload.php';

use Aihimel\MinMax\MinMaxWooCommerce;

MinMaxWooCommerce::get_instance();
