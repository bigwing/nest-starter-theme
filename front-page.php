<?php get_header(); ?>
<div class="content-wrapper">
	<main id="main-content" role="main">
		<?php
          // Start the Loop.
		while ( have_posts() ) : the_post();
            // Include the page content template.
		get_template_part( 'content', 'page' );
		endwhile;
		?>
	</main><!--main-content-->
</div><!--content-wrapper-->
<?php get_footer(); ?>