<?php
namespace Aihimel\MinMax;

use Aihimel\MinMax\Admin\WooCommerceSettingsTab;
use Aihimel\MinMax\Restrictions\AmountRestriction;

defined( 'ABSPATH' ) || exit;

/**
 * Main plugin object
 *
 * @package aihimel/min-max
 *
 * @since 1.0.0
 */
final class MinMaxWooCommerce {
	private static $instance = null;
	private static array $container = [];

	/**
	 * Initializes the objects and puts it inside container for future use
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function __construct() {
		self::$container[ WooCommerceSettingsTab::INSTANCE_KEY ] = new WooCommerceSettingsTab();
		self::$container[ AmountRestriction::INSTANCE_KEY ] = new AmountRestriction();
	}

	/**
	 * Returns main plugin object or container object if available
	 *
	 * @since 1.0.0
	 *
	 * @param string $key
	 *
	 * @return mixed|self|null
	 */
	public static function get_instance( string $key = '' ) {
		if ( empty( $key ) ) {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		} else {
			return self::$container[ $key ] ?? null;
		}
	}
}
