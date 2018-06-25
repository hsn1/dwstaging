<?php
function ocmx_add_scripts()
	{
		global $obox_themeid, $post;

		//Add support for 2.9 and 3.0 functions and setup jQuery for theme
		wp_enqueue_script("jquery");
		if(!is_admin() && !(in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) ):
			// Include stylesheets
			wp_enqueue_style( $obox_themeid.'-style', get_bloginfo( 'stylesheet_url' ) );
			wp_enqueue_style( $obox_themeid.'-responsive', get_template_directory_uri().'/responsive.css');
			wp_enqueue_style( $obox_themeid.'-jplayer', get_template_directory_uri().'/ocmx/jplayer.css');
			wp_enqueue_style( $obox_themeid.'-customizer', home_url().'/?stylesheet=custom');


			// Font Inclusion
			wp_register_style( $obox_themeid.'-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,800,300');
			wp_enqueue_style( $obox_themeid.'-open-sans');

			// Theme Scripts
			wp_enqueue_script( $obox_themeid."-menus", get_template_directory_uri()."/scripts/menus.js", array( "jquery" ) );
			wp_enqueue_script( $obox_themeid."-fitvid", get_template_directory_uri()."/scripts/fitvid.js", array( "jquery" ) );
			wp_enqueue_script( $obox_themeid."-scripts", get_template_directory_uri()."/scripts/theme.js", array( "jquery" ) );
			wp_enqueue_script( $obox_themeid."-portfolio", get_template_directory_uri()."/scripts/portfolio.js", array( "jquery" ) );
			wp_enqueue_script( $obox_themeid."-classie", get_template_directory_uri()."/scripts/classie.js", array( "jquery" ), array(), true );
			wp_enqueue_script( $obox_themeid."-aniheader", get_template_directory_uri()."/scripts/aniheader.js", array( "jquery" ), array(), true );
                        //Andry modification
						$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


					    if (strpos($url,'checkout') !== false) {
					        //do nothing
					    }
					    else
					    {
					    	wp_enqueue_script( $obox_themeid."-portfolio", get_template_directory_uri()."/scripts/jquery.watermark.js", array( "jquery" ) );
	                        wp_enqueue_script( $obox_themeid."-portfolio", get_template_directory_uri()."/scripts/jquery.tools.min.js", array( "jquery" ) );
	                        wp_enqueue_script( $obox_themeid."-portfolio", get_template_directory_uri()."/scripts/global.js", array( "jquery" ) );
	                        wp_enqueue_script( $obox_themeid."-portfolio", get_template_directory_uri()."/scripts/global_public.js", array( "jquery" ) );
	                        wp_enqueue_script( $obox_themeid."-portfolio", get_template_directory_uri()."/scripts/pricing.js", array( "jquery" ) );
	                        wp_enqueue_script( $obox_themeid."-portfolio", get_template_directory_uri()."/scripts/tootip.js", array( "jquery" ) );
					    }
                        

			// Home Page slider scripts
			if(
				( is_home() && is_active_sidebar( 'slider' ) ) ||
				( is_page() && wp_basename( get_page_template() ) == 'widget-page.php' && is_active_sidebar( $post->post_name . "-slider" ) )
			) :
				wp_enqueue_script( $obox_themeid."-slider", get_template_directory_uri()."/scripts/slider.js", array( "jquery" ) );

			// Map scripts for contact page
			elseif( is_page() && wp_basename( get_page_template() ) == 'contact.php' ) :
				wp_enqueue_script( $obox_themeid."-map-api","http://maps.googleapis.com/maps/api/js?sensor=false");
				wp_enqueue_script( $obox_themeid."-map-trigger", get_template_directory_uri()."/scripts/maps.js", array( "jquery" ) );

				if( get_post_meta( $post->ID , 'zoom-level' , true ) != '' ) {
					$zoomlevel = get_post_meta( $post->ID , 'zoom-level' , true );
				} else {
					$zoomlevel = 15;
				}
				wp_localize_script( $obox_themeid."-map-trigger", "mapsettings", array( 'zoomlevel' => $zoomlevel ) );
			endif;

			if ( is_singular() ) wp_enqueue_script( "comment-reply" );

			//Localization
			wp_localize_script( $obox_themeid."-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );

		else :
			/* Back-end */
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-tabs' );

			wp_enqueue_script( "ajaxupload", get_template_directory_uri()."/scripts/ajaxupload.js", array( "jquery" ) );
			wp_enqueue_script( "ocmx-jquery", get_template_directory_uri()."/scripts/ocmx.js", array( "jquery" ) );
			wp_localize_script( "ocmx-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );

			wp_enqueue_style( 'welcome-page', get_template_directory_uri() . '/ocmx/welcome-page.css');
		endif;
	}
add_action('wp_enqueue_scripts', 'ocmx_add_scripts');
add_action('admin_enqueue_scripts', 'ocmx_add_scripts');

function ocmx_add_ajax_calls(){
	//AJAX Functions
	add_action( 'wp_ajax_nopriv_ocmx_cart_display', 'ocmx_cart_display'  );
	add_action( 'wp_ajax_ocmx_cart_display', 'ocmx_cart_display' );

	add_action( 'wp_ajax_nopriv_ocmx_cart_button_display', 'ocmx_cart_button_display'  );
	add_action( 'wp_ajax_ocmx_cart_button_display', 'ocmx_cart_button_display' );

	add_action( 'wp_ajax_ocmx_save-options', 'update_ocmx_options');
	add_action( 'wp_ajax_ocmx_reset-options', 'reset_ocmx_options');
	add_action( 'wp_ajax_ocmx_ads-refresh', 'ocmx_ads_refresh' );
	add_action( 'wp_ajax_ocmx_ads-remove', 'ocmx_ads_remove' );
	add_action( 'wp_ajax_ocmx_layout-refresh', 'ocmx_layout_refresh' );
	add_action( 'wp_ajax_ocmx_ajax-upload', 'ocmx_ajax_upload' );
	add_action( 'wp_ajax_ocmx_remove-image', 'ocmx_ajax_remove_image' );
}
add_action('init', 'ocmx_add_ajax_calls');

//function replace_add_string_scripts() {
    //$my_plugin = WP_PLUGIN_DIR.'/searchreplace';
    //wp_enqueue_script( 'replace_add_string_scripts', $my_plugin.'/include/js/formhandler.js', array( 'jquery' ), '1.0.0', true );
//}
//add_action( 'wp_enqueue_scripts', 'replace_add_string_scripts' );