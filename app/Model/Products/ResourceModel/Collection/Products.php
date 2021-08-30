<?php

namespace Model\Products\ResourceModel\Collection;

use Framework\ResourceModel\Collection\AbstractCollection;

class Products extends AbstractCollection
{

    public function _construct()
    {
        $this->_init(\Model\Products\ResourceModel\Products::class);
    }
}