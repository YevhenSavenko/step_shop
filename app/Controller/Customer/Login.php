<?php

namespace Controller\Customer;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;

class Login implements Action
{
    use DataControl;

    public function execute()
    {
        $this->setData('title', "Ввійти");

        return $this->_data;
    }
}