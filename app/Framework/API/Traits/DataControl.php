<?php

namespace Framework\Api\Traits;

trait DataControl
{
    private $_data;

    public function setData($key, $value)
    {
        $this->_data[$key] = $value;
    }

    public function getData($key)
    {
        return $this->_data[$key];
    }
}