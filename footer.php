<?php
/**
 * The template for displaying the footer.
 *
 * Contains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>
<footer class="footer">

  <div class="row mt-2 p-sm-2" id="footer-inner">
    <div class="col-sm-8 col-md-8 col-lg-3 mb-sm-3 mb-md-0 p-sm-0 logo">
      <div class="row">
        <div class="col-8 pl-0">
          <a href="<?php echo get_home_url(); ?>" >
            <?php

            $image = get_field('logo_ko ', 'option');
            $logo_size = 'full'; // (thumbnail, medium, large, full or custom size)

            if ($image) {
                echo wp_get_attachment_image($image, $logo_size, false, array( 'class' => 'logo' ));
            }

            ?>
          </a>
        </div>
        <div class="col-12 pl-0 mb-0">

          <?php if (get_field('address', 'option')): ?>
            <p>
              <?php the_field('address', 'option'); ?>
            </p>
          <?php endif; ?>

          <?php if (get_field('phone_number', 'option')): ?>
            <p>
              <?php the_field('phone_number', 'option'); ?>
            </p>
          <?php endif; ?>

          <?php if (get_field('email', 'option')): ?>
            <p>
              <a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a>
            </p>
          <?php endif; ?>

          <?php
            if (have_rows('social_channels', 'option')) :
            while (have_rows('social_channels', 'option')) : the_row();
            $social_icon = get_sub_field('social_icon');
            $social_size = 'large';
            if ($social_icon) : ?>
              <a href="<?php the_sub_field('social_url'); ?>">
                <?php
                if ($image) {
                    echo wp_get_attachment_image($social_icon, $social_size, false, array( 'class' => 'social-icon' ));
                }
 ?>
              </a>
          <?php endif;
                endwhile;
                endif; ?>



        </div>
      </div>




    </div>
<?php if (function_exists('theme_nav_footer_primary')) :?>
  <div class="col-sm-12 col-md-12 col-lg-9 p-sm-0">
      <nav class="">
        <?php theme_nav_footer_primary(); ?>
      </nav>
  </div>
<?php endif; ?>

  </div>


  <div class="row p-1 smaller" id="copyright">
    <div class="col-12 m-0 p-sm-1 flex-center">
      <p class="text-center-sm">&copy; <?php echo date('Y') ?>

        <?php
        $company_name = get_field('company_name ', 'option');
        if ($company_name) {
            echo $company_name; ?>. All rights reserved.
          <!-- <?php echo theme_nav_footer_legal(); ?> -->
          <?php
        } ?>
      </p>
    </div>
  </div>

</footer>
<?php wp_footer() ?>
<!-- End Body -->
</div>
</html> <!-- end page -->
