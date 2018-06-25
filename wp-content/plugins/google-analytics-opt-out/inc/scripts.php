<?php
/**
 * Echos out the JavaScript for the opt-out
 *
 * @since 1.0
 * @deprecated 2.0.2
 *
 * @todo Remove this is a future version.
 *
 * @return void
 */
function gaoop_head_script() {

//
//	if ( apply_filters( 'gaoop_stop_head', false ) ) {
//		return;
//	}
//
//	gaoop_js();
}

/**
 * Echos out the Javascript or returns it (if $echo is set to TRUE)
 *
 * @since 1.0
 *
 * @param bool $echo
 *
 * @return void|string
 */
function gaoop_js( $echo = true ) {

	$ua_code = gaoop_get_ua_code();
	if ( empty( $ua_code ) ) {
		return '';
	}
	ob_start();
if ( $echo ):
	?>
	<script type="text/javascript">
		<?php
		endif;
		?>
		/* Google Analytics Opt-Out WordPress by WP-Buddy | http://wp-buddy.com/products/plugins/google-analytics-opt-out */
		<?php do_action( 'gaoop_js_before_script' ); ?>
		var gaoop_property    = '<?php echo $ua_code; ?>';
		var gaoop_disable_str = 'ga-disable-' + gaoop_property;
		if ( document.cookie.indexOf( gaoop_disable_str + '=true' ) > -1 ) {
			window[ gaoop_disable_str ] = true;
		}
		function gaoop_analytics_optout() {
			document.cookie             = gaoop_disable_str + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
			window[ gaoop_disable_str ] = true;
			<?php echo apply_filters( 'gaoop_cookie_set', '' ); ?>
		}
		<?php
		do_action( 'gaoop_js_after_script' );

		if($echo):
		?>
	</script>
	<?php
endif;
	$content = ob_get_clean();
	if ( $echo ) {
		echo $content;
	} else {
		return $content;
	}
}

/**
 * Enqueue Frontend Scripts
 *
 * @since 1.0
 */
function gaoop_enqueue_scripts() {

	wp_enqueue_script( 'goop', GAOOP_URL . 'js/frontend.js', array( 'jquery' ), false, true );

	add_filter( 'script_loader_tag', function ( $tag, $handle ) {

		if ( $handle === 'goop' && false === stripos( $tag, 'defer' ) ) {
			return str_replace( '<script', '<script defer ', $tag );
		}

		return $tag;
	}, 10, 2 );

	$js = gaoop_js( false );
	wp_add_inline_script( 'goop', $js );
}

add_action( 'init', 'gaoop_enqueue_scripts' );

