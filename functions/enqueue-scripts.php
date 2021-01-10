<?php

//--------------------------------------------------------------
//--------------------------------------------------------------
//
//
// *** Use ACF to create a ACF Style Sheet ***
// https://www.designly.net/dynamic-css-in-wordpress-with-advanced-custom-fields/
//
//
//--------------------------------------------------------------
//--------------------------------------------------------------
/**
 * Proper ob_end_flush() for all levels
 *
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
remove_action('shutdown', 'wp_ob_end_flush_all', 1);
add_action('shutdown', function() {
    while (@ob_end_flush());
});

function generate_options_css()
{
    $ss_dir = get_stylesheet_directory();
    ob_start(); // Capture all output into buffer
  require($ss_dir . '/assets/sass/acf-styles.php'); // Grab the custom-style.php file
  $css = ob_get_clean(); // Store output in a variable, then flush the buffer
  file_put_contents($ss_dir . '/assets/css/acf-styles.css', $css, LOCK_EX); // Save it as a css file
}
add_action('acf/save_post', 'generate_options_css', 20); //Parse the output and write the CSS file on post save (thanks Esmail Ebrahimi)
remove_action('shutdown', 'wp_ob_end_flush_all', 1);






//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
//
//
// enqueue Styles and Sripts
//
//
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------

function add_assets()
{

    // —————————————————————————————————————————————————————————————————————————————————
    // Clean up Jquery
    // —————————————————————————————————————————————————————————————————————————————————
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');

    // CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
    wp_enqueue_script(
    'jquery',
    'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
    array(),
    '3.5.1',
    true
  );


    // —————————————————————————————————————————————————————————————————————————————————
    // seems to work better than other methods
    // assumes css/screen.css
    // —————————————————————————————————————————————————————————————————————————————————
    $themecsspath = get_stylesheet_directory() . '/assets/css/screen.css';



    // —————————————————————————————————————————————————————————————————————————————————
    // Styles
    // —————————————————————————————————————————————————————————————————————————————————

    wp_enqueue_style(
    'main-style',
    get_stylesheet_directory_uri() . '/assets/css/screen.css',
    array(),
    filemtime($themecsspath)
  );

    wp_enqueue_style(
    'ACF Styles',
    get_stylesheet_directory_uri() . '/assets/css/acf-styles.css',
    array(),
    filemtime($themecsspath)
  );


    // —————————————————————————————————————————————————————————————————————————————————
    // Scripts
    // —————————————————————————————————————————————————————————————————————————————————
    wp_enqueue_script(
    'Menu Script',
    get_stylesheet_directory_uri() . '/assets/scripts/menu.js',
    array( 'jquery' ) // Says the jquery is required, which most likely it is
  );

    wp_enqueue_script(
    'Site Scripts',
    get_stylesheet_directory_uri() . '/assets/scripts/site.js',
    array('acf-input'),
    false,
    true
  );

    // —————————————————————————————————————————————————————————————————————————————————
    // Slick Slider
    // —————————————————————————————————————————————————————————————————————————————————
    wp_enqueue_script(
    'Slick Script CDN',
    '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
    array('jquery'),
    false,
    false);

    wp_enqueue_style(
    'Slick CSS CDN',
    '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
    array(),
    false,
    'all');

    // Local Styles overrides for slick
    wp_enqueue_style(
      'Slick',
      get_stylesheet_directory_uri() . '/assets/css/slick.css',
      array(),
      filemtime($themecsspath)
    );


    // —————————————————————————————————————————————————————————————————————————————————
    // Fancy Box
    // —————————————————————————————————————————————————————————————————————————————————

    // wp_enqueue_script('fancybox-script-CDN', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js', array('jquery'), false, false);

    // wp_enqueue_style('fancybox-style-CDN', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css', array(), false, all);


    // —————————————————————————————————————————————————————————————————————————————————
    // Select 2
    // —————————————————————————————————————————————————————————————————————————————————

    // wp_enqueue_style('select2-style', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', array(), false, all);

    // wp_enqueue_script('select2-Script', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array('jquery'), false, false);
};
  add_action('wp_enqueue_scripts', 'add_assets');





  // —————————————————————————————————————————————————————————————————————————————
  // —————————————————————————————————————————————————————————————————————————————
  //
  //
  // *** Admin Styles ***
  //
  //
  // —————————————————————————————————————————————————————————————————————————————
  // —————————————————————————————————————————————————————————————————————————————

  function admin_style()
  {
      $themecsspath = get_stylesheet_directory() . '/assets/css/admin.css';
      wp_enqueue_style(
      'Admin Styles',
      get_stylesheet_directory_uri() . '/assets/css/admin.css',
      array(),
      filemtime($themecsspath)
    );
  };
  add_action('admin_enqueue_scripts', 'admin_style', 20);





    // —————————————————————————————————————————————————————————————————————————————
    // —————————————————————————————————————————————————————————————————————————————
    //
    //
    // *** Tweak to ACF Styles ***
    //
    //
    // —————————————————————————————————————————————————————————————————————————————
    // —————————————————————————————————————————————————————————————————————————————


  function my_acf_admin_head()
  {
      ?>
    <style type="text/css">

      .acf-hide-title .acf-label {
        display: none;
      }
      .acf-hide-title.acf-field  {
        padding: 0px 12px 15px;
      }

    </style>
    <?php
  }

  add_action('acf/input/admin_head', 'my_acf_admin_head');
