<?php

namespace App\Controllers;

class DashboardController {
    public static function index() {
        $content = '../app/Views/dashboard.php';
        include '../app/Views/dashboard.php';  // Corrected filename
    }
    
}
