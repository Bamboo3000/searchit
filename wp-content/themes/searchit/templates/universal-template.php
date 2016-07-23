<?php 
/*
Template Name: Universal
*/
 ?>
<?php get_header(); ?>
<div class="universal-container">
	<?php $universal_cont = get_post_meta(get_the_ID(),'_my_universal_fields',TRUE); ?>
	<?php foreach($universal_cont as $uni_cont) : ?>
		<?php 
			// $maintitleU = $uni_cont['main_title'];
			// $subtitleU = $uni_cont['sub_title'];
			// $contentU = $uni_cont['content'];
		 ?>
		<section class="universal-section">	
			<div class="row">
				<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1 parentH universal-left-column">
					<aside>
						<hr>
						<span>
							<?php if(isset($uni_cont['main_title'])) { echo $uni_cont['main_title']; } ?>
						</span>
						<h2>
							<?php if(isset($uni_cont['sub_title'])) { echo $uni_cont['sub_title']; } ?>
						</h2>
					</aside>
				</div>
				<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 universal-right-column">
					<article>
						<?php if(isset($uni_cont['content'])) { echo apply_filters('the_content', $uni_cont['content'], TRUE ); } ?>
					</article>
				</div>
			</div>
		</section>
	<?php endforeach; ?>
</div>
<?php get_footer(); ?>