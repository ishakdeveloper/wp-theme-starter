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
        add_theme_support( 'custom-logo' );
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
      register_nav_menu('main-menu-top-right', 'Main menu top right');
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

if ( class_exists( 'WooCommerce' ) ) {
    add_action( 'wp', 'theme_remove_sidebar_product_pages' );
     
    function theme_remove_sidebar_product_pages() {
        if ( is_product() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
        }
    }
    
    add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
    
    function woo_remove_product_tabs( $tabs ) {
        unset( $tabs['description'] );          // Remove the description tab
        unset( $tabs['reviews'] );          // Remove the reviews tab
        unset( $tabs['additional_information'] );   // Remove the additional information tab
        return $tabs;
    }

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
}

function my_custom_search_join($join) {
    global $wpdb;
    
    if (is_search()) {
        $join .= " LEFT JOIN {$wpdb->postmeta} ON ({$wpdb->posts}.ID = {$wpdb->postmeta}.post_id)";
    }
    
    return $join;
}
add_filter('posts_join', 'my_custom_search_join');

function my_custom_search_where($where) {
    global $wpdb;
    
    if (is_search()) {
        $where = preg_replace(
            "/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "({$wpdb->posts}.post_title LIKE $1) OR ({$wpdb->postmeta}.meta_value LIKE $1)",
            $where
        );
    }
    
    return $where;
}
add_filter('posts_where', 'my_custom_search_where');

function my_custom_search_distinct($where) {
    if (is_search()) {
        return "DISTINCT";
    }

    return $where;
}
add_filter('posts_distinct', 'my_custom_search_distinct');

add_action('wp_ajax_search_products' , 'search_products');
add_action('wp_ajax_nopriv_search_products','search_products');
function search_products(){
    // Check if a search term is provided
    if ( isset($_GET['keyword']) && !empty($_GET['keyword']) ) {
        $search_query = sanitize_text_field($_GET['keyword']);

        $args = array(
            'post_type' => array('product', 'brewery'),
            'posts_per_page' => 10,
            's' => $search_query,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'name',
                    'terms'    => $search_query,
                    'operator' => 'LIKE',
                ),
            ),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {

            while ($query->have_posts()) {
                $query->the_post();
                the_title();
                // wc_get_template_part('content', 'product');
            }

        } else {
            echo '<p>No products found matching your search criteria.</p>';
        }

        wp_reset_postdata();
    } else {
        echo '<p>Please enter a search term.</p>';
    }

    // End the AJAX request
    wp_die();
}

function woocommerce_template_loop_product_title() {
    echo '<h6 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h6>'; 
 }

 add_filter( 'woocommerce_add_to_cart_fragments', 'rerender_cart_fragments', 10, 1 );

 function rerender_cart_fragments( $fragments ) {
     ob_start();

     ?>
    <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" class="menu-actions-cart ms-1 ms-md-2 position-relative" data-bs-toggle="offcanvas" data-bs-target="#cart-popup" aria-controls="offcanvasRight">
        <div class="menu-actions-cart__total">
            <div class="menu-actions-cart__icon">
                <i class="fa-solid fa-bag-shopping"></i><span class="visually-hidden-focusable">Cart</span>
            </div>
        <?php $count = WC()->cart->cart_contents_count; ?>
            <?php if ($count > 0) { ?>
            <span class="menu-actions-cart__amount">
                <?= esc_html($count); ?>
            </span>
            <?php
            }
            ?>
            <div class="menu-actions-cart__total"><?= WC()->cart->get_cart_subtotal(); ?></div>
        </div>
    </a>
    
    <?php
     $fragments['a.menu-actions-cart'] = ob_get_clean();
    //  $fragments['.menu-actions-cart__total'] = ' <div class="menu-actions-cart__total">' . WC()->cart->get_cart_subtotal() . '</div>';
     
     return $fragments;
     
 }

 if(!wp_next_scheduled('update_brewery_list')) {
    wp_schedule_event(time(), 'weekly', 'get_breweries_from_api');
 }

 add_action('wp_ajax_nopriv_get_breweries_from_api', 'get_breweries_from_api');
 add_action('wp_ajax_get_breweries_from_api', 'get_breweries_from_api');

 function get_breweries_from_api() {
    $current_page = (! empty($_POST['current_page']) ? $_POST['current_page'] : 1);
    $breweries = [];

    $results = wp_remote_retrieve_body(wp_remote_get('https://api.openbrewerydb.org/v1/breweries/?page' . $current_page . '&per_page=50'));
    $results = json_decode($results);

    if(!is_array($results) || empty($results)) {
        return false;
    } 

    $breweries[] = $results;

    foreach($breweries[0] as $brewery) {
        $brewery_slug = sanitize_title($brewery->name . '-' . $brewery->id);

        $existing_brewery = get_page_by_path($brewery_slug, 'OBJECT', 'brewery');

        if($existing_brewery === null) {
            $inserted_brewery = wp_insert_post([
                'post_name' => $brewery_slug,
                'post_title' => $brewery_slug,
                'post_type' => 'brewery',
                'post_status' => 'publish'
            ]);
    
            if(is_wp_error($inserted_brewery)) {
                continue;
            }
    
            $fillable = [
                'field_66c5d02cd5982' => 'name',
                'field_66c5d085d5983' => 'brewery_type',
                'field_66c5d08fd5984' => 'street',
                'field_66c5d09bd5985' => 'city',
                'field_66c5d0a7d5986' => 'state',
                'field_66c5d0a7d5986' => 'state',
                'field_66c5d0b2d5987' => 'postal_code',
                'field_66c5d0bdd5988' => 'country',
                'field_66c5d0c8d5989' => 'longitude',
                'field_66c5d0d4d598a' => 'latitude',
                'field_66c5d0dcd598b' => 'phone',
                'field_66c5d0e4d598c' => 'website',
                'field_66c5d0edd598d' => 'updated_at'
            ];
    
            foreach($fillable as $key => $name) {
                update_field($key, $brewery->$name, $inserted_brewery);
            }
        } else {
            $existing_brewery_id = $existing_brewery->ID;
            $existing_brewery_timestamp = get_field('updated_at', $existing_brewery_id);

            if($brewery->updated_at >= $existing_brewery_timestamp) {
                $fillable = [
                    'field_66c5d02cd5982' => 'name',
                    'field_66c5d085d5983' => 'brewery_type',
                    'field_66c5d08fd5984' => 'street',
                    'field_66c5d09bd5985' => 'city',
                    'field_66c5d0a7d5986' => 'state',
                    'field_66c5d0a7d5986' => 'state',
                    'field_66c5d0b2d5987' => 'postal_code',
                    'field_66c5d0bdd5988' => 'country',
                    'field_66c5d0c8d5989' => 'longitude',
                    'field_66c5d0d4d598a' => 'latitude',
                    'field_66c5d0dcd598b' => 'phone',
                    'field_66c5d0e4d598c' => 'website',
                    'field_66c5d0edd598d' => 'updated_at'
                ];
        
                foreach($fillable as $key => $name) {
                    update_field($key, $brewery->$name, $existing_brewery_id);
                }
            }
        }
    }

    $current_page = $current_page + 1;

    wp_remote_post(admin_url('admin-ajax.php?action=get_breweries_from_api'), [
        'blocking' => false,
        'sslverify' => false,
        'body' => [
            'current_page' => $current_page
        ]
    ]);
 }

 




  