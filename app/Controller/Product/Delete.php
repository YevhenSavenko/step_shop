<?php

namespace Controller\Product;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Authorization\Session;
use Framework\MessageManager\MessageManager;
use Framework\Request\Http;
use Model\Products\ResourceModel\Products as ProductsResource;

class Delete implements Action
{
    use DataControl;

    private $productResource;

    private $request;

    private $messageManager;

    private $session;

    public function __construct()
    {
        $this->productResource = new ProductsResource();
        $this->request = new Http();
        $this->messageManager = new MessageManager();
        $this->session = new Session();
    }

    public function execute()
    {
        if(!$this->session->isAdmin()){
            $this->request->redirect('/error/404error/');
        }

        if(!(int)$this->request->getQueryParams('id')){
            $this->messageManager->errorMessage('Такого товару немає');
            $this->request->redirect('/error/404error/');
        }

        $product = $this->productResource->load($this->request->getQueryParams('id'));
        $this->productResource->delete($product);

        $this->messageManager->errorMessage('Товар успішно видалено');
        $this->request->redirect('/product/catalog/');
    }
}