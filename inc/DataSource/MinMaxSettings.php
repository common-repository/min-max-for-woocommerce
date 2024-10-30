<?php
namespace Aihimel\MinMax\DataSource;

use Aihimel\MinMax\Admin\WooCommerceSettingsTab;

defined( 'ABSPATH' ) || exit;

/**
 * Manages all the min max settings read operations
 *
 * @package aihimel/min-max
 *
 * @since 1.0.0
 */
class MinMaxSettings {

	protected $min_amount = 0.00;
	protected $max_amount = 0.00;

	/**
	 * Fetches settings WordPress options
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->min_amount = get_option( WooCommerceSettingsTab::MINIMUM_AMOUNT_ID, 0.00 );
		$this->max_amount = get_option( WooCommerceSettingsTab::MAXIMUM_AMOUNT_ID, 0.00 );

		$this->validate_data();
	}

	/**
	 * Validates the options fetched from options
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function validate_data() {
		$this->min_amount = empty( $this->min_amount ) ? 0.00 : (float)$this->min_amount;
		$this->max_amount = empty( $this->max_amount ) ? 0.00 : (float)$this->max_amount;
	}

	/**
	 * Returns minimum amount or default value
	 *
	 * @since 1.0.0
	 *
	 * @return float
	 */
	public function get_minimum_amount(): float {
		return $this->min_amount;
	}

	/**
	 * Returns maximum amount or default value
	 *
	 * @since 1.0.0
	 *
	 * @return float
	 */
	public function get_maximum_amount(): float {
		return $this->max_amount;
	}

	/**
	 * Check is min max check is enabled
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_cart_amount_enabled(): bool {
		return $this->get_minimum_amount() || $this->get_maximum_amount();
	}
}
