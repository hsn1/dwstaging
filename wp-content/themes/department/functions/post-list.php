<?php // If we want to show the full content, ignore the more tag
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
	        <!--Show the Featured Image or Video -->
                <h3 style="color: #999;"> 
                    <?php if($categories){
                        
                            foreach($categories as $category) {
                                //echo $category->cat_name;
                            if($category->category_parent == 66 OR $category->category_parent == 98 OR $category->category_parent == 74 OR $category->category_parent == 99){
                            
                                $output.= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
                            }
                            
                            }
                            echo trim($output,$separator);
                    }
                    ?>
                    </h3>
            <?php  if($image != "") { echo $image;?> <div class="post-content-text"> <?php } ?>
            
            <div class="post-title-block">
	           <?php if( $date != "false" || $author != "false" ) : ?>
		            <h5 class="post-date">
		                <?php if( $author != "false" ) {_e("Posted by ", "ocmx"); ?> <?php the_author_posts_link();} // Hide the author unless enabled in Theme Options ?>
		                <?php if( $date != "false" && $author != "false" ) {_e(" | ", "ocmx"); } if( $date != "false") { echo the_time(get_option('date_format'));} //Hide the date ?> 
		            </h5>
	            <?php endif; ?>
	            <h2 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
	        </div>   
            
	        <!--Begin Excerpt -->
	        <div class="copy <?php echo $image_class; ?>">
	        	<?php if( get_option( "ocmx_content_length" ) != "no" ) : 
	        		if(strpos($post->post_content, '<!--more-->')) : // Obey the more tag
	        			the_content('');
	        		else : // Use the excerpt or the content shortened
					the_excerpt();
				endif;
                              else :// Use the full content
				the_content();
			      endif; ?>
	        </div>
	        <?php if(word_count(get_the_excerpt()) >= 55) :  ?>
	        <a class="read-more" href="<?php the_permalink(); ?>"><?php echo (ICL_LANGUAGE_CODE =='en')?"Read More >>": "Lire la suite >>"; ?></a>
	        <?php elseif(comments_open()) : ?>
		        <a class="read-more" href="<?php the_permalink(); ?>#comments"><?php _e("Leave a Comment", "ocmx"); ?></a>
	        <?php endif; ?>
    	<?php else : // Render Quote content ?>
    	
    		<div class="copy"><?php the_content(); ?></div>
            <cite>&mdash; <?php if($quote_link != '') : ?><a href="<?php echo $quote_link; ?>" target="_blank"><?php the_title(); ?></a> <?php else : the_title(); endif; ?></cite>
	        
		<?php endif; ?>
             <?php  if($image != "") { ?> </div> <?php } ?>
	</div>
</li>