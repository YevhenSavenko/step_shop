<?php

namespace Controller\Product;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Model\Products\ResourceModel\Collection\Products as ProductsCollection;
use Framework\Request\Http;

class Catalog implements Action
{
    use DataControl;

    private $collectionProducts;

    private $request;

    public function __construct()
    {
        $this->request = new Http();
        $this->collectionProducts = new ProductsCollection();
    }

    public function execute()
    {
        $this->setData('title', "Товари");
        $maxPrice = $this->collectionProducts->getMaxValueByField('price');

        if ($this->request->isAjax() && $this->request->getParams('flag') === 'price') {
            echo json_encode($maxPrice);
            exit;
        }

        if (null !== $values = $this->getDiapasonValue()) {
            $this->collectionProducts
                ->addFieldToFilter('price', ['gteq' => $values['min']])
                ->addFieldToFilter('price', ['lteq' => $values['max']]);
        }

        if (\count($sortParams = $this->getSortParams()) > 0) {
            $this->collectionProducts->setSort(['price', 'qty'], [$sortParams['price'], $sortParams['qty']]);
        }

        $this->getFormDiapason($this->getDiapasonValue(), $maxPrice);

        $products = $this->collectionProducts->getSelect();
        $this->setData('products', $products);
        $this->setData('maxPrice', $maxPrice);
        return $this->_data;
    }

    /**
     * @return array|null
     */
    public function getDiapasonValue(): ?array
    {
        $minPrice = $this->request->getParams('min-price');
        $maxPrice = $this->request->getParams('max-price');

        if ($this->request->getRequest() === 'POST') {
            setcookie('min', $minPrice, 0, '/', '', 0, 1);
            setcookie('max', $maxPrice, 0, '/', '', 0, 1);
        } else {
            $minPrice = $_COOKIE['min'] ?? $minPrice;
            $maxPrice = $_COOKIE['max'] ?? $maxPrice;
        }

        if (null === $minPrice || null === $maxPrice) {
            return null;
        }

        return ['min' => $minPrice, 'max' => $maxPrice];
    }

    public function getSortParams(): array
    {
        $params = [];

        if($this->request->getRequest() === 'POST'){
            $this->request->getParams('sortfirst') === 'price_DESC' ? $params['price'] = 'desc' : $params['price'] = 'asc';
            $this->request->getParams('sortsecond') === 'qty_DESC' ? $params['qty'] = 'desc' : $params['qty'] = 'asc';

            setcookie('price', $params['price'], 0, '/', '', 0, 1);
            setcookie('qty', $params['qty'], 0, '/', '', 0, 1);
        } else if (isset($_COOKIE['price']) && isset($_COOKIE['qty'])) {
            $params['price'] = $_COOKIE['price'];
            $params['qty'] = $_COOKIE['qty'];
        }

        if (isset($params['price']) && isset($params['qty'])) {
            $this->setData('sortPrice', $params['price']);
            $this->setData('sortQty', $params['qty']);
        } else {
            $this->setData('sortPrice', '');
            $this->setData('sortQty', '');
        }

        return $params;
    }

    public function getFormDiapason($diapason, $maxPrice): void
    {
        $min = 0;
        $max = $maxPrice;
        $minRange = 0;
        $maxRange = 100;

        if ($this->request->getRequest() === 'POST') {
            $min = $diapason['min'];
            $max = $diapason['max'];
        } else if (isset($_COOKIE['min']) && isset($_COOKIE['max'])) {
            $min = $_COOKIE['min'];
            $max = $_COOKIE['max'];
        }

        $minRange = (($maxRange * $min) / $maxPrice);
        $maxRange = (($maxRange * $max) / $maxPrice);

        $this->setData('min', $min);
        $this->setData('max', $max);
        $this->setData('minRange', $minRange);
        $this->setData('maxRange', $maxRange);
    }
}