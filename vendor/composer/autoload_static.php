<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8f2bf56de21b20d2ece26756eb3703d0
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Views\\' => 10,
            'App\\Controllers\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Views\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Views',
        ),
        'App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8f2bf56de21b20d2ece26756eb3703d0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8f2bf56de21b20d2ece26756eb3703d0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8f2bf56de21b20d2ece26756eb3703d0::$classMap;

        }, null, ClassLoader::class);
    }
}
