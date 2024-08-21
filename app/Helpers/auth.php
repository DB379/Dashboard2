<?php

function isAuthenticated() {
    session_start();
    return isset($_SESSION['username']);
}

function requireLogin() {
    if (!isAuthenticated()) {
        header('Location: /login');
        exit();
    }
}
