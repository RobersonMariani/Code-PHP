<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit53d5bdd6d4527a1db088a6908a518fbb
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit53d5bdd6d4527a1db088a6908a518fbb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit53d5bdd6d4527a1db088a6908a518fbb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit53d5bdd6d4527a1db088a6908a518fbb::$classMap;

        }, null, ClassLoader::class);
    }
}