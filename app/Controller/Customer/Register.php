<?php

namespace Controller\Customer;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;

class Register implements Action
{
    use DataControl;

    public function execute()
    {
        $this->setData('title', 'Реєстрація');

        return $this->_data;
    }
}

