<?php

class HighlightArticle
{
    const HIGHLIGHT = 'catalogue_highlight';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add($postType, $post)
    {
        add_meta_box(self::HIGHLIGHT, 'Mise en avant', [self::class, 'render'], 'post', 'side');
    }

    public static function render($post)
    {
        $value = get_post_meta($post->ID, self::HIGHLIGHT, true);
        ?>
        <input id="highlight" type="checkbox" value="1" name="<?= self::HIGHLIGHT ?>" <?= checked($value, '1') ?>>
        <label for="highlight">Cet article est mise en avant</label>
        <?php
    }

    public static function save($post)
    {
        if (array_key_exists(self::HIGHLIGHT, $_POST)) {
            if ($_POST[self::HIGHLIGHT] === '0') {
                delete_post_meta($post, self::HIGHLIGHT);
            } else {
                update_post_meta($post, self::HIGHLIGHT, 1);
            }
        }
    }
}