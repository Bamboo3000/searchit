<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">

	<?php $options1 = array('length' => 4, 'limit' => 30); ?>
    <?php while($mb->have_fields_and_multi('follow', $options1)): ?>
    <?php $mb->the_group_open(); ?>
    	<p>
       	<label>Social media link</label>
		<?php $mb->the_field('follow_link'); ?>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
		</p>
		<?php $mb->the_field('follow_img'); ?>
        <p>Social logo image</p>
        <?php $wpalchemy_media_access->setGroupName('img-f'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 		<div class="about-img">
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
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-follow button">Add</a></p>

</div>