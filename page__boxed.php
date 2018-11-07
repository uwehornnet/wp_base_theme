<?php
/*
* Template Name: Boxed
*/

get_header(); ?>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

    <?php the_post_thumbnail('full')?>
    <?php the_title()?>
    <?php the_content(); ?>

<?php endwhile; endif; wp_reset_query(); ?>

<?php get_footer(); ?>
