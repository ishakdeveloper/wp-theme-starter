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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvas-navbar">
    <div class="offcanvas-header">
      <span class="h5 offcanvas-title"><?php esc_html_e('Menu', 'bootscore'); ?></span>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'main-menu',
          'container'      => false,
          'menu_class'     => '',
          'fallback_cb'    => '__return_false',
          'items_wrap'     => '<ul id="perlui-navbar" class="navbar-nav ms-auto %2$s">%3$s</ul>',
          'depth'          => 2,
        ));
      ?>
    </div>
  </div>

  <!-- Offcanvas user -->
<?php
if ( is_account_page() || is_checkout() ) {
 // Do nothing
} else { ?>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-user">
  <div class="offcanvas-header">
    <span class="h5 offcanvas-title"><?php echo __('Account', 'woocommerce'); ?></span>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="my-offcanvas-account">
      <?= do_shortcode('[woocommerce_my_account]'); ?>
    </div>
  </div>
</div>
<?php } ?>

<!-- Offcanvas cart -->
<?php
if ( is_checkout() || is_cart() ) {
 // Do nothing
} else { ?>
  <div class="offcanvas offcanvas-end" tabindex="-1" id="cart-popup">
    <div class="offcanvas-header">
      <span class="h5 offcanvas-title"><?php echo __('Cart', 'woocommerce'); ?></span>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
      <div class="cart-list">
        <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
      </div>
    </div>
  </div>
<?php } ?>

  <?php
    if (class_exists('WooCommerce')) :
      get_template_part('template-parts/header/offcanvas', 'woocommerce');
    endif;
  ?>

  <header id="header" class="header">
      <div class="header-banner d-none d-md-block">
        <div class="container-xxl">
          <div class="header-banner__items">
              <?php if ( have_rows('banner', 'option') ): ?>
                  <?php while ( have_rows('banner', 'option') ) : the_row(); ?>
                    <span><?php the_sub_field("banner_info") ?></span>    
                  <?php endwhile; ?>
              <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="header-main">
        <div class="container-xxl">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto col-md-6">

                <div class="header-main__left">
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-navigation__logo">
                      <?php // the_custom_logo() ?>
                      <svg width="63" height="28" viewBox="0 0 63 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_7204_49474)">
                      <g clip-path="url(#clip1_7204_49474)">
                      <path d="M55.4334 13.3111L55.4056 13.339C55.6007 12.8094 55.991 12.6142 56.3255 12.6142C56.7994 12.6142 57.2175 12.9766 57.2175 13.5063C57.2175 13.6178 57.2175 13.7572 57.1618 13.9244C56.1861 16.4333 54.1232 17.7156 52.1162 17.9107C51.1963 19.4718 49.691 20.6147 47.5445 20.6147C44.4781 20.6147 43.1122 18.1895 43.1122 15.5413C43.1122 12.2797 45.1751 8.65582 48.6317 8.65582C49.3843 8.65582 50.0255 8.82315 50.5551 9.04612C52.1162 9.6315 53.1197 11.6665 53.1197 13.8408C53.1197 14.5377 53.0639 15.2346 52.8967 15.9037C53.9282 15.5413 54.9038 14.7049 55.4334 13.3111ZM49.6073 10.9417V10.9138C48.9941 10.9138 48.6317 11.7222 48.6317 12.6979C48.6317 14.1196 49.4122 15.4297 50.6387 15.9037C50.8339 15.2904 50.9175 14.5935 50.9175 13.7851C50.9175 12.224 50.4436 10.9417 49.6073 10.9417ZM47.5724 18.5797C48.3529 18.5797 49.1334 18.2452 49.7467 17.5483C47.9348 16.7399 46.7918 14.8444 46.7918 13.0324C46.7918 12.4191 46.9034 11.778 47.0706 11.2204C45.9556 12.1404 45.3144 13.9523 45.3144 15.5413C45.3144 17.6041 46.2901 18.5797 47.5724 18.5797Z" fill="black"/>
                      <path d="M43.5426 13.3111L43.5147 13.339C43.7098 12.8094 44.0443 12.5864 44.3788 12.5864C44.8528 12.5864 45.3266 13.0045 45.3266 13.5342C45.3266 13.6735 45.2988 13.7851 45.243 13.9244C44.1559 16.5727 42.539 19.6669 39.9466 21.4789L39.8908 22.0364C39.5842 25.3816 37.8838 27.5001 35.7373 27.5001C34.1204 27.5001 33.1726 26.3851 33.1726 25.0749C33.1726 22.7054 35.5978 21.8413 37.8559 20.3917C37.9116 19.8063 37.9395 19.1373 37.9673 18.3846C36.8523 19.6111 35.6536 20.113 34.5943 20.113C32.4757 20.113 30.7474 18.3846 30.7474 15.7364C30.7474 11.6665 33.4235 8.99039 36.4063 8.99039H36.4342C38.4691 8.99039 40.6435 10.0775 40.6435 12.0289C40.6435 12.67 40.3647 16.1545 40.1417 18.8585C41.647 17.4368 42.9014 15.1231 43.5426 13.3111ZM34.9009 18.1059C35.9324 18.1059 37.3262 17.4647 38.1904 14.3147C38.3297 13.6178 38.4133 13.0045 38.3855 12.2797C38.2183 11.5271 37.5771 11.0811 36.6571 11.0811C34.7616 11.0811 32.9497 12.893 32.9497 15.6528C32.9497 17.3254 33.7302 18.1059 34.9009 18.1059ZM35.9602 25.4652H35.9881C36.5735 25.4652 37.2147 25.0749 37.6328 22.5661C36.4063 23.2908 35.2633 24.0156 35.2633 24.8797C35.2633 25.2421 35.5421 25.4652 35.9602 25.4652Z" fill="black"/>
                      <path d="M31.2366 13.3111L31.2088 13.339C31.4039 12.8094 31.7942 12.6142 32.1287 12.6142C32.6026 12.6142 33.0207 12.9766 33.0207 13.5063C33.0207 13.6178 33.0207 13.7572 32.965 13.9244C31.9893 16.4333 29.9265 17.7156 27.9194 17.9107C26.9995 19.4718 25.4942 20.6147 23.3477 20.6147C20.2813 20.6147 18.9154 18.1895 18.9154 15.5413C18.9154 12.2797 20.9782 8.65582 24.4349 8.65582C25.1875 8.65582 25.8287 8.82315 26.3583 9.04612C27.9194 9.6315 28.923 11.6665 28.923 13.8408C28.923 14.5377 28.8672 15.2346 28.6999 15.9037C29.7314 15.5413 30.707 14.7049 31.2366 13.3111ZM25.4106 10.9417V10.9138C24.7973 10.9138 24.4349 11.7222 24.4349 12.6979C24.4349 14.1196 25.2154 15.4297 26.442 15.9037C26.6371 15.2904 26.7207 14.5935 26.7207 13.7851C26.7207 12.224 26.2468 10.9417 25.4106 10.9417ZM23.3756 18.5797C24.1561 18.5797 24.9366 18.2452 25.5499 17.5483C23.738 16.7399 22.5951 14.8444 22.5951 13.0324C22.5951 12.4191 22.7066 11.778 22.8738 11.2204C21.7588 12.1404 21.1176 13.9523 21.1176 15.5413C21.1176 17.6041 22.0933 18.5797 23.3756 18.5797Z" fill="black"/>
                      <path d="M20.3322 12.4312C19.9419 12.4312 19.6074 12.6264 19.3843 13.156C18.6596 14.9959 17.1542 18.118 15.621 18.118C14.6556 18.118 13.9085 17.8997 13.1536 17.6791C12.3826 17.4538 11.6035 17.226 10.5753 17.226C10.2129 17.226 9.71115 17.2818 9.23725 17.3654C10.6649 15.4186 11.1983 13.0608 11.7151 8.60406C10.742 8.54211 9.95045 8.36233 9.37349 8.18076C8.75725 13.8331 8.05746 15.9883 5.50178 18.118C5.16726 18.3968 5 18.7871 5 19.1774C5 19.7907 5.52966 20.3203 6.1987 20.3203C6.42172 20.3203 6.6726 20.2367 6.92349 20.1252C8.3452 19.484 9.20937 19.3168 10.2687 19.3168C10.9423 19.3168 11.7484 19.5094 12.6114 19.7156C13.6054 19.9532 14.675 20.2088 15.7047 20.2088C17.9626 20.2088 19.4401 18.0066 21.0848 13.7414C21.1685 13.6021 21.1963 13.4348 21.1963 13.2954C21.1963 12.7657 20.7782 12.4312 20.3322 12.4312Z" fill="black"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M9.51493 7.02715C10.0197 7.20338 10.8079 7.40855 11.8297 7.46925L11.9969 7.46916C15.147 7.46916 17.2099 5.5178 17.2099 3.17616C17.2099 1.67082 16.0391 0.5 14.3943 0.5C12.1921 0.5 10.6589 2.00534 9.87832 4.98814C8.90264 4.45848 8.2336 3.51068 7.89908 2.31199C7.73181 1.72657 7.36942 1.36417 6.86763 1.36417C6.25435 1.36417 5.86407 1.83808 5.86407 2.47924C5.86407 4.37486 7.34154 6.18684 9.51592 7.02314L9.51493 7.02715ZM12.1642 5.43417C12.5823 3.51068 13.2514 2.59075 14.1435 2.59075C14.6174 2.59075 14.924 2.86952 14.924 3.3713C14.924 4.29123 13.9483 5.37841 12.1642 5.43417Z" fill="black"/>
                      </g>
                      </g>
                      <defs>
                      <clipPath id="clip0_7204_49474">
                      <rect width="63" height="27" fill="white" transform="translate(0 0.5)"/>
                      </clipPath>
                      <clipPath id="clip1_7204_49474">
                      <rect width="52.5" height="27" fill="white" transform="translate(5 0.5)"/>
                      </clipPath>
                      </defs>
                      </svg>

                  </a>

                  <form class="search-form" method="get" autocomplete="off" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="form__field search">
                      <input type="text" id="keyword" class="search__input" name="s" placeholder="Zoek naar producten...">
                      <button type="submit" class="loading-state">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                    </div>
                    <div class="search__dropdown">
                      <div class="search__dropdown__items"></div>
                    </div>
                  </form>
              </div>

            </div>

            <div class="col-auto d-flex align-items-center">
              <div class="d-block d-md-none">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C11.0111 2 10.0444 2.29324 9.22215 2.84265C8.3999 3.39206 7.75904 4.17295 7.3806 5.08658C7.00216 6.00021 6.90315 7.00555 7.09607 7.97545C7.289 8.94536 7.7652 9.83627 8.46447 10.5355C9.16373 11.2348 10.0546 11.711 11.0245 11.9039C11.9945 12.0969 12.9998 11.9978 13.9134 11.6194C14.827 11.241 15.6079 10.6001 16.1573 9.77785C16.7068 8.95561 17 7.98891 17 7C17 5.67392 16.4732 4.40215 15.5355 3.46447C14.5979 2.52678 13.3261 2 12 2ZM12 10C11.4067 10 10.8266 9.82405 10.3333 9.49441C9.83994 9.16476 9.45542 8.69623 9.22836 8.14805C9.0013 7.59987 8.94189 6.99667 9.05764 6.41473C9.1734 5.83279 9.45912 5.29824 9.87868 4.87868C10.2982 4.45912 10.8328 4.1734 11.4147 4.05764C11.9967 3.94189 12.5999 4.0013 13.1481 4.22836C13.6962 4.45542 14.1648 4.83994 14.4944 5.33329C14.8241 5.82664 15 6.40666 15 7C15 7.79565 14.6839 8.55871 14.1213 9.12132C13.5587 9.68393 12.7956 10 12 10ZM21 21V20C21 18.1435 20.2625 16.363 18.9497 15.0503C17.637 13.7375 15.8565 13 14 13H10C8.14348 13 6.36301 13.7375 5.05025 15.0503C3.7375 16.363 3 18.1435 3 20V21H5V20C5 18.6739 5.52678 17.4021 6.46447 16.4645C7.40215 15.5268 8.67392 15 10 15H14C15.3261 15 16.5979 15.5268 17.5355 16.4645C18.4732 17.4021 19 18.6739 19 20V21H21Z" fill="black"/>
              </svg>

                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 22H19C20.103 22 21 21.103 21 20V9C21 8.73478 20.8946 8.48043 20.7071 8.29289C20.5196 8.10536 20.2652 8 20 8H17V7C17 4.243 14.757 2 12 2C9.243 2 7 4.243 7 7V8H4C3.73478 8 3.48043 8.10536 3.29289 8.29289C3.10536 8.48043 3 8.73478 3 9V20C3 21.103 3.897 22 5 22ZM9 7C9 5.346 10.346 4 12 4C13.654 4 15 5.346 15 7V8H9V7ZM5 10H7V12H9V10H15V12H17V10H19L19.002 20H5V10Z" fill="black"/>
                  </svg>
              </div>
                <div class="col-auto d-md-none">
                  <button class="mobile-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar">
                    <span class="mobile-menu__line"></span>
                    <span class="mobile-menu__line"></span>
                  </button>
                </div>

                <div class="header-main__right d-none d-md-block">
                  <?php 
                      wp_nav_menu(array(
                      'theme_location' => 'main-menu-top-right',
                      'container'      => false,
                      'menu_class'     => '',
                      'fallback_cb'    => '__return_false',
                      'items_wrap'     => '<ul id="navbar-main-right">%3$s</ul>',
                      'depth'          => 2,
                    ));
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="header-menu">
        <div class="container-xxl">
          <div class="row justify-content-between">
            <div class="col-auto d-none d-md-block">
              <div class="header-menu__menu">
                <?php
                  wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container'      => false,
                    'menu_class'     => '',
                    'fallback_cb'    => '__return_false',
                    'items_wrap'     => '<ul id="perlui-navbar" class="navbar-nav ms-auto %2$s">%3$s</ul>',
                    'depth'          => 2,
                  ));
                ?>
              </div>
            </div>

            <div class="col-auto d-none d-md-flex">
              <div class="icon icon-user">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 2C11.0111 2 10.0444 2.29324 9.22215 2.84265C8.3999 3.39206 7.75904 4.17295 7.3806 5.08658C7.00216 6.00021 6.90315 7.00555 7.09607 7.97545C7.289 8.94536 7.7652 9.83627 8.46447 10.5355C9.16373 11.2348 10.0546 11.711 11.0245 11.9039C11.9945 12.0969 12.9998 11.9978 13.9134 11.6194C14.827 11.241 15.6079 10.6001 16.1573 9.77785C16.7068 8.95561 17 7.98891 17 7C17 5.67392 16.4732 4.40215 15.5355 3.46447C14.5979 2.52678 13.3261 2 12 2ZM12 10C11.4067 10 10.8266 9.82405 10.3333 9.49441C9.83994 9.16476 9.45542 8.69623 9.22836 8.14805C9.0013 7.59987 8.94189 6.99667 9.05764 6.41473C9.1734 5.83279 9.45912 5.29824 9.87868 4.87868C10.2982 4.45912 10.8328 4.1734 11.4147 4.05764C11.9967 3.94189 12.5999 4.0013 13.1481 4.22836C13.6962 4.45542 14.1648 4.83994 14.4944 5.33329C14.8241 5.82664 15 6.40666 15 7C15 7.79565 14.6839 8.55871 14.1213 9.12132C13.5587 9.68393 12.7956 10 12 10ZM21 21V20C21 18.1435 20.2625 16.363 18.9497 15.0503C17.637 13.7375 15.8565 13 14 13H10C8.14348 13 6.36301 13.7375 5.05025 15.0503C3.7375 16.363 3 18.1435 3 20V21H5V20C5 18.6739 5.52678 17.4021 6.46447 16.4645C7.40215 15.5268 8.67392 15 10 15H14C15.3261 15 16.5979 15.5268 17.5355 16.4645C18.4732 17.4021 19 18.6739 19 20V21H21Z" fill="black"/>
                </svg>
              </div>

              <div class="icon icon-cart">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 22H19C20.103 22 21 21.103 21 20V9C21 8.73478 20.8946 8.48043 20.7071 8.29289C20.5196 8.10536 20.2652 8 20 8H17V7C17 4.243 14.757 2 12 2C9.243 2 7 4.243 7 7V8H4C3.73478 8 3.48043 8.10536 3.29289 8.29289C3.10536 8.48043 3 8.73478 3 9V20C3 21.103 3.897 22 5 22ZM9 7C9 5.346 10.346 4 12 4C13.654 4 15 5.346 15 7V8H9V7ZM5 10H7V12H9V10H15V12H17V10H19L19.002 20H5V10Z" fill="black"/>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>

  </header>

<div class="breadcrumbs">
  <div class="container-xxl">
    <?php if(function_exists('bcn_display'))
    {
      if(!is_home() && !is_front_page()) {
        bcn_display();
      }
    }?>
  </div>
</div>



