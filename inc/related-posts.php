<?php 
/**
 * get related posts function
 * 
 */


function get_related_post($post_id, $posts_per_page) {

    
    $categories = get_the_category($post_id);
    if(empty($categories)) {
        return false;
    }

    $category_ids = wp_list_pluck($categories, 'term_id');
    
    $related_args = array(
        'post__not_in'   => array($post_id),
        'posts_per_page' => $posts_per_page,
        'category__in'   => $category_ids,
        'orderby'       => 'date',
        'order'         => 'DESC',
        'post_type'     => 'post',
        'post_status'   => 'publish'
    );
    
    return new WP_Query($related_args);
}