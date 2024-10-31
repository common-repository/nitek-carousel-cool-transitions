<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.1.0
 *
 * @package    Nitek_Carousel
 * @subpackage Nitek_Carousel/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Nitek_Carousel
 * @subpackage Nitek_Carousel/public
 * @author     Edgar DJENONTIN <#>
 */
class Nitek_Carousel_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.1.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode('nitek_sc_1', array($this,'nitek_create_slider') );		
		add_shortcode('nitek_sc_2', array($this,'nitek_create_slider_2') );		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nitek_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nitek_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nitek-carousel-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nitek_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nitek_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nitek-carousel-public.js', array( 'jquery' ), $this->version, false );
		
		wp_enqueue_script( 'jssor', plugin_dir_url( __FILE__ ) . 'js/jssor.slider-21.1.5.min.js' );
	}


	/**
	 * Create and Display Carousel Sliders in public area with shortcode [nitek_sc_2].
	 *
	 * @since    1.1.0
	 */
	public function nitek_create_slider(){

		$args1 = array(
			'post_type' => 'nitek-carousel-cpt',
			'category_name' => 'nitek_slider_1'
		);

		$reqExist1 = new WP_Query($args1);		

		if ($reqExist1->have_posts()){
			include_once 'partials/nitek-carousel-public-display.php';	
		}

		
	}



	/**
	 * Create and Display Carousel Sliders in public area with shortcode [nitek_sc_2].
	 *
	 * @since    1.1.0
	 */
	public function nitek_create_slider_2(){

		$args2 = array(
			'post_type' => 'nitek-carousel-cpt',
			'category_name' => 'nitek_slider_2'
		);

		$reqExist2 = new WP_Query($args2);		

		if ($reqExist2->have_posts()){
			include_once 'partials/nitek-carousel-public-display-2.php';	
		}
	}


}
