<?php

class HighlightArticle
{
    const HIGHLIGHT = 'catalogue_highlight';
    const NONCE = 'catalogue_highlight_nonce';

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
        wp_nonce_field(self::NONCE, self::NONCE)
        ?>
        <div class="cat-pad">
        <span>
        <input id="<?= self::HIGHLIGHT ?>"
               type="checkbox" value="1"
               name="<?= self::HIGHLIGHT ?>" <?= checked($value, '1') ?>>
        </span>
            <label class="components-checkbox-control__label" for="<?= self::HIGHLIGHT ?>">Cet article est mise en
                avant</label>
        </div>
        <?php
    }

    public static function save($post)
    {
        if (array_key_exists(self::HIGHLIGHT, $_POST) && wp_verify_nonce($_POST[self::NONCE], self::NONCE)) {
            if ($_POST[self::HIGHLIGHT] === '0') {
                delete_post_meta($post, self::HIGHLIGHT);
            } else {
                update_post_meta($post, self::HIGHLIGHT, 1);
            }
        }
    }
}