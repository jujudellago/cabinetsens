<?php
/**
 * WooCommerce product base class.
 *
 * @package WooCommerce\Abstracts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Abstract Product Class
 *
 * The WooCommerce product class handles individual product data.
 *
 * @version 3.0.0
 * @package WooCommerce\Abstracts
 */
abstract class WC_Product_Qodef_Abstract extends WC_Product {
	
	protected $object_type = '';
	protected $post_type   = '';
	protected $cache_group = 'qodef-products';
	
	private function set_object_type( $type ) {
		$this->object_type = $type;
	}
	
	private function set_post_type( $type ) {
		$this->post_type = $type;
	}
	
	/**
	 * Get the product if ID is passed, otherwise the product is new and empty.
	 * This class should NOT be instantiated, but the wc_get_product() function
	 * should be used. It is possible, but the wc_get_product() is preferred.
	 *
	 * @param int|WC_Product|object $product Product to init.
	 */
	public function __construct( $product = 0 ) {
		parent::__construct( $product );
		
		/* BY QODE */
		$post_type = get_post_type( $this->get_id() );
		$this->set_prop( 'name', get_the_title( $this->get_id() ) );
		$this->set_prop( 'price', $this->generate_price() );
		$this->set_prop( 'status', true );
		$this->set_prop( 'sold_individually', $this->generate_sold_individually() );
		$this->set_prop( 'stock_status', $this->generate_stock_status() );
		$this->set_prop( 'stock_quantity', $this->generate_stock_quantity() );
		$this->set_prop( 'image_id', get_post_thumbnail_id( $this->get_id() ) );
		
		$this->set_post_type( $post_type );
		$this->set_object_type( $post_type );
	}
	
	/* BY QODE */
	abstract protected function generate_price();
	
	abstract protected function generate_sold_individually();
	
	abstract protected function generate_stock_status();
	
	abstract protected function generate_stock_quantity();
	
	/**
	 * Get internal type. Should return string and *should be overridden* by child classes.
	 *
	 * The product_type property is deprecated but is used here for BW compatibility with child classes which may be defining product_type and not have a get_type method.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public function get_type() {
		return get_post_type( $this->get_id() );
	}
	
	/**
	 * Get SKU (Stock-keeping unit) - product unique ID.
	 *
	 * @param  string $context What the value is for. Valid values are view and edit.
	 * @return string
	 */
	public function get_sku( $context = 'view' ) {
		return '';
	}
	
	/**
	 * Get upsell IDs.
	 *
	 * @since  3.0.0
	 * @param  string $context What the value is for. Valid values are view and edit.
	 * @return array
	 */
	public function get_upsell_ids( $context = 'view' ) {
		return array();
	}
	
	/**
	 * Get cross sell IDs.
	 *
	 * @since  3.0.0
	 * @param  string $context What the value is for. Valid values are view and edit.
	 * @return array
	 */
	public function get_cross_sell_ids( $context = 'view' ) {
		return array();
	}
	
	/**
	 * Get purchase note.
	 *
	 * @since  3.0.0
	 * @param  string $context What the value is for. Valid values are view and edit.
	 * @return string
	 */
	public function get_purchase_note( $context = 'view' ) {
		return '';
	}
	
	/*
	|--------------------------------------------------------------------------
	| Conditionals
	|--------------------------------------------------------------------------
	*/
	
	/**
	 * Checks if a product is downloadable.
	 *
	 * @return bool
	 */
	public function is_downloadable() {
		return false;
	}
	
	/**
	 * Checks if a product is virtual (has no shipping).
	 *
	 * @return bool
	 */
	public function is_virtual() {
		return false;
	}
	
	/**
	 * Returns whether or not the product is visible in the catalog.
	 *
	 * @return bool
	 */
	public function is_visible() {
		return true;
	}
	
	/**
	 * Returns false if the product cannot be bought.
	 *
	 * @return bool
	 */
	public function is_purchasable() {
		return apply_filters( 'qodef_checkout_is_purchasable', $this->exists(), $this );
	}
	
	/**
	 * Checks if a product needs shipping.
	 *
	 * @return bool
	 */
	public function needs_shipping() {
		return false;
	}
	
	/**
	 * Returns whether or not the product is stock managed.
	 *
	 * @return bool
	 */
	public function managing_stock() {
		return false;
	}
	
	/**
	 * Returns whether or not the product needs to notify the customer on backorder.
	 *
	 * @return bool
	 */
	public function backorders_require_notification() {
		return false;
	}
	
	/**
	 * Returns whether or not the product has enough stock for the order.
	 *
	 * @param  mixed $quantity Quantity of a product added to an order.
	 * @return bool
	 */
	public function has_enough_stock( $quantity ) {
		return true;
	}
}
