<?php // Show success message first
if (!empty($_SESSION['success_message'])): ?>
    <div class="success">
        <?php 
            echo htmlspecialchars($_SESSION['success_message']); 
            unset($_SESSION['success_message']); // remove it after showing
        ?>
    </div>
<?php endif; ?>

<?php if (!empty($data['errors'])): ?>
    <div class="errors">
        <ul>
            <?php foreach ($data['errors'] as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form action="<?php echo BASE_URL; ?>auth" method="POST">
        <input type="hidden" name="form_type" value="register">
        <input type="text" name="username" placeholder="Username" value=""><br>
        <input type="text" name="name" placeholder="Name" value=""><br>
        <input type="email" name="email" placeholder="Email" value=""><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password"><br>
        <button type="submit" name="register">Register</button>
    </form>
     <br><br><br>
    <form action="<?php echo BASE_URL; ?>/auth" method="POST">
        <input type="hidden" name="form_type" value="login">
        <input type="text" name="username" placeholder="Username" value=""><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit" name="login">Login</button>
    </form>  

    <?php ?>