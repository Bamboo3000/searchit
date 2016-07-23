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

// add_action( 'admin_init', 'hide_editor' );
// function hide_editor() {
// $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
// if( !isset( $post_id ) ) return;
// $template_file = get_post_meta($post_id, '_wp_page_template', true);
// if($template_file == 'templates/home-page.php'){ 
// remove_post_type_support('page', 'editor');
// }
// }

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


// function SearchFilter($query) {
// if ($query->is_search && !is_admin()) {
//     // are we wanting to search Custom posts?
//     if ($_GET['bsearch'] == "yes"){
//         $query->set('post_type', 'post');
//     }
//     else{
//         //default behavour we want is to search posts only
//         $query->set('post_type', 'post');
//     }
// }
// return $query;
// }
// add_filter('pre_get_posts','SearchFilter');

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

 ?>