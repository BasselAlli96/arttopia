<?php

// Enable essential WordPress features
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('html5', ['comment-list', 'comment-form', 'search-form']);
add_theme_support('category-thumbnails');

// In your theme's functions.php
require_once get_template_directory() . '/inc/artwork-ratings.php';


// Enqueue style & Js files
function arttopia_enqueue() {

    // enqueue style files on WP
    wp_enqueue_style(
        'main.css',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/main.css')
    );

    // jquery for JS
    wp_enqueue_script('jquery');

    // enqueue JavaScripts files on WP
    wp_enqueue_script(
        'main.js',
        get_template_directory_uri() . '/assets/js/main.js',
        array( 'jquery' ),
        filemtime(get_template_directory() . '/assets/js/main.js'),
        true
    );



    //only load front page css file on front-page.php
    if (is_front_page()) {
        wp_enqueue_style(
            'front-css',
            get_template_directory_uri(). '/assets/css/front-page.css',
            array()
        );
    }

    // only load css for single post
    if (is_single()) {
        wp_enqueue_style(
            'single-post-css',
            get_template_directory_uri(). '/assets/css/single.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/single.css')
        );
    }

    if(is_page()) {
        wp_enqueue_style(
            'page-css',
            get_template_directory_uri() . '/assets/css/page.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/page.css')
        );
    }


    
    if (is_page('gallary')) {
        wp_enqueue_style(
            'gallary-css',
            get_template_directory_uri() . '/assets/css/gallary.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/gallary.css')
        );
        
        wp_enqueue_script(
            'gallary-js',
            get_template_directory_uri() . '/assets/js/gallary.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/gallary.js')
        );
    }

   // load  gallaery-taxenomy.css only for gallaery taxenomy 
    if (is_tax('artwork_type')) {
        wp_enqueue_style(
            'taxenomy-galley-css',
            get_template_directory_uri(). '/assets/css/gallaery-taxenomy.css',
            array()
        );

        wp_enqueue_script(
            'taxenomy-galley-js',
            get_template_directory_uri(). '/assets/js/gallaery-taxenomy.js',
            array( 'jquery' ),
            filemtime(get_template_directory() . '/assets/js/gallaery-taxenomy.js'),
            true
        );
    }

    if (is_singular('artwork')) {
        wp_enqueue_style
        (
            'single-artwork-css',
            get_template_directory_uri() . '/assets/css/single-artwork.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/single-artwork.css')
        );

        wp_enqueue_script
        (
            'single-artwork-js',
            get_template_directory_uri() . '/assets/js/single-artwork.js',
            array( 'jquery' ),
            filemtime(get_template_directory() . '/assets/js/single-artwork.js'),
            true
        );
    }

}
add_action('wp_enqueue_scripts', 'arttopia_enqueue');



function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');




/**
 * Enqueue admin assets for artwork gallery
 */
function enqueue_artwork_gallery_admin_assets($hook) {
    global $post_type;
    
    // Only load on our post type edit screen
    if (($hook == 'post-new.php' || $hook == 'post.php') && $post_type == 'artwork') {
        wp_enqueue_media(); // Ensure media scripts are loaded
        
        wp_enqueue_script(
            'artwork-gallery-admin',
            get_template_directory_uri() . '/assets/js/admin/artwork-gallery.js',
            ['jquery', 'jquery-ui-sortable'],
            filemtime(get_template_directory() . '/assets/js/admin/artwork-gallery.js'),
            true
        );
        
        wp_enqueue_style(
            'artwork-gallery-admin',
            get_template_directory_uri() . '/assets/css/admin/artwork-gallery.css',
            [],
            filemtime(get_template_directory() . '/assets/css/admin/artwork-gallery.css')
        );
    }
}
add_action('admin_enqueue_scripts', 'enqueue_artwork_gallery_admin_assets');



// register all navigations + custom logo
function regsister_my_helpers(){
    
    // register nav menues on header & footer
    register_nav_menus( [
        'primary' => __( 'Primary Menu', 'arttopia-template'),
        'footer' => __( 'Footer Menu', 'arttopia-template')
    ]);

    // Add logo support
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true
    ]);
}
add_action('after_setup_theme', 'regsister_my_helpers');


// wordpress admin bar display
function arrtopia_admin_bar_settings() {
    // Always show for admins
    if (current_user_can('administrator')) {
        add_filter('show_admin_bar', '__return_true');
    }
    
    // Optional: Hide for specific roles
    if (current_user_can('subscriber')) {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action('init', 'arrtopia_admin_bar_settings');


// load template part loop
function load_theme_parts($context) {
    $registry = [

        'front-website' => [
            'hero-section' => [
                'template' => 'hero-section',
                'load_css' => false,
                'load_js' => false,
            ] ,
            'features-part' => [
                'template' => 'services_section',
                'load_css' => false,
                'load_js' => false,
            ],
            'features-section' => [
                'template' => 'features-section',
                'load_css' => false,
                'load_js' => false,
            ],
            'samples-part' => [
                'template' => 'samples-section',
                'load_css' => false,
                'load_js' => false,
            ]
        ],
        'single-artwork' => [
            'header' => [
                'template' => 'artwork-header',
            ],
            'share-art-section' => [
                'template' => 'share-art'
            ],
            'gallery-part' => [
                'template' => 'singel-gallery',
            ],
            // 'comments' => [
            //     'template' => 'comments-part',
            // ]
        ]
];
    return apply_filters("theme_sections_{$context}", $registry[$context] ?? []);
}

// register wedgits 
function register_wp_wedgits() {

    // register first wedgits on footer
    register_sidebar( array(
        'name' => 'footer wedgit one',
        'id'   => 'footer_wedgit_one',
        'description'   => 'This widget area discription',
        'before_widget' => '<span class="footer-area footer-area-one">',
        'after_widget'  => '</span>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
        )
    );

    // register second wedgits on footer
    register_sidebar( array(
        'name' => 'footer wedgit second',
        'id'   => 'footer_wedgit_second',
        'description'   => 'This widget area discription',
        'before_widget' => '<span class="footer-area footer-area-second">',
        'after_widget'  => '</span>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
        )
    );

    // register 3rd wedgits on footer
    register_sidebar( array(
        'name' => 'footer wedgit third',
        'id'   => 'footer_wedgit_third',
        'description'   => 'This widget area discription',
        'before_widget' => '<span class="footer-area footer-area-third">',
        'after_widget'  => '</span>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
        )
    );
}
add_action( 'widgets_init', 'register_wp_wedgits' );

//=====================================================
//   CUSTOM POSTMETA FOR ARTS + NEW POST TYPE + TAXENOMY
//=====================================================

function register_artworks_post_type() {

    $labels = array(
        'name'                  => __('أعمالي', 'arttopia'),
        'singular_name'         => __('عمل فني', 'arttopia'),
        'add_new'               => __('إضافة عمل جديد', 'arttopia'),
        'add_new_item'          => __('إضافة عمل فني جديد', 'arttopia'),
        'edit_item'             => __('تعديل العمل الفني', 'arttopia'),
        'new_item'              => __('عمل فني جديد', 'arttopia'),
        'view_item'             => __('عرض العمل الفني', 'arttopia'),
        'search_items'          => __('بحث في الأعمال الفنية', 'arttopia'),
        'not_found'             => __('لا توجد أعمال فنية', 'arttopia'),
        'not_found_in_trash'    => __('لا توجد أعمال في سلة المحذوفات', 'arttopia'),
        'menu_name'             => __('أعمالي', 'arttopia'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'capability_type'     => 'post',
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'artworks'),
        'menu_icon'           => 'dashicons-art',
        'supports'            => ['title', 'editor', 'thumbnail', 'comments'], 
        'show_in_rest'        => true, // For Gutenberg support
    );

    register_post_type('artwork', $args);
}
add_action('init', 'register_artworks_post_type');


function register_artwork_types_taxonomy() {

    $labels = array

    (
        'name'              => __('تصنيف الأعمال', 'arttopia'),
        'singular_name'     => __('نوع العمل', 'arttopia'),
        'search_items'      => __('بحث في أنواع الأعمال', 'arttopia'),
        'all_items'         => __('كل أنواع الأعمال', 'arttopia'),
        'parent_item'       => __('النوع الأب', 'arttopia'),
        'parent_item_colon' => __('النوع الأب:', 'arttopia'),
        'edit_item'         => __('تعديل نوع العمل', 'arttopia'),
        'update_item'       => __('تحديث نوع العمل', 'arttopia'),
        'add_new_item'      => __('إضافة نوع عمل جديد', 'arttopia'),
        'new_item_name'     => __('اسم نوع العمل الجديد', 'arttopia'),
        'menu_name'         => __('تصنيف الأعمال', 'arttopia'),
    );

    $args = array
    
    (
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug' => 'artwork-type',
            'with_front' => false, // Important for pagination
            'hierarchical' => false
        ),
        'show_in_rest'      => true,
    );

    register_taxonomy('artwork_type', array('artwork'), $args);
}
add_action('init', 'register_artwork_types_taxonomy');


function add_artwork_meta_boxes() {
    add_meta_box
    
    
    (
        'artwork_properties',

        __('خصائص العمل الفني', 'arttopia'),

        'render_artwork_properties_meta_box', // function that to render metabox

        'artwork', // this is mention artwork post type

        'normal',

        'high'
    );
}
add_action('add_meta_boxes', 'add_artwork_meta_boxes');

function render_artwork_properties_meta_box($post) {
    
    // Get existing values
    $ratio   = get_post_meta($post->ID, '_artwork_ratio', true);
    $colors  = get_post_meta($post->ID, '_artwork_colors', true);
    $exetime = get_post_meta($post->ID, '_artwork_exetime', true); // execution time for project
    $price   = get_post_meta($post->ID, '_price', true);
    // Get existing gallery images
    $gallery_images = get_post_meta($post->ID, '_artwork_gallery_images', true);
    $gallery_images = !empty($gallery_images) ? explode(',', $gallery_images) : array();


    // Security field
    wp_nonce_field('artwork_meta_save', 'artwork_meta_nonce');
    ?>
    
    <div class="artwork-meta-fields">
        <p>
            <label for="artwork_ratio"><?php _e('الأبعاد', 'arttopia'); ?></label>
            <input type="text" id="artwork_ratio" name="artwork_ratio" 
                   value="<?php echo esc_attr($ratio); ?>" class="widefat">
        </p>

        <p>
            <label for="artwork_exetime"><?php _e('وقت التنفيذ', 'arttopia'); ?></label>
            <input type="text" id="artwork_exetime" name="artwork_exetime" 
                   value="<?php echo esc_attr($exetime); ?>" class="widefat">
        </p>

        <p>
            <label for="artwork_colors"><?php _e('الألوان المستخدمة:', 'arttopia'); ?></label>
            <input type="text" id="artwork_colors" name="artwork_colors" 
                   value="<?php echo esc_attr($colors); ?>" class="widefat">
            <small><?php _e('أدخل الألوان باللغة الانجليزية مفصولة بفواصل', 'arttopia'); ?></small>
        </p>

        <p>
            <label for="price"><?php _e('السعر', 'arttopia'); ?></label>
                <input type="text" id="price" name="price"
                class="widefat" value="<?php echo esc_attr($price); ?>">
        </p>
    </div>

    <div class="artwork-gallery-container">
        <ul class="artwork-gallery-images">

            <?php
            if (!empty($gallery_images)) {
                foreach ($gallery_images as $image_id) {
                    if ($image = wp_get_attachment_image_src($image_id)) {
                        echo '<li data-attachment-id="' . esc_attr($image_id) . '">
                                <img src="' . esc_url($image[0]) . '" />
                                <a href="#" class="delete-artwork-image" title="' . esc_attr__('Remove image', 'arttopia') . '"> × </a>
                              </li>';
                    }
                }
            }
            ?>

        </ul>

        <input type="hidden" id="artwork_gallery_images" name="artwork_gallery_images" 
        value="<?php echo esc_attr(implode(',', $gallery_images)); ?>" />


        <p class="add-artwork-gallery-images hide-if-no-js">
            <a href="#" class="button button-primary"><?php _e('Add Gallery Images', 'arttopia'); ?></a>
        </p>

    </div>

    <?php
}

function save_artwork_meta($post_id) {
    // Verify nonce
    if (!isset($_POST['artwork_meta_nonce']) || 
        !wp_verify_nonce($_POST['artwork_meta_nonce'], 'artwork_meta_save')) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save meta data
    if (isset($_POST['artwork_ratio'])) {
        update_post_meta($post_id, '_artwork_ratio', sanitize_text_field($_POST['artwork_ratio']));
    }
    
    if (isset($_POST['artwork_colors'])) {
        update_post_meta($post_id, '_artwork_colors', sanitize_text_field($_POST['artwork_colors']));
    }
    if (isset($_POST['artwork_exetime'])) {
        update_post_meta($post_id, '_artwork_exetime',sanitize_text_field($_POST['artwork_exetime']));
    }

    if (isset($_POST['price'])) {
        update_post_meta($post_id, '_price', sanitize_text_field($_POST['price']));
    }

    if(isset($_POST['artwork_gallery_images'])) {
        update_post_meta($post_id, '_artwork_gallery_images', sanitize_text_field($_POST['artwork_gallery_images']));
    }
    
}
add_action('save_post_artwork', 'save_artwork_meta');


function get_current_url_slug() {
    // Get the current URL path
    $url = wp_parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Extract the last part of the path
    $slug = basename(trim($url, '/'));
    
    return $slug;
}

// Usage:
$current_slug = get_current_url_slug(); // Returns 'gallery' in your case

// Fix taxonomy pagination
function fix_artwork_taxonomy_pagination($query) {
    if (!is_admin() && $query->is_main_query() && is_tax('artwork_type')) {
        $query->set('posts_per_page', 3);
    }
}
add_action('pre_get_posts', 'fix_artwork_taxonomy_pagination');

// Flush rewrite rules on theme activation
function artwork_flush_rewrites() {
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'artwork_flush_rewrites');





