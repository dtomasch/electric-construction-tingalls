<?php

if( get_sub_field('choose_content_type') == 'choose_by_type' ) :
  $post_type  = get_sub_field('select_post_type');
  $entry_type = $post_type;
endif;

// If they select a category, process that data
if( get_sub_field('choose_content_type') == 'choose_by_cat' ) :
  $category_type = get_sub_field('select_category_type');
  $category_tax  = $category_type->taxonomy;
  $category_name = $category_type->name;
  $category_slug = $category_type->slug;
  // $entry_type    = $category_slug;
  $post_type  = get_sub_field('select_post_type');
  if($post_type) {
     $entry_type = $post_type;
  };
endif;

if( get_sub_field('choose_content_type') == 'choose_individual' ) :
  $individual_posts = get_sub_field('choose_specific_posts');
var_dump($individual_posts);
endif;


if( get_sub_field('number_of_posts_to_show') ):
  $number_posts  = get_sub_field('number_of_posts_to_show');
endif;

if( get_sub_field('add_a_sticky_post') ):
  $sticky_post_array  = get_sub_field('choose_sticky_post');
  $sticky_post_ID = $sticky_post_array -> ID;
  // $sticky_post_ID = get_post( $sticky_post_array -> ID  );
  $sticky_post_title = $sticky_post_array->post_title;
// var_dump($sticky_post_ID);
endif;


// Base query with fancy sort order.
// See https://wordpress.stackexchange.com/questions/126772/query-to-sort-a-list-by-meta-key-first-if-it-exists-and-show-remaining-posts
$meta_key = 'staff_sort_order';
$args = array(
  'posts_per_page'   => $number_posts,
  'post_status' => 'publish',

  'meta_query'  => array(
      'relation' => 'OR',
      array(
          'key'     => $meta_key,
          'compare' => 'NOT EXISTS',
      ),
      array(
          'relation' => 'OR',
          array(
              'key'   => $meta_key,
              'value' => 'on',
          ),
          array(
              'key'     => $meta_key,
              'value'   => 'on',
              'compare' => '!=',
          ),
      ),
  ),
'orderby'     => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
);

if( get_sub_field('add_a_sticky_post') ):
  $args['post__not_in'] = array($sticky_post_ID);
endif;

if ($individual_posts) {
  $args['post__in'] = $individual_posts;
} elseif ($category_type) {

// This should be generalized. Right now, it pulls from the various IFIC Categories
// 20201214 -- This broke other places, so I probably have to add a choose post type box to this as well
  $args['post_type'] = $post_type;

// Category Query
  $args['tax_query'] = array(
    array(
      'taxonomy' => $category_tax,
      'field'    => 'slug',
      'terms'    => $category_slug,
    )
  );
} elseif ($post_type) {
// TODO:
// This has to come after category as category has both variables set; could be revised
// Post Type Query if specific post type chosen
$args['post_type'] = $post_type;
};
if(is_page( 'test' )){
print_r($args);
};

?>



<?php $the_query = new WP_Query($args);
if ($the_query->have_posts()) :?>


<div class="row">

<?php if( get_sub_field('add_a_sticky_post') ):

  static $count = 1;
  global $post;

  // Pass the received post data to the $post variable and not to any other.
  $post = $sticky_post_array;

  setup_postdata( $post );
  get_template_part('parts/part', 'sticky_post');
  wp_reset_postdata();
else :
  $count = 0;
endif;?>


  <?php while ($the_query->have_posts()) : $the_query->the_post();


  // It will be useful to have a query count for different purposes
  set_query_var('count_var', $count);

  $post_type = get_post_type();
  if ( '' != locate_template( 'parts/loop-' . $category_slug . '.php' ) ) {
       get_template_part('parts/loop', $category_slug);
  } elseif ( '' != locate_template( 'parts/loop-' . $post_type . '.php' ) ) {
      get_template_part('parts/loop', $post_type);
  } else {
// echo "none";
// echo $post_type;
// echo $category_slug;
}
  $count++;
endwhile; ?>
</div>


<?php if (get_sub_field('add_show_all_link') == 1) : ?>
  <div class="row pb-3">
    <div class="col-12  flex-end">
      <a href="<?php echo get_post_type_archive_link($post_type); ?>" class="button grey">View All</a>
    </div>
  </div>
<?php else : ?>
<?php endif; ?>



<?php


wp_reset_postdata();
else:  ?>





<?php endif; ?>
