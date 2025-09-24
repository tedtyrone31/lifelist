
<?php
// $completeStatus = false;
if (!empty($specificTodo)): 
    echo $specificTodo->tag;
    echo $specificTodo->todoDescription;
?>
    <div id="editModal" class="modal show">
        <div class="modal-content">
            <span id="closeModal" class="close">
               
                <a href="<?= BASE_URL ?>todo"> &times;</a>
            </span>
            <h2>
                 <?php if (!$completeStatus): ?>
                <span class="c_edit_ttl">Edit To-Do</span>
                <br>
                <?php endif; ?>
                <span class="c_tag <?= $specificTodo->tag; ?>">
                    <?= ucfirst($specificTodo->tag); ?>
                </span>
                <span class="c_tag <?= $specificTodo->status; ?>">
                    <?= ucfirst($specificTodo->status); ?>
                </span><br>
            </h2>
            
            <form id="editForm" method="POST" action="<?= BASE_URL; ?>todo/updateTodo/<?= $specificTodo->todoId;  ?>">
                <br>
                <div>
                    <label for="edit_task_title">Title:</label>
                    <input class="u_wd100 c_todo_ttl" type="text" 
                           name="todo_title" id="edit_task_title" 
                           value="<?= htmlspecialchars($specificTodo->todoTitle); ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                <div>
                    <label for="">Description:</label>
                    <input class="u_wd100" type="text" 
                           name="todo_description"  
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
                    <input name="due_date" type="date" style="width: 37%;" 
                           value="<?= $specificTodo->dueDate; ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                <div>
                    <label for="">Time:</label>
                    <input name="due_time" type="time" style="width: 30%;" 
                           value="<?= $specificTodo->dueTime ?? ''; ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                <div>
                    <label for="edit_task_status">Alarm:</label>
                    <select name="alarm_status" id="edit_task_status" <?= $completeStatus ? "disabled" : "" ?>>
                        <option value="on" <?= ($specificTodo->alarmStatus === 'on') ? 'selected' : ''; ?>>On</option>
                        <option value="off" <?= ($specificTodo->alarmStatus === 'off') ? 'selected' : ''; ?>>Off</option>
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
                <!-- Delete -->
                 <?php if ($completeStatus): ?>
                    <br>
                    <form action="<?= BASE_URL ?>todo/updateTodoStatus/<?= $specificTodo->todoId; ?>" method="post" style="display:inline;">
                        <button  style="margin-bottom:10px;"type="submit" name="undo" class="c_todo_undo">Mark as Pending</button>
                    </form>
                    <br>
                <form method="POST" action="<?= BASE_URL; ?>todo/deleteTodo/<?= $specificTodo->todoId; ?>" style="display:inline;">
                    <input type="hidden" name="todo_id" value="<?= $specificTodo->todoId; ?>">
                    <button type="submit" class="c_modal_delete_btn">Delete</button>
                </form>
                <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
