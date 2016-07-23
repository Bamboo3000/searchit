<?php get_header(); ?>
	<?php if ( have_posts() ) : ?>
		<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_type() );
			endwhile;
		?>
	<?php endif; ?>
<?php get_footer(); ?>