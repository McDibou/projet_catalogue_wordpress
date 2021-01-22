<form action="<?= esc_url(home_url('/')) ?>">

    <?php
    $categories = get_terms('category');
    $min = !empty($_GET['min']) && ctype_digit($_GET['min']) ? $_GET['min'] : 0;
    $max = !empty($_GET['max']) && ctype_digit($_GET['max']) ? $_GET['max'] : 2000;
    ?>

    <label>Category :
        <select name="s">
            <option value="nothing">-- choose --</option>
            <?php foreach ($categories as $category): ?>
                <?php $link = get_term_link($category->slug, 'category'); ?>
                <option value="<?= $category->name ?>" <?= ($category->name === $_GET['s'] ? 'selected' : '' ) ?>><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>Min :
        <input name="min" type="range" min="0" max="2000" value="<?= $min ?>">
    </label>
    <label>Max :
        <input name="max" type="range" min="0" max="2000" value="<?= $max ?>">
    </label>

    <input type="hidden" value="1" name="page">

    <button type="submit">search</button>
</form>