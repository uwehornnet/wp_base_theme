<?php get_header(); ?>

<?php

    $args = array (
        'post_type' => '',
        'category_name' => '',
        'order' => 'asc'
    );

    query_posts( $args );

    if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<!--        --><?php // $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
<!--        style="background-image: url('--><?php //echo $url[0]; ?><!--')"-->

        <?php the_title(); ?>
        <?php the_content(); ?>

    <?php endwhile; endif; wp_reset_query(); ?>

<?php get_footer(); ?>
