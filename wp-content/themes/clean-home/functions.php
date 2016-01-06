<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar',
        'before_widget' => '<div class="block %1$s %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Blurb',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
	
if ( function_exists('register_sidebar') )
register_sidebar(array(
	'name' => 'Top Navigation',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
));

/* ADD SVG UPLOAD CAPABILITY */

function cc_mime_types( $mimes ){
                $mimes['svg'] = 'image/svg+xml';
                return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

/* Explain less login issues */

function explain_less_login_issues(){ return '<strong>ERROR</strong>: Entered credentials are incorrect.';}
add_filter( 'login_errors', 'explain_less_login_issues' );

function no_generator() { return ''; }  
add_filter( 'the_generator', 'no_generator' );

add_theme_support( 'post-thumbnails' );

// Puts link in excerpts more tag
function new_excerpt_more($more) {
       global $post;
	return '... <br /><a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 */
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
add_filter('dynamic_sidebar_params','widget_first_last_classes');


/**
 * Enables Shortcodes in text widgets
 */

add_filter( 'widget_text', 'do_shortcode' );

/** 404 Email Reporting - UNCOMMENT TO ENABLE  **/

/*function email_admin($location){
                $name=get_option('blogname');
                $email = get_option('admin_email');
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
                $headers .= 'From: "' . $name . '" <' .$email. ">\r\n";
                $headers .= 'Reply to: "' . $email .  "'>\r\n";
                $subject='404 error in '.$name;
                $body='A 404 error occured at the following url: '.$_SERVER['SERVER_NAME'].$location."\r\n
Referrer: ".$_SERVER['HTTP_REFERER'];

                @mail($email,$subject,$body,$headers);


}

function email_error(){
                global $wp_query;
                $location=$_SERVER['REQUEST_URI'];

                if ($wp_query->is_404){
                                email_admin($location);
                }
}

add_action('get_header', 'email_error');*/

?>