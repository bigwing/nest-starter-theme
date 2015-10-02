<?php get_header(); ?>
  <div class="content-wrapper">
    <main id="main-content" class="sidebar" role="main">
      <section>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

          <?php get_template_part( 'content', get_post_format() ); ?>

        <?php endwhile; ?>

        <?php else: ?>
          <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>
      </section><!-- /section -->
    </main>
    <?php get_sidebar(); ?>
  </div><!--main-wrapper-->
<?php get_footer(); ?>