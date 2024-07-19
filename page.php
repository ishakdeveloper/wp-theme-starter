<?php get_header(); ?>

<main id="main" role="main">
  <article class="block block-article">
    <?php the_post(); ?>
    <div class="container-xxl">
      <div class="block-article__article-wrapper">
        <div class="block-article__header">
          <h1><?php the_title(); ?></h1>
        </div>

        <?php the_content() ?>
      </div>
    </div>
  </article>
</main>

<?php get_footer(); ?>