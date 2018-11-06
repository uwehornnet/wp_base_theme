<?php   get_header(); ?>

<?php if ( have_posts() ): ?>
    <?php global $wp_query; ?>

    <?php echo ucfirst($_GET['s']); ?>
    <?php echo $wp_query->found_posts; ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part('./templates/post__format/excerpt/' . strtolower( get_post_format_string( get_post_format()) )); ?>

    <?php endwhile; ?>

<?php else: ?>

<?php endif; wp_reset_query(); ?>

<?php   get_footer(); ?>
