<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8d5504fed46839db3983588353e3d5da
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dcblogdev\\PdoWrapper\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dcblogdev\\PdoWrapper\\' => 
        array (
            0 => __DIR__ . '/..' . '/dcblogdev/pdo-wrapper/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8d5504fed46839db3983588353e3d5da::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8d5504fed46839db3983588353e3d5da::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8d5504fed46839db3983588353e3d5da::$classMap;

        }, null, ClassLoader::class);
    }
}
