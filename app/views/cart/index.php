<div class="l_main_ttl_container">
    <h1 class="c_main_ttl"><?= $title ?></h1>
    <div>
        <h1 class="c_main_content_count"></h1>
    </div>
 </div>
         <!-- Filters -->
        <?php include "_filters.php"; ?>
        <!-- Flash Messages -->
       <?php include __DIR__ . '/../partials/_messages.php'; ?>
        <br><br>
        <!-- Task List -->
        <?php 
        include "cartTable.php"; 
        ?>