<?php
spl_autoload_register(
    function ($class) {
        $classDir = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, __DIR__ . '/../' . $class) . '.php';
        require $classDir;
    }
);
