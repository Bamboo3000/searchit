<?php/* get_header(); ?>
<div class="row">
	<?php get_template_part('templates/job','filters'); ?>
	<div class="col-l-3of4 job-list">
		<?php
			if( have_posts() ) :
				while( have_posts() ) : the_post(); ?>
					<article class="the-job">
						<div class="row">
							<div class="col-l-8of10">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<hr class="job-green">
								<?php the_excerpt(); ?>
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
</div>
<?php get_footer(); */?>