<?php

namespace Model\API\Model\Customer;

interface CustomerInterface
{
    const CUSTOMER_ID = 'customer_id';
    const LAST_NAME = 'last_name';
    const FIRST_NAME = 'first_name';
    const TELEPHONE = 'telephone';
    const EMAIL = 'email';
    const CITY = 'city';
    const ADMIN_ROLE = 'admin_role';

    /**
     * @return int
     */
    public function getCustomerId(): int;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return string
     */
    public function getFirstName(): string;

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
    public function getCity(): string;

    /**
     * @return bool
     */
    public function getAdminRole(): bool;

    /**
     * @param int $id
     * @return CustomerInterface
     */
    public function setCustomerId(int $id): CustomerInterface;

    /**
     * @param string $lastName
     * @return CustomerInterface
     */
    public function setLastName(string $lastName): CustomerInterface;

    /**
     * @param string $firstName
     * @return CustomerInterface
     */
    public function setFirstName(string $firstName): CustomerInterface;

    /**
     * @param string $telephone
     * @return CustomerInterface
     */
    public function setTelephone(string $telephone): CustomerInterface;

    /**
     * @param string $email
     * @return CustomerInterface
     */
    public function setEmail(string $email): CustomerInterface;

    /**
     * @param string $city
     * @return CustomerInterface
     */
    public function setCity(string $city): CustomerInterface;

    /**
     * @param bool $adminRole
     * @return CustomerInterface
     */
    public function setAdminRole(bool $adminRole): CustomerInterface;

}