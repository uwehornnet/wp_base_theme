<?php   get_header(); ?>

<?php if ( have_posts() ): ?>
    <?php global $wp_query; ?>

    <?php echo ucfirst($_GET['s']); ?>
    <?php echo $wp_query->found_posts; ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php the_permalink(); ?>
        <?php the_title(); ?>
        <?php the_excerpt(); ?>

    <?php endwhile; ?>

<?php else: ?>

<?php endif; wp_reset_query(); ?>

<?php   get_footer(); ?>
