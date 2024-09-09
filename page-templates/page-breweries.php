<?php

/**
 * Template Name: Breweries
 */

get_header(); 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Define your custom query with pagination
$args = array(
    'post_type'      => 'brewery',
    'posts_per_page' => 10,        // Number of posts per page
    'orderby'       => 'date',
    'order'         => 'DESC',
    'paged'         => $paged      // Handle pagination
);

// Execute the query
$query = new WP_Query($args);
?>

<form class="filter-breweries" method="GET" action="<?php esc_url(home_url('/')) ?>">
    <input type="text" name="search_breweries" id="search-breweries" placeholder="Search by keyword">

    <input type="submit" value="Filter">
</form>

<div id="posts-container">
    <!-- Filtered posts will be displayed here -->
</div>
<div id="loading-spinner" style="display: none;">
    <!-- You can use a CSS spinner or a loading message -->
    <div class="spinner"></div>
</div>

<!-- Check if there are posts -->
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