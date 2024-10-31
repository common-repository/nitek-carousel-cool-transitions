<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.1.0
 * @package           Nitek_Carousel
 *
 * @wordpress-plugin
 * Plugin Name:       Nitek Carousel Slider Cool Transitions
 * Plugin URI:        https://wordpress.org/plugins/nitek-carousel-cool-transitions/
 * Description:       Amazing transitions effects sliders using a Custom Post Type Carousel (CPT) for choosing images and content which outputs  Carousel (slider) from a shortcode. You can also use category to group CPT in order to get different sliders. 
 The plugin doesn't need jQuery to work.
 * Version:           1.1.0
 * Author:            Edgar DJENONTIN
 * Author URI:        nitek.site
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nitek-carousel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}




// Create a helper function for easy SDK access.
function nitek_sc_1() {
    global $nitek_sc_1;

    if ( ! isset( $nitek_sc_1 ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

        $nitek_sc_1 = fs_dynamic_init( array(
            'id'                  => '2262',
            'slug'                => 'nitek-carousel',
            'type'                => 'plugin',
            'public_key'          => 'pk_2091673dbe4b99c1233eb9c2e3f04',
            'is_premium'          => false,
            // If your plugin is a serviceware, set this option to false.
            'has_premium_version' => true,
            'has_addons'          => false,
            'has_paid_plans'      => true,
            'menu'                => array(
                'slug'           => 'nitek-menu-carousel',
                'override_exact' => true,
                //'first-path'     => 'plugins.php?page=nitek-menu-carousel&tab=general_sect',
                'contact'        => false,
                'support'        => false,
                'parent'         => array(
                    'slug' => 'plugins.php',
                ),
            ),
            
        ) );
    }

    return $nitek_sc_1;
}

// Init Freemius.
nitek_sc_1();
// Signal that SDK was initiated.
do_action( 'nitek_sc_1_loaded' );

function nitek_sc_1_settings_url() {
    return admin_url( 'plugins.php?page=nitek-menu-carousel&tab=general_sect' );
}

function my_add_tabs_to_upgrade( $html ) {
    $tabs_html = "
    <section 
style='background-color: white; padding-left: 3%; padding-right:3%; padding-bottom:3%; padding-top:5px'>  
<br><br> <br> 
<h2>Suscribe for premium version to get full options of plugin</h2> 
    <table class='widefat fixed' cellspacing='0' style=''>
        <thead >
        <tr>
        <th id='opt' class='manage-column column-opt' scope='col' style='font-weight: bold; font-size:1.3em;'> Options</th>
        <th id='free' class='manage-column column-free' scope='col' style='font-weight: bold; font-size:1.3em; text-align:center'> Free plugin</th>
        <th id='premium' class='manage-column column-premium' scope='col' style='font-weight: bold; font-size:1.3em; text-align:center'>Premium plugin</th> 

        </tr>
        </thead>
        

        <tbody >
            <tr class='alternate' >                 
                <td class='column-opt' style='font-size:1.2em;'>Transition effects </td>
                <td class='column-free' style='font-size:1.2em; text-align:center;'> 07 </td>
                <td class='column-premium' style='font-size:1.2em; text-align:center; color:green;'> <strong> 25 </strong></td>
            </tr>
            <tr>
                <td class='column-opt' style='font-size:1.2em;'>Arrows styles available</td>
                <td class='column-free' style='font-size:1.2em; text-align:center;'> 02 </td>
                <td class='column-premium' style='font-size:1.2em; text-align:center; color:green;'><strong> 04 </strong></td>
            </tr>

            <tr class='alternate'>                  
                <td class='column-opt' style='font-size:1.2em;'>Pagination styles available </td>
                <td class='column-free' style='font-size:1.2em; text-align:center;'> 02 </td>
                <td class='column-premium' style='font-size:1.2em; text-align:center; color:green;'> <strong>04 </strong></td>
            </tr>
            <tr>
                <td class='column-opt' style='font-size:1.2em;'>Support</td>
                <td class='column-free' style='font-size:1.2em; text-align:center;'> Little </td>
                <td class='column-premium' style='font-size:1.2em; text-align:center; color:green;'><strong> Great technical support </strong></td>
            </tr>
            
        </tbody>
    </table>

        
</section>";


     return $tabs_html . $html;
}

nitek_sc_1()->add_filter( 'templates/pricing.php', 'my_add_tabs_to_upgrade' );
nitek_sc_1()->add_filter( 'templates/checkout.php', 'my_add_tabs_to_upgrade' );

nitek_sc_1()->add_filter( 'connect_url', 'nitek_sc_1_settings_url' );
nitek_sc_1()->add_filter( 'after_skip_url', 'nitek_sc_1_settings_url' );
nitek_sc_1()->add_filter( 'after_connect_url', 'nitek_sc_1_settings_url' );
nitek_sc_1()->add_filter( 'after_pending_connect_url', 'nitek_sc_1_settings_url' );
nitek_sc_1()->add_action('after_uninstall', 'nitek_sc_1_uninstall_cleanup');




/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NITEK_CAROUSEL_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nitek-carousel-activator.php
 */
function activate_nitek_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nitek-carousel-activator.php';
	Nitek_Carousel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nitek-carousel-deactivator.php
 */
function deactivate_nitek_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nitek-carousel-deactivator.php';
	Nitek_Carousel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nitek_carousel' );
register_deactivation_hook( __FILE__, 'deactivate_nitek_carousel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nitek-carousel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.1.0
 */
function run_nitek_carousel() {

	$plugin = new Nitek_Carousel();
	$plugin->run();

}
run_nitek_carousel();
