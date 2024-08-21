<!DOCTYPE html>
<html>

<head>
    <title>All Users</title>
    <link rel="stylesheet" href="assets/css/stylez.css">
</head>

<body>

    <h1>All Users</h1>

    <?php if (isset($_SESSION['error'])): ?>
    <p class="error"><?= htmlspecialchars($_SESSION['error']); ?></p>
    <?php unset($_SESSION['error']); ?> <!-- Clear the error after displaying it -->
<?php endif; ?>

    <?php if (!empty($accountsData)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accountsData as $account): ?>
                <tr>
                    <td><?= htmlspecialchars($account['id']); ?></td>
                    <td><?= htmlspecialchars($account['username']); ?></td>
                    <td><?= htmlspecialchars($account['email']); ?></td>
                    <td><?= htmlspecialchars($account['level']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No accounts found.</p>
<?php endif; ?>

    


    
</body>

</html>