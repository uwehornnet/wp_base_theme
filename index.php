<?php get_header(); ?>

<?php $args = [
    'post_type' => '',
    'category_name' => '',
    'order' => 'asc'
]; ?>

<?php include(locate_template('./templates/the__loop.php')); ?>

<?php get_footer(); ?>
