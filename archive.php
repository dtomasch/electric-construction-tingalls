<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>



<main id="site-content" role="main" class="container width-slim">

<?php the_breadcrumb() ?>

<section>

      <div class="row">
        <div class="col-12 m-0">
          <h1><?php echo post_type_archive_title(); ?></h1>
        </div>
      </div>

</section>

<?php
  $post_type = get_post_type();
  if ('' != locate_template('parts/archive-' . $post_type . '.php')) {
      get_template_part('parts/archive', $post_type);
  } else {
      get_template_part('parts/loop-archive');
  }
?>

<?php get_template_part('parts/parts', 'pagination'); ?>


</main>

<?php get_footer(); ?>
