<?php

namespace Model\Customer\ResourceModel;

use Framework\ResourceModel\Db\AbstractDb;

class Customer extends AbstractDb
{

    public function _construct()
    {
        $this->_init('customer', 'customer_id', \Model\Customer\Customer::class);
    }
}