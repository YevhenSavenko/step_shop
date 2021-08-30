<?php

namespace Controller\Customer;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Model\Customer\ResourceModel\Collection\Customer;

class Index implements Action
{
    use DataControl;

    private $collectionCustomer;

    public function __construct()
    {
        $this->collectionCustomer = new Customer();
    }


    public function execute()
    {
        $this->setData('customers', $this->collectionCustomer
            ->setSort(['customer_id'], 'asc')
            ->getSelect());

        return $this->_data;
    }
}