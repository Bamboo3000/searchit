<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">

<h3>Title section</h3>
<hr>
<p>Sub title</p>
<?php 
	$mb->the_field('sub_title_cv');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
 ?>
<p>Main title</p>
<?php 
	$mb->the_field('main_title_cv');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;">
<br/><br/>

</div>