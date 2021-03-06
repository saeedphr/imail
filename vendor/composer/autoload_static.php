<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb5d357ccc38a11d2a38bbc1a624853a3
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'saeedphr\\imail\\Tests\\' => 21,
            'saeedphr\\imail\\' => 15,
        ),
        'P' => 
        array (
            'PhpImap\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'saeedphr\\imail\\Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'saeedphr\\imail\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PhpImap\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-imap/php-imap/src/PhpImap',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb5d357ccc38a11d2a38bbc1a624853a3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb5d357ccc38a11d2a38bbc1a624853a3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
