<?php

namespace Framework\API\Data\Request;

interface HttpInterface
{
    public function getRequest(): array;

    public function getDataPost(): array;

    public function getDataGet(): array;
}