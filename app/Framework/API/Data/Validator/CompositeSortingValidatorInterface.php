<?php

namespace Framework\API\Data\Validator;

interface CompositeSortingValidatorInterface
{
    public function apply($fields, $sortBy);
}