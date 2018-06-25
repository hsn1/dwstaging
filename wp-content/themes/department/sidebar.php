<div id="right-column">
	<ul class="widget-list sidebar">
		<?php if(is_post_type_archive( 'product' ) || ( get_post_type() == "product")) :
			//Shop Sidebar
			dynamic_sidebar('shopsidebar');
		else :
			//Blog Sidebar
			dynamic_sidebar('sidebar');
		endif; ?>
	</ul>
</div>