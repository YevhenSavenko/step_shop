<?php

declare(strict_types=1);

namespace Core;

/**
 * Class App
 * @package Core
 */
class App
{
    public static function getAppDir(): string
    {
        return ROOT . DS . 'app';
    }

    public static function getLayoutDir(): string
    {
        return self::getAppDir() . DS . 'layouts';
    }

    public static function getViewDir(): string
    {
        return self::getAppDir() . DS . 'views';
    }

    /**
     *
     */
    public static function run(string $path = null): void
    {
        Route::init($path);

        $controllerClass = '\\Controllers\\' . ucfirst(Route::getController()) . 'Controller';
        $controllerClassFile = self::getAppDir() . str_replace('\\', DS, $controllerClass) . '.php';
        if (!file_exists($controllerClassFile)) {
            $controllerClass = '\\Controllers\\ErrorController';
        }
        $action = Route::getAction() . 'Action';
        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            $controller = new \Controllers\ErrorController();
            $action = 'error404Action';
        }

        $controller->$action();
    }

//    public static function run(string $path = null): void
//    {
//        Route::init($path);
//
//        $controller = sprintf(
//            "\\Controller\\%s\\%s",
//            ucfirst(Route::getController()),
//            ucfirst(Route::getAction())
//        );
//
//        try {
//            self::checkPathToClass($controller);
//        } catch (\Exception $e) {
//            $controller = '\\Controller\\Error\\Error404';
//        }
//
//        $controllerClass = new $controller();
//        $controllerClass->execute();
//
//
//    }
//
//    public static function checkPathToClass($controller): void
//    {
//        $controllerClassFile = sprintf(
//            "%s%s.php",
//            self::getAppDir(),
//            str_replace('\\', \DS, $controller)
//        );
//
//        if (!file_exists($controllerClassFile)) {
//            throw new \LogicException();
//        }
//    }
}
