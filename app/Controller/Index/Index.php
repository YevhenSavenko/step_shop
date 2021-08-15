<?php

namespace Controller\Index;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;

class Index implements Action
{
    use DataControl;

    public function execute(): array
    {
        $this->setData("title", "Test shop");

        return $this->_data;
    }

}