<?php 
/*
* Template Name: Search
*/
 ?>

<?php get_header(); ?>
<div class="row bg-lgrey">
	<?php get_template_part('templates/job','filters'); ?>
	<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 job-list bg-white">
		<?php printf( '<div class="search-query">' . __( 'Search results for: %s', 'searchit' ), '<strong>' . get_search_query() . '</strong></div>' ); ?>
		<?php 
			$args=array(
			  'post_type' => 'post',
			  'post_status' => 'publish',
			  'posts_per_page' => -1,
			  's' => get_search_query()
			);
			$search_query = null;
			$search_query = new WP_Query($args);			
		 ?>
		<?php
			if( $search_query->have_posts() ) :
				while( $search_query->have_posts() ) : $search_query->the_post(); ?>
					<?php if (preg_match("/\b".get_search_query()."\b/i", get_the_title())) : ?>
					<article class="the-job">
						<div class="row">
							<div class="col-xxl-8-of-10 col-xl-9-of-10 col-xs-1-of-1">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<hr class="job-green">
								<?php the_excerpt(); ?>
								<div class="row in-short">
									<?php
										$location = get_post_meta(get_the_ID(), 'job_location', true); 
										if(!empty($location)) : 
									?>
									<div class="col-l-4-of-10">
										<p>
											<strong><?php echo __('Location:', 'searchit'); ?></strong>
											<?php 
												echo $location;
											 ?>
										</p>
									</div>
									<?php endif; ?>
									<?php 
										$type = get_post_meta(get_the_ID(), 'job_type', true);
										if(!empty($type)) : 
									?>
									<div class="col-l-2-of-7">
										<p>
											<strong><?php echo __('Type:', 'searchit');?></strong>
											<?php 
												echo $type;
											 ?>
										</p>
									</div>
									<?php endif; ?>
									<?php 
										$salaryMin = get_post_meta(get_the_ID(), 'job_salary_min', true);
										if(!empty($salaryMin)) : 
									?>
									<div class="col-l-5-of-16">
										<p>
											<strong><?php echo __('Salary:', 'searchit'); ?></strong>
											<?php 
												echo number_format(get_post_meta(get_the_ID(), 'job_salary_min', true), 0, ',', '.');
											?>
											<?php
												$salaryMax = get_post_meta(get_the_ID(), 'job_salary_max', true); 
												if(!empty($salaryMax)) : 
											?>
												-
												<?php echo number_format(get_post_meta(get_the_ID(), 'job_salary_max', true), 0, ',', '.'); ?>
											<?php endif; ?>
											euro
										</p>
									</div>
									<?php endif; ?>
								</div>
								<a href="<?php the_permalink(); ?>" class="job-readmore"><?php echo __('Read more', 'searchit'); ?></a>
								<hr>
							</div>
						</div>
					</article>
				<?php endif; ?>
				<?php endwhile;
				while( $search_query->have_posts() ) : $search_query->the_post(); ?>
					<?php if (!preg_match("/\b".get_search_query()."\b/i", get_the_title())) : ?>
					<article class="the-job">
						<div class="row">
							<div class="col-xxl-8-of-10 col-xl-9-of-10 col-xs-1-of-1">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<hr class="job-green">
								<?php the_excerpt(); ?>
								<div class="row in-short">
									<?php
										$location = get_post_meta(get_the_ID(), 'job_location', true); 
										if(!empty($location)) : 
									?>
									<div class="col-l-4-of-10">
										<p>
											<strong><?php echo __('Location:', 'searchit'); ?></strong>
											<?php 
												echo $location;
											 ?>
										</p>
									</div>
									<?php endif; ?>
									<?php 
										$type = get_post_meta(get_the_ID(), 'job_type', true);
										if(!empty($type)) : 
									?>
									<div class="col-l-2-of-7">
										<p>
											<strong><?php echo __('Type:', 'searchit');?></strong>
											<?php 
												echo $type;
											 ?>
										</p>
									</div>
									<?php endif; ?>
									<?php 
										$salaryMin = get_post_meta(get_the_ID(), 'job_salary_min', true);
										if(!empty($salaryMin)) : 
									?>
									<div class="col-l-5-of-16">
										<p>
											<strong><?php echo __('Salary:', 'searchit'); ?></strong>
											<?php 
												echo number_format(get_post_meta(get_the_ID(), 'job_salary_min', true), 0, ',', '.');
											?>
											<?php
												$salaryMax = get_post_meta(get_the_ID(), 'job_salary_max', true); 
												if(!empty($salaryMax)) : 
											?>
												-
												<?php echo number_format(get_post_meta(get_the_ID(), 'job_salary_max', true), 0, ',', '.'); ?>
											<?php endif; ?>
											euro
										</p>
									</div>
									<?php endif; ?>
								</div>
								<a href="<?php the_permalink(); ?>" class="job-readmore"><?php echo __('Read more', 'searchit'); ?></a>
								<hr>
							</div>
						</div>
					</article>
					<?php endif; ?>
				<?php endwhile;
				else : ?>
				<article class="the-job">
					<h2>Nothing founded...</h2>
				</article>
			<?php endif;
			wp_reset_query();
		?>
	</div>
	<div class="gradient col-l-1-of-4 col-m-1-of-3"></div>
</div>
<?php get_footer(); ?>