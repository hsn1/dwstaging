<?php
/*
Template Name: Template all category
*/
$pagename = get_query_var('pagename');
$nbpage = get_option( 'posts_per_page' );
get_header(); ?>

<?php get_template_part('/functions/page-title'); ?>

<div id="content" class="clearfix">
	<div id="left-column">
		<ul class="post-list">
			<?php
			global $wp_query;
			global $paged;
			$args = array(
				"post_type" => "post",
				"paged" => $paged,
				'nopaging' => false
			);

			$temp = $wp_query;
			$wp_query = null;

			$wp_query = new WP_Query($args);
			$wp_query->query('posts_per_page='.$nbpage.'&category_name='.$pagename.'&paged='.$paged);
			//var_dump($wp_query->posts);
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				global $post;
				get_template_part("/functions/post-list");
			endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
		<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
		<?php $wp_query = null;
		$wp_query = $temp;  ?>
	</div>

	<?php if(get_option("ocmx_sidebar_layout") != "sidebarnone"): ?>
		<?php get_sidebar('categories'); ?>
	<?php endif;?>
</div>
<?php get_footer(); ?>
?>