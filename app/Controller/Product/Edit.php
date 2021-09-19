<?php

namespace Controller\Product;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Authorization\Session;
use Framework\Request\Http;
use Model\Products\ResourceModel\Products as ProductsResource;

class Edit implements Action
{
    use DataControl;

    private $session;

    private $request;

    private $productResource;

    public function __construct()
    {
        $this->session = new Session();
        $this->request = new Http();
        $this->productResource = new ProductsResource();
    }

    public function execute()
    {
        $product = [];

        if(!$this->session->isAdmin()){
            $this->request->redirect('/error/404error');
        }

        try{
            $product = $this->productResource->load($this->request->getQueryParams('id'));
        } catch (\Exception $e) {
            $product = null;
        }

        $this->setData('btn', 'Редагувати');
        $this->setData('heading', 'Редагувати товар');
        $this->setData('product', $product);
        return $this->_data;
    }
}