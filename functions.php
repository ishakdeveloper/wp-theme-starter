<?php 

function scripts() {

    // Get modification time. Enqueue files with modification date to prevent browser from loading cached scripts and styles when file content changes.
    $modificated_bootscoreCss   = (file_exists(get_template_directory() . '/build/css/main.css')) ? date('YmdHi', filemtime(get_template_directory() . '/build/css/main.css')) : 1;
    $modificated_styleCss       = date('YmdHi', filemtime(get_stylesheet_directory() . '/style.css'));
    $modificated_fontawesomeCss = date('YmdHi', filemtime(get_template_directory() . '/build/fontawesome/css/all.min.css'));
    $modificated_themeJs        = date('YmdHi', filemtime(get_template_directory() . '/build/js/main.js'));
  
    wp_enqueue_style('main', get_template_directory_uri() . '/build/css/main.css', array(), $modificated_bootscoreCss);
  
    // Style CSS
    wp_enqueue_style('style', get_stylesheet_uri(), array(), $modificated_styleCss);
  
    // Fontawesome
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/build/fontawesome/css/all.min.css', array(), $modificated_fontawesomeCss);
  
    // Theme JS
    wp_enqueue_script('script', get_template_directory_uri() . '/build/js/main.js', array('jquery'), $modificated_themeJs, true);
  
    wp_enqueue_script( 'jquery-ui-core');
    wp_enqueue_script( 'jquery-ui-widget');
    wp_enqueue_script( 'jquery-ui-mouse');
    wp_enqueue_script( 'jquery-ui-accordion' );
    wp_enqueue_script( 'jquery-ui-autocomplete');
    wp_enqueue_script( 'jquery-ui-slider');
}
  
add_action('wp_enqueue_scripts', 'scripts');

if (!function_exists('setup')) :
    function setup() {
        load_theme_textdomain('perlui', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
    
        add_theme_support('html5', array(
          'comment-form',
          'comment-list',
          'gallery',
          'caption',
        ));
    
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;

add_action('after_setup_theme', 'setup');

function theme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action('after_setup_theme', 'theme_add_woocommerce_support');

if (!function_exists('create_menus')) :
    function create_menus() {
      // Register Menus
      register_nav_menu('main-menu', 'Main menu');
      register_nav_menu('footer-menu-1', 'Footer menu 1');
      register_nav_menu('footer-menu-2', 'Footer menu 2');
      register_nav_menu('footer-menu-3', 'Footer menu 3');
      register_nav_menu('footer-menu-4', 'Footer menu 4');
    }
endif;

add_action('after_setup_theme', 'create_menus');

register_sidebar(
    array(
        'Name' => 'Shop Sidebar',
        'id' => 'shop-sidebar',
        'class' => '',
    )
);
  