<?php

class SocialNetwork extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('catalogue_social_network_widget', 'Réseaux Sociaux');
    }

    public function widget($args, $instance)
    {
        ?>
        <p><a href="<?= $instance['url'] ?>" target="_blank"><?=$instance['name']?></a></p>
        <?php
    }

    public function form($instance)
    {
        $name = $instance['name'] ?? '';
        $url = $instance['url'] ?? '';
        ?>
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
        return [
            'name' => $new_instance['name'],
            'url' => $new_instance['url']
        ];
    }
}