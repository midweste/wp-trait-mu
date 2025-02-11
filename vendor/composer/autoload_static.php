<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85b64324b9e0bf87ef0ddea3d14bd520
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPTrait\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPTrait\\' => 
        array (
            0 => __DIR__ . '/..' . '/mehrshaddarzi/wp-trait/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit85b64324b9e0bf87ef0ddea3d14bd520::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85b64324b9e0bf87ef0ddea3d14bd520::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit85b64324b9e0bf87ef0ddea3d14bd520::$classMap;

        }, null, ClassLoader::class);
    }
}
