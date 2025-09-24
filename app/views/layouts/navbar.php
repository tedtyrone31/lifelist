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
            <?php if (!empty($todosCompleted)): ?>
				<br>
			<hr style="margin:0 20px;">
			<br>
				<p class="status-completed">Completed</p>
            <?php foreach ($todosCompleted as $todo): ?>
                <li class="c-completed-nav-list-item">
                	<div style="margin-left: 15px;position:relative;">  
						<!-- <a class="c-completed-title-link <?php echo $todo->todoTitle; ?>" href="../public/index.php?page=todo&task_id=<?= $task['task_id'] ?>&task_status=<?= $task['task_status'] ?><?= !empty($_GET['tags']) ? '&' . http_build_query(['tags' => $_GET['tags']]) : '' ?>"><?= htmlspecialchars(substr($task['task_title'],0,30)) ?></a> -->
						<a class="c-completed-title-link"><?php echo $todo->todoTitle; ?><span class="nav-tag-box tag-box <?php echo $todo->tag; ?>"></span></a>  
                    </div>
                </li>
            <?php endforeach; ?>
            <?php endif; ?>
			</ul>
		<?php endif; ?>
		<br>
</nav>
