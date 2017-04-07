<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
	<header class="article-header">	
		<h1 class="entry-title single-title" itemprop="headline"><?php nest_custom_title(); ?></h1>
		<?php get_template_part( 'parts/content', 'byline' ); ?>
	</header> <!-- end article header -->
					
	<section class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</section> <!-- end article section -->
						
	<footer class="article-footer">
		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bigwing-nest' ),
			'after' => '</div>',
		) ); ?>
		<p class="tags"><?php the_tags( '<span class="tags-title">' . __( 'Tags:', 'bigwing-nest' ) . '</span> ', ', ', '' ); ?></p>	
	</footer> <!-- end article footer -->
						
	<?php // comments_template(); ?>	
													
</article> <!-- end article -->
