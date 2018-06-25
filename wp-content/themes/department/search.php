<?php
get_header();
$pagetitle_copy = get_option("ocmx_pagetitle_copy");
?>

<?php get_template_part('/functions/page-title'); ?>

<div id="content" class="clearfix">
	<div id="left-column">
            <form action="/" id="qafp_searchform" method="get" role="search">
		<input type="text" class="qafp_search" id="qasearch" name="s" value="<?php echo get_search_query();?>">
		<input type="hidden" value="<?php echo get_site_url()."/".((ICL_LANGUAGE_CODE =='en')?"": ICL_LANGUAGE_CODE."/");?>find-answers-app/search/" id="qafp_search_link" name="search_link">
		<input type="submit" value="<?php echo (ICL_LANGUAGE_CODE =='en')?"Search": "Chercher"; ?>" id="qafp_searchsubmit">
            </form>
		<ul class="post-list">
			<?php if (have_posts()) :
				while (have_posts()) :	the_post(); setup_postdata($post);
					get_template_part("/functions/post-list-search");
				endwhile;
			else :
				get_template_part("/functions/post-empty");
			endif; ?>
		</ul>
		<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
	</div>

	<?php if(get_option("ocmx_sidebar_layout") != "sidebarnone"): ?>
        <div id="right-column">
            <ul class="widget-list sidebar">
		<?php dynamic_sidebar('Support'); ?>
            </ul>
        </div>
	<?php endif;?>
</div>

<?php get_footer(); ?>