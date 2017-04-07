<?php get_header(); ?>
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-12 medium-12 columns" role="main">
				<?php get_template_part( 'parts/content', 'breadcrumbs' ); ?>
		    	<header>
		    		<h1 class="page-title"><?php the_archive_title();?></h1>
					<?php the_archive_description( '<div class="archive-description">', '</div>' );?>
		    	</header>
				<div class="testimonial-content">
		    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			 
					<!-- To see additional archive styles, visit the /parts directory -->		
					<?php get_template_part( 'parts/testimonial', 'archive' ); ?>
				    
				<?php endwhile; ?>
				</div><!-- .testimonial-content -->	

					<?php joints_page_navi(); ?>
					
				<?php else : ?>
											
					<?php get_template_part( 'parts/content', 'missing' ); ?>
						
				<?php endif; ?>							

			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php get_footer(); ?>
