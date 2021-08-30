<?php

namespace Framework\API\Data\Request;

interface HttpInterface
{
    public function getRequest(): string;

    public function getParams($key = null);

    public static function urlBuilder($path, $params = []): string;
}