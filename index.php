<!--PAGE CATEGORY-->
<?php get_header() ?>

<?php $categories = get_terms('category'); ?>

<h2><?= get_queried_object()->name; ?></h2>
<ul>
    <?php foreach ($categories as $category): ?>
        <?php $link = get_term_link($category->slug, 'category'); ?>
        <li>
            <a href="<?= $link ?>"><?= $category->name ?></a>
        </li>
    <?php endforeach; ?>
</ul>

<?php if (have_posts()) : ?>
    <div>
        <?php while (have_posts()): the_post() ?>
            <div>
                <?php get_template_part('parts/card.article', 'post'); ?>
            </div>
        <?php endwhile; ?>
    </div>

<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?>