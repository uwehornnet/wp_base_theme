<?php

query_posts( $args );

if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

    <?php get_template_part('./templates/post__format/excerpt/' . strtolower( get_post_format_string( get_post_format()) )); ?>

<?php endwhile; endif; wp_reset_query(); ?>