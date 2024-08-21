<?php



class AdminController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        global $error, $accountsData;

        $error = null;  // Initialize an error variable
        $accountsData = [];

        try {
            // Fetch data using the UserModel's fetchTable method
            $accountsData = $this->userModel->fetchTable();
        } catch (Exception $e) {
            // If there is an error, catch the exception and store the error message
            $error = $e->getMessage();
        }

        // Set the view to be loaded
        $content = '../app/Views/admin.php';

        include '../app/Views/layout.php';  // Pass data to the layout
    }
    
    public function accountsFetch()
{
    // Clear any previous session errors
    unset($_SESSION['error']);

    $accountsData = [];

    try {
        // Fetch data using the UserModel's fetchTable method
        $accountsData = $this->userModel->fetchTable();
    } catch (Exception $e) {
        // Store the error in the session instead of a local variable
        $_SESSION['error'] = $e->getMessage();
    }

    // Set the view to be loaded for accounts
    $content = '../app/Views/accounts.php';

    include '../app/Views/layout.php';  // Pass data to the layout
}


public function handleFormSubmission()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];
        $userId = $_POST['id'];
        $username = $_POST['username']; // Assuming username is passed in the form

        if ($action === 'update') {
            $this->updateUser($userId, $_POST);
            $_SESSION['update_message'] = "Account $username updated successfully!";
        } elseif ($action === 'delete') {
            $this->deleteUser($userId);
            $_SESSION['delete_message'] = "Account $username deleted successfully!";
        }

        // Redirect back to the admin page after the action is completed
        header('Location: /admin');
        exit();
    }
}


    private function updateUser($userId, $data)
    {
        try {
            // Assuming the User model has an updateUser method
            $this->userModel->updateUser($userId, $data['username'], $data['email'], $data['level']);
        } catch (Exception $e) {
            $_SESSION['update_message'] = "Failed to update user: " . $e->getMessage();
        }
    }

    private function deleteUser($userId)
    {
        try {
            // Assuming the User model has a deleteUser method
            $this->userModel->deleteUser($userId);
        } catch (Exception $e) {
            $_SESSION['delete_message'] = "Failed to delete user: " . $e->getMessage();
        }
    }
}
