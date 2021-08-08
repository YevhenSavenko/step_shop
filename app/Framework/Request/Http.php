<?php

namespace Framework\Request;

use Framework\API\Data\Request\HttpInterface;

class Http implements HttpInterface
{
    public function getRequest(): array
    {
        return $_REQUEST;
    }

    public function getDataPost(): array
    {
        return $_POST;
    }

    public function getDataGet(): array
    {
        return $_GET;
    }

    public static function getLink($path, $name, $params = [])
    {
        if (!empty($params)) {
            $firts_key = array_keys($params)[0];
            foreach($params as $key=>$value) {
                $path .= ($key === $firts_key ? '?' : '&');
                $path .= "$key=$value";
            }
        }
        return '<a href="' . Route::getBP() . $path .'">' .$name . '</a>';
    }
}