<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
<?php $num = 1; ?>
<?php $settings = array('length' => 3); ?>
<?php while($mb->have_fields_and_multi('universal_fields', $settings)): ?>
<?php $mb->the_group_open(); ?>
	
	<h1>Section <?php echo $num; ?></h1>
	<hr>
	<h3>Left Column</h3>
	<p>Sub title</p>
	<?php 
		$mb->the_field('sub_title');
		?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
	?>
	<p>Main title</p>
	<?php 
		$mb->the_field('main_title');
		?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
	?>
	<br/>
	<br/>
	<h3>Right Column</h3>
	<p>Content</p>
	<?php 
		$mb->the_field('content');
		$cont = $mb_content . $num;
		$editid = $mb_editor_id . $num;
		$sett = $mb_settings . $num;
		$cont = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
		$editid = sanitize_key($mb->get_the_name());
		$sett = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '15', 'wpautop' => true,);
		wp_editor( $cont, $editid, $sett );
	?> 
	<br/>
	<?php /*
	<p>About first image</p>
	<?php $mb->the_field('about_img1'); ?>
	<?php $wpalchemy_media_access->setGroupName('img-a1'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
	<div class="project-slider-img">
		<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
		<p>
			<?php echo $wpalchemy_media_access->getButton(); ?>
		</p>
		<p>
			<a href="#" class="dodelete button">Remove</a>
		</p>
	</div>
	*/ ?>
	<a href="#" class="dodelete button">Remove Section</a>
	<br/><br/>
<?php $mb->the_group_close(); ?>
<?php $num++; ?>
<?php endwhile; ?>
<p>
	<a href="#" class="docopy-universal_fields button">Add another Section</a>
</p>
</div>