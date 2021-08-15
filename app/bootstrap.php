<?php
error_reporting(E_ALL);
session_start();
require ROOT . '/app/Autoloader.php';
require ROOT . '/app/etc/config.php';
Autoloader::register();

//\Core\App::run();

\Settings\Layout\Config::setLocalStyles(
    [
        'href' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
        'rel' => 'stylesheet',
    ]
);

\Settings\Layout\Config::setLocalStyles(
   'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
    'stylesheet',
    'type',
    'in',
    'cros'
);

//$t = \Settings\Layout\Config::getLinks();
//$s = \Settings\Layout\Config::getScripts();

//die();

\Framework\Core\Application\Launch::run();