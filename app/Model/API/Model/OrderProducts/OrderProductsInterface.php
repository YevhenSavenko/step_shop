<?php

namespace Model\API\Model\OrderProducts;

interface OrderProductsInterface
{
    const ORDER_ID = 'order_id';
    const PRODUCT_ID = 'product_id';
    const QTY_ORDER = 'qty_order';

    /**
     * @return int
     */
    public function getOrderId(): int;

    /**
     * @return int
     */
    public function getProductId(): int;

    /**
     * @return int
     */
    public function getQtyOrder(): int;

    /**
     * @param int $orderId
     * @return OrderProductsInterface
     */
    public function setOrderId(int $orderId): OrderProductsInterface;

    /**
     * @param int $productId
     * @return OrderProductsInterface
     */
    public function setProductId(int $productId): OrderProductsInterface;

    /**
     * @param int $qtyOrder
     * @return OrderProductsInterface
     */
    public function setQtyOrder(int $qtyOrder): OrderProductsInterface;
}