<?php

namespace Model\Products;

use Framework\Model\AbstractModel;
use Model\API\Model\Products\ProductsInterface;

class Products extends AbstractModel implements ProductsInterface
{

    public function getSku(): string
    {
        return $this->getData(self::SKU);
    }

    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    public function getPrice(): float
    {
        return (float)$this->getData(self::PRICE);
    }

    public function getQty(): int
    {
        return (int)$this->getData(self::QTY);
    }

    public function getDescription(): string
    {
        return (string)$this->getData(self::DESCRIPTION);
    }

    public function setSku(string $sku): ProductsInterface
    {
        return $this->setData($sku, self::SKU);
    }

    public function setName(string $name): ProductsInterface
    {
         return $this->setData($name, self::NAME);
    }

    public function setPrice(float $price): ProductsInterface
    {
         return $this->setData($price, self::PRICE);
    }

    public function setQty(int $qty): ProductsInterface
    {
         return $this->setData($qty, self::QTY);
    }

    public function setDescription(string $description): ProductsInterface
    {
         return $this->setData($description, self::DESCRIPTION);
    }
}