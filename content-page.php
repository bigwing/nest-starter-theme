<h1><?php nest_custom_title( get_the_ID() ); ?></h1>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_content(); ?>
	<?php //comments_template( '', true ); // Remove if you don't want comments ?>
	<div class="clear"></div>
	<?php edit_post_link(); ?>
</article>