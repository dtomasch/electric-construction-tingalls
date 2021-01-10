<?php
/**
 * The template for displaying the header
 * This is the template that displays all of the <head> section
 *
 */
?>

<!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
    <meta charset="utf-8">

		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $image = wp_get_attachment_image_src(get_field('logo_small', 'option'), 'thumbnail'); ?>

    <!-- Icons & Favicons -->
    <link rel="shortcut icon" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $image[0]; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $image[0]; ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $image[0]; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $image[0]; ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $image[0]; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $image[0]; ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $image[0]; ?>">
    <meta name="theme-color" content="#ffffff">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

	</head>

<!-- Start Body -->
	<body <?php body_class(); ?>>

      <!-- Header -->
      <header id="page-header" class="start-header" role="banner">
    		<?php get_template_part('parts/nav', 'title-bar'); ?>
    	</header>
