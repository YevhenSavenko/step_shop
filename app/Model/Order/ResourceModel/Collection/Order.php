<?php

namespace Model\Order\ResourceModel\Collection;

use Framework\ResourceModel\Collection\AbstractCollection;

class Order extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(\Model\Order\ResourceModel\Order::class);
    }
}