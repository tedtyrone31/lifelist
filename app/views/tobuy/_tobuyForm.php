<form method="POST" action="<?= BASE_URL; ?>tobuy/addNewItem/<?php echo $_SESSION['user_id']; ?>" class="u_mat10">
    <div class="c_task_input_main_container">
        <input type="hidden" name="page" value="<?= htmlspecialchars($_GET['page'] ?? 'todo') ?>">
        <input type="text" name="tobuy_item" class="c_task_input" placeholder="Add an item">
        <select name="tag" class="c-tag-options">
            <?php 
            $tags = [
                "default"     => "Default", 
                "groceries"   => "Groceries",
                "split"       => "Split", 
                "household"   => "Household", 
                "clothing"    => "Clothing",
                "electronics" => "Electronics",
                "wellness"    => "Personal Care", 
                "gifts"       => "Gifts & Events",
                "tools"       => "Tools & Misc",
                "pets"        => "Pets",
            ];

            foreach ($tags as $key => $label): ?>
                <option value="<?= $key ?>"><?= $label ?></option>
            <?php endforeach; ?>
        </select>

        <div class="c_task_submit_input_container">
            <input value="Add" type="submit" class="c_task_submit_input">
        </div>
    </div>
</form>
