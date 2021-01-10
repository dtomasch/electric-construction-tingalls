<?php


$logo      = get_field('logo', 				'option');
$logo_ko   = get_field('logo_ko', 		'option');
$logo_icon = get_field('logo_small', 	'option');
$url       = wp_get_attachment_url($logo);
$url_ko    = wp_get_attachment_url($logo_ko);
$url_icon  = wp_get_attachment_url($logo_icon);


?>

.start-header .megamenu > ul > li.logo {
background-image: url('<?php echo $url ?>');

}

.has-featured-image .start-header .megamenu > ul > li.logo {
	background-image: url('<?php echo $url_ko ?>');
}

.scroll-header .megamenu > ul > li.logo {
background-image: url('<?php echo $url ?>');

}

.has-featured-image .start-header .megamenu-mobile {
background-image: url('<?php echo $url_ko ?>');
}



.megamenu-mobile, .has-featured-image .show-on-mobile .megamenu-mobile {
background-image: url('<?php echo $url ?>');
}
