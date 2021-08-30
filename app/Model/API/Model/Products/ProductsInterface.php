<?php

namespace Model\Api\Model\Products;

interface ProductsInterface
{
    const ID = 'id';
    const SKU = 'sku';
    const NAME = 'name';
    const PRICE = 'price';
    const QTY = 'qty';
    const DESCRIPTION = 'description';

    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return int
     */
    public function getQty(): int;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $sku
     * @return ProductsInterface
     */
    public function setSku(string $sku): ProductsInterface;

    /**
     * @param string $name
     * @return ProductsInterface
     */
    public function setName(string $name): ProductsInterface;

    /**
     * @param float $price
     * @return ProductsInterface
     */
    public function setPrice(float $price): ProductsInterface;

    /**
     * @param int $qty
     * @return ProductsInterface
     */
    public function setQty(int $qty): ProductsInterface;

    /**
     * @param string $description
     * @return ProductsInterface
     */
    public function setDescription(string $description): ProductsInterface;
}