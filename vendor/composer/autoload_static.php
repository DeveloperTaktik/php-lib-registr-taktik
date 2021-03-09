<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd9e1273dce903fe809f320c51a852016
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'TaktikRegistr' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd9e1273dce903fe809f320c51a852016::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd9e1273dce903fe809f320c51a852016::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd9e1273dce903fe809f320c51a852016::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitd9e1273dce903fe809f320c51a852016::$classMap;

        }, null, ClassLoader::class);
    }
}
