<?php


class PromotionArticle
{
    const PROMOTION = 'catalogue_promotion_article';
    const DATE_START_PROMO = 'catalogue_promotion_date_start';
    const DATE_END_PROMO = 'catalogue_promotion_date_end';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add()
    {
        add_meta_box(self::PROMOTION, 'Promotion', [self::class, 'render'], 'post', 'side');
    }

    public static function render($post)
    {
        $promotion = get_post_meta($post->ID, self::PROMOTION, true);
        $date_start = get_post_meta($post->ID, self::DATE_START_PROMO, true);
        $date_end = get_post_meta($post->ID, self::DATE_END_PROMO, true);

        ?>
        <label for="<?= self::PROMOTION ?>">Ajouter une promotion</label>
        <input name="<?= self::PROMOTION ?>" id="<?= self::PROMOTION ?>" value="<?= $promotion ?>" type="number" min="0"
               max="99" step="10"/>

        <input name="<?= self::DATE_START_PROMO ?>" id="<?= self::DATE_START_PROMO ?>" value="<?= $date_start ?>" type="date"/>
        <label for="<?= self::DATE_START_PROMO ?>">debut</label>

        <input name="<?= self::DATE_END_PROMO ?>" id="<?= self::DATE_END_PROMO ?>" value="<?= $date_end ?>" type="date"/>
        <label for="<?= self::DATE_END_PROMO ?>">fin</label>
        <?php
    }

    public static function save($post_id)
    {
        if (array_key_exists(self::PROMOTION, $_POST)) {
            update_post_meta($post_id, self::PROMOTION, $_POST[self::PROMOTION]);
            update_post_meta($post_id, self::DATE_START_PROMO, $_POST[self::DATE_START_PROMO]);
            update_post_meta($post_id, self::DATE_END_PROMO, $_POST[self::DATE_END_PROMO]);
        }
    }
}