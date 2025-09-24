<br>
<form class="l_filter_form" method="get" action="<?= BASE_URL ?>index.php">
    <input type="hidden" name="url" value="todo/index">

    <?php
    $tags = ["default", "personal", "work", "school"];
    foreach ($tags as $tag): ?>
        <div class="c_tag <?= $tag ?>">
            <input type="checkbox" name="tags[]" value="<?= $tag ?>"
                <?= isset($selectedTags) && in_array($tag, $selectedTags) ? 'checked' : '' ?>>
            <span><?= ucfirst($tag) ?></span>
        </div>
    <?php endforeach; ?>

    <button type="submit" class="c_filter_tags">Filter</button>
</form>
