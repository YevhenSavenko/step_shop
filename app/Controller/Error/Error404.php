<?php

namespace Controller\Error;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;

class Error404 implements Action
{
    use DataControl;

    public function execute()
    {
        $this->setData("title", "Error 404");
        header("HTTP/1.0 404 Not Found");

        return $this->_data;
    }
}