<?php
/**
 * CDN Enabler classes
 *
 * Setup the default settings for the Kinsta CDN and communicate with the server
 *
 * @package KinstaMUPlugins
 * @subpackage CDN
 * @since 2.0.0
 */

namespace Kinsta;

if ( ! defined( 'ABSPATH' ) ) { // If this file is called directly.
	die( 'No script kiddies please!' );
}

/**
 * CDN Enabler class
 *
 * @version 1.0
 * @author laci
 * @since 2.0.1
 **/
class CDN_Enabler {

	/**
	 * The class initiate itself
	 *
	 * @return void
	 * @author laci
	 * @since 2.0.1
	 * @version 1.0
	 */
	public static function instance() {
		new self();
	}

	/**
	 * Class constructor
	 *
	 * @return void
	 */
	public function __construct() {
		$is_enabled = self::cdn_is_enabled();
		if ( ! $is_enabled ) {
			return;
		}

		add_action( 'template_redirect', array( __CLASS__, 'handle_rewrite_hook' ) );
		add_action( 'all_admin_notices', array( __CLASS__, 'requirements_check' ) );
	}

	/**
	 * Check the plugin's requirements
	 *
	 * @return void
	 * @author laci
	 * @since 2.0.1
	 * @version 1.0
	 */
	public static function requirements_check() {
		if ( version_compare( $GLOBALS['wp_version'], KINSTA_CDN_ENABLER_MIN_WP . 'alpha', '<' ) && 1 == $_SERVER['KINSTA_CDN_ENABLED'] ) { // WPCS: loose comparison ok.
			show_message(
				sprintf(
					'<div class="error"><p>%s</p></div>',
					sprintf(
						// translators: %1$s minimum WP version, %2$s MyKinsta Dashboard link.
						__( 'Kinsta CDN enabler is optimized for WordPress %1$s. Please disable CDN via %2$s or upgrade your WordPress installation (recommended).', 'kinsta-mu-plugins' ),
						KINSTA_CDN_ENABLER_MIN_WP,
						'<a href="https://my.kintsa.com" target="_blank" title="My Kinsta Dashboard">' . __( 'MyKinsta Dashboard', 'kinsta-mu-plugins' ) . '</a>'
					)
				)
			);
		}
	}

	/**
	 * Get the CDN options
	 *
	 * @return array retunrs the options array
	 * @author laci
	 * @since 2.0.1
	 * @version 0.4
	 */
	public static function get_options() {

		$custom = array();

		$custom['dirs'] = 'wp-content,wp-includes,images';

		if ( defined( 'KINSTA_CDN_USERDIRS' ) && ! empty( KINSTA_CDN_USERDIRS ) ) {
			$custom['dirs'] .= ',' . KINSTA_CDN_USERDIRS;
		}
		if ( isset( $_SERVER['KINSTA_CDN_DOMAIN'] ) && '' !== $_SERVER['KINSTA_CDN_DOMAIN'] ) {
			$custom['url'] = 'https://' . $_SERVER['KINSTA_CDN_DOMAIN'];
		}
		if ( isset( $_SERVER['KINSTA_CDN_DIRECTORIES'] ) && '' !== $_SERVER['KINSTA_CDN_DIRECTORIES'] ) {
			$custom['dirs'] = $_SERVER['KINSTA_CDN_DIRECTORIES'];
		}
		if ( isset( $_SERVER['KINSTA_CDN_EXEPTIONS'] ) && '' !== $_SERVER['KINSTA_CDN_EXEPTIONS'] ) {
			$custom['excludes'] = $_SERVER['KINSTA_CDN_EXEPTIONS'];
		}
		if ( isset( $_SERVER['KINSTA_CDN_HTTPS'] ) && '' !== $_SERVER['KINSTA_CDN_HTTPS'] ) {
			$custom['https'] = $_SERVER['KINSTA_CDN_HTTPS'];
		}

		return wp_parse_args(
			$custom,
			array(
				'url' => get_option( 'home' ),
				'dirs' => 'wp-content,wp-includes,images',
				'excludes' => '.php',
				'relative' => 1,
				'https' => 1,
			)
		);
	}

	/**
	 * Initiate the rewrite rules for the CDN URL
	 *
	 * @return void
	 * @author laci
	 * @since 2.0.1
	 * @version 1.0
	 */
	public static function handle_rewrite_hook() {
		$options = self::get_options();

		/* Check if it doesn't need to run */
		if ( ! $options || get_option( 'home' ) == $options['url'] ) { // WPCS: loose comparison ok.
			return;
		}

		$excludes = array_map( 'trim', explode( ',', $options['excludes'] ) );

		$rewriter = new CDN_Rewriter(
			get_option( 'home' ),
			$options['url'],
			$options['dirs'],
			$excludes,
			$options['relative'],
			$options['https']
		);
		ob_start(
			array( &$rewriter, 'rewrite' )
		);
	}

	/**
	 * Return if the Kinsta server based CDN service is enabled
	 *
	 * @return boolean
	 * @author laci
	 * @since  2.0.1
	 * @version 1.0.1
	 */
	public static function cdn_is_enabled() {
		return ( isset( $_SERVER['KINSTA_CDN_ENABLED'] ) && 1 == $_SERVER['KINSTA_CDN_ENABLED'] && ( ! defined( 'KINSTA_DEV_ENV' ) || KINSTA_DEV_ENV == false ) ) ? true : false; // WPCS: loose comparison ok.
	}
}

/**
 * Backward compatible, WP Rocket plugin's 3.0.1 version caused fatal error without this
 */
class CDNEnabler extends CDN_Enabler {}
