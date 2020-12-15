<?php

class Shops
{

    public static function register()
    {
        add_action('init', [self::class, 'add']);
        add_filter('manage_shops_posts_columns', [self::class, 'addColumns']);
        add_filter('manage_shops_posts_custom_column', [self::class, 'renderColumns'], 10, 2);
    }

    public static function add()
    {
        register_taxonomy('cities', 'shops', [
            'labels' => [
                'name' => 'Ville',
                'singular_name' => 'Ville',
                'plural_name' => 'Villes',
                'search_items' => 'Rechecher des villes',
                'all_items' => 'Toutes les villes',
                'edit_item' => 'Editer une ville',
                'update_item' => 'Mettre à jour une ville',
                'add_new_item' => 'Ajouter une nouvelle ville',
                'new_item_name' => 'Ajouter une nouvelle ville',
                'menu_name' => 'Villes',
            ],
            'show_in_rest' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
        ]);

        register_taxonomy('country', 'shops', [
            'labels' => [
                'name' => 'Pays',
                'singular_name' => 'Pays',
                'plural_name' => 'Pays',
                'search_items' => 'Rechecher des pays',
                'all_items' => 'Tous les pays',
                'edit_item' => 'Editer un pays',
                'update_item' => 'Mettre à jour un pays',
                'add_new_item' => 'Ajouter un nouveau pays',
                'new_item_name' => 'Ajouter un nouveau pays',
                'menu_name' => 'Pays',
            ],
            'show_in_rest' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
        ]);

        register_post_type('shops', [
            'labels' => [
                'name' => 'Magasin',
                'singular_name' => 'Magasin',
                'plural_name' => 'Magasins',
                'search_items' => 'Rechecher des magasins',
                'add_new_item' => 'Ajouter un nouveau Magasin',
                'menu_name' => 'Magasins',
            ],
            'menu_icon' => 'dashicons-location',
            'public' => true,
            'menu_position' => 6,
            'supports' => ['title'],
            'show_in_rest' => true,
            'taxonomies' => ['cities', 'country'],
        ]);
    }

    public static function addColumns($columns) {
//        var_dump($columns);
//        die();
        $newColumns = [];

        foreach ($columns as $key => $value) {

            if ($key === 'taxonomy-cities') {
                $newColumns['street'] = 'Rue';
                $newColumns['number'] = 'Numéro';
                $newColumns['zip'] = 'Code postal';
            }

            $newColumns[$key] = $value;
        }

        unset($newColumns['date']);

        return $newColumns;
    }

    public static function renderColumns($column, $post_id)
    {

        if ($column === 'street') {
            echo get_post_meta($post_id, 'street_shop', true);
        }

        if ($column === 'number') {
            echo get_post_meta($post_id, 'number_shop', true);
        }

        if ($column === 'zip') {
            echo get_post_meta($post_id, 'zip_shop', true);
        }

    }

}
