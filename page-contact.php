<!--AUTRE PAGE-->
<?php get_header() ?>

<div class="contact">
    <div class="form-contact">
        <form method="post">
            <div>
                <label for="name_mail">NAME :</label>
                <input id="name_mail" value="<?= (!empty($name_mail)) ? $name_mail : null; ?>" name="name_mail"
                       type="text"
                       maxlength="30"
                       placeholder="max : 30"
                       pattern="[A-Za-z0-9 '-]+$" required>
            </div>
            <div>
                <label for="subject_mail">SUBJECT :</label>
                <input id="subject_mail" value="<?= (!empty($subject_mail)) ? $subject_mail : null; ?>"
                       name="subject_mail"
                       type="text"
                       maxlength="50"
                       placeholder="max : 50"
                       pattern="[A-Za-z0-9 '-]+$" required>
            </div>
            <div>
                <label for="url_mail">MAIL :</label>
                <input id="url_mail" value="<?= (!empty($url_mail)) ? $url_mail : null; ?>" name="url_mail"
                       type="email"
                       maxlength="80"
                       placeholder="max : 80"
                       pattern="[A-Za-z0-9.-_]+@[A-za-z0-9]+\.[a-z0-9]{2,}" required>
            </div>
            <div>
                <label for="content_mail">CONTENT :</label>
                <textarea id="content_mail" name="content_mail" cols="20" rows="5" maxlength="255"
                          placeholder="max : 255"
                          required><?= (!empty($content_mail)) ? $content_mail : null; ?></textarea>
            </div>

            <button name="contact_mail" type="submit">ENVOYER</button>
        </form>
        <!-- error or success if available -->
        <?= !empty($succes) ? '<div class="success-mail">' . $succes . '</div>' : '' ?>
        <?= !empty($error) ? '<div class="error-mail">' . $error . '</div>' : '' ?>
    </div>
    <div class="map" id="mapid" style="height: 500px; width: 500px"></div>
</div>
<div class="map-shops">
    <?php while ($shops->have_posts()) : $shops->the_post(); ?>
        <?php get_template_part('parts/card.shops', 'post'); ?>
    <?php endwhile;
    wp_reset_query(); ?>
</div>
<?php get_footer() ?>
