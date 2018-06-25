<?php

/**
 * Adds a hidden div to the footer
 *
 * @since 1.0
 * @return void
 */
function gaoop_footer() {

	if ( ! get_option( 'gaoop_banner', false ) ) {
		return;
	}

	$opt_out_text = apply_filters( 'gaoop_optout_text', '' );
	if ( empty( $opt_out_text ) ) {
		return;
	}
	echo '<div style="display: none;" data-gaoop_ua="' . gaoop_get_ua_code() . '" data-gaoop_hide="' . intval( get_option( 'gaoop_hide', 0 ) ) . '" class="gaoop">'
	     . '<a class="gaoop-info-icon" href="#" title="' . __( 'Google Analytics Opt-Out Information', 'google-analytics-opt-out' ) . '" ><img src="' . apply_filters( 'gaoop_info_icon', GAOOP_URL . 'images/info-icon.png' ) . '" alt="' . __( 'Close', 'google-analytics-opt-out' ) . '" /></a>'
	     . '<div class="gaoop-opt-out-content">' . $opt_out_text . '</div>'
	     . '<a class="gaoop-close-icon" href="#" title="' . __( 'Close this and do not ask me again', 'google-analytics-opt-out' ) . '"><img src="' . apply_filters( 'gaoop_close_icon', GAOOP_URL . 'images/close-icon.png' ) . '" alt="' . __( 'Close this and do not ask me again', 'google-analytics-opt-out' ) . '" /></a>'
	     . '</div>';

}

add_action( 'wp_footer', 'gaoop_footer' );


/**
 * The opt-out text on the DIV on the footer
 *
 * @since 1.0
 */
function gaoop_optout_text() {

	$opt_out_text = get_option( 'gaoop_opt_out_text', '' );
	if ( empty( $opt_out_text ) ) {
		$opt_out_text = __( 'This website is using Google Analytics. Please click here if you want to opt-out.', 'google-analytics-opt-out' );
	}

	if ( ! has_shortcode( $opt_out_text, 'google_analytics_optout' ) && (bool) get_option( 'gaoop_opt_out_shortcode_integration', 1 ) ) {
		$opt_out_text .= sprintf( ' [google_analytics_optout]%s[/google_analytics_optout]', __( 'Click here to opt-out.', 'google-analytics-opt-out' ) );
	}

	return $opt_out_text;
}

add_filter( 'gaoop_optout_text', 'gaoop_optout_text', 5 );

add_filter( 'gaoop_optout_text', 'do_shortcode', 15 );

/**
 * Adds the custom styles to the header
 *
 * @since 1.0
 * @return void
 */
function gaoop_wp_head() {

	$box_shadow = '0 4px 15px rgba(0, 0, 0, 0.4)';

	$standard_css_array = array(
		'.gaoop'                                                             => array(
			'color'              => '#ffffff',
			'line-height'        => '2',
			'position'           => 'fixed',
			'bottom'             => 0,
			'left'               => 0,
			'width'              => '100%',
			'-webkit-box-shadow' => $box_shadow,
			'-moz-box-shadow'    => $box_shadow,
			'box-shadow'         => $box_shadow,
			'background-color'   => '#0E90D2',
			'padding'            => 0,
			'margin'             => 0,
		),
		'.gaoop a'                                                           => array(
			'color'           => '#67C2F0',
			'text-decoration' => 'none',
		),
		'.gaoop a:hover'                                                     => array(
			'color'           => '#ffffff',
			'text-decoration' => 'underline',
		),
		'.gaoop-info-icon'                                                   => array(
			'position'       => 'relative',
			'margin'         => '0',
			'padding'        => '0',
			'text-align'     => 'center',
			'vertical-align' => 'top',
			'display'        => 'inline-block',
			'width'          => '5%',
		),
		'.gaoop-close-icon'                                                  => array(
			'position'       => 'relative',
			'opacity'        => '0.5',
			'ms-filter'      => '"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)"',
			'filter'         => 'alpha(opacity=50)',
			'-moz-opacity'   => '0.5',
			'-khtml-opacity' => '0.5',
			'margin'         => '0',
			'padding'        => '0',
			'text-align'     => 'center',
			'vertical-align' => 'top',
			'display'        => 'inline-block',
			'width'          => '5%',
		),
		'.gaoop-close-icon:hover'                                            => array(
			'z-index'        => '1',
			'opacity'        => '1',
			'ms-filter'      => '"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"',
			'filter'         => 'alpha(opacity=100)',
			'-moz-opacity'   => '1',
			'-khtml-opacity' => '1',
		),
		'.gaoop_closed .gaoop-opt-out-link, .gaoop_closed .gaoop-close-icon' => array(
			'display' => 'none',
		),
		'.gaoop_closed'                                                      => array(
			'width'          => '55px',
			'right'          => 0,
			'left'           => 'auto',
			'opacity'        => '0.5',
			'ms-filter'      => '"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)"',
			'filter'         => 'alpha(opacity=50)',
			'-moz-opacity'   => '0.5',
			'-khtml-opacity' => '0.5',
		),
		'.gaoop_closed:hover'                                                => array(
			'opacity'        => '1',
			'ms-filter'      => '"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"',
			'filter'         => 'alpha(opacity=100)',
			'-moz-opacity'   => '1',
			'-khtml-opacity' => '1',
		),
		'.gaoop_closed .gaoop-opt-out-content'                               => array(
			'display' => 'none',
		),
		'.gaoop_closed .gaoop-info-icon'                                     => array(
			'width' => '100%',
		),
		'.gaoop-opt-out-content'                                             => array(
			'display'        => 'inline-block',
			'width'          => '90%',
			'vertical-align' => 'top',
		),
	);

	$standard_css_array = apply_filters( 'gaoop_standard_styles_array', $standard_css_array );

	$standard_css = '';
	if ( is_array( $standard_css_array ) ) {
		foreach ( $standard_css_array as $key => $options ) {
			$standard_css .= $key . ' {';
			if ( is_array( $options ) ) {
				foreach ( $options as $option => $value ) {
					$standard_css .= $option . ': ' . $value . '; ';
				}
			}
			$standard_css .= '} ';
		}
	}

	$standard_css = apply_filters( 'gaoop_standard_styles', $standard_css );

	$custom_css = get_option( 'gaoop_custom_styles', '' );
	$custom_css = apply_filters( 'gaoop_custom_styles', $custom_css );

	echo '<style type="text/css">/** Google Analytics Opt Out Custom CSS */' . $standard_css . $custom_css . '</style>';
}

add_action( 'wp_head', 'gaoop_wp_head' );