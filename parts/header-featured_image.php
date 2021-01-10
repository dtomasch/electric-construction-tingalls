<?php   $header = get_field('page_header');
        $featured_image = $header['featured_image'];
        $featured_image_overlay = $header['featured_header_overlay'];
        $size = 'full'; // (thumbnail, medium, large, full or custom size)

        if ($featured_image) {
            $featured_image_url = wp_get_attachment_url($featured_image, $size);
        }

        ?>

  <header class="featured-header featured-image" style="background-image: url(<?php echo  $featured_image_url ?>)">

    <div class="overlay" style="background-color:<?php echo $featured_image_overlay ?>;"></div>

    <div class="featured-header-text">
      <?php echo $header['featured_header_text']; ?>
    </div>

  </header>

<?php the_breadcrumb() ?>
