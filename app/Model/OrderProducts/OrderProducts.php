<?php

namespace Model\OrderProducts;

use Framework\Model\AbstractModel;
use Model\API\Model\OrderProducts\OrderProductsInterface;

class OrderProducts extends AbstractModel implements OrderProductsInterface
{

    /**
     * @inheritDoc
     */
    public function getOrderId(): int
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @inheritDoc
     */
    public function getProductId(): int
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @inheritDoc
     */
    public function getQtyOrder(): int
    {
        return $this->getData(self::QTY_ORDER);
    }

    /**
     * @inheritDoc
     */
    public function setOrderId(int $orderId): OrderProductsInterface
    {
        $this->setData($orderId, self::ORDER_ID);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setProductId(int $productId): OrderProductsInterface
    {
        $this->setData($productId, self::PRODUCT_ID);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setQtyOrder(int $qtyOrder): OrderProductsInterface
    {
        $this->setData($qtyOrder, self::QTY_ORDER);
        return $this;
    }
}