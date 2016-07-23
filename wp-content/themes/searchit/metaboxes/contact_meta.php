<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">

<?php 
	$mb->the_field('title'); ?>
	<label>Title</label>
	<textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea><?php
	
	$mb->the_field('sub-title'); ?>
	<label>Sub-title</label>
	<textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea><?php 

	$mb->the_field('text'); ?>
	<label>Text</label>
	<textarea name="<?php $metabox->the_name(); ?>" rows="6"><?php $mb->the_value(); ?></textarea>

	<label>Address US</label>
	<?php 
		$mb->the_field('address-US');
		$mb_content1 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
		$mb_editor_id1 = sanitize_key($mb->get_the_name());
		$mb_settings1 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '10', 'wpautop' => true, 'quicktags' => false,);
		wp_editor( $mb_content1, $mb_editor_id1, $mb_settings1 );
	?> 

	<label>Address PL</label>
	<?php 
		$mb->the_field('address-PL');
		$mb_content2 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
		$mb_editor_id2 = sanitize_key($mb->get_the_name());
		$mb_settings2 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '10', 'wpautop' => true,);
		wp_editor( $mb_content2, $mb_editor_id2, $mb_settings2 );
	?>   
<?php
	$mb->the_field('title2'); ?>
	<label>Title 2</label>
	<textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea><?php
	
	$mb->the_field('sub-title2'); ?>
	<label>Sub-title 2</label>
	<textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea>

	<label>About text</label>
	<?php 
		$mb->the_field('about-text');
		$mb_content3 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
		$mb_editor_id3 = sanitize_key($mb->get_the_name());
		$mb_settings3 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '25', 'wpautop' => true,);
		wp_editor( $mb_content3, $mb_editor_id3, $mb_settings3 );
	?> 

	<?php
	$mb->the_field('title3'); ?>
	<label>Title 3</label>
	<textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea><?php
	
	$mb->the_field('sub-title3'); ?>
	<label>Sub-title 3</label>
	<textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea>

	<?php $options1 = array('length' => 2,); ?>
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
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-follow_img button">Add</a></p>

</div>