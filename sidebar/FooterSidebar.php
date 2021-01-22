<?php


require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'widgets' . DIRECTORY_SEPARATOR . 'SocialNetwork.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'widgets' . DIRECTORY_SEPARATOR . 'OpeningTime.php';

class FooterSidebar
{
    public static function register()
    {
        add_action('widgets_init', [self::class, 'add']);
    }

    public static function add()
    {
        register_widget(SocialNetwork::class);
        register_widget(OpeningTime::class);
        register_sidebar([
            'id' => 'footer_sidebar',
            'name' => 'Footer Sidebar',
        ]);
    }
}
