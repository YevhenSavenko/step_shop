<?php

namespace Model\OrderProducts\ResourceModel\Collection;

use Framework\ResourceModel\Collection\AbstractCollection;

class OrderProducts extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(\Model\OrderProducts\ResourceModel\OrderProducts::class);
    }
}