<?php

if( get_field('sidebar') == 'none' ) {
  $page_width = "width-slim";
  $main_column = "col-12";
} else {
  $page_width = "width-wide";
  $main_column_width = "col-8 pr-2";
  $sidebar_width = "col-4 pl-2";
  $sidebar_type = get_field('sidebar');
}?>


<!-- Main Content -->
<main id="site-content" role="main" class="container width-slim">

<section class="width-100 post-header mt-2">
<div class="row">
  <div class="col-12">
    <?php the_post_thumbnail('full'); ?>
  </div>
</div>
</section>


<section class="<?php echo $page_width; ?>">
<div class="row">
  <div class="<?php echo $main_column_width; ?>">
    <h5><?php echo get_the_date(); ?></h5>
    <h2><?php the_title() ?></h2>
    <?php the_content() ?>
  </div>
<?php if( get_field('sidebar') !== 'none' ) { ?>
<aside class="<?php echo $sidebar_width; ?> sidebar-container" id="sidebar-<?php echo $sidebar_type ?>">
  <?php  get_template_part( 'sidebars/sidebar', $sidebar_type) ?>
</aside>
<?php } ?>


</div>
</section>
</main>
