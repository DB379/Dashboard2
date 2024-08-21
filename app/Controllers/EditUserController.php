<?php
class EditUserController
{
    private $editUserModel;

    public function __construct(EditUserModel $editUserModel)
    {
        $this->editUserModel = $editUserModel;
    }

    // Method to handle the deletion of a user
    public function handleDeleteRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
            $userId = $_POST['id']; 
            $result = $this->editUserModel->deleteUserById($userId);
            
            // Set the result message in session for display after redirect
            $_SESSION['delete_message'] = $result;

            header('Location: index.php?page=admin');
            exit();
        }
    }


    // Method to handle the update form submission and apply the PRG pattern
    public function handleFormSubmission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
            $userId = $_POST['id'];
            $submittedUsername = $_POST['username'];
            $submittedEmail = $_POST['email'];
            $submittedLevel = $_POST['level'];
    
            // Call the model's updateUserWithChanges method
            $result = $this->editUserModel->updateUserWithChanges($userId, $submittedUsername, $submittedEmail, $submittedLevel);
    
            // Set the result message in session for display after redirect
            $_SESSION['update_message'] = $result;
    
            // Redirect to the admin page to prevent form resubmission
            header("Location: index.php?page=admin");
            exit();
        }
    }
}
