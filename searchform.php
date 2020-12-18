<form action="<?= esc_url(home_url('/')) ?>">

    <?php $categories = get_terms('category'); ?>

    <select name="s">
        <option value="nothing">-- choose --</option>
        <?php foreach ($categories as $category): ?>
            <?php $link = get_term_link($category->slug, 'category'); ?>
            <option value="<?= $category->name ?>" <?= ($category->name === $_GET['s'] ? 'selected' : '' ) ?>><?= $category->name ?></option>
        <?php endforeach; ?>
    </select>

    <input name="min" type="range" min="0" max="2000" value="<?= $_GET['min'] ?>">
    <input name="max" type="range" min="0" max="2000" value="<?= $_GET['max'] ?>">

    <input type="hidden" value="1" name="page">

    <button type="submit">search</button>
</form>