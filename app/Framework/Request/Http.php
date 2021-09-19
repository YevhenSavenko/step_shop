<?php

namespace Framework\Request;

use Framework\API\Data\Request\HttpInterface;

class Http implements HttpInterface
{
    private $data = [];

    public function getRequest(): string
    {
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    }

    public function getQueryParams($key = null)
    {
        if ($key === null) {
            return $_GET;
        }

        return $_GET[$key];
    }

    public function getPostParams($key = null)
    {
        if ($key === null) {
            return $_POST;
        }

        return $_POST[$key];
    }

    public function getParams($key = null)
    {
        if ($this->getRequest() === 'GET') {
            $data = $this->getQueryParams($key);

            if (!is_array($data)) {
                return $data;
            }

            $this->data = array_merge($this->data, $data);
        }

        if ($this->getRequest() === 'POST') {
            $data = $this->getPostParams($key);

            if (!is_array($data)) {
                return $data;
            }
            $this->data = array_merge($this->data, $data);
        }

        return $this->data;
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

    public function redirectDownload($path)
    {
        header('Content-type: application/xml');
        header('Content-Disposition: attachment; filename="products.xml"');

        readfile($path);
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