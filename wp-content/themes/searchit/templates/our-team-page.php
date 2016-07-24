<?php 
/*
Template Name: Team
*/
 ?>
<?php get_header(); ?>
<div class="team-container">
	<section class="team-section">	
		<div class="row bg-lgrey">
			<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1 team-left-column">
				<aside>
					<hr>
					<span>
						<?php the_title(); ?>
						<?php // get_post_meta(get_the_ID(), '_my_sub_title_cv', TRUE ); ?>
					</span>
					<h2>
						<?php echo __( 'Get to know us!', 'searchit' ); ?>
						<?php // get_post_meta(get_the_ID(), '_my_main_title_cv', TRUE ); ?>
					</h2>
				</aside>
			</div>
			<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 team-right-column bg-white">
				<article>
					<div class="row">
						<?php 
							$args=array(
							  'post_type' => 'team',
							  'post_status' => 'publish',
							  'posts_per_page' => -1,
							);
							$team_query = null;
							$team_query = new WP_Query($args);
						 ?>
						<?php if ( $team_query->have_posts() ) : ?>
							<?php
								while ( $team_query->have_posts() ) : $team_query->the_post(); ?> 
									<div class="team-right-column-single equalH col-xl-1-of-3 col-s-1-of-2 col-xs-1-of-1">
										<div class="team-right-column-single-img">
											<?php the_post_thumbnail(); ?>
										</div>
										<div class="team-right-column-single-text">
											<h3>
												<?php the_title(); ?>
											</h3>
											<hr class="green">
											<p>
												<a href="tel:<?php echo get_post_meta(get_the_ID(), '_my_team_phone', TRUE); ?>">
													<?php echo get_post_meta(get_the_ID(), '_my_team_phone', TRUE); ?>
												</a>
											</p>
											<p>
												<a href="mailto:<?php echo get_post_meta(get_the_ID(), '_my_team_email', TRUE); ?>">
													<?php echo get_post_meta(get_the_ID(), '_my_team_email', TRUE); ?>
												</a>
											</p>
											<p>
												<?php echo get_post_meta(get_the_ID(), '_my_team_bio', TRUE); ?>
											</p>
										</div>
								    </div>
								<?php endwhile;
							?>
						<?php endif; ?>
					</div>
				</article>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>