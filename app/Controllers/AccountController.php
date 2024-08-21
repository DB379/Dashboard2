<?php

namespace App\Controllers;

class AccountController {
    public static function index() {
        require_once '../app/Views/layout.php';
        include '../app/Views/accounts.php';
    }
}