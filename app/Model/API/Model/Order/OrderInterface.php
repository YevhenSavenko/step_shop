<?php

namespace Model\API\Model\Order;

interface OrderInterface
{
    const CUSTOMER_ID = 'customer_id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const TELEPHONE = 'telephone';
    const EMAIL = 'email';
    const ADDRESS = 'address';
    const TOTAL = 'total';
    const DATE = 'date';

    /**
     * @return int
     */
    public function getCustomerId(): int;

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return string
     */
    public function getTelephone(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getAddress(): string;

    /**
     * @return float
     */
    public function getTotal(): float;

    /**
     * @return string
     */
    public function getDate(): string;

    /**
     * @param int $customerId
     * @return OrderInterface
     */
    public function setCustomerId(int $customerId): OrderInterface;

    /**
     * @param string $firstName
     * @return OrderInterface
     */
    public function setFirstName(string $firstName): OrderInterface;

    /**
     * @param string $lastName
     * @return OrderInterface
     */
    public function setLastName(string $lastName): OrderInterface;

    /**
     * @param string $telephone
     * @return OrderInterface
     */
    public function setTelephone(string $telephone): OrderInterface;

    /**
     * @param string $email
     * @return OrderInterface
     */
    public function setEmail(string $email): OrderInterface;

    /**
     * @param string $address
     * @return OrderInterface
     */
    public function setAddress(string $address): OrderInterface;

    /**
     * @param float $total
     * @return OrderInterface
     */
    public function setTotal(float $total): OrderInterface;

    /**
     * @param string $date
     * @return OrderInterface
     */
    public function setDate(string $date): OrderInterface;

}