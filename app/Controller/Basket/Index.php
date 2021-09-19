<?php

namespace Controller\Basket;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Request\Http;
use Model\Basket\Basket as BasketModel;
use Model\Products\ResourceModel\Collection\Products as ProductsCollection;

class Index implements Action
{
    use DataControl;

    private $basketModel;

    private $productCollection;

    private $request;

    public function __construct()
    {
        $this->basketModel = new BasketModel();
        $this->productCollection = new ProductsCollection();
        $this->request = new Http();
    }

    public function execute()
    {
        $products = [];
        $this->setData('title', 'Корзина');
        $this->setData('infoProduct', $this->basketModel->getProductIdsAndQuantity());

        $idsProducts = $this->basketModel->getProductIdsAndQuantity();

        if(null !== $idsProducts){
            $products = $this->productCollection->addFieldToFilter('id', ['in' => $idsProducts])->getSelect();
        }

        if($this->request->getRequest() === 'POST'){
            if($this->request->isAjax()){
                if(count($products) > 0){
                    $idProduct = $products[$this->request->getParams('id')]->getId();
                    $this->basketModel->addToCart($idProduct, $this->request->getParams('qty'));
                    exit;
                }
            }
        }

        if (!empty($products)) {
            $totalPrice = 0;

            foreach ($this->basketModel->getProductIdsAndQuantity() as $id => $qty) {
                foreach ($products as $product) {
                    if ($product->getId() == $id) {
                        $totalPrice += $product->getPrice() * $qty;
                    }
                }
            }

            $this->basketModel->setTotalPrice($totalPrice);

            $this->setData('totalPrice', $totalPrice);
            $this->setData('quantityProducts', array_sum($this->basketModel->getProductIdsAndQuantity()));
        }
        $this->setData('products', $products);

        return $this->_data;
    }
}
