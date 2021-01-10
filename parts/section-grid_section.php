  <div class="row grid">
    <div class="col-12 flex-center flex-wrap pb-4">

      <!-- <?php the_sub_field( 'grid_text_or_image' ); ?> -->
			<?php $grid_image_ids = get_sub_field( 'grid_image' ); ?>
			<?php $size = 'thumbnail'; ?>
			<?php if ( $grid_image_ids ) :  ?>
				<?php foreach ( $grid_image_ids as $grid_image_id ): ?>
					<?php echo wp_get_attachment_image( $grid_image_id, $size ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php the_sub_field( 'grid_text' ); ?>


    </div>
  </div>
