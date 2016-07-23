<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
 
 
        <?php $mb->the_field('slider_imgurl_mp4'); ?>
        <?php $wpalchemy_media_access->setGroupName('img-mp4'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 		
 		<div class="project-slider-img">
 			<p>Video in webm format</p><br/>
	        <p class="link">
	            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
	        </p>
	        <p>
	        	<?php echo $wpalchemy_media_access->getButton(); ?>
	        </p>
        </div>

        <?php $mb->the_field('slider_imgurl_webm'); ?>
        <?php $wpalchemy_media_access->setGroupName('img-webm'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 		
 		<div class="project-slider-img">
 			<p>Video in mp4 format</p><br/>
	        <p class="link">
	            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
	        </p>
	        <p>
	        	<?php echo $wpalchemy_media_access->getButton(); ?>
	        </p>
        </div>

        <?php $mb->the_field('slider_imgurl_ogg'); ?>
        <?php $wpalchemy_media_access->setGroupName('img-ogg'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 		
 		<div class="project-slider-img">
 			<p>Video in ogg format</p><br/>
	        <p class="link">
	            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
	        </p>
	        <p>
	        	<?php echo $wpalchemy_media_access->getButton(); ?>
	        </p>
        </div>

 
</div>