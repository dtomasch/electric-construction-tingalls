<section>
  <div class="row">
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>

    <?php $newValue = get_query_var('my_var_name'); ?>


      <div class="col-lg-4 col-md-4 col-sm-3 mb-2">
        <a href="<?php the_field('redirect_link'); ?>" class="header-image-link">
          <?php
          if (has_post_thumbnail()) {
              the_post_thumbnail('medium_cropped', array( 'alt' => esc_html(get_the_title()) ));
          }
          ?>
        </a>

        <h6><?php echo get_the_date(); ?></h6>

        <p class="use-plain-links">
          <a href="<?php the_field('redirect_link'); ?>">
            <?php the_title(); ?>
          </a>
        </p>
      </div>



  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
  <?php else:  ?>


    <?php get_template_part('parts/', 'error.php'); ?>




  <?php endif; ?>
  </div>
</section>
