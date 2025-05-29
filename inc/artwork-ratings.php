<?php
/**
 * Get or initialize rating data for an artwork
 */
function get_artwork_rating($post_id) {
    $ratings = get_option('artwork_ratings', array());
    
    if (!isset($ratings[$post_id])) {
        $ratings[$post_id] = array(
            'total' => 0,
            'count' => 0,
            'average' => 0
        );
        update_option('artwork_ratings', $ratings);
    }
    
    return $ratings[$post_id];
}

// ----------------------------------------------------
function artwork_rating_display($post_id = null) {

    // This is a common WordPress pattern to make functions flexible for use in different contexts
    // (single post pages, loops, or when you specifically want to rate a different post).
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }
    
    
    $rating_data = get_artwork_rating($post_id); // get post rating data
    $average = round($rating_data['average'], 1); // round mean get to the nearest integer (3.7 => 4 or 3.2 => 3)
    $count = $rating_data['count'];
    
    ob_start();
    ?>
    <div class="artwork-rating" data-post-id="<?php echo $post_id; ?>">
        <div class="stars">
            <?php for ($i = 5; $i >= 1; $i--) : ?>

                <input type="radio" id="star-<?php echo $i; ?>" name="rating"
                    value="<?php echo $i; ?>" <?php echo round($average) == $i ? 'checked' : ''; ?> />

                <label for="star-<?php echo $i; ?>"></label>
            <?php endfor; ?>
        </div>
        <div class="rating-info">
            <span class="average"><?php echo $average; ?></span>/5 
            (<span class="count"><?php echo $count; ?></span> أصوات)
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('artwork_rating', 'artwork_rating_display');


/**
 * Update rating data
 */
function update_artwork_rating($post_id, $new_rating) {
    $ratings = get_option('artwork_ratings', array());
    $current = get_artwork_rating($post_id);
    
    $ratings[$post_id] = array(
        'total' => $current['total'] + $new_rating,
        'count' => $current['count'] + 1,
        'average' => ($current['total'] + $new_rating) / ($current['count'] + 1)
    );
    
    update_option('artwork_ratings', $ratings);
    return $ratings[$post_id];
}


/**
 * Handle AJAX rating submission
**/
function submit_artwork_rating() {
    

    // // Debug: Log the entire $_POST data
    // error_log(print_r($_POST, true));

    // // Check if nonce exists
    // if (!isset($_POST['nonce'])) {
    //     error_log('Nonce is missing in AJAX request.');
    //     wp_send_json_error('Nonce missing.');
    // }

    // $nonce = $_POST['nonce'];

    // // Verify nonce manually first
    // if (!wp_verify_nonce($nonce, 'rating_nonce')) {
    //     error_log('Nonce verification failed. Received: ' . $nonce);
    //     wp_send_json_error('Invalid security token.');
    // }


    if(!(check_ajax_referer('rating_nonce', 'security'))) {
        wp_die();
    }

    $post_id = intval($_POST['post_id']);
    $rating = intval($_POST['rating']);

    $after_update = update_artwork_rating($post_id, $rating);

    $new_average = $after_update['average'];
    $new_count = $after_update['count'];

    // Return success with fresh nonce
    wp_send_json_success([
        'average' => round($new_average, 1),
        'count' => $new_count,
    ]);
}
add_action('wp_ajax_submit_artwork_rating', 'submit_artwork_rating');
add_action('wp_ajax_nopriv_submit_artwork_rating', 'submit_artwork_rating');



// 4. Enqueue scripts
// In your artwork-ratings.php or functions.php
function enqueue_rating_scripts() {

    // Register and enqueue your script
    wp_enqueue_script(
        'artwork-ratings-js',
        get_template_directory_uri() . '/assets/js/rating.js',
        ['jquery'],
        filemtime(get_template_directory() . '/assets/js/rating.js'),
        true
    );

    // Only need to localize ajaxurl now
    wp_localize_script('artwork-ratings-js', 'url', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);

}
add_action('wp_enqueue_scripts', 'enqueue_rating_scripts');