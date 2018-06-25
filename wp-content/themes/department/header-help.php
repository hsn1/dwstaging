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
	bloginfo( 'name' );
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

<?php wp_head(); 

show_admin_bar(false);?>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/style-help.css"?>"/>
<script language="javascript">// <![CDATA[
$ = jQuery.noConflict();
// ]]></script>


<!-- <script src="http://datawinners.com/media/javascript/home/country_networks_fr.js"></script> -->
<script type="text/javascript">    
        function iframe_resize() {
            var body = document.body,
            html = document.documentElement,
            height = Math.max(body.scrollHeight, body.offsetHeight, 
	        html.clientHeight, html.scrollHeight, html.offsetHeight);
            if (parent.postMessage) {
                parent.postMessage(height, "*");
            }
        }
</script>
<script src="<?php echo get_template_directory_uri()."/scripts/target_Blank.js";?>"></script>
</head>

<body style="background: none repeat scroll 0 0 #fff;" onload="iframe_resize();">

<div id="wrapper" class="wrapper-content <?php echo get_option("ocmx_site_layout"); ?> <?php if( !is_active_sidebar( 'slider' ) ) echo "no-slider"; ?>">
	