<?php

require_once 'metaboxes' . DIRECTORY_SEPARATOR . 'PriceArticle.php';
require_once 'metaboxes' . DIRECTORY_SEPARATOR . 'PromotionArticle.php';
require_once 'metaboxes' . DIRECTORY_SEPARATOR . 'GaleryArticle.php';
require_once 'metaboxes' . DIRECTORY_SEPARATOR . 'HighlightArticle.php';
require_once 'metaboxes' . DIRECTORY_SEPARATOR . 'addressShops.php';

require_once 'admin' . DIRECTORY_SEPARATOR . 'Article.php';
require_once 'admin' . DIRECTORY_SEPARATOR . 'Shops.php';

require_once 'sidebar' . DIRECTORY_SEPARATOR . 'FooterSidebar.php';

// appel des support natif de wordpress
function catalogue_supports()
{
    add_theme_support('menus');
    add_theme_support('post-thumbnails', ['page']);
    add_theme_support('widgets');
    register_nav_menus([
        'header' => 'header',
        'footer' => 'footer'
    ]);
}

// appel des dependances script et stylesheet
function catalogue_register_assets()
{
    wp_register_style('style-catalogue', get_stylesheet_uri());
    wp_register_script('app-catalogue', get_template_directory_uri() . '/assets/app.js', [], null, true);
    wp_enqueue_style('style-catalogue');
    wp_enqueue_script('app-catalogue');
}

function catalogue_register_assets_per_page() {
    if (is_page('contact')) {

        $shops = new \WP_Query([
            'post_type' => 'shops',
        ]);

        $tabShops = $shops->get_posts();

        $tab = [];
        foreach ($tabShops as $post) {
            $tab[] = [
                'title' => $post->post_title,
                'street' => get_post_meta($post->ID, 'street_shop', true),
                'number' => get_post_meta($post->ID, 'number_shop', true),
                'zip' => get_post_meta($post->ID, 'zip_shop', true),
                'latitude' => get_post_meta($post->ID, 'latitude_shop', true),
                'longitude' => get_post_meta($post->ID, 'longitude_shop', true),
            ];
        }

        $shopJSON = json_encode($tab);

        wp_register_style('leaflet-style-catalogue', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
        wp_register_script('leaflet-app-catalogue', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', [], null, true);
        wp_register_script('map-catalogue', get_template_directory_uri() . '/assets/map.js', ['leaflet-app-catalogue'], null, true);

        wp_enqueue_style('leaflet-style-catalogue');
        wp_enqueue_script('map-catalogue');

        wp_add_inline_script('map-catalogue', 'let data = ' . $shopJSON, 'before');
    }
}

add_action('after_setup_theme', 'catalogue_supports');
add_action('wp_enqueue_scripts', 'catalogue_register_assets');
add_action('wp_enqueue_scripts', 'catalogue_register_assets_per_page');

// add and mopdify post
Article::register();
Shops::register();

// add metabox admin article
PriceArticle::register();
PromotionArticle::register();
GaleryArticle::register();
HighlightArticle::register();

// add metabox admin shps
addressShops::register();

//add widget foorder sidebar
FooterSidebar::register();


// WP_Query all site
$shops = new WP_Query(['post_type' => 'shops', 'order' => 'ASC', 'oderby' => 'name']);

$promotiom = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'rand',
    'meta_query' => [
        'relation' => 'AND', [
            'key' => 'catalogue_promotion_date_start',
            'compare' => '<',
            'value' => date("Y-m-d H:i:s"),
        ], [
            'key' => 'catalogue_promotion_date_end',
            'compare' => '>',
            'value' => date("Y-m-d H:i:s"),
        ]
    ]
]);

$highlight = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 1,
    'orderby' => 'rand',
    'meta_query' => [
        [
            'key' => 'catalogue_highlight',
            'compare' => '=',
            'value' => 1,
        ]
    ]
]);

$query_cat = [];
$query_nbr_page = 2;

if ($_GET['s'] !== 'nothing') {
    $query_cat = [
        'relation' => 'AND',
        [
            'taxonomy' => 'category',
            'field' => 'name',
            'terms' => $_GET['s'],
        ]
    ];
}

$search = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => $query_nbr_page,
    'offset' => ($_GET['page'] == 1) ? 0 : $query_nbr_page * $_GET['page'] - $query_nbr_page,
    'page' => get_query_var( 'page', 1 ),
    'meta_query' => [
        [
            'key' => 'catalogue_price_article',
            'value' => [$_GET['min'], $_GET['max']],
            'type' => 'numeric',
            'compare' => 'BETWEEN',
        ],
    ],
    'tax_query' => $query_cat,
]);