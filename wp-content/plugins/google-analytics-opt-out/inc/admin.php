<?php

function gaoop_admin_notice() {

	$code = gaoop_get_ua_code();
	if ( ! empty( $code ) ) {
		return;
	}
	?>
	<div class="error">
		<p>
			<a href="<?php echo admin_url( 'options-general.php?page=gaoo-options' ); ?>"><?php _e( 'To use the Google Analytics Opt-Out Plugin please enter an UA-Code on the settings page.', 'google-analytics-opt-out' ); ?></a>
		</p>
	</div>
	<?php
}

add_action( 'admin_notices', 'gaoop_admin_notice' );


/**
 * Adds some action links to the plugin on the list of plugins page
 *
 * @param array $links
 *
 * @since 1.0
 *
 * @return array
 */
function gaoop_plugin_action_links( $links ) {

	$links[] = '<a href="' . admin_url( 'options-general.php?page=gaoo-options' ) . '">' . __( 'Settings', 'google-analytics-opt-out' ) . '</a>';
	$links[] = '<a target="_blank" href="http://wp-buddy.com">' . __( 'More by WP-Buddy', 'google-analytics-opt-out' ) . '</a>';

	return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( GAOOP_FILE ), 'gaoop_plugin_action_links' );


/**
 * Adds the editor button functions
 *
 * @since 1.0
 * @return void
 */
function gaoop_editor_button() {

	if ( get_user_option( 'rich_editing' ) == true ) {
		add_filter( "mce_external_plugins", 'gaoop_add_mce_plugin' );
		add_filter( 'mce_buttons', 'gaoop_register_mce_buttons' );
	}
}

add_action( 'init', 'gaoop_editor_button' );

/**
 * Adds the plugin to tinymce
 *
 * @param array $plugin_array
 *
 * @since 1.0
 *
 * @return array
 */
function gaoop_add_mce_plugin( $plugin_array ) {

	$plugin_array['wpb_analytics_opt_out'] = GAOOP_URL . 'js/editor-button.js';

	return $plugin_array;
}

/**
 * Adds the button
 *
 * @param array $buttons
 *
 * @since 1.0
 *
 * @return array
 */
function gaoop_register_mce_buttons( $buttons ) {

	array_push( $buttons, "wpb_analytics_opt_out" );

	return $buttons;
}


/**
 * Import settings from old version
 *
 * @since 2.0.0
 */
function gaoop_import_from_old_version() {

	$ua_code = get_option( 'gaoo_property', '' );
	if ( ! empty( $ua_code ) ) {
		update_option( 'gaoop_property', $ua_code );
		delete_option( 'gaoo_property' );

		update_option( 'gaoop_yoast', (bool) get_option( 'gaoo_yoast', false ) );
		delete_option( 'gaoo_yoast' );
	}
}

add_action( 'admin_init', 'gaoop_import_from_old_version' );
