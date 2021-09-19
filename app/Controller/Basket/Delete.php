<?php

namespace Controller\Basket;

use Framework\API\Data\Controller\Action\Action;
use Framework\Request\Http;
use Model\Basket\Basket as BasketModel;
use Model\Products\ResourceModel\Products as ResourceModelProducts;

class Delete implements Action
{
    private $basketModel;

    private $productResource;

    private $request;

    public function __construct()
    {
        $this->basketModel = new BasketModel();
        $this->productResource = new ResourceModelProducts();
        $this->request = new Http();
    }

    public function execute()
    {
        $idProduct = $this->request->getQueryParams('id');
        $product = $this->productResource->load($idProduct);

        if($idProduct && null !== $product->getId()){
            $this->basketModel->deleteProduct($idProduct);
        }

        $this->request->redirect('/basket/index/');
    }
}