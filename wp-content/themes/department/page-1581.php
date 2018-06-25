<?php
/*
Template Name: Blog
 *  Datawinners Can Do That
*/ 

get_header(); ?>

<?php get_template_part('/functions/page-title'); ?>

<div id="content" class="clearfix">
    <div id="left-column">
    	<ul class="post-list">
			<?php 
			$indexPage = 0;
			$args = array(
				"post_type" => "post",
				"paged" => $paged
			);
			
			
			$wp_query = new WP_Query($args);
			
			$temp = $wp_query; 
			$num_posts_per_page = get_option("posts_per_page"); 	
			$string_query = 'showposts=1000&category_name=tips';
			$wp_query->query($string_query);
                    
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				global $post;
				get_template_part("/functions/post-list");
			endwhile;
			$temp1 =   $wp_query; 
			 ?> 
        </ul>
		<?php motionpic_pagination("clearfix", "pagination clearfix",$temp); ?>
		<?php $wp_query = $temp1;?>
	</div>
	
	<?php if(get_option("ocmx_sidebar_layout") != "sidebarnone"): ?>
		<?php get_sidebar('categories'); ?>
	<?php endif;?>
</div>
<?php get_footer(); ?>