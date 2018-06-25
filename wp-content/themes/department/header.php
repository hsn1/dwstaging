<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--Set Viewport for Mobile Devices -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>
<?php
	global $page, $paged, $post;
	wp_title( '|', true, 'right' );
	//bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ocmx' ), max( $paged, $page ) );
?>
</title>
<!-- Setup OpenGraph support-->
<?php if(get_option("ocmx_open_graph") !="yes") {
	$default_thumb = get_option('ocmx_site_thumbnail');
	$fb_image = get_fbimage();
	if(is_home()) : ?>
	<meta property="og:title" content="<?php bloginfo('name'); ?>"/>
	<meta property="og:description" content="<?php bloginfo('description'); ?>"/>
	<meta property="og:url" content="<?php echo home_url(); ?>"/>
	<meta property="og:image" content="<?php if(isset($default_thumb) && $default_thumb !==""){echo $default_thumb; } else {echo $fb_image;}?>"/>
	<meta property="og:type" content="<?php echo "website";?>"/>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<?php else : ?>
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:description" content="<?php echo strip_tags($post->post_excerpt); ?>"/>
	<meta property="og:url" content="<?php the_permalink(); ?>"/>
	<meta property="og:image" content="<?php if($fb_image ==""){echo $default_thumb;} else {echo $fb_image;} ?>"/>
	<meta property="og:type" content="<?php echo "article"; ?>"/>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<?php endif;
}

// Custom favicon
if(get_option("ocmx_custom_favicon") != "") : ?>
	<link href="<?php echo get_option("ocmx_custom_favicon"); ?>" rel="icon" type="image/png" />
<?php endif; ?>

<?php  // Load custom header image for spectific pages
$parentpage = get_template_link(get_post_type().".php");
if(!empty($parentpage) && !is_page())
	$headerid = $parentpage->ID;
elseif(is_page())
	$headerid = $post->ID;

if(isset($headerid)) :
$header_bg_image = get_post_meta($headerid, "header_image", true);
$header_bg_attributes = get_post_meta($headerid, "header_image_attributes", true);

if($header_bg_image  != '' || !empty($header_bg_attributes["colour"])) : ?>
	<style>#title-container{
			background-image: <?php if($header_bg_image != '') echo "url($header_bg_image);"; ?>;
			background-repeat: <?php echo $header_bg_attributes['repeat']; ?>;
			background-position: <?php echo $header_bg_attributes['position']; ?>;
			background-color: <?php echo $header_bg_attributes['colour']; ?>;
		}
	</style>
<?php endif;
endif; ?>

<?php wp_head(); ?>
<script language="javascript">// <![CDATA[
$ = jQuery.noConflict();
// ]]></script>
<?php if(is_page(309) || is_page(582)): ?>

<script src="<?php echo get_template_directory_uri()."/scripts/howto.js";?>"></script>	
<?php endif; ?>
<?php if(is_child(1079) || is_child(1297) ) :?>
<link href="<?php echo get_template_directory_uri()."/data-collection-style.css";?>" rel="stylesheet" type="text/css" />
<?php endif;?>
<link href="<?php echo get_template_directory_uri()."/section_public.css";?>" rel="stylesheet" type="text/css" />
<?php
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


    if (strpos($url,'checkout') !== false) 
    {
        //do nothing
    }else
    {
    	echo '<script src="'.get_template_directory_uri().'/scripts/jquery.watermark.js"?>"></script>';
    	echo '<script src="'.get_template_directory_uri().'/scripts/gplus-youtubeembed.js"?>"></script>';
    	echo '<script src="'.get_template_directory_uri().'/scripts/global.js"?>"></script>';
    	echo '<script src="'.get_template_directory_uri().'/scripts/global_public.js"?>"></script>';
    	echo '<script src="'.get_template_directory_uri().'/scripts/tooltip.js"?>"></script>';
    }
?>

<script src="<?php echo get_template_directory_uri()."/scripts/jquery.tools.min.js"?>"></script>

<?php
//if(is_page(7)) : ?>
 <!--<script src="<?php //echo get_template_directory_uri()."/scripts/country_networks_en.js"?>"></script>
<?php  //elseif(is_page(611)) : ?>
 <script src="<?php echo get_template_directory_uri()."/scripts/country_networks_fr.js"?>"></script>
<?php //endif;
 ?>
<script src="<?php echo get_template_directory_uri()."/scripts/pricing.js"?>"></script> -->


<?php
/*$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


    if (strpos($url,'checkout') !== false) 
    {
        //do nothing
    }else
    {
    	echo '<script src="'.get_template_directory_uri().'/scripts/gplus-youtubeembed.js"?>"></script>'
    	<script src="<?php echo get_template_directory_uri()."/scripts/global.js"?>"></script>
<script src="<?php echo get_template_directory_uri()."/scripts/global_public.js"?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()."/scripts/tooltip.js"?>"></script>
    }*/
?>


</head>

<body <?php body_class(''); ?>>

<div id="wrapper" class="wrapper-content <?php echo get_option("ocmx_site_layout"); ?> <?php if( !is_active_sidebar( 'slider' ) ) echo "no-slider"; ?>">

	<div id="header-container">

		<?php get_template_part( 'functions/contact-header' ); ?>

		<div id="header" class="clearfix">
			<div class="logo">
				<h1 <?php if(get_option("ocmx_custom_logo") =="") echo 'class="default-logo"'; ?>>
					<a href="<?php echo home_url(); ?>">
						<?php if(get_option("ocmx_custom_logo")) : ?>
							<img src="<?php echo get_option("ocmx_custom_logo"); ?>" alt="<?php bloginfo('name'); ?>" />
						<?php else : ?>
							<?php bloginfo('name'); ?>
						<?php endif; ?>
					</a>
				</h1>
			</div>

			<?php $menustyle = get_option("ocmx_menu_style"); ?>
			<div id="navigation-container" class="<?php if( $menustyle !="" ) echo $menustyle; else echo "compact "; ?> clearfix">

				<a id="menu-drop-button" href="#">
					<?php if( '' != get_option( 'ocmx_menu_button_label' ) ) {
						echo get_option( 'ocmx_menu_button_label' );
					} else {
						_e( 'Menu' , 'ocmx' );
					} ?>
				</a>
				
				<?php if (function_exists("wp_nav_menu")) :
						wp_nav_menu(array(
							'menu' => 'Obox Nav',
							'menu_id' => 'nav',
							'menu_class' => 'clearfix',
							'sort_column' 	=> 'menu_order',
							'theme_location' => 'primary',
							'container' => 'ul',
							'fallback_cb' => 'ocmx_fallback')

					);
				endif; ?>
			</div>
			<?php $headercart = get_option("ocmx_headercart");
			if ( class_exists( "WooCommerce" ) && $headercart =="yes") {
				get_template_part( 'functions/header-cart' );
			} // If WooCommerce is Active ?>
		</div>
	</div>

	<div id="content-container" class="<?php if(is_tax('product_cat') || is_post_type_archive('product') || is_singular('product')) : echo get_option("ocmx_shop_sidebar_layout"); else : echo get_option("ocmx_sidebar_layout"); endif;?> clearfix">