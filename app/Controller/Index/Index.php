<?php

namespace Controller\Index;

use Framework\API\Data\Controller\Action\Action;
use Framework\Request\Route;

class Index implements Action
{
    public function execute()
    {
        Route::forward('order/orders');
    }

}