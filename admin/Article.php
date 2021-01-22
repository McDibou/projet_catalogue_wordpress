<?php

class Article
{

    public static function register()
    {
        add_filter('manage_post_posts_columns', [self::class, 'add']);
        add_filter('manage_post_posts_custom_column', [self::class, 'render'], 10, 2);
        add_filter('register_post_type_args', [self::class, 'replace_icon'], 20, 2);
        add_action('init', [self::class, 'unregister_taxonomy']);
    }

    public static function replace_icon($args, $type)
    {
        if ($type === 'post') {
            $args['menu_icon'] = 'dashicons-tag';
        }
        return $args;
    }

    public static function unregister_taxonomy()
    {
        unregister_taxonomy_for_object_type('post_tag', 'post');
    }

    public static function add($columns)
    {
        $newColumns = [];

        foreach ($columns as $key => $value) {

            unset($newColumns['tags']);
            unset($newColumns['author']);


            if ($key === 'title') {
                $newColumns['galleries'] = 'Image';

            }

            if ($key === 'categories') {
                $newColumns['title'] = 'Produit';
                $newColumns['price'] = 'Prix';
                $newColumns['promo'] = 'Promotion';
                $newColumns['date_start_promo'] = 'Date de debut';
                $newColumns['date_end_promo'] = 'Date de fin';
            }

            if ($key === 'comments') {
                $newColumns['highlight_article'] = 'Mise en avant';
            }

            $newColumns[$key] = $value;
        }

        return $newColumns;
    }

    public static function render($column, $post_id)
    {
        if ($column === 'galleries') {
            $image = wp_get_attachment_image_src(get_post_meta($post_id, 'vdw_gallery_id', true)[0]);
            echo '<img style="width: 60px" class="image-preview" src="' . $image[0] . '">';
        }

        if ($column === 'price') {
            echo get_post_meta($post_id, PriceArticle::META_KEY, true);
        }

        if ($column === 'promo') {
            echo get_post_meta($post_id, PromotionArticle::PROMOTION, true);
            echo !empty(get_post_meta($post_id, PromotionArticle::PROMOTION, true)) ? ' %': '';
        }

        if ($column === 'date_start_promo') {
            echo get_post_meta($post_id, PromotionArticle::DATE_START_PROMO, true);
        }

        if ($column === 'date_end_promo') {
            echo get_post_meta($post_id, PromotionArticle::DATE_END_PROMO, true);
        }

        if ($column === 'highlight_article') {
            if (!empty(get_post_meta($post_id, HighlightArticle::HIGHLIGHT, true))) {
                echo '<p class="cat-yes-promo">YES</p>';
            } else {
                echo '<p class="cat-no-promo">NO</p>';
            }
        }
    }

}
