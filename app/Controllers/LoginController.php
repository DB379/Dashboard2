<?php

class LoginController {
    private $userModel;
    private $sessionTimeout = 1800; // 30 minutes

    public function __construct($userModel) {
        $this->userModel = $userModel;
        $this->checkSessionTimeout();
    }

    public function showLoginForm() {
        session_start();
        $this->userModel->regenerateCSRFToken();
        require '../app/Views/login.php';
    }

    public function login() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrf_token = $_POST['csrf_token'] ?? '';
            if (!$this->userModel->validateCsrfToken($csrf_token)) {
                $this->handleFormError("Invalid CSRF token.", "login");
            }

            $username = $this->userModel->sanitizeInput($_POST['username']);
            $password = $this->userModel->sanitizeInput($_POST['password']);
            $rememberMe = isset($_POST['remember_me']); 

            if (!$this->userModel->validateUsername($username) || !$this->userModel->validatePassword($password)) {
                $this->handleFormError("Invalid input.", "login");
            }

            try {
                $this->userModel->checkRateLimit();
                $user = $this->userModel->authenticate($username, $password);

                if ($user) {
                    $status = $this->userModel->checkUserStatus($username);
                    $this->handleUserStatus($username, $status, $rememberMe);
                } else {
                    $this->userModel->incrementFailedLogin($username);
                    $this->handleFormError("Invalid username or password.", "login");
                }
            } catch (Exception $e) {
                $this->handleFormError($e->getMessage(), "login");
            }
        } else {
            $this->showLoginForm();
        }
    }

    private function handleUserStatus($username, $status, $rememberMe) {
        switch ($status) {
            case 0:
                $this->handleSuccessfulLogin($username, $rememberMe);
                break;
            case 1:
                $this->handleFormError("Your account has been muted!", "login");
                break;
            case 2:
                $this->handleFormError("Account locked by Administrator", "login");
                break;
            case 3:
                $this->handleFormError("Account banned permanently", "login");
                break;
            default:
                $this->handleFormError("Unknown account status", "login");
                break;
        }
    }

    private function handleSuccessfulLogin($username, $rememberMe) {
        session_regenerate_id(true);
        $sessionKey = $this->userModel->generateSessionKey($username);
        $_SESSION['username'] = $username;
        $_SESSION['session_key'] = $sessionKey;
        $_SESSION['last_activity'] = time();
        $_SESSION['remember_me'] = $rememberMe;

        $this->userModel->setLoggedStatus($username, 1);
        $this->setRememberMeCookies($username, $sessionKey, $rememberMe);

        $this->userModel->clearLoginAttempts();
        $this->userModel->regenerateCSRFToken();

        header('Location: /dashboard');
        exit();
    }

    private function setRememberMeCookies($username, $sessionKey, $rememberMe) {
        $expireTime = $rememberMe ? time() + $this->sessionTimeout : 0;
        $secure = isset($_SERVER['HTTPS']);
        $path = '/';

        setcookie('username', $username, $expireTime, $path, "", $secure, true);
        setcookie('session_key', $sessionKey, $expireTime, $path, "", $secure, true);
    }

    private function handleFormError($message, $redirect) {
        $_SESSION['login_error'] = $message;
        $this->userModel->regenerateCSRFToken();
        header("Location: /login");
        exit();
    }

    private function checkSessionTimeout() {
        if (isset($_SESSION['last_activity'])) {
            $timeout = isset($_SESSION['remember_me']) && $_SESSION['remember_me'] ? $this->sessionTimeout : 1800; // 30 minutes

            if ((time() - $_SESSION['last_activity']) > $timeout) {
                $this->userModel->logout();
            }
        }
        $_SESSION['last_activity'] = time();
    }
}
