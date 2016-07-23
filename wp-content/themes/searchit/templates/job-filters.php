<div class="col-xs-1-of-1 filter-opener">
	<i class="fa fa-filter" aria-hidden="true"></i>
	<span>
		<?php echo __('Show job filters', 'searchit'); ?>
	</span>
</div>
<div class="col-l-1-of-4 col-m-1-of-3 col-xs-1-of-1 job-filters">
	<aside>
		<div class="job-filters-search1">
			<?php get_template_part('templates/ajax', 'search'); ?>
		</div>
		<?php 
			$args = array(
				'hide_empty' => 0
			);
		?>
		<div class="job-filters-search2">
			<h5><?php echo __('Job categories', 'searchit') ?></h5>
			<hr class="green">
			<ul class="job-categories">
				<?php
					foreach((get_categories($args)) as $category) {
					    if ($category->cat_name != 'Uncategorised' && $category->cat_name != 'Fulfilled' && $category->cat_name != 'All' && $category->cat_name != 'Vervulde vacatures') {
						    echo '<li>';
						    echo '<a href="' . $category->slug . '" title="' . sprintf( __( "View all jobs in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
						    echo '</li>';
						}
						if ($category->cat_name == 'All') {
							echo '<li>';
						    echo '<a href="' . $category->slug . '" title="' . sprintf( __( "View all jobs in %s" ), $category->name ) . '" ' . '>' . $category->name.' Jobs</a> ';
						    echo '</li>';
						}
					}
				?>
			</ul>
		</div>
		<div class="job-filters-search3">
			<h5><?php echo __('Job type', 'searchit') ?></h5>
			<hr class="green">
			<ul class="job-types">
				<li>
					<a href="Fulltime employee"><?php echo __('Fulltime', 'searchit'); ?></a>
				</li>
				<li>
					<a href="Parttime employee"><?php echo __('Parttime', 'searchit'); ?></a>
				</li>
				<li>
					<a href="Contract employee"><?php echo __('Contract', 'searchit'); ?></a>
				</li>
				<li>
					<a href="Internship"><?php echo __('Internship', 'searchit'); ?></a>
				</li>
			</ul>
		</div>
		<div class="job-filters-search4">
			<h5><?php echo __('Salary', 'searchit') ?></h5>
			<hr class="green">
			<?php get_template_part('templates/ajax', 'search-two'); ?>
		</div>
	</aside>
</div>