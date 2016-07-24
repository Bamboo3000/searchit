<?php 
/*
Template Name: Upload CV
*/
 ?>
<?php get_header(); ?>
<div class="universal-container">
	<section class="universal-section">	
		<div class="row">
			<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1 parentH universal-left-column">
				<aside>
					<hr>
					<span>
						<?php echo __( 'Upload CV', 'searchit' ); ?>
						<?php // get_post_meta(get_the_ID(), '_my_sub_title_cv', TRUE ); ?>
					</span>
					<h2>
						<?php echo __( 'First step to Your new job!', 'searchit' ); ?>
						<?php // get_post_meta(get_the_ID(), '_my_main_title_cv', TRUE ); ?>
					</h2>
				</aside>
			</div>
			<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 universal-right-column">
				<article>
					<?php require_once 'apply-form.php'; ?>
				</article>
			</div>
		</div>
	</section>
</div>
<?php get_footer('jobs'); ?>