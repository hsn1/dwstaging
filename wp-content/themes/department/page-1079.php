<?php
/*
Template Name: Blog
 * Explore by category
*/ 

get_header(); ?>

<?php get_template_part('/functions/page-title'); ?>

<div id="content" class="clearfix">
    <div id="left-column">
    	<ul class="post-list">
			<?php 
			$args = array(
				"post_type" => "page" ,
                                "post_parent" => 1079,
                                "paged" => $paged,
                                "post__in" => array(1093,1083,1085,1087,1089,1091,1095,1097),
                                "orderby" => "post__in",
                                "nopaging" => true
			);
				
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query($args);
                        
			while ( $wp_query->have_posts() ) : 
                                $wp_query->the_post(); 
				global $post;		
                            // If we want to show the full content, ignore the more tag
                           if( get_option( "ocmx_content_length" ) == "no" ) :
                                   global $more;    // Declare global $more (before the loop).
                                   $more = 1; 
                           endif;

                           // Declare the image sizes
                           $layout = get_option( "ocmx_sidebar_layout" );
                           if(isset($layout) && $layout == 'sidebarnone') : 
                                   $resizer = '4-3-large';
                                   $width = '940';
                                   $height = '529';
                           else : 
                                   $resizer = '4-3-medium';
                                   $width = '660';
                                   $height = '360';
                           endif; 

                           // Meta Arguments
                           $date = get_option("ocmx_meta_date_post");
                           $author = get_option("ocmx_meta_author_post");
                           $social = get_option("ocmx_meta_social_post");

                           // Feature Image
                           $args  = array( 'postid' => $post->ID, 'width' => $width, 'height' => $height, 'hide_href' => false, 'exclude_video' => true, 'wrap' => 'div', 'wrap_class' => 'post-image fitvid', 'resizer' => $resizer );

                           $image = get_obox_media( $args );

                           // Fetch Post Format & meta associated
                           $categories=get_the_category();
                           $separator = ', ';
                           $output = '';
                           $format = get_post_format();
                           $quote_link = get_post_meta($post->ID, "quote_link", true);
                           $link = get_permalink( $post->ID ); ?>
                           <li id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
                               <div class="post-content contained<?php if($layout == 'sidebarnone') : ?>one-column<?php endif; ?> clearfix">
                                   <!--Begin Top Meta -->

                                   <?php if( $format != 'quote' ) : // Render Normal content ?>    
                                           
                                     
                                       <?php  if($image != "") { echo $image; } ?>
                                       <div class="post-title-block">
                                              <?php if( $date != "false" || $author != "false" ) : ?>
                                                       <h5 class="post-date">
                                                           <?php if( $author != "false" ) {_e("Posted by ", "ocmx"); ?> <?php the_author_posts_link();} // Hide the author unless enabled in Theme Options ?>
                                                           <?php if( $date != "false" && $author != "false" ) {_e(" | ", "ocmx"); } if( $date != "false") { echo the_time(get_option('date_format'));} //Hide the date ?> 
                                                       </h5>
                                               <?php endif; ?>
                                               <h2 class="post-title"><?php the_title(); ?></h2>
                                           </div>   

                                           <!--Begin Excerpt -->
                                           <div class="copy <?php echo $image_class; ?>">
                                                   <?php if( get_option( "ocmx_content_length" ) != "no" ) : 
                                                           if(strpos($post->post_content, '<!--more-->')) : // Obey the more tag
                                                                   the_content('');
                                                           else : // Use the excerpt or the content shortened
                                                                           the_excerpt();
                                                                   endif;
                                                           else :  // Use the full content
                                                                   echo the_content();
                                                           endif; ?>
                                           </div>
                                           <?php if( get_option( "ocmx_content_length" ) != "no" ) :  ?>
                                           <a class="read-more" href="<?php the_permalink(); ?>"><?php echo (ICL_LANGUAGE_CODE =='en')?"Learn More >>": "Apprendre la suite>>"; ?></a>
                                           <?php elseif(comments_open()) : ?>
                                                   <a class="read-more" href="<?php the_permalink(); ?>#comments"><?php _e("Leave a Comment", "ocmx"); ?></a>
                                           <?php endif; ?>
                                   <?php else : // Render Quote content ?>

                                           <div class="copy"><?php the_content(); ?></div>
                                       <cite>&mdash; <?php if($quote_link != '') : ?><a href="<?php echo $quote_link; ?>" target="_blank"><?php the_title(); ?></a> <?php else : the_title(); endif; ?></cite>

                                           <?php endif; ?>
                                       
                                   </div>
                           </li>
                           <hr style="clear: both;"/>     
                                
                                
			<?php endwhile; ?> 
        </ul>
		<?php //motionpic_pagination("clearfix", "pagination clearfix"); ?>
		<?php $wp_query = null; $wp_query = $temp;?>
	</div>
	
	<?php if(get_option("ocmx_sidebar_layout") != "sidebarnone"): ?>
		<?php get_sidebar('categories'); ?>
	<?php endif;?>
</div>
<?php get_footer(); ?>