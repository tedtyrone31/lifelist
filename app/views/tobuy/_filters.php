<br>
<form class="l_filter_form" method="get" action="<?= BASE_URL ?>index.php">
    <input type="hidden" name="url" value="tobuy/index">

    <?php
    
    $tags = [
        "default"     => "Default", 
        "groceries"   => "Groceries",
        "split"       => "Split", 
        "household"   => "Household", 
        "clothing"    => "Clothing",
        "electronics" => "Electronics",
        "wellness"    => "Personal Care", // <-- map display name
        "gifts"       => "Gifts & Events",
        "tools"       => "Tools & Misc",
        "pets"        => "Pets",
    ];
    ?>
   <?php foreach ($tags as $key => $label): ?>
    <div class="c_tag <?= $key ?>">
        <input type="checkbox" name="tags[]" value="<?= $key ?>"
            <?= isset($selectedTags) && in_array($key, $selectedTags) ? 'checked' : '' ?>>
        <span><?= $label ?></span>
    </div>
<?php endforeach; ?>

    <button type="submit" class="c_filter_tags">Filter</button>
</form>
