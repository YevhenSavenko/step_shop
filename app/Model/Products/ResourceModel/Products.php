<?php

namespace Model\Products\ResourceModel;

use Framework\ResourceModel\Db\AbstractDb;

class Products extends AbstractDb
{
    public function _construct()
    {
        $this->_init('products', 'id', \Model\Products\Products::class);
    }
}