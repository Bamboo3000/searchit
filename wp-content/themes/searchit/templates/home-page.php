<?php 
/*
Template Name: Home
*/
 ?>
<?php get_header('home'); ?>
	
	<?php if(wp_is_mobile()) : ?>
		<header class="home-bg vheight" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);">
	<?php else : ?>
		<header class="home-bg vheight">
			<video autoplay loop muted id="bgvid">
				<source src="<?php echo get_template_directory_uri(); ?>/video/vid.mp4" type="video/mp4">
			    <source src="<?php echo get_template_directory_uri(); ?>/video/vid.webm" type="video/webm">
			</video>
	<?php endif; ?>
		<div class="centerV">
			<div class="claim white">
				<?php 
					$claim = get_post_meta(get_the_ID(),'_my_main_claim',TRUE); 
					echo apply_filters('meta_content', $claim );
				?>
			</div>
			<div class="main-search">
				<?php get_search_form(); ?>
			</div>
		</div>
	</header>
	<section class="categories">
		<div class="row">
			<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1">
				<aside>
					<hr>
					<span>
						<?php echo get_post_meta(get_the_ID(),'_my_sub_title_categories',TRUE); ?>
					</span>
					<h2>
						<?php echo get_post_meta(get_the_ID(),'_my_main_title_categories',TRUE); ?>
					</h2>
				</aside>
			</div>
			<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1">
				<div class="row categories-list">
					<?php 
						$args = array(
							'hide_empty' => 0
						);
					 ?>
					 <?php foreach (get_categories($args) as $cat) : ?>
							<?php if(z_taxonomy_image_url($cat->term_id)) : ?>
							<div class="col-xl-1-of-3 col-s-1-of-2 col-xs-1-of-1 the-category">
								<figure>
									<a href="<?php echo get_category_link($cat->term_id); ?>">
										<img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>" />
									</a>
									<figcaption>
										<?php if(ICL_LANGUAGE_CODE == 'en') : ?>
											<a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?> Jobs</a>
										<?php else : ?>
											<a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?> Vacatures</a>
										<?php endif; ?>
									</figcaption>
								</figure>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>	
			</div>
		</div>
	</section>
	<section class="about">
		<div class="row">
			<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1">
				<aside>
					<hr>
					<span>
						<?php echo get_post_meta(get_the_ID(),'_my_sub_title_about',TRUE); ?>
					</span>
					<h2>
						<?php echo get_post_meta(get_the_ID(),'_my_main_title_about',TRUE); ?>
					</h2>
				</aside>
			</div>
			<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 bg-white">
				<div class="row parentH">
					<div class="col-l-1-of-2 col-xs-1-of-1 about-text">
						<?php $about = get_post_meta(get_the_ID(),'_my_about_text',TRUE); 
							echo apply_filters('meta_content', $about );
						?>
					</div>
					<div class="col-l-1-of-2 col-xs-1-of-1 backgroundF" style="background-image:url('<?php echo get_post_meta(get_the_ID(),'_my_about_img1',TRUE);  ?>');">
						
					</div>
				</div>
				<div class="row parentH">
					<div class="col-l-1-of-2 col-xs-1-of-1 backgroundF" style="background-image:url('<?php echo get_post_meta(get_the_ID(),'_my_about_img2',TRUE);  ?>');">
						
					</div>
					<div class="col-l-1-of-2 col-xs-1-of-1 our-stats">
						<hr>
						<h4>
							<?php echo get_post_meta(get_the_ID(),'_my_stats_title',TRUE); ?>
						</h4>
						<div class="row">
							<div class="col-s-1-of-4 col-xs-1-of-2 the-stat">
								<div class="hexagon">
									<span><?php echo get_post_meta(get_the_ID(),'_my_stat1',TRUE); ?></span>
								</div>
								<p class="small"><?php echo get_post_meta(get_the_ID(),'_my_stat1_desc',TRUE); ?></p>
							</div>
							<div class="col-s-1-of-4 col-xs-1-of-2 the-stat">
								<div class="hexagon">
									<span><?php echo get_post_meta(get_the_ID(),'_my_stat2',TRUE); ?></span>
								</div>
								<p class="small"><?php echo get_post_meta(get_the_ID(),'_my_stat2_desc',TRUE); ?></p>
							</div>
							<div class="col-s-1-of-4 col-xs-1-of-2 the-stat">
								<div class="hexagon">
									<span><?php echo get_post_meta(get_the_ID(),'_my_stat3',TRUE); ?></span>
								</div>
								<p class="small"><?php echo get_post_meta(get_the_ID(),'_my_stat3_desc',TRUE); ?></p>
							</div>
							<div class="col-s-1-of-4 col-xs-1-of-2 the-stat">
								<div class="hexagon">
									<span><?php echo get_post_meta(get_the_ID(),'_my_stat4',TRUE); ?></span>
								</div>
								<p class="small"><?php echo get_post_meta(get_the_ID(),'_my_stat4_desc',TRUE); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="testimonials">
		<div class="row">
			<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1">
				<aside>
					<hr>
					<span>
						<?php echo get_post_meta(get_the_ID(),'_my_sub_title_testimonials',TRUE); ?>
					</span>
					<h2>
						<?php echo get_post_meta(get_the_ID(),'_my_main_title_testimonials',TRUE); ?>
					</h2>
				</aside>
			</div>
			<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 testimonials-list bg-lgrey">
				<div id="carousel" class="owl-carousel">
				<?php 
					$args=array(
					  'post_type' => 'testimonials',
					  'post_status' => 'publish',
					  'posts_per_page' => -1,
					  'meta_key' => '_my_testimonials-check',
    				  'meta_value' => 'yes',
					);
					$testimonials_query = null;
					$testimonials_query = new WP_Query($args);
				 ?>
				<?php if ( $testimonials_query->have_posts() ) : ?>
					<?php
						while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?> 
							<div class="item the-testimonial">
								<div class="col-xxl-7-of-10 col-xl-9-of-10 col-xs-1-of-1">
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