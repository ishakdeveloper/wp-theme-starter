<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>

<main id="main" class="main">
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?php //get_sidebar( 'shop' ); ?>
                <form action="">
                    <?php
                        $terms = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false
                        ]);
                    ?>

                    <?php foreach ($terms as $term): ?>
                        <input type="checkbox" name="product_cat[]" value="<?php echo $term->slug; ?>">
                        <?php echo $term->name; ?>
                    <?php endforeach; ?>

                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="col-xl-9 col-lg-8">
            <?php if ( woocommerce_product_loop()): ?>
                <div class="product__archive__header">
                    <?php 
                        /**
                         * Hook: woocommerce_shop_loop_header.
                         *
                         * @since 8.6.0
                         *
                         * @hooked woocommerce_product_taxonomy_archive_header - 10
                         */
                        do_action( 'woocommerce_shop_loop_header' );

                        /**
                         * Hook: woocommerce_before_shop_loop.
                         *
                         * @hooked woocommerce_output_all_notices - 10
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
                        do_action( 'woocommerce_before_shop_loop' );
                    ?>
                </div>

                    <?php
                        woocommerce_product_loop_start();
                    
                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();
                    
                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action( 'woocommerce_shop_loop' );
                    
                                wc_get_template_part( 'content', 'product' );
                            }
                        }
                    
                        woocommerce_product_loop_end();
                    
                        /**
                         * Hook: woocommerce_after_shop_loop.
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                    ?>

                <?php else: ?>
                    <?php 
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action( 'woocommerce_no_products_found' );
                    ?>
                <?php endif; ?>
            </div>
        </div>
      
    </div>
</main>

<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */

get_footer( 'shop' );