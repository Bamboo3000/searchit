<?php 

add_filter('wp_get_attachment_image_attributes', 'resp_func', PHP_INT_MAX);
function resp_func($attr) {
    if (isset($attr['sizes'])) unset($attr['sizes']);
    if (isset($attr['srcset'])) unset($attr['srcset']);
    return $attr;
}
add_filter('wp_calculate_image_sizes', '__return_false', PHP_INT_MAX);
add_filter('wp_calculate_image_srcset', '__return_false', PHP_INT_MAX);
remove_filter('the_content', 'wp_make_content_images_responsive');

add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies' );
add_filter( 'meta_content', 'convert_chars' );

//use my override wpautop
if(function_exists('override_wpautop')){
add_filter( 'meta_content', 'override_wpautop' );
} else {
add_filter( 'meta_content', 'wpautop' );
}
add_filter( 'meta_content', 'shortcode_unautop' );
add_filter( 'meta_content', 'prepend_attachment' );


function languages_list(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
    	?><div class="lang-cont"><?php
        foreach($languages as $l){
        	if($l['active']){
        		echo '<div class="lang-visible">';
        		echo '<a href="'.$l['url'].'">'.$l['native_name'].'</a>';
        		echo '</div>';
        	} else {
        		echo '<div class="lang-hidden">';
        		echo '<a href="'.$l['url'].'">'.$l['native_name'].'</a>';
        		echo '</div>';
        	}
        }
        ?></div><?php
    }
}

function languages_list_mobile(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        ?><div class="lang-cont mobile"><?php
        foreach($languages as $l){
            if($l['active']){
                echo '<div class="lang-visible">';
                echo '<a href="'.$l['url'].'">'.$l['language_code'].'</a>';
                echo '</div>';
            } else {
                echo '<div class="lang-hidden">';
                echo '<a href="'.$l['url'].'">'.$l['language_code'].'</a>';
                echo '</div>';
            }
        }
        ?></div><?php
    }
}

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

 ?>