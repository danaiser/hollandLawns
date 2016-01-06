<?php
// Define what post types to search
function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'custom_type'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );


/* Custom Post Types*/
function custom_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'custom_type', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Custom Types'), /* This is the Title of the Group */
			'singular_name' => __('Custom Post'), /* This is the individual type */
			'all_items' => __('All Custom Posts'), /* the all items menu item */
			'add_new' => __('Add New'), /* The add new menu item */
			'add_new_item' => __('Add New Custom Type'), /* Add New Display Title */
			'edit' => __( 'Edit' ), /* Edit Dialog */
			'edit_item' => __('Edit Post Types'), /* Edit Display Title */
			'new_item' => __('New Post Type'), /* New Display Title */
			'view_item' => __('View Post Type'), /* View Display Title */
			'search_items' => __('Search Post Type'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example custom post type' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'custom_type', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'custom_type', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
		/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'custom_type');
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_type');
	


/* Custom Categories*/
	//Custom
    register_taxonomy( 'custom', 
    	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Customs' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Custom' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Customs' ), /* search title for taxomony */
    			'all_items' => __( 'All Customs' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom:' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Custom' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Name' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
			'rewrite' => array( 'slug' => 'custom' ),
    	)
    ); 
?>