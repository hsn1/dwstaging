<?php
/**
 * Initialize CDN Feature
 *
 * @package KinstaMUPlugins
 * @subpackage CDN
 * @since 2.0.0
 */

namespace Kinsta;

if ( ! defined( 'ABSPATH' ) ) { // If this file is called directly.
	die( 'No script kiddies please!' );
}

/* Defines */
define( 'KINSTA_CDN_ENABLER_MIN_WP', '3.8' );
define( 'KINSTA_SERVERNAME_CDN_DOMAIN', 'KINSTA_CDN_DOMAIN' );
define( 'KINSTA_SERVERNAME_CDN_OTHERDOMAIN', 'KINSTA_CDN_OTHERDOMAINS' );

/* Start CDN related stuff */
add_action( 'plugins_loaded', array( 'Kinsta\CDN_Enabler', 'instance' ), 99 );

/* Requires */
require_once 'class-cdn-enabler.php';
require_once 'class-cdn-rewriter.php';
