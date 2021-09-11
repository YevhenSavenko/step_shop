<?php

namespace Model\Customer\Validator\Fields;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use LogicException;

class FirstNameValidator implements CompositeValidatorInterface
{
    private const FIRST_NAME = 'first_name';

    public function validate($params): string
    {
        if (!isset($params[self::FIRST_NAME]) || $params[self::FIRST_NAME] === '') {
            throw new LogicException("Поле для імені не заповнено");
        }

        if (mb_strlen($params[self::FIRST_NAME]) > 20) {
            throw new LogicException("Поле для імені містить забагато символів");
        }

        return true;
    }
}