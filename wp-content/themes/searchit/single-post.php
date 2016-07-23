<?php get_header(); ?>
<div class="row bg-lgrey">
	<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1 job-details">
		<aside>
			<?php 
				$location = get_post_meta(get_the_ID(), 'job_location', true);
				if(!empty($location)) : 
			?>
			<div class="row the-details">
				<div class="col-xl-4-of-10 col-m-1-of-1 col-s-2-of-10 col-xs-1-of-1 title">
					<?php 
						echo __('Location', 'searchit');
					 ?>:
				</div>
				<div class="col-xl-6-of-10 col-m-1-of-1 col-s-8-of-10 col-xs-1-of-1 value">
					<?php 
						echo get_post_meta(get_the_ID(), 'job_location', true);
					 ?>
				</div>
			</div>
			<?php endif; ?>
			<?php
				$type = get_post_meta(get_the_ID(), 'job_type', true); 
				if(!empty($type)) : 
			?>
			<div class="row the-details">
				<div class="col-xl-4-of-10 col-m-1-of-1 col-s-2-of-10 col-xs-1-of-1 title">
					<?php 
						echo __('Job type', 'searchit');
					 ?>:
				</div>
				<div class="col-xl-6-of-10 col-m-1-of-1 col-s-8-of-10 col-xs-1-of-1 value">
					<?php 
						echo get_post_meta(get_the_ID(), 'job_type', true);
					 ?>
				</div>
			</div>
			<?php endif; ?>
			<?php
				$salaryMin = get_post_meta(get_the_ID(), 'job_salary_min', true); 
				if(!empty($salaryMin)) : 
			?>
			<div class="row the-details">
				<div class="col-xl-4-of-10 col-m-1-of-1 col-s-2-of-10 col-xs-1-of-1 title">
					<?php 
						echo __('Salary', 'searchit');
					 ?>:
				</div>
				<div class="col-xl-6-of-10 col-m-1-of-1 col-s-8-of-10 col-xs-1-of-1 value">
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
				</div>
			</div>
			<?php endif; ?>
			<div class="row the-details">
				<div class="col-xs-1-of-1 share-btn">
					<ul class="share-buttons">
					  <li>
					  	<div class="hexagon facebook">
					  		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>&t=<?php the_title(); ?>" title="Share on Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					  	</div>
					  </li>
					  <li>
						<div class="hexagon twitter">
						  	<a href="https://twitter.com/intent/tweet?source=<?php echo get_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" title="Tweet"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					  	</div>
					  </li>
					  <li>
						<div class="hexagon gplus">
					  		<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank" title="Share on Google+"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
					  	</div>
					  </li>
					  <li>
					  	<div class="hexagon pocket">
					  		<a href="https://getpocket.com/save?url=<?php echo get_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" title="Add to Pocket"><i class="fa fa-get-pocket" aria-hidden="true"></i></a>
					  	</div>
					  </li>
					  <li>
					  	<div class="hexagon linkedin">
					  		<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php the_title(); ?>&summary=Checkout%20this%20job%20offer!&source=<?php echo get_permalink(); ?>" target="_blank" title="Share on LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
					  	</div>
					  </li>
					  <li>
					 	<div class="hexagon mail">
					  		<a href="mailto:?subject=<?php the_title(); ?>&body=Checkout%20this%20job%20offer: <?php echo get_permalink(); ?>" target="_blank" title="Email"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
					  	</div>
					  </li>
					</ul>
				</div>
			</div>
			<?php 
				$job_lat = get_post_meta(get_the_ID(), 'job_lat', true);
				$job_lng = get_post_meta(get_the_ID(), 'job_lng', true);
				if(!empty($job_lat) && !empty($job_lng)) : 
			?>
			<div class="row the-details">
				<div class="col-xs-1-of-1 map">
					<div id="job_map"></div>
				</div>
			</div>
			<script>
			  	function initMap() {
			        var job_map = document.getElementById('job_map');
			        var map = new google.maps.Map(job_map, {
						center: {lat: <?php echo get_post_meta(get_the_ID(), 'job_lat', true); ?>, lng: <?php echo get_post_meta(get_the_ID(), 'job_lng', true); ?>},
						zoom: 12,
						scrollwheel: false,
						draggable: false,
			        });
			        var marker = new google.maps.Marker({
			          	map: map,
			          	position: new google.maps.LatLng(<?php echo get_post_meta(get_the_ID(), 'job_lat', true); ?>,<?php echo get_post_meta(get_the_ID(), 'job_lng', true); ?>)
			        });
			         map.set('styles', [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a0d6d1"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#dedede"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#dedede"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f1f1f1"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]);
			  	}
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
			<?php endif; ?>
			<div class="row">
				<div class="col-xs-1-of-1">
					<a href="#" class="scrollTo apply-to" data-to="apply-form-section">Apply</a>
				</div>
			</div>
		</aside>
	</div>
	<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 job-content bg-white">
		<?php
			if( have_posts() ) :
				while( have_posts() ) : the_post(); ?>
					<article class="the-job-content">
						<div class="row the-job-content-text">
							<div class="col-xxl-8-of-10 col-xl-9-of-10 col-xs-1-of-1">
								<h2><?php the_title(); ?></h2>
								<hr class="job-green">
								<?php the_content(); ?>
							</div>
						</div>
						<!-- <div class="row share-job">
							<div class="col-xs-1-of-1 share-btn-down">
								<h4>
									Share this job!
								</h4>
								<hr class="job-green">
								<ul class="share-buttons">
								  <li>
								  	<div class="hexagon facebook">
								  		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>&t=<?php the_title(); ?>" title="Share on Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
								  	</div>
								  </li>
								  <li>
									<div class="hexagon twitter">
									  	<a href="https://twitter.com/intent/tweet?source=<?php echo get_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" title="Tweet"><i class="fa fa-twitter" aria-hidden="true"></i></a>
								  	</div>
								  </li>
								  <li>
									<div class="hexagon gplus">
								  		<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank" title="Share on Google+"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
								  	</div>
								  </li>
								  <li>
								  	<div class="hexagon pocket">
								  		<a href="https://getpocket.com/save?url=<?php echo get_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" title="Add to Pocket"><i class="fa fa-get-pocket" aria-hidden="true"></i></a>
								  	</div>
								  </li>
								  <li>
								  	<div class="hexagon linkedin">
								  		<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php the_title(); ?>&summary=Checkout%20this%20job%20offer!&source=<?php echo get_permalink(); ?>" target="_blank" title="Share on LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
								  	</div>
								  </li>
								  <li>
								 	<div class="hexagon mail">
								  		<a href="mailto:?subject=<?php the_title(); ?>&body=Checkout%20this%20job%20offer: <?php echo get_permalink(); ?>" target="_blank" title="Email"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
								  	</div>
								  </li>
								</ul>
								<div class="hexagon"></div>
							</div>
						</div> -->
						<?php get_template_part('templates/apply', 'form'); ?>
					</article>
				<?php endwhile;
			endif;
		?>
	</div>
	<div class="gradient col-l-1-of-4 col-m-1-of-3"></div>
</div>
<?php get_footer('jobs'); ?>