<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
  <div class="content-wrapper">
    <main id="main-content" role="main">
      <!-- section -->
      <section>
      <?php
      // Start the Loop.
      while ( have_posts() ) : the_post();

        // Include the page content template.
        get_template_part( 'content', 'page' );

      endwhile;
      ?>
      </section>
      <!-- /section -->
    </main>
  </div><!--main-wrapper-->
<?php get_footer(); ?>