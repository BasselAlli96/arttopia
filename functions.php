<?php

// Enable essential WordPress features
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('html5', ['comment-list', 'comment-form', 'search-form']);

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