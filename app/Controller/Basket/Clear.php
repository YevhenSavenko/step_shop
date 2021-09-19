<?php

namespace Controller\Basket;

use Framework\API\Data\Controller\Action\Action;
use Framework\Request\Http;
use Model\Basket\Basket as BasketModel;

class Clear implements Action
{
    private $basketModel;

    private $request;

    public function __construct()
    {
        $this->basketModel = new BasketModel();
        $this->request = new Http();
    }

    public function execute()
    {
        $this->basketModel->clearCart();
        $this->request->redirect('/basket/index/');
    }
}