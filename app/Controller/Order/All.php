<?php

namespace Controller\Order;

use Framework\API\Traits\DataControl;
use Framework\Authorization\Session;
use Framework\Request\Http;
use Model\Order\ResourceModel\Collection\Order as OrderCollection;
use Model\OrderProducts\ResourceModel\Collection\OrderProducts as OrderProductsCollection;
use Model\Products\ResourceModel\Products;

class All
{
    use DataControl;

    private $session;

    private $orderCollection;

    private $orderProducts;

    private $productResource;

    private $request;

    public function __construct()
    {
        $this->session = new Session();
        $this->orderCollection = new OrderCollection();
        $this->orderProducts = new OrderProductsCollection();
        $this->productResource = new Products();
        $this->request = new Http();
    }

    public function execute()
    {
        if(!$this->session->isAdmin()){
            $this->request->redirect('/error/404error/');
        }

        $this->setData('title', 'Всі замовлення');

        $orders = $this->orderCollection->setSort('date', 'desc')->getSelect();

        foreach ($orders as $order) {
            $products = new OrderProductsCollection();
            $products = $products->addFieldToFilter('order_id', ['eq' => $order->getId()])->getSelect();
            $productsOrder = [];

            foreach ($products as $product) {
                $productLoad = $this->productResource->load($product->getProductId());
                $productLoad->setQty($product->getQtyOrder());

                $productsOrder[] = $productLoad;
            }

            $order->setProducts($productsOrder);
        }

        $this->setData('orders', $orders);

        return $this->_data;
    }
}