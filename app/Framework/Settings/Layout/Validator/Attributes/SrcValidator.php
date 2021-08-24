<?php

namespace Framework\Settings\Layout\Validator\Attributes;

use Framework\API\Data\Validator\CompositeValidatorInterface;

class SrcValidator implements CompositeValidatorInterface
{
    const SRC = 'src';
    const SRC_CUSTOM = 'src_custom';

    public function validate($params): string
    {
        $src = '';

        if($params[self::SRC]){
            $src = "src = \"{$params[self::SRC]}\"";
        } else {
            $src = "src = \"{$params[self::SRC_CUSTOM]}\"";
        }

        return $src;
    }
}