<?php

/**
 * The template for displaying 404 (page not found) pages.
 * For more info: https://codex.wordpress.org/Creating_an_Error_404_Page
*/
get_header();
?>


<!-- Main Content -->
<main id="site-content" role="main" class="container width-wide">
	<?php the_breadcrumb() ?>
	<section class="mt-4 text-center">

	<div class="row">
			<div class="col-12">
				<h1>404 &bull; Nothing Found</h1>
				<p>
					Try searching the site.
				</p>
				<?php get_search_form() ?>
			</div>
		</div>

	</section>
</main>


<?php get_footer(); ?>
