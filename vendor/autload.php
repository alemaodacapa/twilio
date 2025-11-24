<?php
// Minimal autoload stub. This is NOT the full Composer autoload.
// For production, run: composer require twilio/sdk
spl_autoload_register(function($class) {
    $prefixes = [
        'Twilio\\\\' => __DIR__ . '/twilio/src/',
    ];
    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) continue;
        $relative = substr($class, $len);
        $file = $baseDir . str_replace('\\\\', '/', $relative) . '.php';
        if (file_exists($file)) {
            require $file;
            return true;
        }
    }
    $file = __DIR__ . '/classes/' . $class . '.php';
    if (file_exists($file)) require $file;
});
?>
