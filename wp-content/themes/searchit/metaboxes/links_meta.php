<div class="my_meta_control">

<?php 
	
	$mb->the_field('sub-title-links'); ?>
	<label>Sub-title</label>
	<textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea>

	<label>Links 1st row</label>
	<?php 
		$mb->the_field('links-1');
		$mb_content1 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
		$mb_editor_id1 = sanitize_key($mb->get_the_name());
		$mb_settings1 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '20', 'wpautop' => true,);
		wp_editor( $mb_content1, $mb_editor_id1, $mb_settings1 );
	?> 
	<label>Links 2nd row</label>
	<?php 
		$mb->the_field('links-2');
		$mb_content2 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
		$mb_editor_id2 = sanitize_key($mb->get_the_name());
		$mb_settings2 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '20', 'wpautop' => true,);
		wp_editor( $mb_content2, $mb_editor_id2, $mb_settings2 );
	?> 
	<label>Links 3rd row</label>
	<?php 
		$mb->the_field('links-3');
		$mb_content3 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
		$mb_editor_id3 = sanitize_key($mb->get_the_name());
		$mb_settings3 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '20', 'wpautop' => true,);
		wp_editor( $mb_content3, $mb_editor_id3, $mb_settings3 );
	?> 

</div>