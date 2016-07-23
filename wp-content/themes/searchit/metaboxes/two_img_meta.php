<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
 
 	<?php $options = array('length' => 2, 'limit' => 2); ?>
    <?php while($mb->have_fields_and_multi('docs', $options)): ?>
    <?php $mb->the_group_open(); ?>
 
        <?php $mb->the_field('imgurl'); ?>
        <?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 
        <p class="two-img">
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
            <?php echo $wpalchemy_media_access->getButton(); ?>
            <a href="#" class="dodelete button">Remove</a>
        </p>
 
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
 
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-docs button">Add</a></p>
 
</div>