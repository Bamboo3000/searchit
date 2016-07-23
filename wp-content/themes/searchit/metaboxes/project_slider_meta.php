<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
 
 	<?php $options = array('length' => 10, 'limit' => 40); ?>
    <?php while($mb->have_fields_and_multi('p_slider', $options)): ?>
    <?php $mb->the_group_open(); ?>
 
        <?php $mb->the_field('slider_imgurl'); ?>
        <?php $wpalchemy_media_access->setGroupName('img-m'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 		
 		<div class="project-slider-img">
	        <p class="link">
	            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
	        </p>
	        <p>
	        	<?php echo $wpalchemy_media_access->getButton(); ?>
	        </p>
	        <p>
	        	<a href="#" class="dodelete button">Remove</a>
	        </p>
        </div>
 
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
 
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-p_slider button">Add</a></p>
 
</div>