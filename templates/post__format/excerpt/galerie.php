<div class="post post__<?php strtolower( get_post_format_string( get_post_format() )) ?>">

    <!--        --><?php // $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
    <!--        style="background-image: url('--><?php //echo $url[0]; ?><!--')"-->
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <?php the_post_tags($post->id) ?>
    <?php the_post_categories(); ?>

    <?php the_excerpt(); ?>

</div>

