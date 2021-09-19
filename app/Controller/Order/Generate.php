<?php

namespace Controller\Order;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Request\Http;
use Model\Basket\Basket;
use Model\Order\ResourceModel\Collection\Order;
use Model\Order\ResourceModel\Order as OrderResource;

class Generate implements Action
{
    use DataControl;

    private $basketModel;

    private $orderCollection;

    private $request;

    private $orderResource;

    public function __construct()
    {
        $this->basketModel = new Basket();
        $this->orderCollection = new Order();
        $this->request = new Http();
        $this->orderResource = new OrderResource();
    }

    public function execute()
    {
        if($this->basketModel->orderIsActive()){
            $this->setData('title', 'Замовлення');
            $this->setData('total', Basket::getTotalSum());
            $this->setData('orderId', $this->request->getQueryParams('id'));
            $this->basketModel->clearCart();
            $this->basketModel->deleteActiveOrder();
            return $this->_data;
        }

        $this->request->redirect('/error/error404/');
        return null;
    }
}
