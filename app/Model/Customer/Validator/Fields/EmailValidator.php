<?php

namespace Model\Customer\Validator\Fields;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use LogicException;
use Model\Customer\ResourceModel\Collection\Customer;

class EmailValidator implements CompositeValidatorInterface
{
    private const EMAIL = 'email';

    private $customerCollection;

    public function __construct()
    {
        $this->customerCollection = new Customer();
    }

    public function validate($params): ?string
    {
        if(!isset($params[self::EMAIL]) || $params[self::EMAIL] === ''){
            throw new LogicException("Поле для емейлу не заповнено");
        }

        if(!filter_var($params[self::EMAIL], FILTER_VALIDATE_EMAIL)){
            throw new LogicException("Емейл не валідний");
        }

         $this->customerCollection
            ->addFieldToFilter(self::EMAIL, ['eq' => $params[self::EMAIL]])
             ->getSelect();

        if($this->customerCollection->selectFirst()){
            throw new LogicException("Такий емейл вже існує");
        }

        return true;
    }
}