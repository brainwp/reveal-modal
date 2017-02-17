<?php
/**
 *
 *
 * @package   Reveal Modal WP
 * @author    Matheus Gimenez <contato@matheusgimenez.com.br>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Matheus Gimenez
 *
 * @wordpress-plugin
 * Plugin Name:       Reveal Modal WP
 * Plugin URI:        http://codeispoetry.info/plugins/reveal-modal
 * Description:       Reveal Modal WP
 * Version:           1.0.0
 * Author:            Matheus Gimenez
 * Plugin URI:        http://codeispoetry.info/plugins/reveal-modal
 * Text Domain:       reveal-modal
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/brasadesign/reveal-modal
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


class Reveal_Modal_Plugin {
	public function __construct() {
		define( 'REVEALWPURL', plugin_dir_url( __FILE__ ) );
		$this->admin_init(); //call function to init metabox and options
		register_activation_hook( __FILE__, array( $this, 'install' ) ); //call function to install the plugin
		//register_uninstall_hook(plugin_dir_path(__FILE__) . 'uninstall', 'uninstall'); //call function to remove the plugin
		//var option
		$this->option_string = get_option( 'reveal-modal-string-random' );
		$this->modal_id      = 'reveal-modal-id';
		//require_once plugin_dir_path(__FILE__) . 'inc/class-options-helper.php';
		$this->options = get_option( 'reveal-modal-options' );
		if(!empty($_GET['reveal-modal-iframe']) && $_GET['reveal-modal-iframe'] == 'true') {
			add_filter('show_admin_bar', '__return_false');
		}
		add_action( 'wp_head', array( $this, 'add_metatags' ) ); //add meta tags
		add_action( 'wp_head', array( $this, 'scripts' ) ); //add javascript & css
		add_action( 'wp_footer', array( $this, 'footer' ) ); //add javascript & css
		add_action( 'template_redirect', array( $this, 'template' ) ); //template files
		add_action( 'init', array( $this, 'network_install' ) ); //add meta tags

	}

	private function admin_init() {
		load_plugin_textdomain( 'reveal-modal', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			//echo get_current_blog_id();
			require_once plugin_dir_path( __FILE__ ) . 'inc/options.php';
			require_once plugin_dir_path( __FILE__ ) . 'inc/metabox.php';
		}
	}

	public function install() {
		delete_option( 'reveal-modal-string-random' );
		add_option( 'reveal-modal-string-random', $this->random_string(), '', 'yes' );
	}

	public function network_install() {
		if ( ! get_option( 'reveal-modal-string-random' ) ) {
			add_option( 'reveal-modal-string-random', $this->random_string(), '', 'yes' );
		}
	}
	private function random_string() {
		$length          = 4;
		$validCharacters = "abcdefghijklmnopqrstuxyvwz123456789";
		$validCharNumber = strlen( $validCharacters );

		$result = "";

		for ( $i = 0; $i < $length; $i ++ ) {
			$index = mt_rand( 0, $validCharNumber - 1 );
			$result .= $validCharacters[ $index ];
		}

		return '-' . $result;
	}

	public function add_metatags() {
		if ( ! is_404() && is_singular() && ! isset( $_REQUEST[ 'reveal-modal-ajax'] ) ) {
			global $wp_query;
			$_post = get_post( $wp_query->post->ID );
			if ( $_post && strpos( $_post->post_name, $this->option_string ) !== false && ! empty( $this->options['reveal-modal-inload'] ) && $this->options['reveal-modal-inload'] == 1 ) {
				echo '<meta name="reveal-modal-cfg-inload" content="true">';
			}
		}
		echo '<meta name="reveal-modal-cfg-str-url" content="' . home_url() . '">';
		echo '<meta name="reveal-modal-cfg-str" content="' . $this->option_string . '">';
	}

	public function scripts() {
		wp_enqueue_style( 'reveal-modal-css', plugin_dir_url( __FILE__ ) . 'assets/css/foundation.min.css' );
		wp_enqueue_script(
			'reveal-modal-js-foundation',
			plugin_dir_url( __FILE__ ) . 'assets/js/foundation.js',
			array( 'jquery' ),
			'',
			true
		);

		wp_enqueue_script(
			'reveal-modal-js',
			plugin_dir_url( __FILE__ ) . 'assets/js/reveal.js',
			array( 'jquery' ),
			'',
			true
		);
	}

	public function footer() {
		echo '<div id="reveal-modal-id" class="reveal-modal" data-reveal>';
		if ( ! is_404() && is_single() ) {
			global $wp_query;
			$_post = get_post( $wp_query->post->ID );
			if ( $_post && strpos( $_post->post_name, $this->option_string ) !== false ) {
				$_post_name = str_replace( $this->option_string, '', $_post->post_name );
				global $post;
				$post = $_post;
				$next_post  = get_next_post();
				if ( ! empty( $next_post ) ) {
					echo '<a class="next-post-reveal-nav" data-open-ajax="true" href="' . get_permalink( $next_post->ID ) . '">&#62;</a>';
				}
				$prev_post  = get_previous_post();
				if ( ! empty( $prev_post ) ) {
					echo '<a class="prev-post-reveal-nav" data-open-ajax="true" href="' . get_permalink( $prev_post->ID ) . '">&#60;</a>';
				}
				if ( file_exists( get_template_directory() . '/reveal-' . $_post_name . '.php' ) ) {
					include get_template_directory() . '/reveal-' . $_post_name . '.php';
					//echo '<a class="close-reveal-modal">&#215;</a>';
				} elseif ( file_exists( get_template_directory() . '/reveal-' . $_post->post_name . '.php' ) ) {
					include get_template_directory() . '/reveal-' . $_post->post_name . '.php';
					//echo '<a class="close-reveal-modal">&#215;</a>';
				} elseif ( file_exists( get_template_directory() . '/reveal.php' ) ) {
					include get_template_directory() . '/reveal.php';
					//echo '<a class="close-reveal-modal">&#215;</a>';
				} else {
					include plugin_dir_path( __FILE__ ) . 'inc/template.php';
					//echo '<a class="close-reveal-modal">&#215;</a>';
				}
			}
		}
		echo '<a class="close-reveal-modal">&#215;</a>';
		echo '</div>';
		//options
		echo '<style>';
		echo '#' . $this->modal_id . '{background-color:' . $this->options['reveal-modal-color'] . ';border:none !important}';
		echo '.reveal-modal-bg{background:#000 !important;opacity:' . $this->options['reveal-modal-bg-opacity'] . ' !important}';
		echo '.close-reveal-modal{color:' . $this->options['reveal-modal-closeicon-color'] . ' !important}';
		echo '</style>';
	}

	public function template() {
		if ( ! is_404() && is_singular() ) {
			global $wp_query;
			$_post = get_post( $wp_query->post->ID );
			if ( isset( $_GET['reveal-modal-ajax'] ) && $_GET['reveal-modal-ajax'] == 'true' && ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
				if ( $_post && strpos( $_post->post_name, $this->option_string ) !== false ) {
					$_post_name = str_replace( $this->option_string, '', $_post->post_name );
					global $post;
					$post = $_post;
					$next_post  = get_next_post();
					if ( ! empty( $next_post ) ) {
						echo '<a class="next-post-reveal-nav" data-open-ajax="true" href="' . get_permalink( $next_post->ID ) . '">&#62;</a>';
					}
					$prev_post  = get_previous_post();
					if ( ! empty( $prev_post ) ) {
						echo '<a class="prev-post-reveal-nav" data-open-ajax="true" href="' . get_permalink( $prev_post->ID ) . '">&#60;</a>';
					}
					if ( file_exists( get_template_directory() . '/reveal-' . $_post_name . '.php' ) ) {
						include get_template_directory() . '/reveal-' . $_post_name . '.php';
						echo '<a class="close-reveal-modal">&#215;</a>';
						die();
					} elseif ( file_exists( get_template_directory() . '/reveal-' . $_post->post_name . '.php' ) ) {
						include get_template_directory() . '/reveal-' . $_post->post_name . '.php';
						echo '<a class="close-reveal-modal">&#215;</a>';
						die();
					} elseif ( file_exists( get_template_directory() . '/reveal.php' ) ) {
						include get_template_directory() . '/reveal.php';
						echo '<a class="close-reveal-modal">&#215;</a>';
						die();
					} else {
						include plugin_dir_path( __FILE__ ) . 'inc/template.php';
						echo '<a class="close-reveal-modal">&#215;</a>';
						die();
					}
				}
			} else {
				if ( $_post && strpos( $_post->post_name, $this->option_string ) !== false && is_singular() ) {
					if ( !empty( $this->options['reveal-modal-inload'] ) ) {
						$_post_name = str_replace( $this->option_string, '', $_post->post_name );
						//if ( file_exists( get_template_directory() . '/page-' . $_post_name . '.php' ) ) {
							include plugin_dir_path( __FILE__ ) . 'inc/template_inload.php';
						echo '<iframe id="reveal-modal-bg-page" src="'.home_url().'?reveal-modal-iframe=true" scrolling="no"/>';
						//	die();
						//}
					}
				}
			}
		}
	}
}
new Reveal_Modal_Plugin();
