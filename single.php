<?php


get_header();
?>


<?php if (have_posts() ) : ?>
<?php while (have_posts() ) : the_post(); ?>

  <!-- Main Content -->
<main id="site-content" role="main" class="container width-slim">

<section class="width-100 post-header">
  <div class="row">
    <div class="col-12">
      <?php the_post_thumbnail('full'); ?>
    </div>
  </div>
</section>

<?php the_breadcrumb() ?>

<section class="width-slim">
  <div class="row">
    <div class="col-12">

      <h5><?php echo get_the_date(); ?></h5>
      <h2><?php the_title() ?></h2>
      <?php the_content() ?>

    </div>
  </div>
</section>

</main>


<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else:  ?>


  <?php get_template_part('parts/', 'error.php'); ?>




<?php endif; ?>


<?php get_footer(); ?>
