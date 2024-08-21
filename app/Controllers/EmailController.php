<?php

namespace App\Controllers;

class EmailController {
    public static function index() {
        require_once '../app/Views/layout.php';
        include '../app/Views/email.php';
    }
}
