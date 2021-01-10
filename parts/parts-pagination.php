<?php if ($wp_query->max_num_pages > 1) : ?>

	<section class="pagination">
	    <?php the_posts_pagination(array(
	        // 'mid_size' => 2,
	        'prev_text' => '<<',
	        'next_text' => '>>',
	        'mid_size' => 4
	    )); ?>

	</section>

<?php endif; ?>
