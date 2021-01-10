<?php   $header = get_field('page_header');
        $featured_image = $header['featured_video'];
        $embed_code = $header['featured_video_embed_code'];
        $featured_image_overlay = $header['featured_header_overlay'];
        $poster_image = $header['featured_video_poster_frame'];

        $size = 'large'; ?>



<?php if($poster_image): ?>
      <style type="text/css" >
             .vimeo-container{
                   background: url('<?php echo $poster_image; ?>');
                   background-size: cover;
                   background-repeat: no-repeat;
                   background-position: center center;
               }
           </style>
<?php endif; ?>



<header class="featured-header featured-video">

  <div class="overlay " style="background-color:<?php echo $featured_image_overlay ?>;">
    <div class="featured-header-text"><?php echo $header['featured_header_text']; ?></div>
  </div>

  <div class="vimeo-container">
        <?php // TODO: This is hard coded to vimeo but we cna change it ?>
        <iframe src="https://player.vimeo.com/video/<?php echo $embed_code ?>?background=1" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>

  </div>

  <!-- <div class="featured-header-text">

  </div> -->

</header>
<?php the_breadcrumb() ?>
