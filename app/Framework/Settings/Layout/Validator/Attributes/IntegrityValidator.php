<?php

namespace Framework\Settings\Layout\Validator\Attributes;

use Framework\API\Data\Validator\CompositeValidatorInterface;

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