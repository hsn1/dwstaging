<?php get_header('help'); ?>
<div id="content" class="clearfix">
		<div id="left-column">
			<ul class="post-list">
			
				<?php if (have_posts()) :
					while (have_posts()) : the_post(); setup_postdata($post);
						get_template_part("/functions/post-view-help");
					endwhile;
				else :
					ocmx_no_posts();
				endif; ?>
					
			</ul>
                    <!--<a href="http://datawinners.staging.wpengine.com/what-is-datawinners/" target="_blank">Link to DW/Public</a>
                    <a href="http://uat.datawinners.com/login/" target="_top">Link to DW/App</a> -->
		</div>
                  
		
		<?php if(get_option("ocmx_sidebar_layout") != "sidebarnone"): ?>
			<?php dynamic_sidebar(''); ?>
		<?php endif;?>	
</div>
	
<?php wp_footer(); ?>