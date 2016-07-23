<?php get_header(); ?>
<div class="row bg-lgrey">
	<?php get_template_part('templates/job','filters'); ?>
	<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 job-list bg-white">
		<?php
			if( have_posts() ) :
				while( have_posts() ) : the_post(); ?>
					<article class="the-job">
						<div class="row">
							<div class="col-xxl-8-of-10 col-xl-9-of-10 col-xs-1-of-1">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<hr class="job-green">
								<?php the_excerpt(); ?>
								<div class="row in-short">
									<?php if(!empty(get_post_meta(get_the_ID(), 'job_location', true))) : ?>
									<div class="col-l-4-of-10">
										<p>
											<strong><?php echo __('Location:', 'searchit'); ?></strong>
											<?php 
												echo get_post_meta(get_the_ID(), 'job_location', true);
											 ?>
										</p>
									</div>
									<?php endif; ?>
									<?php if(!empty(get_post_meta(get_the_ID(), 'job_type', true))) : ?>
									<div class="col-l-2-of-7">
										<p>
											<strong><?php echo __('Type:', 'searchit');?></strong>
											<?php 
												echo get_post_meta(get_the_ID(), 'job_type', true);
											 ?>
										</p>
									</div>
									<?php endif; ?>
									<?php if(!empty(get_post_meta(get_the_ID(), 'job_salary_min', true))) : ?>
									<div class="col-l-5-of-16">
										<p>
											<strong><?php echo __('Salary:', 'searchit'); ?></strong>
											<?php 
												echo number_format(get_post_meta(get_the_ID(), 'job_salary_min', true), 0, ',', '.');
											?>
											<?php if(!empty(get_post_meta(get_the_ID(), 'job_salary_max', true))) : ?>
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
				<?php endwhile;
				the_posts_pagination( array( 
					'mid_size'  => 2,
					'screen_reader_text' => ' ', 
				) );
			endif;
		?>
	</div>
	<div class="gradient col-l-1-of-4 col-m-1-of-3"></div>
</div>
<?php get_footer(); ?>