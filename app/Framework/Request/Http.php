<?php

namespace Framework\Request;

use Framework\API\Data\Request\HttpInterface;

class Http implements HttpInterface
{
    private $data;

    public function getRequest(): string
    {
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    }

    public function getParams($key = null)
    {
        if ($this->getRequest() === 'GET') {
            $this->data = $_GET;
        }

        if ($this->getRequest() === 'POST') {
            $this->data = $_POST;
        }

        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else if ($key === null) {
            return $this->data;
        } else {
            return null;
        }
    }

    public function isAjax(): bool
    {
        if ($this->getParams('isAjax') == true) {
            return true;
        }

        return false;
    }

    public function redirect($path, $params = [])
    {
        $protocol = '';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $protocol = 'https';
        } else {
            $protocol = 'http';
        }

        $server_host = $protocol . '://' . $_SERVER['HTTP_HOST'];
        $url = $server_host . self::urlBuilder($path, $params);

        header("Location: $url");
        exit;
    }

    public static function urlBuilder($path, $params = []): string
    {
        if (!empty($params)) {
            $firstKey = array_keys($params)[0];
            foreach ($params as $key => $value) {
                $path .= ($key === $firstKey ? '?' : '&');
                $path .= "$key=$value";
            }
        }

        return sprintf('%s%s', Route::getBP(), $path);
    }
}