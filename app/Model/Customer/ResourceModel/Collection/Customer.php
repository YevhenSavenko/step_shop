<?php

namespace Model\Customer\ResourceModel\Collection;

use Framework\ResourceModel\Collection\AbstractCollection;

class Customer extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(\Model\Customer\ResourceModel\Customer::class);
    }
}