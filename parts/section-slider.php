<?php
if (have_rows('slides')) : ?>

<div class="row <?php echo $slider_class; ?>" id="<?php echo $slider_id; ?>">
  <div class="col-12 p-0 <?php the_sub_field('slider_class'); ?>" id="<?php the_sub_field('slider_id'); ?>">
    <div class="slider solid-color larger" >

      <?php
      while (have_rows('slides')) : the_row();?>
      <div class="slide" style="background-color:<?php the_sub_field('slider_color'); ?>">
        <div class="slide-inner">
          <?php the_sub_field('slider_text'); ?>
        </div>
      </div>


    <?php endwhile;  ?>

  </div>

</div>
</div>

<?php endif; ?>
