<?php

require_once 'metaboxes' . DIRECTORY_SEPARATOR . 'PriceArticle.php';
require_once 'metaboxes' . DIRECTORY_SEPARATOR . 'PromotionArticle.php';
require_once 'metaboxes' . DIRECTORY_SEPARATOR . 'GaleryArticle.php';

require_once 'admin' . DIRECTORY_SEPARATOR . 'Article.php';

// appel des support natif de wordpress
function catalogue_supports()
{
    add_theme_support('menus');
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

add_action('after_setup_theme', 'catalogue_supports');
add_action('wp_enqueue_scripts', 'catalogue_register_assets');

// add columns admin article
Article::register();

// add metabox admin article
PriceArticle::register();
PromotionArticle::register();
GaleryArticle::register();

