<nav class="l_nav_area drawer-nav u_mab30" role="navigation">
		<ul class="c_nav_type01">
			<button type="button" class="drawer-toggle drawer-hamburger"> 
			  <span class="drawer-hamburger-icon"></span> 
			</button>
			<br>
			<div style="text-align: center;">
				<img src="../public/images/main_logo.png" alt="" class="c_main_logo">
			</div>
			<br>
			<li class="<?= ($activeMenu=="dashboard")?"active":"" ?>"><a href="<?= BASE_URL ?>dashboard">Dashboard</a></li>
			<li class="<?= ($activeMenu=="todo")?"active":"" ?>"><a href="<?= BASE_URL ?>todo">Todo</a></li>
			<li class="<?= ($activeMenu=="tobuy")?"active":"" ?>"><a href="<?= BASE_URL ?>tobuy">To-Buy</a></li>
			<li class="<?= ($activeMenu=="cart")?"active":"" ?>"><a href="<?= BASE_URL ?>cart">Cart History</a></li>
	
			
		 <?php if ($activeMenu == "todo"): ?>
            <?php if (!empty($todosCompleted)): ?>
				<br>
			<hr style="margin:0 20px;">
			<br>
				<p class="status-completed">Completed <span class="c_completed_count"><?= $completedCount; ?></span></p>
            <?php foreach ($todosCompleted as $todo): ?>
                <li class="c-completed-nav-list-item">
                	<div style="margin-left: 15px;">  
						<a class="c-completed-title-link" href="<?= BASE_URL ?>todo/<?= $todo->todoId;?>/completed"><?php echo $todo->todoTitle; ?><span class="nav-tag-box tag-box <?= $todo->tag;?>"></span></a>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php endif; ?>
			</ul>
		<?php endif; ?>

		<br>
		 <?php if ($activeMenu == "tobuy"): ?>
            <?php if (!empty($itemCompleted)): ?>
				<br>
			<hr style="margin:0 20px;">
			<br>
				<p class="status-completed">Completed <span class="c_completed_count"><?= $completedCount; ?></span></p>
            <?php foreach ($itemCompleted as $tobuy): ?>
                <li class="c-completed-nav-list-item">
                	<div style="margin-left: 15px;">  
						<a class="c-completed-title-link" href="<?= BASE_URL ?>tobuy/<?= $tobuy->tobuyId;?>/completed"><?php echo $tobuy->tobuyItem; ?><span class="nav-tag-box tag-box <?= $tobuy->tag;?>"></span></a>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php endif; ?>
			</ul>
		<?php endif; ?>
		
		<br>
</nav>
