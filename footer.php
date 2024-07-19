<footer class="footer">
  <div class="footer__main">
    <div class="container-xxl">
      <div class="row gap-4 justify-content-between">
        <div class="col-auto">
          <?php the_custom_logo(); ?>
        </div>
            <div class="col-auto">
              <h5>Over ons</h5>
              <?php wp_nav_menu( array(
                'theme_location' => 'footer-menu-1',
                'depth'       => 1,
                'fallback_cb' => false,
                'container'   => false,
                'menu_class'  => 'footer-nav',
              ) ); ?>
            </div>
    
            <div class="col-auto">
              <h5>Diensten</h5>
              <?php wp_nav_menu( array(
                'theme_location' => 'footer-menu-2',
                'depth'       => 1,
                'fallback_cb' => false,
                'container'   => false,
                'menu_class'  => 'footer-nav',
              ) ); ?>
            </div>
            <div class="col-auto">
              <h5>Social Media</h5>
              <?php wp_nav_menu( array(
                'theme_location' => 'footer-menu-3',
                'depth'       => 1,
                'fallback_cb' => false,
                'container'   => false,
                'menu_class'  => 'footer-nav',
              ) ); ?>
            </div>
            <div class="col-auto">
              <h5>Informatie</h5>
              <div class="footer__copyright-links">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer-menu-4',
                        'depth'       => 1,
                        'fallback_cb' => false,
                        'container'   => false,
                        'menu_class'  => 'footer-nav',
                    ) ); ?>
                </div>
            </div>
      </div>
    </div>
  </div>
  
  <div class="footer__bottom">
    <div class="container-xxl">
      <div class="footer__bottom-wrapper">
        <div class="footer__copyright">
          <div class="footer__copyright-info">
            <span>&copy; 2023 Per Lui</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>