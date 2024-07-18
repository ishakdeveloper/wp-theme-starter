<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= get_stylesheet_directory_uri(); ?>/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= get_stylesheet_directory_uri(); ?>/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= get_stylesheet_directory_uri(); ?>/img/favicon/site.webmanifest">
  <link rel="mask-icon" href="<?= get_stylesheet_directory_uri(); ?>/img/favicon/safari-pinned-tab.svg" color="#0d6efd">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-navbar">
    <div class="offcanvas-header">
      <span class="h5 offcanvas-title"><?php esc_html_e('Menu', 'bootscore'); ?></span>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>
      <?php
        wp_nav_menu(array(
          'theme_location' => 'main-menu',
          'container'      => false,
          'menu_class'     => '',
          'fallback_cb'    => '__return_false',
          'items_wrap'     => '<ul id="fornax-navbar" class="navbar-nav %2$s">%3$s</ul>',
          'depth'          => 2,
        ));
      ?>
      </div>
    </div>
  </div>

  <header id="header" role="banner">
      <div class="header-navigation">
        <div class="container-fluid">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto d-flex align-items-center">
              <?php the_custom_logo(); ?>
              <a href="<?php echo esc_url(home_url()) ?>">
                <span class="brand-name">fornax</span>
              </a>
            </div>
            <div class="col-auto">
              <div class="row justify-content-center align-items-center">
                <div class="col-auto d-none d-md-block">
                  <div class="header-navigation__menu">
                    <?php
                      wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container'      => false,
                        'menu_class'     => '',
                        'fallback_cb'    => '__return_false',
                        'items_wrap'     => '<ul id="fornax-navbar" class="navbar-nav ms-auto %2$s">%3$s</ul>',
                        'depth'          => 2,
                      ));
                    ?>
                  </div>
                </div>
                <div class="col-auto d-md-none">
                  <button class="mobile-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar">
                    <span class="mobile-menu__line"></span>
                    <span class="mobile-menu__line"></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
      // if (class_exists('WooCommerce')) :
      //   get_template_part('template-parts/header/top-nav-search-collapse', 'woocommerce');
      // else :
      //   get_template_part('template-parts/header/top-nav-search-collapse');
      // endif;
      ?>

  </header>

<?php wp_body_open(); ?>


