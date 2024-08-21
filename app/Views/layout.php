<?php
$csrf_token = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>

    <link rel="stylesheet" href="/assets/css/styles.css">
    <script src="/assets/script/theme.js"></script>
    <script src="/assets/script/avatars.js"></script>
</head>

<body>
    <div class="container">
        <!-- Sidebar Navigation -->
            <nav class="sidebar">
                <div class="user-info">
                    

                        <img src="/assets/img/users/<?php echo htmlspecialchars($avatar ?? 'default.png'); ?>" alt="User Avatar" class="user-avatar">
              
                    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
                </div> <!-- Welcome message -->
                
                <!-- Navigation menu -->
                    <ul>
                        <li><a href="/dashboard" class="<?= $_SERVER['REQUEST_URI'] === '/dashboard' ? 'active' : '' ?>">Dashboard</a></li>
                        <li><a href="/accounts" class="<?= $_SERVER['REQUEST_URI'] === '/accounts' ? 'active' : '' ?>">Accounts</a></li>
                        <li><a href="/email" class="<?= $_SERVER['REQUEST_URI'] === '/email' ? 'active' : '' ?>">Email</a></li>
                        <li><a href="/admin" class="<?= $_SERVER['REQUEST_URI'] === '/admin' ? 'active' : '' ?>">Admin</a></li>
                    </ul>
                <!-- end -->

                <div class="theme-switcher"> <!-- Theme Switcher -->
                    <form id="theme-form" method="POST">
                        <input type="hidden" name="theme" id="theme-input">
                        <label>
                            <input type="checkbox" class="theme-checkbox" id="theme-toggle">
                        </label>
                    </form>



                    <!-- Settings and Logout -->
                    <div class="sidebar-buttons">
                        <a href="/settings" class="button <?= $_SERVER['REQUEST_URI'] === '/settings' ? 'active' : '' ?>">Settings</a>
                        <a href="/logout" class="button">Logout</a>
                    </div>

</nav>
  

        <!-- Main Content -->
        <main class="content">
            <?php if (isset($content)) include $content; ?>
        </main>
    </div>
</body>

</html>
<?php /*
echo "Token generated: " . $_SESSION['csrf_token'] . "<br/>"; */
?>