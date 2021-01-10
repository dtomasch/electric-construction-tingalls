    <!-- Main Content -->
    <main id="site-content" role="main" class="container width-wide">
      <?php the_breadcrumb() ?>

      <section>
        <div class="row flex-around">

          <div class="col-4">
            <?php
            $image = get_field('staff_photo');
            $size = 'staff'; // (thumbnail, medium, large, full or custom size)
            if ($image) {
                // echo wp_get_attachment_image($image, $size, array( "class" => "img-responsive" ));
                echo wp_get_attachment_image($image, $size, '', array( 'class' => 'mb-1' ));
            }

            ?>
          </div>

          <div class="col-7">
            <h1 class="blue mb-0">
              <?php the_field('staff_name_salutation'); ?>
              <?php the_field('staff_name_first'); ?>
              <?php the_field('staff_name_last'); ?>
            </h1>
            <h4>
              <?php the_field('staff_title'); ?>
            </h4>
            <p>
              <?php the_field('staff_bio'); ?>
            </p>
          </div>

        </div>
      </section>



    </main>
