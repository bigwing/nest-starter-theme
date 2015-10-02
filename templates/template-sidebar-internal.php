<?php
/*
Template Name: Sidebar Internal
*/
?>
<?php get_header(); ?>
<div class="content-wrapper">
    <main id="main-content" class="sidebar" role="main">
      <section>
        <?php
        // Start the Loop.
        while ( have_posts() ) : the_post();

          // Include the page content template.
          get_template_part( 'content', 'page' );

        endwhile;
        ?>
      </section><!--section -->

    </main>
    <?php get_sidebar('internal'); ?>
</div><!--main-wrapper-->
<?php get_footer(); ?>