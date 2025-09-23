<?php if (!empty($todos)): ?>
    <h4 class="status-pending" style="margin-left: -5px;">Pending</h4>
    <div class="table-wrapper">
        <table class="c_table_type02">
            <tbody>
                <?php foreach ($todos as $todo): ?>
                    <tr>
                        <td>
                            <div class="c_task_list_left u_flex">
                                <div class="u_flex">

                                    <!-- Checkbox -->
                                    <form method="POST" action="<?= BASE_URL; ?>todo/update_status/<?= $todo->todoId;  ?>" style="align-self: center;">
                                        <input type="hidden" name="todo_id" value="<?= $todo->userId; ?>">
                                        <input class="c-complete-checkbox" type="checkbox" onchange="this.form.submit()">
                                    </form>

                                    <!-- Title Button -->
                                    <form method="POST" action="<?= BASE_URL; ?>todo/index/<?= $todo->todoId;  ?>" class="u_wd100">
                                    <!-- <form method="POST" action="<?= BASE_URL; ?>todo/update_status/<?= $todo->todoId;  ?><?= !empty($_GET['tags']) ? '&' . http_build_query(['tags' => $_GET['tags']]) : '' ?>" class="u_wd100"> -->
                                        <button class="task-title">
                                            <span class="tag-box <?= htmlspecialchars($todo->tag) ?>"></span>
                                            <?= htmlspecialchars(ucfirst($todo->todoTitle)) ?>
                                        </button>
                                    </form>
                                </div>

                                <!-- Delete -->
                                <form method="POST" action="<?= BASE_URL; ?>todo/deleteTodo/<?= $todo->todoId; ?>" style="display:inline;">
                                    <input type="hidden" name="todo_id" value="<?= $todo->todoId; ?>">
                                    <button type="submit" class="c_task_list_close_btn">X</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No tasks yet. Add one above!</p>
<?php endif; ?>
