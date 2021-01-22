<?php

class OpeningTime extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('catalogue_opening_time_widget', 'Heure d\'ouverture');
    }

    public function widget($args, $instance)
    {
        ?>
        <div class="hours"><?php
        echo '<h2>' . $instance['title'] . '</h2>';
        foreach ($instance as $key => $value):
            if ($key !== 'title') {
                if ($instance[$key][0] == 'closed') {
                    echo '<div class="line">' . ucfirst($key) . ' : Fermé ! </div>';
                } else {
                    echo '<div class="line">' . ucfirst($key) . ' : ' . $instance[$key][0] . ' to ' . $instance[$key][1] . '</div>';
                }
            }
        endforeach;

        ?></div><?php
    }

    public function form($instance)
    {
        $week = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        ?>
        <h3>Titre :</h3>
        <p>
            <label class="label-widget" for="<?= $this->get_field_id('title') ?>"></label>
            <input class="input-widget" type="text" id="<?= $this->get_field_id('title') ?>"
                   name="<?= $this->get_field_name('title') ?>"
                   value="<?= $instance['title'] ?>"
            >
        </p>
        <h3>Horaire :</h3>
        <?php
        foreach ($week as $day) :
            $value = isset($instance[$day]) ? $instance[$day] : '';
            ?>


            <label class="label-widget block-hours" <?= ($value[0] === 'closed') ? 'style="background-color:#bdbdbd; color:white;"' : '' ?>
                   for="<?= $this->get_field_id($day) ?>"><?= ucfirst($day) ?> :
                <input class="input-widget time-catalogue" type="time" id="<?= $this->get_field_id($day) ?>"
                       name="<?= $this->get_field_name($day . '[]') ?>"
                       value="<?= esc_attr($value[0]) ?>"
                    <?= $value[0] == 'closed' ? 'disabled' : '' ?>
                >
                to
                <input class="input-widget time-catalogue" type="time" id="<?= $this->get_field_id($day) ?>"
                       name="<?= $this->get_field_name($day . '[]') ?>"
                       value="<?= esc_attr($value[1]) ?>"
                    <?= $value[0] == 'closed' ? 'disabled' : '' ?>
                >

                <input class="input-widget time-catalogue" type="checkbox" id="<?= $this->get_field_id($day) ?>"
                       onclick="test(this)"
                       value="<?= esc_attr($value[0]) ?>"
                       name="<?= $this->get_field_name($day . '[]') ?>"
                    <?= ($value[0] === 'closed') ? 'checked' : '' ?>
                >
            </label>

            <script>
                function test(el) {
                    el.checked ? el.value = 'closed' : ''
                    let input = el.parentElement.querySelectorAll('input[type="time"]')
                    if (el.checked) {
                        el.parentElement.setAttribute("style", "background-color:#bdbdbd; color:white;");
                        input[0].disabled = true
                        input[1].disabled = true
                    } else {
                        el.parentElement.setAttribute("style", "");
                        input[0].disabled = false
                        input[1].disabled = false
                    }
                }
            </script>
        <?php
        endforeach;
    }

    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}
