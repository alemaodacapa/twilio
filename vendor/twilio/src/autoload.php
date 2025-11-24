<?php

spl_autoload_register(function ($class) {
    // Converte namespace em caminho
    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});

// Carrega funções do Composer (placeholder)
require_once __DIR__ . "/composer/autoload_real.php";
