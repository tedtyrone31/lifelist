<div class="l_main_ttl_container">
    <h1 class="c_main_ttl"><?= $title ?></h1>
 </div>
         <!-- Filters -->
        <?php include "_filters.php"; ?>
        <!-- Flash Messages -->
         <br>
       <?php include __DIR__ . '/../partials/_messages.php'; ?>
       
        <!-- Task List -->
        <?php 
        include "cartTable.php"; 
        ?>