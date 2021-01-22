<!--PAGE CATEGORY-->
<?php get_header() ?>

<img class="cat-img-home" src="<?php the_post_thumbnail_url(); ?>" alt="">
<?php $categories = get_terms('category'); ?>


<div class="menu-categ">
    <ul>
        <?php foreach ($categories as $category): ?>
            <?php $link = get_term_link($category->slug, 'category'); ?>
            <li>
                <a href="<?= $link ?>"><?= $category->name ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<h2 class="name-categ">Categorie : <?= get_queried_object()->name; ?></h2>

<?php if (have_posts()) : ?>
    <div class="cat-blog">
        <?php while (have_posts()): the_post() ?>
            <div>
                <?php get_template_part('parts/card.article', 'post'); ?>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="pagination"><?= paginate_links(); ?></div>

<?php else : ?>
    <h1 class="message-catalog">NOT FOUND !</h1>
<?php endif; ?>

<?php get_footer() ?>