<?php
namespace Aihimel\MinMax\Restrictions;

use Aihimel\MinMax\DataSource\MinMaxSettings;

defined( 'ABSPATH' ) || exit;

/**
 * Adds amount restriction on frontend
 *
 * @package aihimel/min-max
 *
 * @since 1.0.0
 */
class AmountRestriction {

	const INSTANCE_KEY = 'amount-restriction';

	public function __construct() {
		add_action( 'woocommerce_check_cart_items', [ $this, 'validate_cart' ] );
	}

	public function validate_cart() {

		if ( ! is_cart() && ! is_checkout() ) {
			return;
		}

		$cart_total =WC()->cart->cart_contents_total;
		$settings = new MinMaxSettings();
		$min_amount = $settings->get_minimum_amount();
		$max_amount = $settings->get_maximum_amount();
		if ( ! empty( $cart_total ) && ! empty( $min_amount ) && $cart_total < $min_amount ) {
			$notice = sprintf(
				/*
				 * translators:
				 * 1. Minimum required cart amount
				 * 2. Current cart amount
				 */
					esc_html__( 'Minimum required cart amount is %1$s. Current you have %2$s in cart', 'min-max-for-woocommerce' ),
					wc_price( $min_amount ),
					wc_price( $cart_total )
			);
			wc_add_notice( $notice, 'error' );
			$this->remove_checkout();
		}

		if ( ! empty( $cart_total ) && ! empty( $max_amount ) && $cart_total > $max_amount ) {
			$notice = sprintf(
			/*
			 * Translators:
			 * 1. Minimum required cart amount
			 * 2. Current cart amount
			 */
				esc_html__( 'Maximum allowed cart amount is %1$s. Current you have %2$s in cart', 'min-max-for-woocommerce' ),
				wc_price( $max_amount ),
				wc_price( $cart_total )
			);
			wc_add_notice( $notice, 'error' );
			$this->remove_checkout();
		}
	}

	/**
	 * Removed checkout from cart page
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function remove_checkout() {
		remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
	}
}
