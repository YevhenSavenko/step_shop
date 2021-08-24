<?php

namespace Model\Customer;

use Framework\Model\AbstractModel;
use Model\API\Model\Customer\CustomerInterface;

class Customer extends AbstractModel implements CustomerInterface
{
    public function getCustomerId(): int
    {
        return (int)$this->getData(self::CUSTOMER_ID);
    }

    public function getLastName(): string
    {
        return $this->getData(self::LAST_NAME);
    }

    public function getFirstName(): string
    {
        return $this->getData(self::FIRST_NAME);
    }

    public function getTelephone(): string
    {
        return $this->getData(self::TELEPHONE);
    }

    public function getEmail(): string
    {
        return $this->getData(self::EMAIL);
    }

    public function getCity(): string
    {
        return $this->getData(self::CITY);
    }

    public function getAdminRole(): bool
    {
        return (bool)$this->getData(self::ADMIN_ROLE);
    }

    public function setCustomerId(int $id): CustomerInterface
    {
        return $this->setData($id, self::CUSTOMER_ID);
    }

    public function setLastName(string $lastName): CustomerInterface
    {
        return $this->setData($lastName, self::LAST_NAME);
    }

    public function setFirstName(string $firstName): CustomerInterface
    {
        return $this->setData($firstName, self::FIRST_NAME);
    }

    public function setTelephone(string $telephone): CustomerInterface
    {
        return $this->setData($telephone, self::TELEPHONE);
    }

    public function setEmail(string $email): CustomerInterface
    {
        return $this->setData($email, self::EMAIL);
    }

    public function setCity(string $city): CustomerInterface
    {
        return $this->setData($city, self::CITY);
    }

    public function setAdminRole(bool $adminRole): CustomerInterface
    {
        return $this->setData($adminRole, self::ADMIN_ROLE);
    }
}