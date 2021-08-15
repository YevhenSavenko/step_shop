<?php

namespace Settings\Layout\Validator;

use Framework\Api\Data\Validator\CompositeValidatorInterface;

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