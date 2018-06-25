<?php
/*
Template Name: Blog
 * Success-Stories
*/ 

get_header(); ?>

<?php get_template_part('/functions/page-title'); ?>

<div id="content" class="clearfix">
    <div id="left-column">
    	<ul class="post-list">
			<?php 
			$args = array(
				"post_type" => "post", 
				"paged" => $paged
			);
				
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query($args);	
			$wp_query->query('showposts=1000&category_name=success-stories');
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				global $post;
				get_template_part("/functions/post-list");
			endwhile; ?> 
        </ul>
		<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
		<?php $wp_query = null; $wp_query = $temp;?>
	</div>
	
	<?php if(get_option("ocmx_sidebar_layout") != "sidebarnone"): ?>
		<?php get_sidebar('categories'); ?>
	<?php endif;?>
</div>
<?php get_footer(); ?>