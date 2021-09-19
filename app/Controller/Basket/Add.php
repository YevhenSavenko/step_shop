<?php

namespace Controller\Basket;

use Framework\API\Data\Controller\Action\Action;
use Framework\MessageManager\MessageManager;
use Framework\Request\Http;
use Model\Basket\Basket as BasketModel;
use Model\Products\ResourceModel\Products as ResourceModelProducts;

class Add implements Action
{
    private $request;

    private $productResource;

    private $messageManager;

    private $basketModel;

    public function __construct()
    {
        $this->request = new Http();
        $this->productResource = new ResourceModelProducts();
        $this->messageManager = new MessageManager();
        $this->basketModel = new BasketModel();
    }

    public function execute()
    {
        $idProduct = $this->request->getQueryParams('id');
        $product = $this->productResource->load($idProduct);

        if (null !== $product->getId()) {
            $this->basketModel->addToCart($idProduct);
            $this->messageManager->accessMessage("Продукт \"{$product->getName()}\" доданий до корзини");
            $this->request->redirect('/basket/index');
        }

        $this->messageManager->errorMessage('Такого продукта не існує');
        $this->request->redirect('/product/catalog/');
    }
}