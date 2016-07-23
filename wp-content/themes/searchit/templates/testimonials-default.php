<?php 
/*
Template Name: Testimonials Default
*/
 ?>
<?php get_header(); ?>
<section class="testimonials">	
	<div class="row">
		<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1 parentH universal-left-column">
			<aside>
				<hr>
				<span>
					<?php echo __( 'Testimonials', 'searchit' ); ?>
				</span>
				<h2>
					<?php echo __( 'Kind words about us', 'searchit' ); ?>
				</h2>
			</aside>
		</div>
		<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 testimonials-list">
			<div id="carousel" class="owl-carousel">
			<?php 
				$args=array(
				  'post_type' => 'testimonials',
				  'post_status' => 'publish',
				  'posts_per_page' => -1,
				);
				$testimonials_query = null;
				$testimonials_query = new WP_Query($args);
			 ?>
			<?php if ( $testimonials_query->have_posts() ) : ?>
				<?php
					while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?> 
						<div class="item the-testimonial">
							<div class="col-xxl-7-of-10 col-xl-8-of-10 col-l-9-of-10 col-xs-1-of-1">
								<?php the_content(); ?>
								<p class="signature">
									<?php the_title(); ?>
								</p>
							</div>
					    </div>
					<?php endwhile;
				?>
			<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>