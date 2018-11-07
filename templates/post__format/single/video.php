<div class="post post__<?php echo strtolower( get_post_format_string( get_post_format() )) ?>">



    <!--        --><?php // $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
    <!--        style="background-image: url('--><?php //echo $url[0]; ?><!--')"-->

    <?php the_post_thumbnail('full')?>

    <h1><?php the_title(); ?></h1>

    <?php the_post_tags($post->id) ?>
    <?php the_post_categories(); ?>
    <?php the_published_date(); ?>

    <?php the_content(); ?>

    <?php the_video(); ?>

</div>

