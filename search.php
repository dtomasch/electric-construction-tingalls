<?php


// This is the search results page

get_header(); ?>

<main id="site-content" role="main" class="container width-wide">

	<?php the_breadcrumb() ?>

	<section class="mt-4">
		<div class="row  text-center">
			<div class="col-12">
				<h1>Search Results</h1>
			</div>
		</div>
	</section>

<section class="width-slim">
		<div class="row">
			<div class="col-12 flex-column">

				<?php if (have_posts()) : ?>
				<?php
          $s = get_search_query();
          $args = array(
              's' => $s
          );
          _e('<h4>You searched for: ' . get_query_var('s') . '</h4>');
         ?>

				<?php while (have_posts()) : the_post(); ?>
				<div class="pb-3">
					<p class="smaller text-uppercase">
						<?php
									$post_type = get_post_type_object($post->post_type);
									echo $post_type->labels->singular_name;
						?>
					</p>
					<p>
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</p>
				</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				<?php else:  ?>

					<h1>Sorry</h1>
					<p>No results found. Try a different search.</p>

				<?php endif; ?>

			</div>
		</div>
	</section>
	<?php get_template_part('parts/parts', 'pagination'); ?>
</main>

<!-- end #content -->

<?php get_footer(); ?>
