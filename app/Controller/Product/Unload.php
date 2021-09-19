<?php

namespace Controller\Product;

use Framework\API\Data\Controller\Action\Action;
use Framework\Authorization\Session;
use Framework\Request\Http;
use Model\Products\ResourceModel\Collection\Products as ProductsCollection;
use Model\Products\ResourceModel\Products as ProductResource;

class Unload implements Action
{
    private $session;

    private $request;

    private $productsCollection;

    private $productResource;

    public function __construct()
    {
        $this->session = new Session();
        $this->request = new Http();
        $this->productsCollection = new ProductsCollection();
        $this->productResource = new ProductResource();
    }

    public function execute()
    {
        if (!$this->session->isAdmin()) {
            $this->request->redirect('/error/404error');
        }

        $products = $this->productsCollection->getSelect();
        $columns = $this->productResource->getColumns();

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><products/>');

        foreach ($products as $product) {
            $xmlProduct = $xml->addChild('product');

            foreach ($columns as $field) {
                $xmlProduct->addChild($field, $product->getData($field));
            }
        }

        $dom = new \DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());

        $file = fopen('public/products.xml', 'w');
        fwrite($file, $dom->saveXML());
        fclose($file);

        $this->request->redirectDownload('public/products.xml');
    }
}