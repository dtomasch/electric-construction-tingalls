<?php

///--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// Image Options
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------


// Add WP Thumbnail Support
add_theme_support('post-thumbnails');

//
//
update_option( 'medium_size_w', 500 );
update_option( 'medium_size_h', 300 );
update_option( 'medium_crop', 1 );
//
//
// update_option( 'medium_large_size_w', 750 );
// update_option( 'medium_large_crop', 1 );
//
//
// update_option( 'large_large_size_w', 1250 );
// update_option( 'large_large_size_h', 650 );
// update_option( 'large_large_crop', 1 );


add_image_size( 'small_staff', 175, 219, array( 'center', 'center' ) );
add_image_size( 'staff', 300, 375, array( 'center', 'center' ) );
add_image_size( 'large_staff', 600, 750, array( 'center', 'center' ) );
add_image_size( 'small_cropped', 250, 150, array( 'center', 'center' ) );
add_image_size( 'medium_cropped', 500, 300, array( 'center', 'center' ) );
add_image_size( 'large_cropped', 750, 450, array( 'center', 'center' ) );
add_image_size( 'x_large_cropped', 1000, 600, array( 'center', 'center' ) );


function remove_extra_image_sizes() {
  foreach ( get_intermediate_image_sizes() as $size ) {
    if ( !in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large', 'staff', 'small_staff', 'large_staff', 'small_cropped', 'medium_cropped', 'large_cropped', 'x_large_cropped' ) ) ) {
      remove_image_size( $size );
    }
  }
}

add_action('init', 'remove_extra_image_sizes');



// Add HTML5 Support
add_theme_support('html5',
array(
  'comment-list',
  'comment-form',
  'search-form',
)
);


//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// Add a Custom Login Logo
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------
function my_login_logo()
{
  $logo = get_field('logo', 				'option');
  $url = wp_get_attachment_url($logo); ?>
  <style type="text/css">
    #login {
      padding: 5% 0 0;
    }
    #login h1 a, .login h1 a {
      background-image: url('<?php echo $url ?>'); ?>;
      height:175px;
      width:320px;
      background-size: contain;
      background-repeat: no-repeat;
      padding-bottom: 0px;
    }
  </style>
  <?php
}
add_action('login_enqueue_scripts', 'my_login_logo');



//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// displays "Page x of x". Just call php current_paged();
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------


function current_paged($var = '')
{
  if (empty($var)) {
    global $wp_query;
    if (!isset($wp_query->max_num_pages)) {
      return;
    }
    $pages = $wp_query->max_num_pages;
  } else {
    global $$var;
    if (!is_a($$var, 'WP_Query')) {
      return;
    }
    if (!isset($$var->max_num_pages) || !isset($$var)) {
      return;
    }
    $pages = absint($$var->max_num_pages);
  }
  if ($pages < 1) {
    return;
  }
  $page = get_query_var('paged') ? get_query_var('paged') : 1;
  echo 'Page ' . $page . ' of ' . $pages;
}


//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// Title Tag
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------

function bk_setup()
{
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'bk_setup');

if (! function_exists('_wp_render_title_tag')) {
  function theme_slug_render_title()
  {
    ?>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php
  }
  add_action('wp_head', 'theme_slug_render_title');
}


//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// Breadcrumbs Function
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------

function the_breadcrumb()
{
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb

  global $post;
  $homeLink = get_bloginfo('url');

  if (is_home() || is_front_page()) {
    if ($showOnHome == 1) {
      echo '<a href="' . $homeLink . '">' . $home . '</a>';
    }
  } else {
    echo "<section class='breadcrumbs'>";
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    if (is_category()) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
      }
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
    } elseif (is_search()) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
    } elseif (is_day()) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
      echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
      if (get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->name . '</a>';
        if ($showCurrent == 1) {
          echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        }
      } else {
        $cat = get_the_category();
        $cat = $cat[0];
        $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) {
          $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        }
        echo $cats;
        if ($showCurrent == 1) {
          echo $before . get_the_title() . $after;
        }
      }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID);
      $cat = $cat[0];
      echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) {
        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      }
    } elseif (is_page() && !$post->post_parent) {
      if ($showCurrent == 1) {
        echo $before . get_the_title() . $after;
      }
    } elseif (is_page() && $post->post_parent) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) {
          echo ' ' . $delimiter . ' ';
        }
      }
      if ($showCurrent == 1) {
        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      }
    } elseif (is_tag()) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
    } elseif (is_404()) {
      echo $before . 'Error 404' . $after;
    }
    if (get_query_var('paged')) {
      echo ' (';
      current_paged();
      echo ')';
    }
    echo '</section>';
  }

}





// —————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————
//
//
// *** Add Classes to Body  ***
//
//
// —————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————

function add_body_class($classes)
{

  global $post;
  $post_id = $post->ID;
  $header = get_field('page_header', $post_id);
  $header_type = $header['which_header_type'];
  // $header_type = the_sub_field( 'which_header_type',  $post_id);
  // echo $header_type . ' ';

// if (($header_type == 'featured_image' || $header_type == 'featured_video' || has_post_thumbnail( $post_id )) && isset($post->ID)) {
  if (($header_type == 'featured_image' || $header_type == 'featured_video' ) && isset($post->ID)) {
    $classes[] = 'has-featured-image';
  } else {
    $classes[] = 'without-featured-image';
  }


if(is_page()&&($post->post_parent==92||is_page(92))||(is_archive())||(is_search())) {
    $classes[] = 'paged';
  }
  return $classes;

}
add_filter('body_class', 'add_body_class');




//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// *** ACF ***
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------



//--------------------------------------------------------------
// ACF Options Page
//--------------------------------------------------------------
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Theme General Settings',
    'menu_title' => 'Site Settings',
    'menu_slug' => 'theme-general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));

  acf_add_options_sub_page(array(
  	'page_title' 	=> 'Theme Header Settings',
  	'menu_title'	=> 'Header Settings',
  	'parent_slug'	=> 'theme-general-settings',
  ));

  // acf_add_options_sub_page(array(
  // 	'page_title' 	=> 'Theme Footer Settings',
  // 	'menu_title'	=> 'Footer Settings',
  // 	'parent_slug'	=> 'theme-general-settings',
  // ));
};


//--------------------------------------------------------------
// Creates a ACF field auto-populated with custom post types
//--------------------------------------------------------------
add_filter('acf/load_field/name=select_post_type', 'yourprefix_acf_load_post_types');
/*
*  Load Select Field `select_post_type` populated with the value and labels of the singular
*  name of all public post types
*/
function yourprefix_acf_load_post_types( $field ) {

  $choices = get_post_types( array( 'show_in_nav_menus' => true ), 'objects' );

  foreach ( $choices as $post_type ) :
    $field['choices'][$post_type->name] = $post_type->labels->name;
  endforeach;
  return $field;
}


//--------------------------------------------------------------
// Uses First and Last Name for Staff Titles
//--------------------------------------------------------------

function my_post_title_updater( $post_id ) {

  $my_post = array();
  $my_post['ID'] = $post_id;

  $first_name = get_field('staff_name_first');
  $last_name  = get_field('staff_name_last');

  $full_name = $first_name . ' ' . $last_name;
  $new_slug = sanitize_title( $full_name );

  if ((get_post_type() == 'staff_members') || (get_post_type() == 'board_members')) {
    $my_post['post_title'] = $full_name;
    $my_post['post_name'] = $new_slug;

  };

  // Update the post into the database
  wp_update_post( $my_post );

};

// run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'my_post_title_updater', 20);

add_action('admin_init', 'hide_title_staff_members');

function hide_title_staff_members()
{
  remove_post_type_support('staff_members', 'title');
  remove_post_type_support('board_members', 'title');
}

//--------------------------------------------------------------
// Default ACF Colors
// // TODO: Find a way to integrate this into the theme.
//--------------------------------------------------------------
function acf_default_colors() { ?>

  <script type="text/javascript">
  (function($) {

    acf.add_filter('color_picker_args', function( args, $field ){

      // add the hexadecimal codes here for the colors you want to appear as swatches
      args.palettes = ['#2d6db5', '#138f45', '#901945', '#f68b28', '#21252b', '#fbfbfb']

      // return colors
      return args;

    });

  })(jQuery);
</script>

<?php }

add_action('acf/input/admin_footer', 'acf_default_colors');


// —————————————————————————————————————————————————————————————————————————————————
// Adds a New WYSIWYG text toolbar
// —————————————————————————————————————————————————————————————————————————————————

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{

  // Add a new toolbar called "Very Simple"
  // - this toolbar has only 1 row of buttons
  $toolbars['None' ] = array();
  $toolbars['None' ][1] = array('bold' , 'italic' , 'underline', 'alignleft', 'aligncenter', 'alignright' );


  // return $toolbars - IMPORTANT!
  return $toolbars;
}

// —————————————————————————————————————————————————————————————————————————————————
// Adds a New WYSIWYG color toolbar
// —————————————————————————————————————————————————————————————————————————————————

// TODO: This could be moved to a acf or customize of some sort
function my_mce4_options($init) {

    $custom_colours = '
        "2d6db5", "Blue",
        "138f45", "Green",
        "901945", "Red",
        "f68b28", "Orange",
        "21252b", "Black",
        "fbfbfb", "White"

    ';

    // build colour grid default+custom colors
    $init['textcolor_map'] = '['.$custom_colours.']';

    // change the number of rows in the grid if the number of colors changes
    // 8 swatches per row
    $init['textcolor_rows'] = 1;

    return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');


//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// *** Checks if it's a parent or one of it's children ***
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------

function is_tree($pid, $xpid = null) {      // $pid = The ID of the page we're looking for pages underneath
  global $post;         // load details about this page
  if(is_page()&&($post->post_parent==$pid||is_page($pid))&&(!is_page($xpid)))
  return true;   // we're at the page or at a sub page
  else
  return false;  // we're elsewhere
};



//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// *** Change number of posts on an archive page ***
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------


add_action( 'pre_get_posts', 'archive_set_posts_per_page_in_the_news' );
// Show all in_the_news on in_the_news Archive Page
function archive_set_posts_per_page_in_the_news( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'in_the_news' ) ) {
    $query->set(
    'posts_per_page', '-1'
  );
  }
}

add_action( 'pre_get_posts', 'archive_set_posts_per_page_press_releases' );
function archive_set_posts_per_page_press_releases( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'press_releases' ) ) {
    $query->set( 'posts_per_page', '21' );
  }
}



//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// *** Settings pull for page flexible content ***
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------


// TODO: this can be cleaned up
function section_settings() {



  $sectionprefix = 'section-';
  $category_type = get_sub_field('select_category_type');
  $post_type     = get_sub_field('select_post_type');



  if ($category_type) :
        $category_tax  = $category_type->taxonomy;
        $category_name = $category_type->slug;
        $section_category_type = $sectionprefix . $category_tax;
        $section_category_tax  = $sectionprefix . $category_name;
  elseif ($post_type) :
        $section_category_type = $sectionprefix . $post_type;
  else :
        $section_category_type = $sectionprefix . get_row_layout();
  endif;


      if (have_settings() ) : while (have_settings() ) : the_setting();
        if ( have_rows( 'section_options' ) ) : while ( have_rows( 'section_options' ) ) : the_row();


            // these are the section options you can set on the backend
            if (get_sub_field( 'section_class' )) {
                $class     = get_sub_field( 'section_class' );
            }
            if (get_sub_field( 'section_width' )) {
                $width     = get_sub_field( 'section_width' );
            }
            if (get_sub_field( 'section_id' )) {
                $sectionID = get_sub_field( 'section_id' );
            }


            // if we have a background color set
            if( get_sub_field('section_background_color') ):
              $bkrdcolor   = esc_html(get_sub_field( 'section_background_color' ));
              $sectionbkrd = 'background-color:' . $bkrdcolor;
              $bkrdclass   = 'has-background-color';
            endif;


            // if there are borders
            $section_border_checked_values = get_sub_field( 'section_border' );

            if ( $section_border_checked_values ) :
                $border = null;
              foreach ( $section_border_checked_values as $section_border_value ):
                $border .=  'hr-' . esc_html( $section_border_value );
              endforeach;
            endif;

      // end row settings
        endwhile; endif;
      endwhile; wp_reset_postdata(); endif;




$sectionautoclass = implode(' ', array_filter(array($section_category_type, $section_category_tax, $width, $border, $class, $bkrdclass)));



if (!empty($sectionautoclass)) {
  echo 'class="' . $sectionautoclass . '" ';
}
if (!empty($sectionID)) {
  echo 'id="' . $sectionID . '" ';
}
if (!empty($sectionbkrd)) {
  echo 'style="' . $sectionbkrd . '" ';
}

};


//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// *** Section Header ***
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------


//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// *** Customize the Excerpt ***
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------

//https://www.winwar.co.uk/2015/01/how-to-grab-the-first-sentence-of-a-wordpress-post/
function excerpt_first_sentence( $string ) {

  $sentence = preg_split( '/(\.|!|\?)\s/', $string, 2, PREG_SPLIT_DELIM_CAPTURE );

if (isset($sentence['1'])) {
      return $sentence['0'] . $sentence['1'];
   } else {
  return $sentence['0'];
};

} add_filter( 'get_the_excerpt', 'excerpt_first_sentence', 10, 1 );




function post_type_template_grabber($type){

  if (have_posts()) {
      while (have_posts()) {
          the_post();

          $post_type = get_post_type();
          if ('' != locate_template('parts/' . $type . '-' . $post_type . '.php')) {
              get_template_part('parts/' . $type . 'single', $post_type);
          } else {
              get_template_part('parts/' . $type . 'single');
          }
      }
  }

  };
