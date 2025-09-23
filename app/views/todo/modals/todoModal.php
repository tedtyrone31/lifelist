
<?php
$completeStatus = false;
if (!empty($specificTodo)): 
?>
    <div id="editModal" class="modal show">
        <div class="modal-content">
            <span id="closeModal" class="close">
               
                <a href="<?= BASE_URL ?>todo"> &times;</a>
            </span>
            <h2>
                Edit To-Do 
                &nbsp;&nbsp;&nbsp;
                <span class="c_tag <?= $specificTodo->tag; ?>">
                    <?= ucfirst($specificTodo->tag); ?>
                </span>
                &nbsp;
                <span class="c_tag <?= $specificTodo->status; ?>">
                    <?= ucfirst($specificTodo->status); ?>
                </span>
            </h2>
            
            <form id="editForm" method="POST" action="../public/index.php?action=update_task&type=todo">
                <input type="hidden" name="task_id" id="edit_task_id" value="<?= $specificTodo->todoId; ?>">
                
                <br>
                <div>
                    <label for="edit_task_title">Title:</label>
                    <input class="u_wd100 c_todo_ttl" type="text" 
                           name="task_title" id="edit_task_title" 
                           value="<?= htmlspecialchars($specificTodo->todoTitle); ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                <div>
                    <label for="">Description:</label>
                    <input class="u_wd100" type="text" 
                           name="task_description"  
                           value="<?= htmlspecialchars($specificTodo->todoDescription ?? ''); ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                <div>
                    <label for="edit_task_status">Tag:</label>
                    <select name="tag" id="edit_task_status" <?= $completeStatus ? "disabled" : "" ?>>
                        <option value="default" <?= ($specificTodo->tag === 'default') ? 'selected' : ''; ?>>Default</option>
                        <option value="personal" <?= ($specificTodo->tag === 'personal') ? 'selected' : ''; ?>>Personal</option>
                        <option value="work" <?= ($specificTodo->tag === 'work') ? 'selected' : ''; ?>>Work</option>
                        <option value="school" <?= ($specificTodo->tag === 'school') ? 'selected' : ''; ?>>School</option>
                    </select>
                </div>
                
                <br>
                <div>
                    <label for="">Due Date:</label>
                    <input name="due_date" type="date" style="width: 28%;" 
                           value="<?= $specificTodo->due_date ?? ''; ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                <div>
                    <label for="">Time:</label>
                    <input name="due_time" type="time" style="width: 24%;" 
                           value="<?= $specificTodo->due_time ?? ''; ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                <div>
                    <label for="edit_task_status">Alarm:</label>
                    <select name="alarm_status" id="edit_task_status" <?= $completeStatus ? "disabled" : "" ?>>
                        <option value="on" <?= ($specificTodo->alarm_status === 'on') ? 'selected' : ''; ?>>On</option>
                        <option value="off" <?= ($specificTodo->alarm_status === 'off') ? 'selected' : ''; ?>>Off</option>
                    </select>
                </div>
                
                <br>
                <div>
                    <label for="">Alarm Sound:</label><br><br>
                    <input name="alarm_sound" type="file" <?= $completeStatus ? "disabled" : "" ?>>
                    <?php if (!empty($specificTodo->alarm_sound)): ?>
                        <p>Current File: <?= htmlspecialchars($specificTodo->alarm_sound); ?></p>
                    <?php endif; ?>
                </div>
                
                <br><br>
                <button type="submit" 
                        class="c_save_changes_btn <?= $completeStatus ? "complete-status" : "" ?>"  
                        <?= $completeStatus ? "disabled" : "" ?>>
                    Save changes
                </button>
            </form>
        </div>
    </div>
<?php endif; ?>
