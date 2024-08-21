<?php

class AvatarController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    // Fetch and display the avatar
    public function displayAvatar($username)
    {
        // Get the user's avatar or the default
        $avatar = $this->userModel->getAvatar($username);

        // Check if it's the default avatar
        $isDefaultAvatar = ($avatar === 'default.png');

        // Include the view with the avatar display logic
        include '../app/Views/layout.php'; // Ensure this view file exists
    }

    // Update the avatar
    public function updateAvatar($username, $file)
    {
        // Handle the file upload
        $uploadDir = '../public/assets/img/users/';
        $avatarFilename = $this->uploadFile($file, $uploadDir);

        if ($avatarFilename) {
            // Update the avatar in the database
            $this->userModel->updateAvatar($username, $avatarFilename);
            $_SESSION['success_message'] = "Avatar updated successfully!";
        } else {
            $_SESSION['error_message'] = "Failed to upload avatar.";
        }

        // Redirect back to profile or avatar page
        header('Location: /profile');
        exit();
    }

    // Handle the file upload
    private function uploadFile($file, $uploadDir)
    {
        $targetFile = $uploadDir . basename($file['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];

        // Check if the file is a valid image type
        if (!in_array($imageFileType, $allowedTypes)) {
            return false;
        }

        // Move the uploaded file to the correct location
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return basename($file['name']);
        }

        return false;
    }
}
