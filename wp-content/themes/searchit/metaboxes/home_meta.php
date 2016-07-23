<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
 
 	<?php $options = array('length' => 3, 'limit' => 9); ?>
    <?php while($mb->have_fields_and_multi('home', $options)): ?>
    <?php $mb->the_group_open(); ?>

    	<?php $mb->the_field('home_img'); ?>
        <p>Box image</p>
        <?php $wpalchemy_media_access->setGroupName('img-m'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 		<div class="about-img">
	        <p class="link">
	            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
	        </p>
	        <p>
	        	<?php echo $wpalchemy_media_access->getButton(); ?>
	        </p>  
	        <!-- <p>
		    	<a href="#" class="dodelete button">Remove</a>
		    </p> -->
        </div>
 
		<div class="text">
			<?php $metabox->the_field('title'); ?>
			<p>Box title</p>
			<textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $metabox->the_value(); ?></textarea>
		</div>

		<div class="text">
			<p>Box text</p>
			<?php $metabox->the_field('text'); ?>
			<textarea name="<?php $metabox->the_name(); ?>" rows="6"><?php $metabox->the_value(); ?></textarea>
		</div>

        
 
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
 	
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-home button">Add</a></p>
 
</div>