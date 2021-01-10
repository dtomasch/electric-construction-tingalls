<?php
$category_array = get_field('choose_category');
$category_ID = $category_array->term_id;
$category_name = $category_array->name;
$num_posts = get_field('posts_to_show');
$post_type = get_post_type();
// echo $category;
// echo $num_posts;
// var_dump($category_array)
?>

    <?php
    global $post;

    $myposts = get_posts(array(
        'posts_per_page' => $num_posts,
        // 'offset'         => 1,
        'category' => $category_ID,
        'post_type' => $post_type,
    ));

    if ($myposts) : ?>
<div class="sidebar pl-2 pt-2 pb-2">
<h5 class="">Previous <?php echo $category_name; ?></h5>
<ul class="flat flex-column">
        <?php foreach ($myposts as $post) :
            setup_postdata($post); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php
        endforeach;
        wp_reset_postdata();?>
</ul>
</div>
<?php endif;  ?>
