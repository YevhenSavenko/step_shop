<?php

namespace Core;

class Helper
{
    public static function redirect($path)
    {
        $protocol = '';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $protocol = 'https';
        } else {
            $protocol = 'http';
        }


        $server_host = $protocol . '://' . $_SERVER['HTTP_HOST'];
        $url = $server_host . route::getBP() . $path;


        header("Location: $url");
    }
}
