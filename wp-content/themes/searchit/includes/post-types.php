<?php 

function change_post_menu_text() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Jobs';
	$submenu['edit.php'][5][0] = 'Jobs';
	$submenu['edit.php'][10][0] = 'Add Jobs';
	$submenu['edit.php'][16][0] = 'Jobs Tags';
}
add_action( 'admin_menu', 'change_post_menu_text' );
function change_post_type_labels() {
	global $wp_post_types;
	$postLabels = $wp_post_types['post']->labels;
	$postLabels->name = 'Jobs';
	$postLabels->singular_name = 'Jobs';
	$postLabels->add_new = 'Add Jobs';
	$postLabels->add_new_item = 'Add Jobs';
	$postLabels->edit_item = 'Edit Jobs';
	$postLabels->new_item = 'Jobs';
	$postLabels->view_item = 'View Jobs';
	$postLabels->search_items = 'Search Jobs';
	$postLabels->not_found = 'No Jobs found';
	$postLabels->not_found_in_trash = 'No Jobs found in Trash';
}
add_action( 'init', 'change_post_type_labels' );

function custom_menu_page_removing() {
    remove_menu_page( 'edit-comments.php' );
    // remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'custom_menu_page_removing' );



function create_testimonials() {
	register_post_type( 'testimonials',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'Testimonials' )
			),
			'menu_icon' => 'dashicons-editor-quote',
			'menu_position' => 20,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'testimonials'),
		)
	);
}
add_action( 'init', 'create_testimonials' );

function testimonials_post_type() {

	$labels = array(
		'name'                => _x( 'Testimonials', 'Post Type General Name', 'searchit' ),
		'singular_name'       => _x( 'Testimonials', 'Post Type Singular Name', 'searchit' ),
		'menu_name'           => __( 'Testimonials', 'searchit' ),
		'parent_item_colon'   => __( 'Parent Testimonials', 'searchit' ),
		'all_items'           => __( 'All Testimonials', 'searchit' ),
		'view_item'           => __( 'View Testimonials', 'searchit' ),
		'add_new_item'        => __( 'Add New Testimonials', 'searchit' ),
		'add_new'             => __( 'Add New', 'searchit' ),
		'edit_item'           => __( 'Edit Testimonials', 'searchit' ),
		'update_item'         => __( 'Update Testimonials', 'searchit' ),
		'search_items'        => __( 'Search Testimonials', 'searchit' ),
		'not_found'           => __( 'Not Found', 'searchit' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'searchit' ),
	);
	
	$args = array(
		'label'               => __( 'testimonials', 'searchit' ),
		'description'         => __( 'Testimonials', 'searchit' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	
	register_post_type( 'testimonials', $args );
}
add_action( 'init', 'testimonials_post_type', 0 );



// add_action( 'admin_init', 'hide_editor_universal' );
// function hide_editor_universal(){
// 	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
// 	$template_file = get_post_meta($post_id, '_wp_page_template', true);
// 	if($template_file == 'templates/universal-template.php'){ // the filename of the page template
// 		remove_post_type_support('page', 'editor');
// 	}
// }

function create_team() {
	register_post_type( 'team',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Team' ),
				'singular_name' => __( 'Team' )
			),
			'menu_icon' => 'dashicons-groups',
			'menu_position' => 20,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'team'),
		)
	);
}
add_action( 'init', 'create_team' );

function team_post_type() {

	$labels = array(
		'name'                => _x( 'Team', 'Post Type General Name', 'searchit' ),
		'singular_name'       => _x( 'Team', 'Post Type Singular Name', 'searchit' ),
		'menu_name'           => __( 'Team', 'searchit' ),
		'parent_item_colon'   => __( 'Parent Team', 'searchit' ),
		'all_items'           => __( 'All Team', 'searchit' ),
		'view_item'           => __( 'View Team', 'searchit' ),
		'add_new_item'        => __( 'Add New Team', 'searchit' ),
		'add_new'             => __( 'Add New', 'searchit' ),
		'edit_item'           => __( 'Edit Team', 'searchit' ),
		'update_item'         => __( 'Update Team', 'searchit' ),
		'search_items'        => __( 'Search Team', 'searchit' ),
		'not_found'           => __( 'Not Found', 'searchit' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'searchit' ),
	);
	
	$args = array(
		'label'               => __( 'team', 'searchit' ),
		'description'         => __( 'Team', 'searchit' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	
	register_post_type( 'team', $args );
}
add_action( 'init', 'team_post_type', 0 );

add_action( 'init', 'remove_team_editor' );
function remove_team_editor() {
	remove_post_type_support( 'team', 'editor' );
}


 ?>