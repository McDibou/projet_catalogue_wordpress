<?php


class PromotionArticle
{
    const PROMOTION = 'catalogue_promotion_article';
    const DATE_START_PROMO = 'catalogue_promotion_date_start';
    const DATE_END_PROMO = 'catalogue_promotion_date_end';
    const NONCE = 'catalogue_promo_nonce';

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
        wp_nonce_field(self::NONCE, self::NONCE)
        ?>
        <div class="cat-pad">
            <label class="components-base-control__label css-pezhm9-StyledLabel e1puf3u2" for="<?= self::PROMOTION ?>">Pourcentage de promotion : </label>
            <input class="components-text-control__input" name="<?= self::PROMOTION ?>" id="<?= self::PROMOTION ?>"
                   value="<?= $promotion ?>" type="number"
                   min="0"
                   max="99" step="10"/>
        </div>
        <div class="cat-pad">
            <label class="components-base-control__label css-pezhm9-StyledLabel e1puf3u2"
                   for="<?= self::DATE_START_PROMO ?>">Début de la promotion :</label>
            <input class="components-text-control__input" name="<?= self::DATE_START_PROMO ?>"
                   id="<?= self::DATE_START_PROMO ?>" value="<?= $date_start ?>"
                   type="date"/>
        </div>
        <div class="cat-pad">
            <label class="components-base-control__label css-pezhm9-StyledLabel e1puf3u2"
                   for="<?= self::DATE_END_PROMO ?>">Fin de la promotion :</label>
            <input class="components-text-control__input" name="<?= self::DATE_END_PROMO ?>"
                   id="<?= self::DATE_END_PROMO ?>" value="<?= $date_end ?>"
                   type="date"/>
        </div>
        <?php
    }

    public static function save($post_id)
    {
        if (array_key_exists(self::PROMOTION, $_POST) && wp_verify_nonce($_POST[self::NONCE], self::NONCE)) {
            update_post_meta($post_id, self::PROMOTION, $_POST[self::PROMOTION]);
            update_post_meta($post_id, self::DATE_START_PROMO, $_POST[self::DATE_START_PROMO]);
            update_post_meta($post_id, self::DATE_END_PROMO, $_POST[self::DATE_END_PROMO]);
        }
    }
}