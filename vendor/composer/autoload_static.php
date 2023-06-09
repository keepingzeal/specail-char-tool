<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit61bfc8000bd7886224a309ce7914c65d
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kzeal\\SpecailCharTool\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kzeal\\SpecailCharTool\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit61bfc8000bd7886224a309ce7914c65d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit61bfc8000bd7886224a309ce7914c65d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit61bfc8000bd7886224a309ce7914c65d::$classMap;

        }, null, ClassLoader::class);
    }
}
