<?php get_header(); ?>
  <?php get_template_part( 'content', 'breadcrumbs' ); ?>
  <div class="content-wrapper">
    <main id="main-content" class="sidebar" role="main">
      <section>
      <?php if ( have_posts() ) : ?>

      <header class="page-header">
        <h1 class="page-title">
          <?php
            if ( is_day() ) :
              printf( __( 'Daily Archives: %s', 'opubco' ), get_the_date() );

            elseif ( is_month() ) :
              printf( __( 'Monthly Archives: %s', 'opubco' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'opubco' ) ) );

            elseif ( is_year() ) :
              printf( __( 'Yearly Archives: %s', 'opubco' ), get_the_date( _x( 'Y', 'yearly archives date format', 'opubco' ) ) );

            else :
              _e( 'Archives', 'opubco' );

            endif;
          ?>
        </h1>
      </header><!-- .page-header -->

      <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', get_post_format() );

          endwhile;
          // Previous/next post navigation.
          get_template_part( 'content', 'pagination' );

        else :
          // If no content, include the "No posts found" template.
          get_template_part( 'content', 'none' );

        endif;
      ?>
      </section><!-- /section -->
    </main>
    <?php get_sidebar(); ?>
  </div><!--main-wrapper-->
<?php get_footer(); ?>