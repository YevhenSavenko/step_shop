<?php

namespace Framework\API\Data\Validator;

interface CompositeValidatorInterface
{
    public function validate($params): string;
}