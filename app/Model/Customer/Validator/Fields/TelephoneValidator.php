<?php

namespace Model\Customer\Validator\Fields;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use LogicException;

class TelephoneValidator implements CompositeValidatorInterface
{
    private const TEL = 'telephone';

    public function validate($params): string
    {
        if (!isset($params[self::TEL]) || $params[self::TEL] === '') {
            throw new LogicException(
                "Поле для телефону пусте"
            );
        }

        if (!preg_match('/^\+380\d{9}$/', $params[self::TEL]) && !preg_match('/^0\d{9}$/', $params[self::TEL])) {
            throw new LogicException(
                "Телефон вказано в неправильному форматі (Формати: +380999227744 або 0999227744)"
            );
        }

        return true;
    }
}