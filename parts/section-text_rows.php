<div class="row text-row">

  <?php if (have_rows('text_rows_text')) :  while (have_rows('text_rows_text')) : the_row(); ?>

    <div class="col-12 hr-bottom ">
      <h5><?php the_sub_field( 'text_rows_header' ); ?></h5>
      <?php the_sub_field( 'text_rows_text' ); ?>
    </div>

  <?php endwhile; else : endif; ?>

</div>
