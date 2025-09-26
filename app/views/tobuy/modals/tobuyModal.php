
<?php
// $completeStatus = false;
if (!empty($specificItem)): 
    echo $specificItem->tag;
?>
    <div id="editModal" class="modal show">
        <div class="modal-content">
            <span id="closeModal" class="close">
               
                <a href="<?= BASE_URL ?>tobuy"> &times;</a>
            </span>
            <h2>
                 <?php if (!$completeStatus): ?>
                <span class="c_edit_ttl">Edit To-buy</span>
                <br>
                <?php endif; ?>
                <?php 
                $currentTagLabel = isset($tags[$specificItem->tag]) ? $tags[$specificItem->tag] : ucfirst($specificItem->tag);
                ?>
                <span class="c_tag <?= $specificItem->tag; ?>">
                    <?= htmlspecialchars($currentTagLabel) ?>
                </span>
                <span class="c_tag <?= $specificItem->status; ?>">
                    <?= ucfirst($specificItem->status); ?>
                </span><br>
            </h2>
            
            <form id="editForm" method="POST" action="<?= BASE_URL; ?>tobuy/updateTobuy/<?= $specificItem->tobuyId;  ?>">
                <br>
                <div>
                    <label for="edit_task_title">Title:</label>
                    <input class="u_wd100 c_todo_ttl" type="text" 
                           name="tobuy_item" id="edit_task_title" 
                           value="<?= htmlspecialchars($specificItem->tobuyItem); ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                <div>
                    <label for="">Description:</label>
                    <input class="u_wd100" type="text" 
                           name="tobuy_description"  
                           value="<?= $specificItem->tobuyDescription; ?>" 
                           <?= $completeStatus ? "disabled" : "" ?>>
                </div>

                <br>
                <div>
                    <label for="edit_task_status">Category:</label>
                       <select name="tag" class="c-tag-options"  <?= $completeStatus ? "disabled" : "" ?>>
        <?php 
        foreach ($tags as $key => $label): 
            $isSelected = ($specificItem->tag === $key) ? 'selected' : '';
        ?>
            <option value="<?= $key ?>" <?= $isSelected ?>><?= $label ?></option>
        <?php endforeach; ?>
    </select>
                </div>

                <br>
                <div>
                    <label for="edit_task_title">Quantity:</label>
                    &nbsp;
                    <input name="quantity" id="quantity" type="number" style="width: 15%;" value="<?= $specificItem->quantity; ?>" step="any"  <?= $completeStatus ? "disabled" : "" ?>>
                    <select name="unit" id="unit"  <?= $completeStatus ? "disabled" : "" ?>>
                        <?php 
                        $units = [
                            "pcs"    => "pcs",
                            "kg"     => "kg",
                            "g"      => "g",
                            "l"      => "l",
                            "ml"     => "ml",
                            "can"    => "can",
                            "pack"   => "pack",
                            "dozen"  => "dozen",
                            "box"    => "box",
                            "bottle" => "bottle",
                            "set"    => "set",
                        ];

                        $currentUnit = !empty($specificItem->unit) ? $specificItem->unit : "pcs";

                        foreach ($units as $value => $label): ?>
                            <option value="<?= $value ?>" <?= ($value === $currentUnit) ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                 <br>
                <div>
                    <label for="edit_task_title">Price:</label>&nbsp;
                   <input name="price" id="price" type="number" style="width: 24%;" value="<?= $specificItem->price; ?>" step="any"  <?= $completeStatus ? "disabled" : "" ?>>
                </div>

                 <br>
                <div>
                    <label for="edit_task_title">Total:</label>&nbsp;
                    <input step="any" type="number" name="total" id="total" value="<?= $specificItem->total; ?>"  <?= $completeStatus ? "disabled" : "" ?>>
                </div>
                
                <br>
                 <?php if (!$completeStatus): ?>
                <button type="submit" 
                        class="c_save_changes_btn <?= $completeStatus ? "complete-status" : "" ?>"  
                        <?= $completeStatus ? "disabled" : "" ?>>
                    Save changes
                </button>
                <?php endif; ?>
             </form>
                <!-- Delete -->
                 <?php if ($completeStatus): ?>
                    <br>
                    <form action="<?= BASE_URL ?>tobuy/updateTobuyStatus/<?= $specificItem->tobuyId; ?>" method="post" style="display:inline;">
                        <button  style="margin-bottom:10px;"type="submit" name="undo" class="c_todo_undo">Mark as Pending</button>
                    </form>
                    <br>
                <form method="POST" action="<?= BASE_URL; ?>tobuy/markAsDeleted/<?= $specificItem->tobuyId; ?>" style="display:inline;">
                    <input type="hidden" name="todo_id" value="<?= $specificItem->todoId; ?>">
                    <button type="submit" class="c_modal_delete_btn">Delete</button>
                </form>
                <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
