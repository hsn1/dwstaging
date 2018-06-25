<?php

/**
 * Creating the menu item
 *
 * @since 1.0
 * @return void
 */
function gaoop_admin_menu() {

	$hook = add_submenu_page( 'options-general.php', __( 'Analytics Opt-Out', 'google-analytics-opt-out' ), __( 'Analytics Opt-Out', 'google-analytics-opt-out' ), 'manage_options', 'gaoo-options', 'gaoop_settings_page' );
	add_action( "load-$hook", 'gaoop_settings_scripts' );

	$hook = add_submenu_page( 'monsterinsights_dashboard', __( 'Analytics Opt-Out', 'google-analytics-opt-out' ), __( 'Opt-Out Settings', 'google-analytics-opt-out' ), 'manage_options', 'gaoo-options', 'gaoop_settings_page' );
	add_action( "load-$hook", 'gaoop_settings_scripts' );
}

add_action( 'admin_menu', 'gaoop_admin_menu', 30 );


/**
 * Creating the settings page HTML output
 *
 * @since 1.0
 * @return void
 */
function gaoop_settings_page() {

	?>
	<div class="wrap">
		<div id="icon-options-general" class="icon32"></div>
		<h2><?php _e( 'Google Analaytics Opt-Out Pro', 'google-analytics-opt-out' ); ?> </h2>

		<form action="options.php" method="post">
			<?php
			settings_fields( 'gaoop_options_page' );
			do_settings_sections( 'gaoop_options_page' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}


/**
 * Enqueues the settings page scripts and styles
 *
 * @since 1.0
 * @return void
 */
function gaoop_settings_scripts() {

	wp_enqueue_script( 'equipment', GAOOP_URL . '/js/settings.js', array( 'jquery' ), false, true );
}


/**
 * Registers Settings sections and fields
 *
 * @since 1.0
 * @return void
 */
function gaoop_register_theme_options_section() {

	add_settings_section( 'gaoop_settings_section', __( 'Analytics Opt-Out', 'google-analytics-opt-out' ), null, 'gaoop_options_page' );

	add_settings_field( 'gaoop_yoast', __( 'Use Monster Insights Settings', 'google-analytics-opt-out' ), 'gaoop_options_yoast', 'gaoop_options_page', 'gaoop_settings_section', array( 'label_for' => 'gaoop_options_yoast' ) );
	register_setting( 'gaoop_options_page', 'gaoop_yoast', 'intval' );

	add_settings_field( 'gaoop_property', __( 'UA-Code', 'google-analytics-opt-out' ), 'gaoop_options_property', 'gaoop_options_page', 'gaoop_settings_section', array( 'label_for' => 'gaoop_options_property' ) );
	register_setting( 'gaoop_options_page', 'gaoop_property', 'sanitize_text_field' );

	add_settings_field( 'gaoop_banner', __( 'Use Banner', 'google-analytics-opt-out' ), 'gaoop_options_banner', 'gaoop_options_page', 'gaoop_settings_section', array( 'label_for' => 'gaoop_options_banner' ) );
	register_setting( 'gaoop_options_page', 'gaoop_banner', 'intval' );

	add_settings_field( 'gaoop_opt_out_text', __( 'Opt-Out Banner-Text', 'google-analytics-opt-out' ), 'gaoop_options_opt_out_text', 'gaoop_options_page', 'gaoop_settings_section', array( 'label_for' => 'gaoop_options_opt_out_text' ) );
	register_setting( 'gaoop_options_page', 'gaoop_opt_out_text', 'wp_kses_post' );

	add_settings_field( 'gaoop_opt_out_shortcode_integration', __( 'Integrate Shortcode', 'google-analytics-opt-out' ), 'gaoop_options_opt_out_shortcode_integration', 'gaoop_options_page', 'gaoop_settings_section', array( 'label_for' => 'gaoop_options_opt_out_shortcode_integration' ) );
	register_setting( 'gaoop_options_page', 'gaoop_opt_out_shortcode_integration', 'sanitize_text_field' );

	add_settings_field( 'gaoop_opt_out_cookie_set_text', __( 'Opt-Out Successful', 'google-analytics-opt-out' ), 'gaoop_options_opt_out_cookie_set_text', 'gaoop_options_page', 'gaoop_settings_section', array( 'label_for' => 'gaoop_options_opt_out_cookie_set_text' ) );
	register_setting( 'gaoop_options_page', 'gaoop_opt_out_cookie_set_text', 'sanitize_text_field' );

	add_settings_field( 'gaoop_hide', __( 'Hide banner after closing', 'google-analytics-opt-out' ), 'gaoop_options_hide', 'gaoop_options_page', 'gaoop_settings_section', array( 'label_for' => 'gaoop_options_hide' ) );
	register_setting( 'gaoop_options_page', 'gaoop_hide', 'intval' );

	add_settings_field( 'gaoop_custom_styles', __( 'Custom CSS', 'google-analytics-opt-out' ), 'gaoop_options_custom_styles', 'gaoop_options_page', 'gaoop_settings_section', array( 'label_for' => 'gaoop_options_custom_styles' ) );
	register_setting( 'gaoop_options_page', 'gaoop_custom_styles' );


}

add_action( 'admin_init', 'gaoop_register_theme_options_section' );


/**
 * Settings field for the Yoast Checkbox
 *
 * @since 1.0
 * @return void
 */
function gaoop_options_yoast() {

	$monster_insights_active = gaoop_monster_insights_plugin_active();

	$option = get_option( 'gaoop_yoast', null );

	// if the plugin is used the first time it has the value of NULL. In this case we set the option to 1
	if ( is_null( $option ) ) {
		$option = 1;
	}

	if ( ! $monster_insights_active ) {
		$option = 0;
	}

	echo '<input ' . disabled( ! $monster_insights_active, true, false ) . ' ' . checked( $option, 1, false ) . ' id="gaoop_options_yoast" type="checkbox" name="gaoop_yoast" value="1" />';
	echo '<p class="description">';
	if ( $monster_insights_active ) {
		echo '<span style="color: #5EB95E;">' . __( 'Monster Insights Plugin has been detected.', 'google-analytics-opt-out' ) . '</span>';
	} else {
		echo '<span style="color: #DD514C;">' . __( 'Monster Insights Plugin has NOT been detected. Please enter your UA code manually and then check the sourcode of your website. Make sure that Analytics code appears AFTER the opt-out code (which starts with <code>/* Google Analytics Opt-Out</code>).', 'google-analytics-opt-out' ) . '</span>';
	}
	echo '</p>';
}


/**
 * Settings field for the UA property
 *
 * @since 1.0
 * @return void
 */
function gaoop_options_property() {

	$monster_insights_active = gaoop_monster_insights_plugin_active();
	$option       = get_option( 'gaoop_yoast', null );

	if ( $monster_insights_active && 1 == $option ) {
		$value = gaoop_get_monster_insights_ua();
	} else {
		$value = sanitize_text_field( get_option( 'gaoop_property', '' ) );
	}

	echo '<input id="gaoop_options_property" placeholder="UA-XXXXXX-X" type="text" class="regular-text" value="' . $value . '" name="gaoop_property" /> ';

}


/**
 * Settings field for the banner checkbox
 *
 * @since 2.0.0
 * @return void
 */
function gaoop_options_banner() {

	$banner_active = (bool) get_option( 'gaoop_banner', false );

	echo '<input ' . checked( $banner_active, true, false ) . ' id="gaoop_options_banner" type="checkbox" name="gaoop_banner" value="1" />';
}


/**
 * Settings field for the UA property
 *
 * @since 1.0
 * @return void
 */
function gaoop_options_opt_out_text() {

	wp_editor(
		get_option( 'gaoop_opt_out_text', '' ),
		'gaoop_options_opt_out_text',
		array(
			'textarea_name' => 'gaoop_opt_out_text',
		)
	);

	printf( '<p class="description">%s</p>', __( 'Please integrate the shortcode so that the user can opt-out.', 'google-analytics-opt-out' ) );
}

/**
 * Set if the shortcode should be integrated automatically when it's not there.
 *
 * @since 1.4
 */
function gaoop_options_opt_out_shortcode_integration() {

	printf(
		'<input type="checkbox" id="gaoop_options_opt_out_shortcode_integration" value="1" name="gaoop_opt_out_shortcode_integration" %s />',
		checked( (bool) get_option( 'gaoop_opt_out_shortcode_integration', 1 ), true, false )
	);
	printf( '<p class="description">%s</p>', __( 'If the shortcode was not detected, it will be added automatically.', 'google-analytics-opt-out' ) );
}

/**
 * Successful Opt-Out Text
 *
 * @since 1.0
 * @return void
 */
function gaoop_options_opt_out_cookie_set_text() {

	echo '<input id="gaoop_options_opt_out_cookie_set_text" placeholder="' . __( 'Thanks. We have set a cookie so that Google Analytics data collection will be disabled on your next visit.', 'google-analytics-opt-out' ) . '" type="text" class="regular-text" value="' . sanitize_text_field( get_option( 'gaoop_opt_out_cookie_set_text', '' ) ) . '" name="gaoop_opt_out_cookie_set_text" /> ';

}

/**
 * Settings field for the Hide checkbox
 *
 * @since 1.0
 * @return void
 */
function gaoop_options_hide() {

	echo '<input type="checkbox" id="gaoop_options_hide" ' . checked( intval( get_option( 'gaoop_hide', 0 ) ), 1, false ) . ' value="1" name="gaoop_hide" /> ';
	echo '<p class="description">' . __( 'This will hide the opt-out box after the user has clicked the close-button. Otherwise a little info-button will be fixed to the bottom-right.', 'google-analytics-opt-out' ) . '</p>';

}

/**
 * Settings field for the custom CSS textarea
 *
 * @since 1.0
 * @return void
 */
function gaoop_options_custom_styles() {

	echo '<textarea id="gaoop_options_custom_styles" style="width: 400px;" cols="30" rows="5" class="regular-text" name="gaoop_custom_styles">' . esc_textarea( get_option( 'gaoop_custom_styles', '' ) ) . '</textarea> ';
}
