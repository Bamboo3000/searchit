<?php 

function ajax_search_enqueues() {
    	wp_enqueue_script( 'ajax-search', get_template_directory_uri() . '/js/ajaxSearch.js', array( 'jquery' ), NULL, true );
        wp_localize_script( 'ajax-search', 'searchAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'ajax_search_enqueues' );

function ajax_search(){
	$query = $_POST['query'];
	$location = $_POST['location'];
	$category = $_POST['category'];
	$min = $_POST['min'];
	$max = $_POST['max'];
	$type = $_POST['type'];
	if(!empty($location)){
		$locationArg = array(
			'key' => 'job_location',
			'value' => $location,
			'compare' => 'LIKE',
		);
	}
	if(!empty($type)){
		$typeArg = array(
			'key' => 'job_type',
			'value' => $type,
			'compare' => 'LIKE',
		);
	}
	if(!empty($min) && !empty($max)){
		$salaryArg = array(
			'relation' => 'AND',
			array(
				'key' => 'job_salary_max',
				'value' => $min,
				'compare' => '>=',
			),
			array(
				'key' => 'job_salary_max',
				'value' => $max,
				'compare' => '<=',
			),
		);
	} elseif (!empty($min) && empty($max)){
		$salaryArg = array(
			array(
				'key' => 'job_salary_max',
				'value' => $min,
				'compare' => '>=',
			),
		);
	} elseif(!empty($max) && empty($min)){
		$salaryArg = array(
			array(
				'key' => 'job_salary_max',
				'value' => $max,
				'compare' => '<=',
			),
		);
	}
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		's' => $query,
		'category_name' => $category,
		'meta_query' => array(
			'relation' => 'AND',
			$locationArg,
			$typeArg,
			$salaryArg,
		),
	);
	$search = new WP_Query( $args );
    ob_start();
    $query_vars = array($query, $location, $category, $type, $min, $max);
    // printf( '<div class="search-query">' . __( 'Search results for: %s', 'searchit' ), '<span>' . get_search_query() .  '</span></div>' );
    if(!empty($query_vars)) {
    	echo '<div class="search-query">' . __( 'Search results for: ', 'searchit' );
    	foreach($query_vars as $var) {
    		if(!empty($var)) {
    			echo '<span>' . $var . '</span>';
    		}
    	}
    	echo '</div>';
    }
    if ( $search->have_posts() ) : ?>
		<?php while ( $search->have_posts() ) : $search->the_post(); ?>
			<?php 
				$titlei = get_the_title();
				$searchi = $query;
				if (preg_match("/\b".$_POST['query']."\b/i", get_the_title())) :
			?>
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
							<div class="col-l-4-of-10 col-xs-1-of-1">
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
							<div class="col-l-2-of-7 col-xs-1-of-1">
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
							<div class="col-l-5-of-16 col-xs-1-of-1">
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
		<?php endwhile; ?>
		<?php while ( $search->have_posts() ) : $search->the_post(); ?>
			<?php if (!preg_match("/\b".$_POST['query']."\b/i", get_the_title())) : ?>
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
							<div class="col-l-4-of-10 col-xs-1-of-1">
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
							<div class="col-l-2-of-7 col-xs-1-of-1">
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
							<div class="col-l-5-of-16 col-xs-1-of-1">
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
		<?php endwhile; ?>
		<?php else : ?>
			<article class="the-job">
				<h2>Nothing founded...</h2>
			</article>
			<?php
	endif;
	the_posts_pagination( array( 
		'mid_size'  => 2,
		'screen_reader_text' => ' ', 
	) );
	$content = ob_get_clean();
	echo $content;
	die();
}
add_action('wp_ajax_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');

 ?>