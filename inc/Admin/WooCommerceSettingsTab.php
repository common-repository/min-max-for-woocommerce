<?php
namespace Aihimel\MinMax\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Adds WooCommerce settings page
 *
 * @package aihimel/min-max
 *
 * @since 1.0.0
 */
class WooCommerceSettingsTab {

	const INSTANCE_KEY = 'woocommerce-settings-tab';
	const MIN_MAX_SETTINGS_PAGE_KEY = 'min-max-settings';

	/**
	 * Settings ids
	 *
	 * @since 1.0.0
	 */
	const TITLE_ID = 'min-max-for-woocommerce-settings-title';
	const MINIMUM_AMOUNT_ID = 'min-max-for-woocommerce-settings-minimum-amount';
	const MAXIMUM_AMOUNT_ID = 'min-max-for-woocommerce-settings-maximum-amount';

	public function __construct() {
		add_filter( 'woocommerce_get_sections_products', [ $this, 'add_min_max_menu' ], 11 );
		add_filter( 'woocommerce_get_settings_products', [ $this, 'add_min_max_settings' ], 10, 2 );
	}

	/**
	 * Adds min max settings inside `min-max-settings` tab
	 *
	 * @since 1.0.0
	 *
	 * @param $settings
	 * @param $current_section
	 *
	 * @return mixed
	 */
	public function add_min_max_settings( $settings, $current_section ) {
		if ( ! self::MIN_MAX_SETTINGS_PAGE_KEY === $current_section ) {
			return $settings;
		}
		$settings[] = [
			'name' => __('Cart Amount Settings', 'min-max-for-woocommerce'),
			'type' => 'title',
			'desc' => __('Set minimum and maximum cart amount for your customers', 'min-max-for-woocommerce'),
			'id'   => self::TITLE_ID,
		];

		$settings[] = [
			'name'     => __('Minimum Amount', 'min-max-for-woocommerce'),
			'desc_tip' => __('Enter the cart minimum amount for your customers.', 'min-max-for-woocommerce'),
			'id'       => self::MINIMUM_AMOUNT_ID,
			'type'     => 'text',
			'css'      => 'min-width:300px;',
			'desc'     => __('Cart minimum amount', 'min-max-for-woocommerce'),
			'default'  => '',
			'placeholder' => 'eg: 30.00',
		];

		$settings[] = [
			'name'     => __('Maximum Amount', 'min-max-for-woocommerce'),
			'desc_tip' => __('Enter the cart maximum amount for your customers.', 'min-max-for-woocommerce'),
			'id'       => self::MAXIMUM_AMOUNT_ID,
			'type'     => 'text',
			'css'      => 'min-width:300px;',
			'desc'     => __('Cart maximum amount', 'min-max-for-woocommerce'),
			'default'  => '',
			'placeholder' => 'eg: 300.00',
		];

		$settings[] = array(
			'type' => 'sectionend',
			'id'   => 'my_custom_product_settings',
		);

		return $settings;
	}

	/**
	 * Adds a menu under woocommerce > settings > products
	 *
	 * @since 1.0.0
	 *
	 * @param array $sections
	 *
	 * @return array
	 */
	public function add_min_max_menu( array $sections ): array {
		$sections[ self::MIN_MAX_SETTINGS_PAGE_KEY ] = __( 'Min Max', 'min-max-for-woocommerce' );
		return $sections;
	}
}
