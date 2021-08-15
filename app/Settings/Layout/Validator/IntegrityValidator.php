<?php

namespace Settings\Layout\Validator;

use Framework\Api\Data\Validator\CompositeValidatorInterface;

class IntegrityValidator implements CompositeValidatorInterface
{
    const INTEGRITY = 'integrity';

    public function validate($params): string
    {
        if ($params[self::INTEGRITY]) {
            return " integrity = \"{$params['integrity']}\"";
        }

        return '';
    }
}