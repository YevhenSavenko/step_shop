<?php

namespace Model\Order\Validator\Fields;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use LogicException;

class AddressValidator implements CompositeValidatorInterface
{
    private const ADDRESS = 'address';

    public function validate($params): string
    {
        if (!isset($params[self::ADDRESS]) || $params[self::ADDRESS] === '') {
            throw new LogicException(
                "Поле для адреси пусте"
            );
        }

        return true;
    }
}