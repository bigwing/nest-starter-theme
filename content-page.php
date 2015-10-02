<h1><?php the_title(); ?></h1>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_content(); ?>
	<?php //comments_template( '', true ); // Remove if you don't want comments ?>
	<div class="clear"></div>
	<?php edit_post_link(); ?>
</article>