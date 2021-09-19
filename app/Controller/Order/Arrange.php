<?php

namespace Controller\Order;

use Exception;
use Framework\API\Data\Controller\Action\Action;
use Framework\Authorization\Session;
use Framework\Core\Data\Persistor;
use Framework\MessageManager\MessageManager;
use Framework\Request\Http;
use Model\Basket\Basket as BasketModel;
use Model\Order\Order as OrderModel;
use Model\Order\ResourceModel\Order as OrderResource;
use Model\Order\Validator\OrderValidatorComposite;
use Model\Order\ResourceModel\Collection\Order as OrderCollection;
use Model\OrderProducts\OrderProducts;
use Model\OrderProducts\ResourceModel\OrderProducts as OrderProductsResource;

class Arrange implements Action
{
    private $request;

    private $validator;

    private $messageManager;

    private $orderResource;

    private $orderModel;

    private $basketModel;

    private $session;

    private $orderCollection;

    private $orderProductsResource;

    private $persistor;

    public function __construct()
    {
        $this->request = new Http();
        $this->validator = new OrderValidatorComposite();
        $this->messageManager = new MessageManager();
        $this->orderResource = new OrderResource();
        $this->orderModel = new OrderModel();
        $this->basketModel = new BasketModel();
        $this->session = new Session();
        $this->orderCollection = new OrderCollection();
        $this->orderProductsResource = new OrderProductsResource();
        $this->persistor = new Persistor();
    }

    public function execute()
    {
        if($this->request->getRequest() !== 'POST'){
            $this->request->redirect('/product/catalog/');
        }

        try {
            $this->persistor->set('order_form_data', $this->request->getPostParams());
            $this->validator->validate($this->request->getPostParams());
            $this->persistor->clear('order_form_data');
        } catch (Exception $e) {
            $this->messageManager->errorMessage($e->getMessage());
            $this->request->redirect('/order/index/');
        }

        $order = $this->orderModel
            ->setData($this->request->getPostParams())
            ->setTotal(BasketModel::getTotalSum());

        if(null !== $this->session->isLogin()){
            $customer = $this->session->isLogin();
            $order->setCustomerId($customer->getCustomerId());
        }

        $this->orderResource->save($order);
        $products = $this->basketModel->getProductIdsAndQuantity();
        $lastId = $this->orderCollection->getLastId();

        foreach ($products as $id => $quantity){
            $product = new OrderProducts();
            $product->setOrderId($lastId)->setProductId($id)->setQtyOrder($quantity);
            $this->orderProductsResource->save($product);
        }

        $this->basketModel->setActiveOrder();
        $this->request->redirect('/order/generate', ['id' => $lastId]);
    }
}
