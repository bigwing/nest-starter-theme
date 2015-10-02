<?php get_header(); ?>
  <div class="content-wrapper">
    <main id="main-content" class="sidebar" role="main">
	    <section>
	      <?php if ( have_posts() ) : ?>
	        <h1><?php _e( 'Tag Archive: ', 'opubco' ); echo single_tag_title('', false); ?></h1>
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
	      endif;    ?>
	    </section><!-- /section -->
    </main>
    <?php get_sidebar(); ?>
  </div><!--main-wrapper-->
<?php get_footer(); ?>