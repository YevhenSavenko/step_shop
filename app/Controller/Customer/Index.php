<?php

namespace Controller\Customer;

use ErrorException;
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

    /**
     * @throws ErrorException
     */
    public function execute()
    {
        $this->setData('customers', $this->collectionCustomer
            ->setSort(['customer_id'], 'asc')
            ->getSelect());
        $this->setData('title', "Користувачі");

        return $this->_data;
    }
}