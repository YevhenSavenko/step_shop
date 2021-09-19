<?php

namespace Framework\Core\Data;

class Persistor
{
    public function set($key, $data): void
    {
        $_SESSION['data']['persistor'][$key] = $data;
    }

    public function get($key)
    {
        if (isset($_SESSION['data']['persistor'][$key])) {
            return $_SESSION['data']['persistor'][$key];
        }

        return null;
    }

    public function clear($key): void
    {
        if (isset($_SESSION['data']['persistor'][$key])) {
            unset($_SESSION['data']['persistor'][$key]);
        }
    }
}