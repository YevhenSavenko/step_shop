<?php

namespace Framework\Core\Application;

use Framework\Request\Route;

class Launch
{
    public static function run(string $path = null)
    {
        Route::init($path);

        $controller = sprintf(
            "\\Controller\\%s\\%s",
            ucfirst(Route::getController()),
            ucfirst(Route::getAction())
        );

        try {
            self::checkPathToClass($controller);
        } catch (\Exception $e) {
            $controller = '\\Controller\\Error\\Error404';
        }


        $controllerClass = new $controller();
        $data = $controllerClass->execute();

        $build = new Builder($data);
        $build->renderLayout();
    }

    public static function checkPathToClass($controller): void
    {
        $controllerClassFile = sprintf(
            "%s%s.php",
            self::getAppDir(),
            str_replace('\\', \DS, $controller)
        );

        if (!file_exists($controllerClassFile)) {
            throw new \LogicException();
        }
    }

    public static function getAppDir(): string
    {
        return ROOT . DS . 'app';
    }

    public static function getLayoutPath(): string
    {
        return self::getAppDir() . \DS . 'Framework' . \DS . 'Layout' . \DS  . 'layout.php';
    }

    public static function getViewDir(): string
    {
        return self::getAppDir() . DS . 'views';
    }

}