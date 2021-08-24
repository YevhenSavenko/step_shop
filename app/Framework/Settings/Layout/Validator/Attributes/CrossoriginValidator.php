<?php

namespace Framework\Settings\Layout\Validator\Attributes;

use Framework\API\Data\Validator\CompositeValidatorInterface;

class CrossoriginValidator implements CompositeValidatorInterface
{
    const CROSSORIGIN = 'crossorigin';

    public function validate($params): string
    {
        if($params[self::CROSSORIGIN]){
            return " crossorigin = \"{$params['crossorigin']}\"";
        }

        return '';
    }
}