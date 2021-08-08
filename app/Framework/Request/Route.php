<?php

namespace Framework\Request;

class Route
{
    private static $controller = null;

    private static $action = null;

    public static function init(string $route = null)
    {
        if (!$route) {
            $request = explode('?', $_SERVER['REQUEST_URI']);
            $uri = $request[0];
            $route = substr($uri, strlen(self::getBasePath()));
        }
        $route_array = explode('/', $route);
        if ($route_array[0] === "") {
            array_shift($route_array);
        }
        if (isset($route_array[0]) && $route_array[0] === 'index.php') {
            array_shift($route_array);
        }
        self::$controller = !empty($route_array[0]) ? $route_array[0] : 'index';
        self::$action = !empty($route_array[1]) ? $route_array[1] : 'index';
    }

    public static function getBP()
    {
        return self::getBasePath();
    }

    public static function getBasePath()
    {
        /**
         * For subfolders in Windows (or for subfolders in OpenServer)
         */
        $base_path = substr(trim(\ROOT, '/'), strlen(trim($_SERVER['DOCUMENT_ROOT'], '/')));
        if (DS !== '/') {
            $base_path = str_replace(DS, '/', $base_path);
        }
        return $base_path;
    }

    public static function getAction(): string
    {
        return self::$action;
    }

    public static function getController(): string
    {
        return self::$controller;
    }
}