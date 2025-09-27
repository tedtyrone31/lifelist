
<?php if (!empty($_SESSION['success_message'])): ?>
  <?php $successMessage = $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
<?php endif; ?>
<div class="log-in-wrapper" id="auth-container"
     data-show-register="<?= $data['showRegister'] ? 'true' : 'false' ?>">
    <!-- Login Form (added class) -->
    <form class="form login-form" action="<?php echo BASE_URL; ?>/auth" method="POST">
      <input type="hidden" name="form_type" value="login">
      <h2>Get Started</h2>
    <!-- Login errors -->
    <?php if (!empty($data['loginErrors'])): ?>
      <div class="errors">
        <ul>
          <?php foreach ($data['loginErrors'] as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
      <input type="text" name="username" placeholder="Username" value="">
      <input type="password" name="password" placeholder="Password">
      <button type="submit" name="login">Login</button>
    </form>

    <!-- Register Form  -->
    <form class="form register-form" action="<?php echo BASE_URL; ?>/auth" method="POST">
      <input type="hidden" name="form_type" value="register">
      <h2>Create Account</h2>
    <!-- show registration success here-->
    <?php if (!empty($successMessage)): ?>
    <div class="flash-message success">
        <?= htmlspecialchars($successMessage) ?>
    </div>
<?php endif; ?>
       <!-- registration errors -->
    <?php if (!empty($data['registerErrors'])): ?>
      <div class="errors">
        <ul>
          <?php foreach ($data['registerErrors'] as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
      <input type="text" name="username" placeholder="Username" value="">
      <input type="text" name="name" placeholder="Name" value="">
      <input type="email" name="email" placeholder="Email" value="">
      <input type="password" name="password" placeholder="Password">
      <input type="password" name="confirm_password" placeholder="Confirm Password">
      <button type="submit" name="register">Sign Up</button>
    </form>

    <!-- Panel that will COVER one side when toggled -->
    <div class="auth-panel" id="auth-panel">
      <div class="panel-content">
        <h2 id="panel-title">Don't have an account?</h2>
        <p id="panel-text">Organize tasks and to-buys <br> in one place—start today.</p>
        <button type="button" id="toggle-btn">Sign Up</button>
      </div>
    </div>

</div>
    <?php ?>