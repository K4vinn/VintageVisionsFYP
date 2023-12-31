<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit78faeb153e6e4f1c1cc97ee7e58417ec
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit78faeb153e6e4f1c1cc97ee7e58417ec', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit78faeb153e6e4f1c1cc97ee7e58417ec', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit78faeb153e6e4f1c1cc97ee7e58417ec::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
