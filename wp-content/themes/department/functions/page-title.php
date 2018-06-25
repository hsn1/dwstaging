<?php if(get_option("ocmx_hide_title") !="no") {
	$parentpage = get_template_link(get_post_type().".php");
	$pagetitle_copy = get_option("ocmx_pagetitle_copy");
        $categories = get_the_category();
	if (class_exists( 'Woocommerce' )) { if(function_exists('is_shop') && ( is_shop() || is_product() ) ) : ?>
        <!--shop-->
		<div id="title-container">
                    <!--shop-->
			<div class="title-block">
				<?php 
				$shop_page_id = woocommerce_get_page_id('shop');
				$shop_title = get_post( $shop_page_id ); 
				if( !is_object( $shop_title ) ) { ?>
					<h1><?php _e( 'Shop' , 'ocmx' ); ?></h1>
				<?php } else { ?>
					<h1><?php echo $shop_title->post_title; ?></h1>
				<?php }?>
			</div>
		</div>
	<?php endif; } ?>
	<?php if(!is_page() && get_query_var('term' ) != '' ) :
		$term = get_term_by( 'slug', get_query_var('term' ), get_query_var( 'taxonomy' ) ); ?>
        <!--!ispage-->
		<div id="title-container">
                    <!--page-->
			<div class="title-block">
				<h1><?php echo $term->name; ?></h1>
				<?php if($pagetitle_copy !="no") :
					if ( !empty( $term->description) ) :
						echo '<p>'.$term->description.'</p>';
					else :
						false;
					endif;
				endif; ?>
			</div>
		</div>
	<?php elseif(!empty($parentpage) && !is_search()) : 
		$parentpage = get_template_link(get_post_type().".php"); 
		$pagetitle_copy = get_option("ocmx_pagetitle_copy"); ?>
        <!--no-->
		<div id="title-container">
                    <!--no-->
			<div class="title-block">
				<h1><?php echo $parentpage->post_title; ?></h1>
				<?php if($pagetitle_copy !="no") :
					if($parentpage->post_excerpt != '') : echo '<p>'.$parentpage->post_excerpt.'</p>'; endif;
				endif; ?>
			</div>
		</div>
         <?php elseif( ( get_post_type() == "post" ) && in_category(55) || in_category(72)  && !is_search() ) : ?>
        <!--post-->
		<div id="title-container">
                    <!--post-->
			<div class="title-block">
				<h1><?php echo (ICL_LANGUAGE_CODE == "en")?get_cat_name(55):get_cat_name(72);//Success Stories et Réussites?></h1>
				<?php if($pagetitle_copy !="no") :
					echo category_description();
				endif; ?>
			</div>
		</div>
        <?php elseif( ( get_post_type() == "post" ) && in_category(181) || in_category(177)  && !is_search() ) : ?>
        <!--post-->
		<div id="title-container">
                    <!--post-->
			<div class="title-block">
				<h1><?php echo (ICL_LANGUAGE_CODE == "en")?get_cat_name(177):get_cat_name(181);//Tips?></h1>
				<?php if($pagetitle_copy !="no") :
					echo category_description();
				endif; ?>
			</div>
		</div>
        <?php elseif( ( get_post_type() == "qa_faqs") || is_search() ) : ?>
        <!--post-->
		<div id="title-container">
                    <!--post-->
			<div class="title-block">
				<h1><?php echo (ICL_LANGUAGE_CODE == "en")?"Find Answers":"Trouvez des Réponses"; ?></h1>
				<?php if($pagetitle_copy !="no") :
					echo category_description();
				endif; ?>
			</div>
		</div>
        <?php elseif(  get_post_type() == "post" && (in_category('dwctd') || in_category('dwctd-fr'))): ?>
        <!--post-->
		<div id="title-container">
                    <!--post-->
			<div class="title-block">
				<h1><?php echo (ICL_LANGUAGE_CODE == "en")?"Tips for Successful Data Collection":"Conseils pour une Collecte de Données réussie";?></h1>
				<?php if($pagetitle_copy !="no") :
					echo category_description();
				endif; ?>
			</div>
		</div>
	<?php elseif( ( get_post_type() == "post") || is_search()) : ?>
        <!--poste-->
		<div id="title-container">
                    <!--post-->
			<div class="title-block">
				<h1><?php wp_title();?></h1>
				<?php if($pagetitle_copy !="no") :
					echo category_description();
				endif; ?>
			</div>
		</div>
        
	<?php elseif(get_post_type() == "post" && is_single()) : 
                $separator = ', ';
                $output = '';?>
        <!--cat-->
		<div id="title-container">
                    <!--cat-->
			<div class="title-block">
				<h1><?php if($categories){
                        
                            foreach($categories as $category) {
                                //echo $category->cat_name;
                            if($category->category_parent == 66 OR $category->category_parent == 98 OR $category->category_parent == 74)
                            {
                                $output.= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
                            }
                            
                            }
                            echo trim($output,$separator);
                            }
                            ?></h1>
				<?php if($pagetitle_copy !="no") :
					echo category_description();
				endif; ?>
			</div>
		</div>
	<?php else : ?>
		<?php while ( have_posts() ) : the_post(); 
			$header_bg_image = get_post_meta($post->ID, "header_image", true);
			$header_bg_attributes = get_post_meta($post->ID, "header_image_attributes", true);
			if($header_bg_image  != '' || !empty($header_bg_attributes["colour"]) || is_page()) : ?>
                <!--img-->
			<div id="title-container">
                <?php echo "<!--img-->";//if ($post->ID == 7 || $post->ID == 611) { ?>
                    <div class="title-block">              
					<h1><?php the_title(); ?></h1>
					<?php if($pagetitle_copy !="no") :
						// Check if we're using a real excerpt or the content
						if( $post->post_excerpt != "") :
							$excerpt = get_the_excerpt();
							$excerpttext = strip_tags( $excerpt );
						endif;
						
						// If the Excerpt exists, continue
						if(isset($excerpttext) && $excerpttext != "" ) :

						// Use an ellipsis if the excerpt is longer than the count
							echo '<p>'.$excerpttext.'</p>';
						endif;	
					endif; ?>
				</div>
			</div>
		<?php endif;
		endwhile; ?>
	<?php endif; 
} ?>

<!--<div id="crumbs-container">
	<?php //ocmx_breadcrumbs(); ?>
</div> -->