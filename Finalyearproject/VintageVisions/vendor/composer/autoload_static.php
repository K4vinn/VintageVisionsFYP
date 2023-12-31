<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit78faeb153e6e4f1c1cc97ee7e58417ec
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit78faeb153e6e4f1c1cc97ee7e58417ec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit78faeb153e6e4f1c1cc97ee7e58417ec::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit78faeb153e6e4f1c1cc97ee7e58417ec::$classMap;

        }, null, ClassLoader::class);
    }
}
