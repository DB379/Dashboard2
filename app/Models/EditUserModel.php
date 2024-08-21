<?php
class EditUserModel
{
    private $db;
    private $userModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->userModel = new User($db); // Initialize User model
    }

    public function deleteUserById($userId) {
        try {
            // Call the deleteUser method from the User model
            $result = $this->userModel->deleteUser($userId);
    
            // Check if the deletion was successful
            if ($result) {
                return "Account deleted successfully!";
            } else {
                return "Failed to delete user.";
            }
        } catch (Exception $e) {
            return "An error occurred while deleting the user.";
        }
    }
    

    // Update only changed fields for a user
    public function updateUserWithChanges($userId, $submittedUsername, $submittedEmail, $submittedLevel)
    {
        // Fetch all users and find the current user
        $allUsers = $this->userModel->fetchTable(); // vadimo sve korisnike
        $currentUser = null;

        foreach ($allUsers as $user) { // prolazimo kroz sve korisnike i trazimo trenutnog korisnika po id-u
            if ($user['id'] == $userId) {
                $currentUser = $user;
                break;
            }
        }

        if (!$currentUser) {
            return "User not found.";
        }

        // Prepare an array to hold fields that need to be updated
        $updateFields = [];
        $updateValues = [];

        // Compare each field and add to update array if different
        if ($submittedUsername !== $currentUser['username']) {
            $updateFields[] = "username = :username";
            $updateValues[':username'] = $submittedUsername;
        }

        if ($submittedEmail !== $currentUser['email']) {
            $updateFields[] = "email = :email";
            $updateValues[':email'] = $submittedEmail;
        }

        if ($submittedLevel !== $currentUser['level']) {
            $updateFields[] = "level = :level";
            $updateValues[':level'] = $submittedLevel;
        }

        // Only run the update if there are fields to update
        if (!empty($updateFields)) {
            // Build the SQL query dynamically based on the fields to update
            $sql = "UPDATE accounts SET " . implode(", ", $updateFields) . " WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            // Bind the values to the prepared statement
            foreach ($updateValues as $param => $value) {
                $stmt->bindValue($param, $value);
            }
            $stmt->bindValue(':id', $userId, PDO::PARAM_INT);

            // Execute the update

            if ($stmt->execute()) {
                return "User updated successfully!";
            } else {
                return "Failed to update user.";
            }
        } else {
            return "No changes detected.";
        }
    }
}

