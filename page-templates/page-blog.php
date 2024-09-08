<?php

/**
 * Template Name: Blog
 */

get_header(); ?>

<main id="main" role="main">

    <?php 

    ?>

    <section class="block-heading">
        <div class="container-sm">
            <h1><?php the_title() ?></h1>
            <p><?php the_content() ?></p>
        </div>
    </section>
    <section class="block-articles">
        <?php 
            $args = array(
                // Arguments for your query. 
                'post_type'	=> 'post'
            );
            // Custom query. 
            $query = new WP_Query( $args );
            // Check that we have query results. 
            if ( $query->have_posts() ) {
                // Start looping over the query results. 
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <div>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </div>
                    <?php
                }
            }
            // Restore original post data. 
            wp_reset_postdata();
        ?>
    </section>
</main>

<?php get_footer(); 