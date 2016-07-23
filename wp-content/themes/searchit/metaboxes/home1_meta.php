<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">

<?php 
	$mb->the_field('main_claim');
	$mb_content1 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
	$mb_editor_id1 = sanitize_key($mb->get_the_name());
	$mb_settings1 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '10', 'wpautop' => true,);
	wp_editor( $mb_content1, $mb_editor_id1, $mb_settings1 );
?>  
<br/><br/>
<h3>Categories section</h3>
<hr>
<p>Sub title</p>
<?php 
	$mb->the_field('sub_title_categories');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
<p>Main title</p>
<?php 
	$mb->the_field('main_title_categories');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
<br/><br/>


<h3>About section</h3>
<hr>
<p>Sub title</p>
<?php 
	$mb->the_field('sub_title_about');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
<p>Main title</p>
<?php 
	$mb->the_field('main_title_about');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
 <br/>
<p>About text</p>
<?php 
	$mb->the_field('about_text');
	$mb_content2 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
	$mb_editor_id2 = sanitize_key($mb->get_the_name());
	$mb_settings2 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '10', 'wpautop' => true,);
	wp_editor( $mb_content2, $mb_editor_id2, $mb_settings2 );
?> 
<br/>
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
<p>About second image</p>
<?php $mb->the_field('about_img2'); ?>
<?php $wpalchemy_media_access->setGroupName('img-a2'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
<div class="project-slider-img">
	<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
	<p>
		<?php echo $wpalchemy_media_access->getButton(); ?>
	</p>
	<p>
		<a href="#" class="dodelete button">Remove</a>
	</p>
</div>
<br/>
<p>Stats title</p>
<?php 
	$mb->the_field('stats_title');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
 <br/>
<p>Stat 1</p>
<?php 
	$mb->the_field('stat1');
	?><input type="number" min="0" max="100" name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>"><?php
 ?>
 <span>description</span>
 <?php 
	$mb->the_field('stat1_desc');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
 <p>Stat 2</p>
<?php 
	$mb->the_field('stat2');
	?><input type="number" min="0" max="100" name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>"><?php
 ?>
 <span>description</span>
 <?php 
	$mb->the_field('stat2_desc');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
 <p>Stat 3</p>
<?php 
	$mb->the_field('stat3');
	?><input type="number" min="0" max="100" name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>"><?php
 ?>
 <span>description</span>
 <?php 
	$mb->the_field('stat3_desc');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
 <p>Stat 4</p>
<?php 
	$mb->the_field('stat4');
	?><input type="number" min="0" max="100" name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>"><?php
 ?>
 <span>description</span>
 <?php 
	$mb->the_field('stat4_desc');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
<br/><br/>


<h3>Testimonials section</h3>
<hr>
<p>Sub title</p>
<?php 
	$mb->the_field('sub_title_testimonials');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
<p>Main title</p>
<?php 
	$mb->the_field('main_title_testimonials');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>

</div>