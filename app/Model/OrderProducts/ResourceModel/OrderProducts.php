<?php

namespace Model\OrderProducts\ResourceModel;

use Framework\ResourceModel\Db\AbstractDb;

class OrderProducts extends AbstractDb
{
    public function _construct()
    {
        $this->_init('order_products', 'id', \Model\OrderProducts\OrderProducts::class);
    }
}