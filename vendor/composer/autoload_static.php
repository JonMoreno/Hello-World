<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc63cf982cf7cf8496ed6a8169913f0ea
{
    public static $files = array (
        '955095158f7b489fb05ea17919e32550' => __DIR__ . '/../..' . '/app/core/collections.php',
        '5102b9eff353a1fc2ee2b838224804d7' => __DIR__ . '/../..' . '/app/core/minions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc63cf982cf7cf8496ed6a8169913f0ea::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc63cf982cf7cf8496ed6a8169913f0ea::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
