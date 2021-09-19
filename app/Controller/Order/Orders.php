<?php

namespace Controller\Order;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Authorization\Session;
use Model\Order\ResourceModel\Collection\Order as OrderCollection;
use Model\OrderProducts\ResourceModel\Collection\OrderProducts as OrderProductsCollection;
use Model\Products\ResourceModel\Products;

class Orders implements Action
{
    use DataControl;

    private $session;

    private $orderCollection;

    private $orderProducts;

    private $productResource;

    public function __construct()
    {
        $this->session = new Session();
        $this->orderCollection = new OrderCollection();
        $this->orderProducts = new OrderProductsCollection();
        $this->productResource = new Products();
    }

    public function execute()
    {
        $this->setData('title', 'Всі замовлення');
        $customer = $this->session->isLogin();

        if (null === $customer) {
            $this->setData('login', 'no');
            return $this->_data;
        }

        $orders = $this->orderCollection
            ->addFieldToFilter('customer_id', ['eq' => $customer->getCustomerId()])
            ->getSelect();

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
