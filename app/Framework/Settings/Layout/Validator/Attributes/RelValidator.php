<?php

namespace Framework\Settings\Layout\Validator\Attributes;

use Framework\API\Data\Validator\CompositeValidatorInterface;

class RelValidator implements CompositeValidatorInterface
{
    const REL = 'rel';

    public function validate($params): string
    {
        if ($params[self::REL]) {
            return " rel = \"{$params['rel']}\"";
        }

        return '';
    }
}