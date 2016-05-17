<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="post-details-wrapper">
    <?php
    if ( is_single() ) :
      nest_custom_title( get_the_ID(), '<h1 class="entry-title">', '</h1>' );
    else :
      the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
    ?><!--post-title-->
    <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
    <span class="author"><?php _e( 'Published by', 'opubco' ); ?> <?php the_author_posts_link(); ?></span>
    <span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'opubco' ), __( '1 Comment', 'opubco' ), __( '% Comments', 'opubco' )); ?></span>
  </div><!--post-detais-wrapper-->
  <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_post_thumbnail('thumbnail'); // Declare pixel size you need inside the array ?>
    </a>
  <?php endif; ?><!--post-thumbnail-->
  <?php if ( !is_single() ) : ?>
    <div class="entry-summary">
      <?php nest_custom_excerpt(20,'Read More'); // Build your custom callback length in functions.php ?>
    </div><!-- .entry-summary -->
  <?php else : ?>
    <div class="entry-content">
      <?php
      the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'opubco' ) );
      ?>
    </div><!-- .entry-content -->
  <?php endif; ?>
  <?php edit_post_link(); ?>
</article>