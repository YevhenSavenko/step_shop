<?php

namespace Framework\Settings\Layout\Validator\Attributes;

use Framework\API\Data\Validator\CompositeValidatorInterface;

class HrefValidator implements CompositeValidatorInterface
{
    const HREF = 'href';
    const HREF_CUSTOM = 'href_custom';

    public function validate($params): string
    {
        $href = '';

        if($params[self::HREF]){
            $href = "href = \"{$params[self::HREF]}\"";
        } else {
            $href = "href = \"{$params[self::HREF_CUSTOM]}\"";
        }

        return $href;
    }
}