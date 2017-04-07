<?php
$testimonial = nest_get_testimonial();

// Get testimonial Image
$has_image = false;
$testimonial_image_src = wp_get_attachment_image_src( $testimonial['image_id'], 'thumbnail' );
if ( $testimonial_image_src ) {
	$has_image = true;
}

// Get testimonial Location
$has_location = false;
if ( isset( $testimonial['location'] ) ) {
	$has_location = true;
}
?>
<div class="testimonial">
	<blockquote>
		<?php echo esc_html( $testimonial['excerpt'] ); ?>
	</blockquote>
	<div class="testimonial-meta">
		<div class="testimonial-image">
			<?php
			if ( $has_image ) {
				printf( '<img src="%s" alt="%s" />', esc_url( $testimonial_image_src[0] ), esc_attr( get_the_title() ) );
			}
			?>
		</div><!-- .testimonial-image -->
		<div class="testimonial-name">
			<?php the_title(); ?>
		</div>
		<?php
		if ( $has_location ) {
			?>
			<div class="testimonial-location">
				&nbsp;|&nbsp;<?php echo esc_html( $testimonial['location'] ); ?>
			</div>
			<?php
		}
		?>
	</div><!-- .testimonial-meta -->
	<div class="testimonial-readmore">
		<a href="<?php the_permalink(); ?>" class="button ffab fa-arrow-right">Full Testimonial</a>
	</div><!-- .testimonial-readmore -->
</div><!-- .testimonial -->
