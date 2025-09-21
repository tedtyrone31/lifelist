<div class="c_list_main_container u_mat20">
    <form method="get" action="">
        <input type="hidden" name="page" value="todo">
        <div class="c_list_main_container u_mat30">
            <?php
            $tags = ["default", "personal", "work", "school"];
            foreach ($tags as $tag): ?>
                <div class="c_tag <?= $tag ?>">
                    <input type="checkbox" name="tags[]" value="<?= $tag ?>"
                        <?= isset($_GET['tags']) && in_array($tag, $_GET['tags']) ? 'checked' : '' ?>>
                    <span><?= ucfirst($tag) ?></span>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="c_filter_tags">Filter</button>
        </div>
    </form>
 </div>
