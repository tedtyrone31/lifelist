<div id="sessionModal">
    <div class="session-content">
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])): ?>
            <p>✅  <strong>LOGGED IN</strong></p>
             <!-- <a href="<?= BASE_URL ?>auth/logout">Logout</a> -->
            <span class="nav-right">
                <?php if(isset($_SESSION['user_name'])): ?>
                Hello <?= htmlspecialchars($_SESSION['user_name']) ?> |
                <!-- <a href="<?= BASE_URL ?>user/profile">Profile</a> | -->
                <a href="<?= BASE_URL ?>auth/logout">Logout</a>
                <?php endif; ?>
            </span>
        <?php else: ?>
            <p>❌ Not logged in</p>
            <!-- <a href="<?= BASE_URL; ?>/auth">Login</a> -->
        <?php endif; ?>
    </div>
</div>

<style>
    #sessionModal {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.85);
        color: #fff;
        padding: 12px 18px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        font-family: Arial, sans-serif;
        z-index: 1000;
        animation: fadeIn 0.3s ease-in-out;
    }

    #sessionModal a {
        color: #ffcc00;
        text-decoration: none;
        margin-left: 10px;
    }

    #sessionModal a:hover {
        text-decoration: underline;
    }

    /* @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    } */
</style>
