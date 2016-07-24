<?php 

if ( ! isset( $content_width ) ) {
	$content_width = 1920;
}

if ( ! function_exists( 'searchit_setup' ) ) :
	function searchit_setup() {
		load_theme_textdomain( 'searchit', TEMPLATEPATH . '/languages' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		register_nav_menus( array(
			'main' => __( 'Main Menu', 'searchit' ),
			'main-mobile' => __( 'Main Menu Mobile', 'searchit' ),
		) );
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
	}
endif;
add_action( 'after_setup_theme', 'searchit_setup' );

function searchit_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'searchit' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'searchit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'searchit' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'searchit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'searchit' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'searchit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'searchit' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'searchit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'searchit' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'searchit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	) );
}
add_action( 'widgets_init', 'searchit_widgets_init' );

function searchit_scripts() {
	wp_enqueue_script( 'searchit-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array( 'jquery' ), NULL, true );
	wp_enqueue_script( 'searchit-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), NULL, true );
	wp_enqueue_script( 'searchit-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), NULL, true );
	wp_enqueue_script( 'searchit-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), NULL, true );
}
add_action( 'wp_enqueue_scripts', 'searchit_scripts' );


/**
 * Duplicate a post/page/custom post on publish or update
 * 
 **/
add_action('save_post', 'wpml_duplicate_on_publish');
function wpml_duplicate_on_publish ( $post_id ) {
    global $sitepress, $iclTranslationManagement;
     
    // don't save for autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // don't save for revisions
    if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
        return $post_id;
    }
    // save only for posts
    if (isset($post->post_type) && $post->post_type != 'post') {
        return $post_id;
    }

    // if ( isset( $post->post_type ) && $post->post_type != 'page' ) {
    //     return $post_id;
    // }

    // Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        }
    } else {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }
 
    $master_post_id = $post_id;
    $master_post = get_post($master_post_id);
    $language_details_original = $sitepress->get_element_language_details($master_post_id, 'post_' . $master_post->post_type);
     
    // unhook this function so it doesn't loop infinitely
    remove_action('save_post', 'wpml_duplicate_on_publish');
     
    foreach($sitepress->get_active_languages() as $lang => $details){
        if($lang != $language_details_original->language_code){
            $iclTranslationManagement->make_duplicate($master_post_id, $lang);    
        }
    }
     
    // re-hook this function
    add_action('save_post', 'wpml_duplicate_on_publish');
}

// Add a column to the edit post list
add_filter( 'manage_edit-post_columns', 'add_new_columns');




/**
 * Add new columns to the post table
 *
 * @param Array $columns - Current columns on the list post
 */
function add_new_columns( $columns ) {
 	$column_meta = array( 'meta' => 'Job ID' );
	$columns = array_slice( $columns, 0, 2, true ) + $column_meta + array_slice( $columns, 2, NULL, true );
	return $columns;
}

// Add action to the manage post column to display the data
add_action( 'manage_posts_custom_column' , 'custom_columns' );

/**
 * Display data in new columns
 *
 * @param  $column Current column
 *
 * @return Data for the column
 */
function custom_columns( $column ) {
	global $post;

	switch ( $column ) {
		case 'meta':
			$metaData = get_post_meta( $post->ID, 'job_id', true );
			echo $metaData;
		break;
	}
}

// Register the column as sortable
function register_sortable_columns( $columns ) {
    $columns['meta'] = 'Job ID';
    return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'register_sortable_columns' );


include_once 'includes/post-types.php';
include_once 'includes/custom.php';
include_once 'includes/function_search.php';

include_once 'metaboxes/setup.php';
include_once 'metaboxes/home1_spec.php';
include_once 'metaboxes/universal_spec.php';
include_once 'metaboxes/team_spec.php';
include_once 'metaboxes/testimonials_spec.php';
include_once 'metaboxes/uploadcv_spec.php';

include_once 'includes/cron.php';



/*add_action( 'save_post', 'wpml_duplicate_on_publish');
function wpml_duplicate_on_publish( $post_id ) {
    global $sitepress, $iclTranslationManagement;
    // don't save for autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // dont save for revisions
    if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
        return $post_id;
    }

    if ( isset( $post->post_type ) && $post->post_type == 'post' ) {
        return $post_id;
    }
 
     
    // we need this to avoid recursion see add_action at the end
    remove_action('save_post', 'wpml_duplicate_on_publish');
         
        // make duplicates if the post being saved does not have any already or is not a duplicate of another
        $has_duplicates = $iclTranslationManagement->get_duplicates( $post_id );
        $is_duplicate = get_post_meta($post_id, '_icl_lang_duplicate_of', true);
        if ( !$is_duplicate &&  !$has_duplicates) {
            icl_makes_duplicates( $post_id );
        }
    // must hook again - see remove_action further up
    add_action('save_post', 'wpml_duplicate_on_publish');
}
*/

// include_once 'simple_html_dom.php';








