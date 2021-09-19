<?php

namespace Model\Order;

use Framework\Model\AbstractModel;
use Model\API\Model\Order\OrderInterface;


class Order extends AbstractModel implements OrderInterface
{
    /**
     * @inheritDoc
     */
    public function getCustomerId(): int
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function getFirstName(): string
    {
        return $this->getData(self::FIRST_NAME);
    }

    /**
     * @inheritDoc
     */
    public function getLastName(): string
    {
        return $this->getData(self::LAST_NAME);
    }

    /**
     * @inheritDoc
     */
    public function getTelephone(): string
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): string
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function getAddress(): string
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * @inheritDoc
     */
    public function getTotal(): float
    {
        return $this->getData(self::TOTAL);
    }

    /**
     * @inheritDoc
     */
    public function getDate(): string
    {
        return $this->getData(self::DATE);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId(int $customerId): OrderInterface
    {
        $this->setData($customerId, self::CUSTOMER_ID);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setFirstName(string $firstName): OrderInterface
    {
        $this->setData($firstName, self::FIRST_NAME);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLastName(string $lastName): OrderInterface
    {
        $this->setData($lastName, self::LAST_NAME);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTelephone(string $telephone): OrderInterface
    {
        $this->setData($telephone, self::TELEPHONE);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setEmail(string $email): OrderInterface
    {
        $this->setData($email, self::EMAIL);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAddress(string $address): OrderInterface
    {
        $this->setData($address, self::ADDRESS);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTotal(float $total): OrderInterface
    {
        $this->setData($total, self::TOTAL);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDate(string $date): OrderInterface
    {
        $this->setData($date, self::DATE);
        return $this;
    }
}