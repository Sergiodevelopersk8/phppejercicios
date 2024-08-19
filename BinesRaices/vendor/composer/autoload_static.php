<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb01ef128af56acd3c655f9087cff9cc4
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb01ef128af56acd3c655f9087cff9cc4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb01ef128af56acd3c655f9087cff9cc4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb01ef128af56acd3c655f9087cff9cc4::$classMap;

        }, null, ClassLoader::class);
    }
}