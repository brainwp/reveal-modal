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
if (!defined('WPINC')) {
	die;
}


class Reveal_Modal_Plugin
{
	public function __construct()
	{
		$this->admin_init(); //call function to init metabox and options
		register_activation_hook(__FILE__, array($this, 'install')); //call function to install the plugin
		register_uninstall_hook(__FILE__, array($this, 'uninstall')); //call function to remove the plugin
	}

	private function admin_init()
	{
		if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {
			require_once plugin_dir_path(__FILE__) . 'inc/options.php';
			require_once plugin_dir_path(__FILE__) . 'inc/metabox.php';
		}
	}

	private function random_string()
	{
		$length = 4;
		$validCharacters = "abcdefghijklmnopqrstuxyvwz123456789";
		$validCharNumber = strlen($validCharacters);

		$result = "";

		for ($i = 0; $i < $length; $i++) {
			$index = mt_rand(0, $validCharNumber - 1);
			$result .= $validCharacters[$index];
		}
		return '-'.$result;
	}

	public function install()
	{
		add_option( 'reveal-modal-string-random', $this->random_string(), '', 'yes' );
	}
	public function uninstall(){
		if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
			exit();
		delete_option( 'reveal-modal-string-random' );
	}
}
new Reveal_Modal_Plugin();