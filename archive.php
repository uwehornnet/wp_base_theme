<?php   get_header(); ?>

<?php the_post(); ?>
<?php get_search_form(); ?>

<?php wp_get_archives('type=monthly'); ?>

<?php wp_list_categories(); ?>

<?php   get_footer(); ?>
