<?php			
if (get_option("ocmx_slider_cat") != '1') :
					
	//SLIDER
	the_widget("obox_feature_posts_widget", array(
		"posttype" => "slider",
		"post_category" => get_option("ocmx_slider_cat"),
		"post_count" => get_option("ocmx_feature_post_count"),
		"auto_interval" => get_option("ocmx_feature_post_interval")
	));
	
endif; ?>


<div id="widget-block" class="clearfix <?php if (get_option("ocmx_slider_cat") != '1') : ?>home-page <?php else : ?>no-slider <?php endif;?>">
	<ul id="home_page_downs" class="widget-list">
		<?php
				 
		if (get_option("ocmx_services_three_col_cat") != 1) :
				
			// SERVICES THREE COL
			the_widget("obox_content_widget", array(
				"title" => get_option("ocmx_services_three_col_title"),
				"posttype" => "services",
				"post_count" => get_option("ocmx_services_three_col_post_count"),
				"layout_columns" => 'three',
				"postfilter" => "services-category",
				"filterval" => get_option("ocmx_services_three_col_cat"),
				"post_thumb" => get_option("ocmx_services_three_col_images"),
				"show_excerpts" => get_option("ocmx_services_three_col_excerpt"), 
				"excerpt_length" => get_option("ocmx_services_three_col_excerpt_length")
			));
			
		endif; 
		
		if ( class_exists( "WooCommerce" ) && get_option("ocmx_products_four_col_cat") != 1) :
			
			// PRODUCTS FOUR COL
			the_widget("obox_product_content_widget", array(
				"title" => get_option("ocmx_products_four_col_title"),
				"post_count" => get_option("ocmx_products_four_col_post_count"),
				"product_content" => "recent-products",
				"layout_columns" => 'four',
				"post_category" => get_option("ocmx_products_four_col_cat"),
				"post_thumb" => '1'
			));
			
		endif; 


		// TEXT WIDGET
		the_widget("WP_Widget_Text", array(
			"title" => get_option("ocmx_text_widget_title"), 
			"text" => get_option("ocmx_text_widget_text"), 
			
		));

		if ( class_exists( "WooCommerce" ) && get_option("ocmx_products_four_col_two_cat") != 1) :
			
			// PRODUCTS FOUR COL
			the_widget("obox_product_content_widget", array(
				"title" => get_option("ocmx_products_four_col_two_title"),
				"post_count" => get_option("ocmx_products_four_col_two_post_count"),
				"product_content" => "recent-products",
				"layout_columns" => 'four',
				"post_category" => get_option("ocmx_products_four_col_two_cat"),
				"post_thumb" => '1'
			));
			
		endif; 

		if (get_option("ocmx_testimonials_cat") != 1) :
			
			// TESTIMONIALS WIDGET
			the_widget("obox_content_testimonials_widget", array(
				"title" => get_option("ocmx_testimonials_title"), 
				"posttype" => "testimonials",
				"post_count" => get_option("ocmx_testimonials_post_count"),
				"post_category" => get_option("ocmx_testimonials_cat"),
				"auto_interval" => get_option("ocmx_testimonials_interval")
			));
			
		endif;

		if (get_option("ocmx_posts_three_col_cat") != 1) :
				
			// POSTS THREE COL
			the_widget("obox_content_widget", array(
				"title" => get_option("ocmx_posts_three_col_title"),
				"posttype" => "post",
				"post_count" => get_option("ocmx_posts_three_col_count"),
				"layout_columns" => 'three',
				"postfilter" => "category",
				"filterval" => get_option("ocmx_posts_three_col_cat"),
				"post_thumb" => get_option("ocmx_posts_three_col_images"),
				"show_date" => get_option("ocmx_posts_three_col_date"),
				"show_excerpts" => get_option("ocmx_posts_three_col_excerpt"),
				"excerpt_length" => get_option("ocmx_posts_three_col_excerpt_length"),
				"read_more" => get_option("ocmx_posts_three_col_readmore")
			));
			
		endif; 
		

		?>
	</ul>
</div>