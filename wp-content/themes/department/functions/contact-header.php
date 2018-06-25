<?php
//includes "../functions.php";
$show_contact = get_option("ocmx_header_contact_show");
$phone = get_option("ocmx_header_contact_phone");
$email = get_option("ocmx_header_contact_email");
$facebook = get_option("ocmx_header_contact_facebook");
$twitter = get_option("ocmx_header_contact_twitter");
$linkedin = get_option("ocmx_header_contact_linkedin");
$googleplus = get_option("ocmx_header_contact_gplus");
//$pinterest = get_option("ocmx_header_contact_pinterest"); skype
$search = get_option("ocmx_header_search");
if($show_contact !="false" ) : ?>
	<div id="header-contact-container" class="clearfix">
		<div id="header-contacts" class="clearfix">
			<?php if(isset($search) && $search !="no") : ?>
				<div class="header-search">
					<form action="<?php echo home_url(); ?>" method="get" class="header-form">
						<input type="text" name="s" id="s" class="search-form" maxlength="50" value="" placeholder="Search" />
						<input type="submit" class="search_button" value="" />
						<span class="icon-search"></span>
					</form>
				</div>
			<?php endif; ?>
			
			<?php if ( $phone != '' || $email != '' ) { ?>
				<ul class="header-contact">
                                    
                                    <?php
                                    $number= '<li class="header-number">'.((ICL_LANGUAGE_CODE =='en')?$phone:"<a href='https://app.datawinners.com/fr/login'>Se connecter</a>");
                                    $email2= /*'<a href="mailto:'.$email.'" target="_blank">'.*/((ICL_LANGUAGE_CODE =='en')?$email:"<a href='https://app.datawinners.com/fr/register'>S'inscrire</a>");
                                    
                                    if( $phone !="" && $email !="") : echo $number."&nbsp;&nbsp;&nbsp;<strong style=\"color:#fff;\">|</strong>&nbsp;&nbsp;&nbsp;".$email2."</li>&nbsp;&nbsp;&nbsp;"; endif;?>
				</ul>
				&nbsp;&nbsp;
			<?php } // If contact details?>
			<ul class="header-contact" style="background : none repeat scroll 0 0 #429633;">
				
				<?php icl_top_languages();?>
			</ul>
			
			<?php if( $facebook !="" || $twitter !="" || $linkedin !="" || $pinterest !="") { ?>
				<ul class="header-social">
					<?php if($facebook !="") : ?><li class="header-facebook"><a href="<?php echo $facebook; ?>" target="_blank"><?php _e("Facebook"); ?></a></li><?php endif; ?>
					<?php if($twitter !="") : ?><li class="header-twitter"><a href="<?php echo $twitter; ?>" target="_blank"><?php _e("Twitter"); ?></a></li><?php endif; ?>
					<?php if($linkedin !="") : ?><li class="header-linkedin"><a href="<?php echo $linkedin; ?>" target="_blank"><?php _e("LinkedIn"); ?></a></li><?php endif; ?>
					<?php if($googleplus !="") : ?><li class="header-gplus"><a href="<?php echo $googleplus; ?>" target="_blank"><?php _e("Google Plus"); ?></a></li><?php endif; ?>
					<?php //if($pinterest !="") : ?><!--<li class="header-pinterest"><a href="<?php //echo $pinterest; ?>" target="_blank"><?php //_e("Pinterest"); ?></a></li>--><?php //endif; ?><!--Skype Link-->
				</ul>
			<?php }; // If social icons ?>

			<?php $headercart = get_option("ocmx_headercart");
			if ( class_exists( "WooCommerce" ) && $headercart =="yes") {
				global $woocommerce; ?>
				<a class="header-cart-button" href="#">
					<?php _e("Shopping Bag", "ocmx"); ?>
					<?php echo sprintf(_n('(%d)', '(%d)', $woocommerce->cart->cart_contents_count), $woocommerce->cart->cart_contents_count); ?>
				</a>
			<?php } // If WooCommerce is Active ?>

			<div id="top-navigation-container">
				<?php wp_nav_menu(array(
						'menu' => 'Top Obox Nav',
						'menu_id' => 'top-nav',
						'menu_class' => 'clearfix',
						'sort_column' 	=> 'menu_order',
						'theme_location' => 'top',
						'container' => 'ul',
						'fallback_cb' => false)
					); ?>
			</div>
		</div>
	</div>
<?php endif; ?>