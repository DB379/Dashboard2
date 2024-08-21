<!DOCTYPE html>
<html>

<head>
    <title>All Users</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

    <h1>All Users</h1>

    <?php if (isset($_SESSION['delete_message'])): ?>
    <div id="deleteMessage" class="deleteMessage">
        <?= $_SESSION['delete_message']; ?>
    </div>
    <?php unset($_SESSION['delete_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['update_message'])): ?>
    <div id="updateMessage" class="successMessage">
        <?= $_SESSION['update_message']; ?>
    </div>
    <?php unset($_SESSION['update_message']); ?>
<?php endif; ?>

    <?php if (!empty($accountsData)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accountsData as $account): ?>
                <tr>
                    <td><?= htmlspecialchars($account['id']); ?></td>
                    <td><?= htmlspecialchars($account['username']); ?></td>
                    <td><?= htmlspecialchars($account['email']); ?></td>
                    <td><?= htmlspecialchars($account['level']); ?></td>
                    <td>
                        <!-- Button to open the modal -->
                        <button class="edit-btn"
                            data-id="<?= htmlspecialchars($account['id']); ?>"
                            data-username="<?= htmlspecialchars($account['username']); ?>"
                            data-email="<?= htmlspecialchars($account['email']); ?>"
                            data-level="<?= htmlspecialchars($account['level']); ?>"
                            onclick="openModal(<?= htmlspecialchars($account['id']); ?>)">
                            Edit
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No accounts found.</p>
<?php endif; ?>

    <!-- Modal structure -->
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit User</h2>
            <form id="editUserForm" action="/admin/submit" method="POST">

                <input type="hidden" name="id" id="editUserId">
                <input type="hidden" name="action" id="formAction" value="update">


                <label for="editUsername">Username:</label>
                <input type="text" name="username" id="editUsername" required>

                <label for="editEmail">Email:</label>
                <input type="email" name="email" id="editEmail" required>

                <label for="editLevel">Level:</label>
                <input type="number" name="level" id="editLevel" required>

                <div class="button-group">

                    <button type="button" class="save-btn" onclick="submitUpdate()">Save changes</button>
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="button" class="delete-btn" onclick="submitDelete(event)">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal structure -->

    <script src="assets/script/modal.js"></script>
    <script src="assets/script/testing.js"></script>

</body>

</html>