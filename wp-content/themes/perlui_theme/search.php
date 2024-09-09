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

$query = isset($args['query']) ? $args['query'] : null;
?>

<main id="main" class="main">
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?php do_action( 'woocommerce_sidebar' ); ?>
            </div>
            <div class="col-xl-9 col-lg-8">
            !-- Check if there are posts -->
            <?php if ($query->have_posts()) : ?>

                <ul>
                    <!-- Loop through the posts -->
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <li>
                            <h2><?php the_title(); ?></h2>
                            <p><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>">Read More</a>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    // Display pagination links
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'prev_text' => __('&laquo; Previous'),
                        'next_text' => __('Next &raquo;'),
                    ));
                    ?>
                </div>

                <!-- Restore original Post Data -->
                <?php wp_reset_postdata(); ?>

            <?php else : ?>

                <p><?php _e('No breweries found.'); ?></p>

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