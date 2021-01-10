
<!-- Staff Photo -->
<div class="col-lg-3 col-md-4 col-sm-6 pb-2">
	<a href="<?php the_permalink() ?>">
		<?php
        $image = get_field('staff_photo');
        $size = 'staff'; // (thumbnail, medium, large, full or custom size)
        if ($image) {
            // echo wp_get_attachment_image($image, $size, array( "class" => "img-responsive" ));
            echo wp_get_attachment_image($image, $size, '', array( 'class' => 'mb-1' ));
        }

        ?>
	</a>


	<h6 class="blue mb-0">
		<a href="<?php the_permalink() ?>">
			<?php the_field('staff_name_salutation'); ?>
			<?php the_field('staff_name_first'); ?>
			<?php the_field('staff_name_last'); ?>
		</a>
	</h6>

	<p class="use-plain-links">
		<a href="<?php the_permalink() ?>">
			<?php the_field('staff_title'); ?>
		</a>
	</p>


	<!-- <?php the_field('staff_bio'); ?> -->

</div>
