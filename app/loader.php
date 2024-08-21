<?php
class Loader {
    public static function loadDirectory($directory) {
        $files = glob($directory . '/*.php'); // Get all PHP files in the directory

        foreach ($files as $file) {
            require_once $file;
        }
    }

    public static function loadModels() {
        self::loadDirectory('../app/Models');
    }

    public static function loadControllers() {
        self::loadDirectory('../app/Controllers');
    }

    public static function loadHelpers() {
        self::loadDirectory('../app/Helpers');
    }
}