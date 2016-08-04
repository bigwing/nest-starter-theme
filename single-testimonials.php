<?php
/*
Template Name: Full Width (No Sidebar)
*/
?>

<?php get_header(); ?>
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-12 medium-12 columns" role="main">
				<?php get_template_part( 'parts/content', 'breadcrumbs' ); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
											
						<header class="article-header">
							<h1 class="page-title"><?php nest_custom_title(); ?></h1>
						</header> <!-- end article header -->
										
					    <section class="entry-content" itemprop="articleBody">
						    <?php
							$testimonial = nest_get_testimonial();
							?>
							<blockquote>
								<?php
								// Output Image left-aligned
								if ( isset( $testimonial[ 'image_id' ] ) ):
									$image_src = wp_get_attachment_image_src( $testimonial[ 'image_id' ], 'thumbnail' );
									if ( $image_src ):
								?>
									 <p class="alignleft"><img src="<?php echo esc_url( $image_src[ 0 ] ); ?>" alt="<?php the_title(); ?>" /></p>	
								<?php
									endif;
								endif;
								?>
								<?php
								// Output the content
								$content = $testimonial[ 'excerpt' ];
								if ( isset( $testimonial[ 'content' ] ) ) {
									$content = $testimonial[ 'content' ];
								}	
								echo apply_filters( 'nest_the_content', $content );
								?>
							</blockquote>
							<?php
							// Output organizational information
							if ( isset( $testimonial[ 'organization_name' ] ) && ( isset( $testimonial[ 'address' ] ) || isset( $testimonial[ 'phone' ] ) || isset( $testimonial[ 'website' ] ) ) ):
							?>
							<dl>
								<dt>Organization</dt>
								<dd><?php echo esc_html( $testimonial[ 'organization_name' ] ); ?>
								<?php
								if ( isset( $testimonial[ 'address' ] ) ):
								?>
								<dt>Address</dt>
								<dd><?php echo $testimonial[ 'address' ];?></dd>
								<?php
								endif; 
								?>
								<?php
								if ( isset( $testimonial[ 'phone' ] ) ):
								?>
								<dt>Phone</dt>
								<dd><?php echo esc_html( $testimonial[ 'phone' ] );?></dd>
								<?php
								endif; 
								?>
								<?php
								if ( isset( $testimonial[ 'website' ] ) ):
								?>
								<dt>Website</dt>
								<dd><a target="_blank" href="<?php echo esc_url( $testimonial[ 'website' ] );?>"><?php echo esc_html( $testimonial[ 'website' ] );?></a></dd>
								<?php
								endif; 
								?>
							</dl>
							<?php
							endif;	
								
							?>
						</section> <!-- end article section -->
											
						<footer class="article-footer">
							
						</footer> <!-- end article footer -->
											    
										
					</article> <!-- end article -->
					
				<?php endwhile; endif; ?>							

			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php get_footer(); ?>
