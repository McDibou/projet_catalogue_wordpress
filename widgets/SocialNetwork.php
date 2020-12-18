<?php

class SocialNetwork extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('catalogue_social_network_widget', 'Réseaux Sociaux');
    }

    public function widget($args, $instance)
    {
        foreach ($instance as $key => $social) :
            if ($key !== 'delete'): ?>
                <p><a href="<?= $social['url'] ?>" target="_blank"><?= $social['name'] ?></a></p>
            <?php endif; endforeach;
    }

    public function form($instance)
    {

        foreach ($instance as $key => $social) :
            if ($key !== 'delete'): ?>
                <p><?= $social['url'] ?> | <?= $social['name'] ?><input value="<?= $key ?>"
                                                                        name="<?= $this->get_field_name('delete') ?>"
                                                                        type="checkbox"></p>
            <?php endif; endforeach; ?>

        <h3>Ajouter un reseaux</h3>
        <p>
            <label for="<?= $this->get_field_id('name') ?>">Name</label>
            <input type="text" id="<?= $this->get_field_id('name') ?>" name="<?= $this->get_field_name('name') ?>"
                   value="<?= esc_attr($name) ?>">
        </p>
        <p>
            <label for="<?= $this->get_field_id('url') ?>">URL</label>
            <input type="text" id="<?= $this->get_field_id('url') ?>" name="<?= $this->get_field_name('url') ?>"
                   value="<?= esc_attr($url) ?>">
        </p>

        <?php
    }

    public function update($new_instance, $old_instance)
    {

        if (empty($new_instance['name'])) {
            $old_instance['delete'] = $new_instance['delete'];

            if (array_key_exists($old_instance['delete'], $old_instance)) {
                unset($old_instance[$old_instance['delete']]);
            }

            return $old_instance;
        }

        if (empty($old_instance)) {
            return [
                'delete' => $new_instance['delete'],
                [
                    'name' => $new_instance['name'],
                    'url' => $new_instance['url'],
                ]
            ];

        } else {

            $old_instance['delete'] = $new_instance['delete'];
            $old_instance[] = [
                'name' => $new_instance['name'],
                'url' => $new_instance['url'],
            ];

            return $old_instance;
        }
    }
}