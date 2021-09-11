<?php

namespace Model\Customer\Validator\Fields;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use LogicException;

class LastNameValidator implements CompositeValidatorInterface
{
    private const LAST_NAME = 'last_name';

    public function validate($params): string
    {
        if(!isset($params[self::LAST_NAME]) || $params[self::LAST_NAME] === ''){
            throw new LogicException("Поле для прізвища не заповнено");
        }

        if(mb_strlen($params[self::LAST_NAME]) > 20){
            throw new LogicException("Поле для прізвища містить забагато символів");
        }

        return true;
    }
}