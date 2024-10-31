<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       #
 * @since      1.1.0
 *
 * @package    Nitek_Carousel
 * @subpackage Nitek_Carousel/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.1.0
 * @package    Nitek_Carousel
 * @subpackage Nitek_Carousel/includes
 * @author     Edgar DJENONTIN <nitek.site>
 */
class Nitek_Carousel_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.1.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'nitek-carousel',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
