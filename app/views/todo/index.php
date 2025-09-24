<div class="l_main_ttl_container">
    <h1 class="c_main_ttl"><?= $title ?></h1>
    <div>
        <h1 class="c_main_content_count"><?= $pendingCount; ?></h1>
    </div>
 </div>
     <!-- Filters -->
        <?php include "_filters.php"; ?>
        <!-- Flash Messages -->
        <?php 
        include "_messages.php"; 
        ?>
        <!-- Add Task Form -->
        <?php 
        include "_todoForm.php"; 
        ?>
        <br>
        <!-- Task List -->
        <?php 
        include "_todoTable.php"; 
        ?>

        <!-- Modal -->
        <?php if (!empty($specificTodo)) : ?>
            <?php include "modals/todoModal.php"; ?>
        <?php endif; ?>