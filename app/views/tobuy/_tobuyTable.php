<?php if (!empty($itemPending)): ?>
    <h4 class="status-pending" style="margin-left: -5px;">Pending</h4>
    <div class="table-wrapper">
        <table class="c_table_type02">
            <tbody>
                <?php foreach ($itemPending as $tobuy): ?>
                    <tr>
                        <td>
                            <div class="c_task_list_left u_flex">
                                <div class="u_flex">

                                    <!-- Checkbox -->
                                    <form method="POST" action="<?= BASE_URL; ?>tobuy/updateTobuyStatus/<?= $tobuy->tobuyId;  ?>" style="align-self: center;">
                                        <input class="c-complete-checkbox" type="checkbox" onchange="this.form.submit()">
                                    </form>

                                    <!-- Title Button -->
                                    <form method="POST" action="<?= BASE_URL; ?>tobuy/index/<?= $tobuy->tobuyId;  ?>" class="u_wd100">
                                        <button class="task-title">
                                            <span class="tag-box <?= htmlspecialchars($tobuy->tag) ?>"></span>
                                            <?= htmlspecialchars(ucfirst($tobuy->tobuyItem)) ?>
                                        </button>
                                    </form>
                                </div>

                                <!-- Delete -->
                                <form method="POST" action="<?= BASE_URL; ?>tobuy/deleteItem/<?= $tobuy->tobuyId; ?>" style="display:inline;">
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
    <p>No item yet. Add one above!</p>
<?php endif; ?>
