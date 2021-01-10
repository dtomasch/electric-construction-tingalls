<?php
/**
 * The template for displaying search form
 */
 ?>

<div class="row flex-center">
  <div class="col-lg-6 col-sm-12 mt-2">
    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">

      <div>
        <label class="screen-reader-text" for="s"><?php _x('Search for:', 'label'); ?></label>
        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"/>
        <input type="submit" class="button solid blue" id="searchsubmit" value="<?php echo esc_attr_x('Search', 'submit button'); ?>"/>
      </div>

    </form>
  </div>
</div>
