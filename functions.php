<?php

// Enable essential WordPress features
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('html5', ['comment-list', 'comment-form', 'search-form']);
add_theme_support('category-thumbnails');


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

}
add_action('wp_enqueue_scripts', 'arttopia_enqueue');

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
//   CUSTOM DATABASE FOR ARTS + NEW POST TYPE + TAXENOMY
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
        'supports'            => array('title', 'editor', 'thumbnail'),
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
        'rewrite'           => array('slug' => 'artwork-type'),
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

        'render_artwork_properties_meta_box', // this is function to render the box

        'artwork', // this is mention artwork post type

        'normal',

        'high'
    );
}
add_action('add_meta_boxes', 'add_artwork_meta_boxes');

function render_artwork_properties_meta_box($post) {
    
    // Get existing values
    $ratio = get_post_meta($post->ID, '_artwork_ratio', true);
    $colors = get_post_meta($post->ID, '_artwork_colors', true);
    
    // Security field
    wp_nonce_field('artwork_meta_save', 'artwork_meta_nonce');
    ?>
    
    <div class="artwork-meta-fields">
        <p>
            <label for="artwork_ratio"><?php _e('نسبة الألوان:', 'arttopia'); ?></label>
            <input type="text" id="artwork_ratio" name="artwork_ratio" 
                   value="<?php echo esc_attr($ratio); ?>" class="widefat">
        </p>
        
        <p>
            <label for="artwork_colors"><?php _e('الألوان المستخدمة:', 'arttopia'); ?></label>
            <input type="text" id="artwork_colors" name="artwork_colors" 
                   value="<?php echo esc_attr($colors); ?>" class="widefat">
            <small><?php _e('أدخل الألوان مفصولة بفواصل', 'arttopia'); ?></small>
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
}
add_action('save_post_artwork', 'save_artwork_meta');

