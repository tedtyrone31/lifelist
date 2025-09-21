<form method="POST" action="<?= BASE_URL; ?>todo/addTodo/<?php echo $_SESSION['user_id']; ?>" class="u_mat10">
    <div class="c_task_input_main_container">
        <input type="hidden" name="page" value="<?= htmlspecialchars($_GET['page'] ?? 'todo') ?>">
        <input type="text" name="todo_title" class="c_task_input" placeholder="Add a task">

        <select name="tag" class="c-tag-options">
            <?php foreach (["default", "personal", "work", "school"] as $tag): ?>
                <option value="<?= $tag ?>"><?= ucfirst($tag) ?></option>
            <?php endforeach; ?>
        </select>

        <div class="c_task_submit_input_container">
            <input value="Add" type="submit" class="c_task_submit_input">
        </div>
    </div>
</form>
