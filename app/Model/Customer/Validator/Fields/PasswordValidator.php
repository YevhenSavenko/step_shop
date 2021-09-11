<?php

namespace Model\Customer\Validator\Fields;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use LogicException;

class PasswordValidator implements CompositeValidatorInterface
{
    public const PASSWORD = 'password';

    public function validate($params): ?string
    {
        if(!isset($params[self::PASSWORD]) || $params[self::PASSWORD] === ''){
            throw new LogicException("Поле для пароля не заповнено");
        }

        if (!preg_match("/^[A-z0-9]+$/", $params[self::PASSWORD])){
            throw new LogicException("Пароль повинен містити тільки символи латинського алфавіту та цифри");
        }

        if (!preg_match("/[A-Z]+/", $params[self::PASSWORD])){
            throw new LogicException("Пароль повинен містити хоча б одну заголовну літеру");
        }

        if (!preg_match("/[a-z]+/", $params[self::PASSWORD])){
            throw new LogicException("Пароль повинен містити хоча б одну малельку літеру");
        }

        if (!preg_match("/[0-9]+/", $params[self::PASSWORD])) {
            throw new LogicException("Пароль повинен містити хоча б одну цифру");
        }

        if (strlen($params[self::PASSWORD]) > 25 || strlen($params[self::PASSWORD]) < 8)  {
            throw new LogicException("Пароль повинен містити мінімум 8 символів та максимум 25 символів");
        }

        return true;
    }
}