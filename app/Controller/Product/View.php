<?php

namespace Controller\Product;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\MessageManager\MessageManager;
use Framework\Request\Http;
use Model\Products\ResourceModel\Products as ProductsResource;

class View implements Action
{
    use DataControl;

    private $productResource;

    private $request;

    private $messageManager;

    public function __construct()
    {
        $this->productResource = new ProductsResource();
        $this->request = new Http();
        $this->messageManager = new MessageManager();
    }

    public function execute()
    {
        $this->setData('title', 'Картка товару');

        try {
            if(!$this->request->getQueryParams('id')){
                throw new \LogicException();
            }
            $product = $this->productResource->load($this->request->getQueryParams('id'));
        } catch (\Exception $e) {
            $product = null;
        }

        $this->setData('product', $product);
        return $this->_data;
    }


}
