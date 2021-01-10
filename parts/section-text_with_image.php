<?php
if (have_rows('text_image_row')) :
while (have_rows('text_image_row')) : the_row(); ?>

<div class="row text-image-row">

  <div class="col-md-6 col-lg-8">
    <h5><?php the_sub_field('section_title'); ?></h5>
    <?php the_sub_field('text'); ?>
  </div>

  <div class="col-md-6 col-lg-4">
    <?php $image = get_sub_field('image'); ?>
    <?php $size = 'medium'; ?>
    <?php if ($image) : ?>
      <?php echo wp_get_attachment_image($image, $size); ?>
    <?php endif; ?>
  </div>

</div>


<?php endwhile; else : endif; ?>
