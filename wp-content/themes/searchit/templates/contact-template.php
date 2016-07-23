<?php 
/*
Template Name: Contact
*/
 ?>
<?php get_header(); ?>
<div class="universal-container">
	<?php $universal_cont = get_post_meta(get_the_ID(),'_my_universal_fields',TRUE); ?>
	<?php foreach($universal_cont as $uni_cont) : ?>
		<?php 
			$maintitleU = $uni_cont['main_title'];
			$subtitleU = $uni_cont['sub_title'];
			$contentU = $uni_cont['content'];
		 ?>
		<section class="universal-section">	
			<div class="row bg-lgrey">
				<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1 universal-left-column">
					<aside>
						<hr>
						<span>
							<?php echo $maintitleU; ?>
						</span>
						<h2>
							<?php echo $subtitleU; ?>
						</h2>
					</aside>
				</div>
				<div class="col-l-3-of-4 col-m-2-of-3 col-xs-1-of-1 bg-white">
					<div class="row">
						<div class="col-m-1-of-2 col-xs-1-of-1 universal-right-column">
							<article>
								<?php echo apply_filters('the_content', $contentU, TRUE ); ?>
							</article>
						</div>
						<div class="col-m-1-of-2 col-xs-1-of-1">
							<div id="map"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endforeach; ?>
</div>
<?php get_footer(); ?>
<script>
  	function initMap() {
        var map = document.getElementById('map');
        var map = new google.maps.Map(map, {
			center: {lat: 52.3214278, lng: 4.876879},
			zoom: 12,
			scrollwheel: false,
			draggable: false,
        });
        var marker = new google.maps.Marker({
          	map: map,
          	position: new google.maps.LatLng(52.3214278, 4.876879)
        });
        map.set('styles', [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a0d6d1"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#dedede"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#dedede"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f1f1f1"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]);
        // map.set('styles', [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]);
  	}
//     	var panorama;
	// function initialize() {
	//     panorama = new google.maps.StreetViewPanorama(
	// 	document.getElementById('job_map'),
	// 	{
	// 	position: {lat: <?php/// echo get_post_meta(get_the_ID(), 'job_lat', true); ?>, lng: <?php/// echo get_post_meta(get_the_ID(), 'job_lng', true); ?>},
	// 	pov: {heading: 180, pitch: 0},
	// 	zoom: 1
	// 	});
	// }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>