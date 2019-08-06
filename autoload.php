<?php

function contributors_plugin_autoload($class)
{

    if (strpos($class, CONTRIBUTORS_PLUGIN_NAMESPACE) === false) {
        return;
    }

    $class_mod = str_replace(CONTRIBUTORS_PLUGIN_NAMESPACE . '\\', '', $class);
    $cl = str_replace('\\', '/', $class_mod);
    $path = __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . $cl . ".php";
    if (file_exists($path)) {
        include $path;
    }
}

spl_autoload_register("contributors_plugin_autoload");
