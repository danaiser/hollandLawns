<?php
/***** WP Head *****/

//Head Cleanup

// launching operation cleanup
add_action('init', 'head_cleanup');
// remove WP version from RSS
add_filter('the_generator', 'rss_version');
// remove pesky injected css for recent comments widget
add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );
// clean up comment styles in the head
add_action('wp_head', 'remove_recent_comments_style', 1);
// clean up gallery output in wp
add_filter('gallery_style', 'gallery_style');

function head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css and js
	add_action("wp_head", "remove_version_from_assets",1);
}
// Hide Map Plugin Nag
add_action('admin_menu','hidemapnag');
function hidemapnag() {
remove_action( 'admin_notices', 'wdp_un_check', 5 );
}

// Hide Wordpress Upgrade Nag
add_action('admin_menu','wphidenag');
function wphidenag() {
remove_action( 'admin_notices', 'update_nag', 3 );
}

// remove WP version from RSS
function rss_version() { return ''; }

// remove WP version from scripts
function remove_version_from_assets(){
    function remove_cssjs_ver( $src ) {
        if( strpos( $src, '?ver=' ) )
            $src = remove_query_arg( 'ver', $src );
        return $src;
    }
    add_filter( 'style_loader_src', 'remove_cssjs_ver', 999 );
    add_filter( 'script_loader_src', 'remove_cssjs_ver', 999 );
}

// remove injected CSS for recent comments widget
function remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


//Scripts, Styles & Enqueueing
add_action('wp_enqueue_scripts', 'scripts_and_styles', 999);

function scripts_and_styles() {
  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  if (!is_admin()) {
	
    // register main stylesheet
    wp_register_style( 'grid', get_stylesheet_directory_uri() . '/css/grid.css', array(), '', 'all' );

    wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );
    wp_register_style( 'icons', get_stylesheet_directory_uri() . '/css/icons.css', array(), '', 'all' );

    // ie-only style sheet
    wp_register_style( 'ie-only', get_stylesheet_directory_uri() . '/css/ie.css', array(), '' );

    //adding scripts file in the footer
    //wp_register_script( 'js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), '', true );

    // enqueue styles and scripts
    wp_enqueue_style( 'grid' );
    wp_enqueue_style( 'style' );
	wp_enqueue_style( 'icons' );
    wp_enqueue_style('ie-only');
    wp_enqueue_script( 'jquery' );


    $wp_styles->add_data( 'ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
  }
}

/***** Menu Functions *****/

//Register Theme Support for Menus

add_action( 'init', 'register_my_menus' );

function register_my_menus() {
  register_nav_menus(
    array( 
		'header-menu' => __( 'Main Navigation' ), 
		'footer-menu' => __( 'Footer Navigation' )
	)
  );
}

//Clean Up Menu Classes

add_filter('nav_menu_css_class', 'discard_menu_classes', 10, 2);

function discard_menu_classes($classes, $item) {
    $classes = array_filter( 
        $classes, 
        create_function( '$class', 
                 'return in_array( $class, 
                      array( "current-menu-item", "current-menu-parent" ) );' )
        );
    return array_merge(
        $classes,
        (array)get_post_meta( $item->ID, '_menu_item_classes', true )
        );
    }
/***** Widget Functions *****/

// Register Widget Areas

if ( function_exists('register_sidebar') )
register_sidebar(array(
	'name' => 'Sidebar',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

if ( function_exists('register_sidebar') )
register_sidebar(array(
	'name' => 'Footer',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
));

//Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)

add_filter('dynamic_sidebar_params','widget_first_last_classes');

function widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}

/***** Additional Theme Support *****/
//Post Thumbnails
add_theme_support( 'post-thumbnails' );

//Custom Post Type
//require_once('custom-post-type.php');

//Pagination

function pagination($pages = '', $range = 4)
{ 
     $showitems = ($range * 2)+1; 
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>"; 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

/***** Other Stuff *****/
function explain_less_login_issues(){ return '<strong>ERROR</strong>: Entered credentials are incorrect.';}
add_filter( 'login_errors', 'explain_less_login_issues' );

// cleaning up excerpt
add_filter('excerpt_more', 'excerpt_more');

function excerpt_more($more) {
	global $post;
	// edit here if you like
return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Read') . get_the_title($post->ID).'">'. __('Read more &raquo;') .'</a>';
}

/* ADD SVG UPLOAD CAPABILITY */

function cc_mime_types( $mimes ){
                $mimes['svg'] = 'image/svg+xml';
                return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

/**
 * Enables Shortcodes in text widgets
 */

add_filter( 'widget_text', 'do_shortcode' );

?>