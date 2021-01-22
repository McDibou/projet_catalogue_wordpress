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
        <div class="social"><?php
        foreach ($instance as $key => $social) :
            if ($key !== 'delete' && $key !== 'title'): ?>
                <p><a href="<?= $social['url'] ?>" target="_blank"><?= $social['name'] ?></a></p>
            <?php endif; endforeach;
        ?> </div><?php
    }

    public function form($instance)
    {
        foreach ($instance as $key => $social) :
            if ($key !== 'delete' && $key !== 'title'): ?>
                <p class="read-social-widget"><?= $social['name'] ?><a href="<?= $social['url'] ?>"><?= substr($social['url'], 0, 25) ?>...</a> <input class="checkbox-widget" value="<?= $key ?>"
                                                                        name="<?= $this->get_field_name('delete') ?>"
                                                                        type="checkbox"></p>
            <?php endif; endforeach; ?>

        <h3>Titre :</h3>
        <p>
            <label for="<?= $this->get_field_id('title') ?>"></label>
            <input class="input-widget" type="text" id="<?= $this->get_field_id('title') ?>"
                   name="<?= $this->get_field_name('title') ?>"
                   value="<?= $instance['title'] ?>"
            >
        </p>
        <h3>Ajouter un reseaux :</h3>
        <p>
            <label class="label-widget" for="<?= $this->get_field_id('name') ?>">Name :</label>
            <input class="input-widget"  type="text" id="<?= $this->get_field_id('name') ?>" name="<?= $this->get_field_name('name') ?>">
        </p>
        <p>
            <label class="label-widget" for="<?= $this->get_field_id('url') ?>">URL :</label>
            <input class="input-widget"  type="text" id="<?= $this->get_field_id('url') ?>" name="<?= $this->get_field_name('url') ?>">
        </p>

        <?php
    }

    public function update($new_instance, $old_instance)
    {

        if (empty($new_instance['name'])) {
            $old_instance['delete'] = $new_instance['delete'];
            $old_instance['title'] = $new_instance['title'];
            if (array_key_exists($old_instance['delete'], $old_instance)) {
                unset($old_instance[$old_instance['delete']]);
            }

            return $old_instance;
        }

        if (empty($old_instance)) {
            return [
                'delete' => $new_instance['delete'],
                'titre' => $new_instance['title'],
                [
                    'name' => $new_instance['name'],
                    'url' => $new_instance['url'],
                ]
            ];

        } else {

            $old_instance['delete'] = $new_instance['delete'];
            $old_instance['title'] = $new_instance['title'];
            $old_instance[] = [
                'name' => $new_instance['name'],
                'url' => $new_instance['url'],
            ];

            return $old_instance;
        }
    }
}