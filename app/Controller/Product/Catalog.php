<?php

namespace Controller\Product;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;

class Catalog implements Action
{
    use DataControl;

    public function execute()
    {
        return $this->_data;
    }
}