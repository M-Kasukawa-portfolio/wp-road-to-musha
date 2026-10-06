<?php get_header(); ?>

<?php if(have_posts()): ?>
  <?php while(have_posts()): the_post(); ?>
  <main class="u-ptb">
      <div class="l-container-s">
          <h1 class="c-title-level1"><?php the_title(); ?></h1>

          <div class="l-page-body">
            <?php the_content(); ?>
          </div>
      </div>
  </main>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>