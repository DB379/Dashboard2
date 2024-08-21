<?php
// Connecting to db
require_once '../app/Database.php';

require_once '../app/loader.php';

// Loading the router
require_once 'router.php';

// Loading models, controllers, and helpers
Loader::loadModels();
Loader::loadControllers();
Loader::loadHelpers();

// Initialize the database and models
$db = Database::getInstance()->getConnection();
$userModel = new User($db);

// Initialize the router
$router = new Router();

// Login routes
$router->get('/login', function() use ($userModel) {
    $controller = new LoginController($userModel);
    $controller->showLoginForm();
});

$router->post('/login', function() use ($userModel) {
    $controller = new LoginController($userModel);
    $controller->login();
});

// Register routes
$router->get('/register', function() use ($userModel) {
    $controller = new RegisterController($userModel);
    $controller->showRegisterForm();
});

$router->post('/register', function() use ($userModel) {
    $controller = new RegisterController($userModel);
    $controller->register();
});

// Logout route
$router->post('/logout', function() use ($userModel) {
    $userModel->logout();
});

// Other routes...
$router->get('/dashboard', function() use ($userModel) {
    requireLogin();
    $userModel->regenerateCSRFToken();

    // Fetch avatar details


    // Include layout with the avatar variables
    include '../app/Views/layout.php';
});

$router->get('/accounts', function() use ($userModel) {
    requireLogin();  
    $userModel->regenerateCSRFToken(); 
    $controller = new AdminController($userModel);
    $controller->accountsFetch();  
});

$router->get('/email', function() use ($userModel) {
    requireLogin();  
    $userModel->regenerateCSRFToken(); 
    $content = '../app/Views/email.php';  
    include '../app/Views/layout.php';  
});

$router->get('/admin', function() use ($userModel) {
    requireLogin();  
    $userModel->regenerateCSRFToken(); 
    $controller = new AdminController($userModel);
    $controller->index();
});

$router->post('/admin/submit', function() use ($userModel) {
    requireLogin();
    $controller = new AdminController($userModel);
    $controller->handleFormSubmission();
});


$router->get('/settings', function() use ($userModel) {
    requireLogin();  
    $userModel->regenerateCSRFToken(); 
    $content = '../app/Views/settings.php';  
    include '../app/Views/layout.php';  
});
