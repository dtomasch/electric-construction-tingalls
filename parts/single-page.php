<?php
// Set width per template choice
// template-wide.php and template-full.php are just placecholders so we can call it on the front end and output it's variable here -->
unset($container_class);
if (is_page_template('templates/template-full.php')) {
    $container_class = 'width-full';
} elseif (is_page_template('templates/template-wide.php')) {
    $container_class = 'width-wide';
} elseif (is_page_template('templates/template-slim.php')) {
    $container_class = 'width-wide';
} else {
    $container_class = 'width-medium';
};?>


<!-- Main Content -->
<main id="site-content" role="main" class="container <?php echo $container_class ?>">


  <?php
      // Here we pull in the header type (title only, featured image, etc)
      $header = get_field('page_header');
      $header_type = $header['which_header_type'];
      get_template_part('parts/header', $header_type);
  ?>


    <?php
    // Start Loop for Flexible Content
    if (have_rows('section')): while (have_rows('section')) : the_row();
    $sectiontype = get_row_layout();
    ?>

    <section  <?php section_settings(); ?>>



<?php
// TODO: this can get clened up and added to functions
      $section_header = get_sub_field('section_header');
      $section_header_options_checked_values = $section_header['section_header_options'];
      if ($section_header_options_checked_values):
      $section_header_text = $section_header['section_header_text'];
      $section_header_color = $section_header['section_header_color'];
      $section_header_size = $section_header['section_header_size'];
      $section_header_alignment = $section_header['section_header_alignment'];
      $section_header_intro = $section_header['section_header_intro']; ?>

<div class="row">
  <div class="col-12">

  <?php
  // TODO: Change this to a return instead of echo
  if ($section_header_options_checked_values && in_array('use_section_header', $section_header_options_checked_values)) :
      echo '<';
      echo $section_header_size;
        if ($section_header_color):
          echo ' style="color:' . $section_header_color . '"';
        endif;
        if ($section_header_alignment):
          echo ' class="' . $section_header_alignment . '"';
        endif;
      echo '>';
      echo $section_header_text;
      echo '</';
      echo $section_header_size;
      echo '>';
  endif;

  if ($section_header_options_checked_values && in_array('use_section_intro', $section_header_options_checked_values)) :
    echo '<p>';
    echo $section_header_intro;
    echo '</p>';
  endif; ?>

  </div>
</div>

<?php endif; ?>



  <?php

  // Pull in the appropriate section type
  if ($sectiontype == 'advanced_sections') :
    $module = get_sub_field('template_part');
    get_template_part('parts/section', $module);

    else :
      get_template_part('parts/section', $sectiontype);

    endif;?>

  </section>
<?php endwhile; endif; ?>








</main>
