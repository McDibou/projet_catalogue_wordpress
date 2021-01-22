<?php get_header() ?>

    <div class="single-post">
        <?php get_template_part('parts/card.article', 'post'); ?>
    </div>

    <div class="comment-block">
        <?php if (comments_open() || get_comments_number()):
            comments_template();
        endif; ?>
    </div>

<?php get_footer() ?>