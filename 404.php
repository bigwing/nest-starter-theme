<?php get_header(); ?>
  <?php get_template_part( 'content', 'breadcrumbs' ); ?>
  <div class="content-wrapper">
    <main id="main-content" class="sidebar" role="main">
      <section>
        <article id="post-404">
          <h1><?php _e( 'Page not found', 'opubco' ); ?></h1>
          <h2>
            <a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Return home?', 'opubco' ); ?></a>
          </h2>

        </article>
      </section><!-- /section -->
    </main>
    <?php get_sidebar(); ?>
  </div><!--main-wrapper-->
<?php get_footer(); ?>