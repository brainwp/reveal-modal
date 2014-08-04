<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 *
 * @wordpress-plugin
 * Plugin Name:       Reveal Lightbox
 * Plugin URI:        http://brasa.art.br
 * Description:       Reveal Lightbox
 * Version:           1.0.0
 * Author:            Brasa
 * Plugin URI:        http://brasa.art.br
 * Text Domain:       reveal-modal
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: dps coloco essa porra
 * WordPress-Plugin-Boilerplate: v2.6.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

    require_once plugin_dir_path( __FILE__ ) . 'inc/options.php' ;
    //new Add_Gift_Wrap_Options();
}

require_once plugin_dir_path( __FILE__ ) . 'inc/odin-metabox.php' ;