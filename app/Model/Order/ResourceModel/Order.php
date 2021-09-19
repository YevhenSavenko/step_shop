<?php

namespace Model\Order\ResourceModel;

use Framework\ResourceModel\Db\AbstractDb;
use Model\Basket\Basket;

class Order extends AbstractDb
{

    public function _construct()
    {
        $this->_init('orders', 'id', \Model\Order\Order::class);
    }
}