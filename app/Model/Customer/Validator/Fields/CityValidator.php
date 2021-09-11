<?php

namespace Model\Customer\Validator\Fields;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use LogicException;

class CityValidator implements CompositeValidatorInterface
{
    private const CITY = 'city';

    public function validate($params): string
    {
        if(!isset($params[self::CITY]) || $params[self::CITY] === ''){
            throw new LogicException("Поле для міста пусте");
        }

        return true;
    }
}