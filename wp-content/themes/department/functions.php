<?php  global $obox_themename, $input_prefix;

/*****************/
/* Theme Details */

$obox_themename = "Department";
$obox_themeid = "department";
$obox_productid = "1810";
$obox_presstrendsid = "ofu5pfy23zb17enl2g8iwcsy7vjtsdjju";

/**********************/
/* Include OCMX files */
$include_folders = array("/ocmx/includes/", "/ocmx/theme-setup/", "/ocmx/widgets/", "/ocmx/front-end/", "/ajax/", "/ocmx/interface/");
include_once (get_template_directory()."/ocmx/folder-class.php");
include_once (get_template_directory()."/ocmx/load-includes.php");

/***********************/

/***********************
 Remove ?ver=x.x from css and js


function remove_cssjs_ver( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
***********************/

/* Add OCMX Menu Items */
//add_action( 'wp_enqueue_scripts', 'test' );
add_action( 'wp_enqueue_scripts', 'youtube_iframe' );
add_action('admin_menu', 'ocmx_add_admin');
add_action( 'wp_enqueue_scripts', 'ga_scripts', 99999999999999999999999999999999999999999 );
add_action( 'wp_enqueue_scripts', 'playlist' );
add_action('wp_footer','wpb_add_googleanalytics');
add_action('wp_footer','youtube_gtm_scripts'); //youtube event popup video tracking script to load just after G.A.
add_action('wp_footer','youtube_iframe_function');
add_action('wp_footer','playlist_postscript');
function ocmx_add_admin() {
    global $wpdb;

    add_object_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), '', 'http://obox-design.com/images/ocmx-favicon.png');
    add_submenu_page(basename(__FILE__), "General Options", "General", "edit_theme_options", basename(__FILE__), 'ocmx_general_options');
    add_submenu_page(basename(__FILE__), "Adverts", "Adverts", "administrator",  "ocmx-adverts", 'ocmx_advert_options');
    add_submenu_page(basename(__FILE__), "Typography", "Typography", "edit_theme_options", "ocmx-fonts", 'ocmx_font_options');
    add_submenu_page(basename(__FILE__), "Customize", "Customize", "edit_theme_options", "customize.php");
    add_submenu_page(basename(__FILE__), "Help", "Help", "edit_theme_options", "obox-help", 'ocmx_welcome_page');
};
/*function test()
{
    $plugin_path = WP_PLUGIN_DIR.'/searchreplace';
    wp_enqueue_script( 'test', $plugin_path.'/include/js/formhandler.js', array( 'jquery' ));
};*/
function youtube_iframe()
{
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


    if (strpos($url,'checkout') !== false) 
    {
        //do nothing
    } 
    else
    {
        wp_enqueue_script( 'youtube_iframe', 'https://www.youtube.com/iframe_api', array( 'jquery' ));
    }
};
function playlist()
{
    //wp_register_script( 'playlist', 'https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.6/mediaelement-and-player.min.js', array( 'jquery' ));
    //wp_enqueue_script('playlist');
};
function playlist_postscript()
{
    /*echo "var mediaElements = document.querySelectorAll('video, audio');
    console.log('mediaelement=');
    console.log(mediaelement);
    for (var i = 0, total = mediaElements.length; i < total; i++) {
        var features = ['prevtrack', 'playpause', 'nexttrack', 'current', 'progress', 'duration', 'speed', 'skipback', 'jumpforward',
        'markers', 'volume', 'playlist', 'loop', 'shuffle', 'contextmenu'];
        // To demonstrate the use of Chromecast with audio
        if (mediaElements[i].tagName === 'AUDIO') {
            features.push('chromecast');
        }
        new MediaElementPlayer(mediaElements[i], {
            // This is needed to make Jump Forward to work correctly
            pluginPath: 'https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.5/',
            shimScriptAccess: 'always',
            autoRewind: false,
            features: features,
            currentMessage: 'Now playing:'
        });
    }";*/
}

function wpb_add_googleanalytics()
{
    echo "<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');


  ga('create', 'UA-35575996-1', 'auto');
  ga('send', 'pageview');
</script>
<script async src='https://www.googletagmanager.com/gtag/js?id=UA-35575996-1'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-35575996-1');
</script>
'";
};
function youtube_gtm_scripts() 
{
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


    if (strpos($url,'checkout') !== false) {
        //do nothing
    } else {
        wp_enqueue_script( 'youtube_gtm_scripts', get_template_directory_uri() . '/js/youtube_video_analytics.js', array( 'jquery' ),null,true);
    }
    
};
function youtube_iframe_function()
{
    /*echo "var player;

      function onYouTubeIframeAPIReady() {
        player = new YT.Player('ytplayer', {
          height: '390',
          width: '640',
          videoId: 'NdU83XFgXRM',
          events: {
            'onStateChange': function(event) {
              if (event.data == YT.PlayerState.PLAYING) {
                console.log('function youtube iframe');
                pauseAudio();
              }
            }
          }
        });
      }";*/
};
function ga_scripts() 
{
    wp_enqueue_script( 'ga_scripts', get_template_directory_uri() . '/js/ga_handler.js', array( 'jquery' ),null,true);
};

function icl_top_languages(){
  $languages = icl_get_languages('skip_missing=0');
  if(1 < count($languages)){
    if(ICL_LANGUAGE_CODE =='en'){ echo __('<li class="header-number" style="margin-right:0px;color:#ffffff;">Languages:</li>');}
    elseif(ICL_LANGUAGE_CODE =='fr'){ echo __('<li class="header-number" style="margin-right:0px;color:#ffffff;">Langues:</li>');}
    $languages=array_reverse($languages);
    foreach($languages as $l){
        
      /*if(!$l['active'])*/ $langs[] = '<a href="'.$l['url'].'">'.$l['native_name'].'</a>';
    }
    $beginli="<li class=\"header-number\" style=\"margin-right:0px;\">";
    $endli="</li>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $beginli.join('&nbsp;&nbsp;&nbsp;<strong style="color:#fff;">|</strong>&nbsp;&nbsp;&nbsp;', $langs).$endli;
    
  }
};
function list_cats_args_filter($args)
{
    $exclude = "0"; // The IDs of the excluding categories
    $args["show_count"] = "0";
    $args["hide_empty"] = 1;
    $args["title_li"] = "";
    $args["exclude"] = "0";
    //$args["taxonomy"] = ""; 
    return $args;
}

function add_horizontal_lines($output)
{
   
        $find="Countries</a>";
        $replace="Countries</a><hr/>";
        $output= str_replace($find,$replace,$output);
        $find="Sector</a>";
        $replace="Sector</a><hr/>";
        $output= str_replace($find,$replace,$output);
        $find="Santé</a>";
        $replace="Santé</a><hr/>";
        $output= str_replace($find,$replace,$output);
        $find="Pays</a>";
        $replace="Pays</a><hr/>";
        $output= str_replace($find,$replace,$output);
    return $output;
}
add_filter('wp_list_categories','add_horizontal_lines');
add_filter('widget_categories_args','list_cats_args_filter');

// Create the shortcode
function template_url( $atts, $content = null ) {
    return '<img src="'. get_template_directory_uri() .'/'. $content .'" alt="'.$content.'" />';
}  

// Add as shortcode
add_shortcode("template", "template_url");
function sjc_add_query_vars($vars) {
    global $wp;
    return array('template') + $vars;
}

add_filter('query_vars', 'sjc_add_query_vars');
add_filter('page_template', 'sjc_template_help');
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
function sjc_template_help($template) {
  global $wp;
  if ($wp->query_vars['template']=='help') {
      //Remove Header spacing for admin bar
    add_action('get_header', 'remove_admin_login_header');
    
    return dirname( __FILE__ ).'/single-help.php';
  }
  else {
    return $template;
  }
}
function parse_content($content)
{
 global $wp;
  if ($wp->query_vars['template'] == 'help') {
      $var=do_shortcode('[qa limit="-1"]');
      preg_match_all('/<a\s[^>]*href\s*=\s*(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>/siU',$var,$matches);
      echo $var;

  }   
//return $content;

}
function is_child($page_id) { 
    global $post; 
    if( is_page() && ($post->post_parent == $page_id) ) {
       return true;
    } else { 
       return false; 
    }
}
function footer_helpcenter() {
    $args = array(
    "post_type" => "portfolio"
    ); 
    $wp_query = null; 
    $wp_query = new WP_Query($args);    
    //$wp_query->query('');
        while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
                $ret=get_the_content();
                break;
        endwhile;
     return do_shortcode($ret);
    
}
add_shortcode( 'foot_hc', 'footer_helpcenter' );
//add_filter('the_content','parse_content');
remove_filter('the_content','qafp_add_categories_to_single');
add_filter('the_content','qafp_add_categories_to_single_up');
function qafp_add_categories_to_single_up ($content) {
    global $post, $qafp_options;

    if ( is_single() && in_the_loop() && 'qa_faqs' == get_post_type($post) ) {
        
        $page_title = get_the_title( get_page_by_path($qafp_options['faq_slug']) ); 
        $qa_post_options = '';
        if ( $qafp_options['ratings'] === true ) $qa_post_options = '<p class="qafp-faq-meta qafp-post-like">' . getPostLikeLink($post->ID) . '</p>
        ';
        if ( $qafp_options['hr'] === true ) $qa_post_options .= '<hr />
        ';
        $posttags = '';
        if ( has_term( '', 'post_tag', $post->ID ) && !$qafp_options['hide_tags'] ) $posttags = get_the_term_list( $post->ID, 'post_tag', $before = __( 'Tags: ', 'qa-focus-plus' ), $sep = ', ', $after = '' );
        $home_link = '<a href="javascript:history.back()" title="">&larr; ' .((ICL_LANGUAGE_CODE =='en')?"Return to search results":"Retour aux résultats de recherche"). '</a>';
        
        $qafp_cats = '';
        $faq_cats = qafp_add_categories();
        $hasCats = !empty( $faq_cats );
        if ( $hasCats ) {
            $catCount = count( $faq_cats );
            if ( $catCount > 1 ) $qafp_cats = __( 'Categories: ', 'qa-focus-plus' ) . $faq_cats;
            else $qafp_cats = __( 'Category: ', 'qa-focus-plus' ) . $faq_cats;
         //$qafp_cats = sprintf( _n( 'Category: ', 'Categories: ', $faq_cats, 'qa-focus-plus' ), $catCount ) . ' - ' . get_post_reply_link( '', $post->ID );
        //if ( $hasCats ) $qafp_cats = __( 'Posted in: ', 'qa-focus-plus' ) . $faq_cats;
        }
        if ( $hasCats ) {
            $content = $content . $qa_post_options . '<p class="qafp-faq-meta">
            ' . $qafp_cats . '<br />
            ' . $posttags . 
            '</p>
            ' . $home_link;
        } else {
            $content = $content . $qa_post_options . '<p class="qafp-faq-meta">
            ' . $posttags . 
            '</p>
            ' . $home_link;
        }

    }
    return $content;
}
function widget_title_link( $title ) {
    if( $title == "HELP CENTER" ) {
        if (ICL_LANGUAGE_CODE == 'en')
        {
            return "<a href=\"/en/help-center/\">".$title."</a>";
        }
        if(ICL_LANGUAGE_CODE == 'fr')
        {
            return "<a href=\"/fr/centre-d-aide/\">".$title."</a>";
        }
        
    }
    if( $title == "WHAT IS DATAWINNERS" ) {
        if (ICL_LANGUAGE_CODE == 'en')
        {
            return "<a href=\"/en/what-is-datawinners/\">".$title."</a>";
        }
        if (ICL_LANGUAGE_CODE == 'fr')
        {
            return "<a href=\"/fr/what-is-datawinners/\">".$title."</a>";
        }
        
    }
    if( $title == "QU\’EST-CE QUE DATAWINNERS"){
       if (ICL_LANGUAGE_CODE == 'fr')
        {
            return "<a href=\"/fr/what-is-datawinners/\">".$title."</a>";
        } 
    }
    if( $title == "COUNTRIES")
    {
        if (ICL_LANGUAGE_CODE == 'en')
        {
            return "<a href=\"/category/success-stories/countries/\">".$title."</a>";
        } 
    }
    if( $title == "SECTOR")
    {
        if (ICL_LANGUAGE_CODE == 'en')
        {
            return "<a href=\"/category/success-stories/sector/\">".$title."</a>";
        } 
    }
    if( $title == "PAYS")
    {
        if (ICL_LANGUAGE_CODE == 'fr')
        {
            return "<a href=\"/fr/category/reussites/pays/\">".$title."</a>";
        } 
    }
    if( $title == "REUSSITES")
    {
        if (ICL_LANGUAGE_CODE == 'fr')
        {
            return "<a href=\"/fr/category/reussites/secteur/\">".$title."</a>";
        } 
    }
    if( $title == "ABOUT US")
    {
        if (ICL_LANGUAGE_CODE == 'en')
        {
            return "<a href=\"/en/about-us/\">".$title."</a>";
        } 
    }
    if( $title == "QUI SOMMES-NOUS?")
    {
        if (ICL_LANGUAGE_CODE == 'fr')
        {
            return "<a href=\"/fr/about-us/\">".$title."</a>";
        } 
    }
        return $title;
    
}
add_filter( 'widget_title', 'widget_title_link' );


//function replace_add_string_scripts() {
    //$my_plugin = WP_PLUGIN_DIR.'/searchreplace';
    //wp_enqueue_script( 'replace_add_string_scripts', $my_plugin.'/include/js/formhandler.js', array( 'jquery' ), '1.0.0', true );
//}
//add_action( 'wp_enqueue_scripts', 'replace_add_string_scripts' );


function theme_name_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }
    
    global $page, $paged;

    // Add the blog name
    //$title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        //$title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }
        if(is_search())
        {
            $title.= 'Test';
        }
    return $title;
}
add_filter( 'wp_title', 'theme_name_wp_title', 10, 2 );
add_action('in_widget_form', 'spice_get_widget_id');

function spice_get_widget_id($widget_instance)

{
    
    // Check if the widget is already saved or not. 
    
    if ($widget_instance->number=="__i__"){
     
     echo "<p><strong>Widget ID is</strong>: Pls save the widget first!</p>"   ;
    
    
  }  else {

        
       echo "<p><strong>Widget ID is: </strong>" .$widget_instance->id. "</p>";
         
 
    }
}
function word_count() {
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    return $word_count;
}
function get_featuredClients($atts)
{
    $a = shortcode_atts( array(
    'lang' => 'en'
), $atts );
    $domain="hni.org";
    $url="";
    if ($a['lang']== 'en'){
        $url="http://".$domain."/wp-json/wp/v2/posts/2624";
    }
    elseif ($a['lang']== 'fr') {
        $url="http://".$domain."/wp-json/wp/v2/posts/2627";
    }
    $ret="";
    if($url != "")
    {
        $response = wp_remote_get( $url );
        $json_response= json_decode($response['body']);
        $ret=$json_response->content->rendered;
    }
    if($response!=null)
        return $ret;
}
add_shortcode('get_featured_clients','get_featuredClients');
/*
 * Force URLs in srcset attributes into HTTPS scheme.
 * This is particularly useful when you're running a Flexible SSL frontend like Cloudflare
 */
function ssl_srcset( $sources ) {
  foreach ( $sources as &$source ) {
    $source['url'] = set_url_scheme( $source['url'], 'https' );
  }

  return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'ssl_srcset' );


