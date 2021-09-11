<?php

namespace Framework\API\Data\Validator;

interface CompositeValidatorInterface
{
    /**
     * @param $params
     * @return string|bool
     */
    public function validate($params): ?string;
}