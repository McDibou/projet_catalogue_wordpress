<?php

// reworking
class GaleryArticle
{

    const META_KEY = 'catalogue_gallery_article';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
        add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    public static function registerScripts()
    {
        wp_enqueue_script('catalogue-gallery-script', get_template_directory_uri() . '/assets/gallery.script.js', [], false, true);
    }

    public static function add()
    {
        add_meta_box('gallery-metabox', 'Gallery', [self::class, 'render'], 'post', 'side');
    }

    public static function render($post)
    {
        wp_nonce_field(basename(__FILE__), 'gallery_meta_nonce');
        $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
        ?>
        <table class="form-table">
            <tr>
                <td>
                    <a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery"
                       data-uploader-button-text="Add image(s)">Add image(s)</a>
                    <ul id="gallery-metabox-list">
                        <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
                            <li>
                                <input type="hidden" name="vdw_gallery_id[<?php echo $key; ?>]"
                                       value="<?php echo $value; ?>">
                                <img class="image-preview" src="<?php echo $image[0]; ?>">
                                <a class="change-image button button-small" href="#" data-uploader-title="Change image"
                                   data-uploader-button-text="Change image">Change image</a><br>
                                <small><a class="remove-image" href="#">Remove image</a></small>
                            </li>
                        <?php
                        endforeach;
                        endif;
                        ?>
                    </ul>
                </td>
            </tr>
        </table>
        <?php
    }

    public static function save($post_id)
    {
        if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__)))
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (isset($_POST['vdw_gallery_id'])) {
            update_post_meta($post_id, 'vdw_gallery_id', $_POST['vdw_gallery_id']);
        } else {
            delete_post_meta($post_id, 'vdw_gallery_id');
        }
    }
}