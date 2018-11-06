<?php // custom functions.php template @ digwp.com


// custom excerpt length in letters
function excerpt_length()
{
    return 10;
}

add_theme_support( 'post-thumbnails' );

register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'template' ),
    'secondary' => esc_html__( 'Secondary', 'template' ),
) );

// add feed links to header
if (function_exists('automatic_feed_links')) {
    automatic_feed_links();
} else {
    return;
}

// jquery deactivation
 if (!is_admin()) {
 	wp_deregister_script('jquery');
 }

// enable threaded comments
function enable_threaded_comments(){
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
            wp_enqueue_script('comment-reply');
    }
}
add_action('get_header', 'enable_threaded_comments');


// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


// add google analytics to footer
function add_google_analytics() {
    echo '<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>';
    echo '<script type="text/javascript">';
    echo 'var pageTracker = _gat._getTracker("UA-XXXXX-X");';
    echo 'pageTracker._trackPageview();';
    echo '</script>';
}
add_action('wp_footer', 'add_google_analytics');

// custom post formats
add_theme_support( 'post-formats', array( 'image', 'gallery', 'video') );




// custom excerpt ellipses for 2.8-
function custom_excerpt_more($excerpt) {
	return str_replace('[...]', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'custom_excerpt_more');


// no more jumping for read more link
function no_more_jumping($post) {
    return '<a href="'.get_permalink($post->ID).'" class="read-more">'.'Continue Reading'.'</a>';
}
add_filter('excerpt_more', 'no_more_jumping');


// add a favicon to your
function blog_favicon() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_directory').'/assets/images/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');


// add a favicon for your admin
function admin_favicon() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_directory').'/assets/images/favicon.png" />';
}
add_action('admin_head', 'admin_favicon');


// disable all widget areas
function disable_all_widgets($sidebars_widgets) {
    //if (is_home())
    $sidebars_widgets = array(false);
    return $sidebars_widgets;
}
add_filter('sidebars_widgets', 'disable_all_widgets');


// kill the admin nag
if (!current_user_can('edit_users')) {
    add_action('init', create_function('$a', "remove_action('init', 'wp_version_check');"), 2);
    add_filter('pre_option_update_core', create_function('$a', "return null;"));
}


// category id in body and post class
function category_id_class($classes) {
    global $post;
    foreach((get_the_category($post->ID)) as $category)
        $classes [] = 'cat-' . $category->cat_ID . '-id';
    return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');


// get the first category id
function get_first_category_ID() {
    $category = get_the_category();
    return $category[0]->cat_ID;
}


// rename Artikel
// function revcon_change_post_label() {
//     global $menu;
//     global $submenu;
//     $menu[5][0] = 'Casestudies';
//     $submenu['edit.php'][5][0] = 'Casestudies';
//     $submenu['edit.php'][10][0] = 'Add Casestudy';
//     $submenu['edit.php'][16][0] = 'Casestudies Tags';
// }
// function revcon_change_post_object() {
//     global $wp_post_types;
//     $labels = &$wp_post_types['post']->labels;
//     $labels->name = 'Casestudies';
//     $labels->singular_name = 'Casestudies';
//     $labels->add_new = 'Add Casestudy';
//     $labels->add_new_item = 'Add Casestudy';
//     $labels->edit_item = 'Edit Casestudy';
//     $labels->new_item = 'Casestudies';
//     $labels->view_item = 'View Casestudies';
//     $labels->search_items = 'Search Casestudies';
//     $labels->not_found = 'No Casestudies found';
//     $labels->not_found_in_trash = 'No Casestudies found in Trash';
//     $labels->all_items = 'All Casestudies';
//     $labels->menu_name = 'Casestudies';
//     $labels->name_admin_bar = 'Casestudies';
// }
//
// add_action( 'admin_menu', 'revcon_change_post_label' );
// add_action( 'init', 'revcon_change_post_object' );

/*
 * Custom functions
 */

function dd($data)
{
    echo '<pre>' . var_export($data, true) . '</pre>';
    die;
}

function the_custom_excerpt()
{
    global $post;
    $count = excerpt_length();
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $post->post_content, $matches);

    echo $matches[0] . ' ...';
}


function the_published_date()
{
    global $post;
    $date = date('d m Y', strtotime($post->post_date));

    $month = [
        '01' => 'Januar',
        '02' => 'Februar',
        '03' => 'März',
        '04' => 'April',
        '05' => 'Mai',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'August',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Dezember',
    ];

    echo '<span class="post__published_at">' . explode(' ', $date)[0] . '. ' . $month[explode(' ', $date)[1]] . ' ' . explode(' ', $date)[2] . '</span>';

}


function the_post_categories()
{
    $categories = get_the_category();
    if(!empty($categories))
    {
        foreach($categories as $category)
        {
            echo '<a href="' . esc_url(get_category_link( $category->term_id )) . '">' . ucfirst($category->name) . '</a>';
        }
    }
}


function the_post_tags()
{
    $tags = get_the_tags();
    if(!empty($tags))
    {
        foreach( $tags as $tag )
        {
            echo '<span>' . ucfirst($tag->name) . '</span>';
        }
    }
}

?>
