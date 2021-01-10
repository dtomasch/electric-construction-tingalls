<?php

//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
//
//
// Register Menus
// https://codex.wordpress.org/Navigation_Menus
//
//
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------

function register_my_menus()
{
    register_nav_menus(
    array(
      'nav_top_primary'    => __('Top Primary Menu'),
      // 'nav_footer_primary' => __('Footer Primary'),
      // 'nav_footer_legal'   => __('Legal Menu'),
      // 'nav_footer_about'   => __('About Menu'),
     )
   );
}
 add_action('init', 'register_my_menus');


 // ---------------------------------------------------------------------------------
 // Just add this function where you want this menu
 //---------------------------------------------------------------------------------
function theme_nav_top_primary()
{
    wp_nav_menu(array(
        'container'      => 'ul',                           // Remove nav container
        // 'menu_class'     => 'megamenu',                           // Adding custom nav class
        'theme_location' => 'nav_top_primary',                // Where it's located in the theme


    ));
}

// function theme_nav_footer_primary()
// {
//     wp_nav_menu(array(
//         'container'      => false,                           // Remove nav container
//         'menu_class'     => 'menu',       // Adding custom nav class
//         'theme_location' => 'nav_footer_primary',                    // Where it's located in the theme
//
//
//     ));
// }
//
//
// function theme_nav_footer_legal()
// {
//     wp_nav_menu(array(
//         'container'      => false,                           // Remove nav container
//         'menu_class'     => 'menu flat',       // Adding custom nav class
//         'theme_location' => 'nav_footer_legal',                    // Where it's located in the theme
//
//
//     ));
// }
//
// function theme_nav_about()
// {
//     wp_nav_menu(array(
//         'container'      => false,                           // Remove nav container
//         'menu_class'     => 'menu flat flex-between-md flex-center-sm',                     // Adding custom nav class
//         'theme_location' => 'nav_footer_about',                    // Where it's located in the theme
//
//     ));
// }
