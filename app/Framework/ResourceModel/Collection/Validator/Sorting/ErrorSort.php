<?php

namespace Framework\ResourceModel\Collection\Validator\Sorting;

use Framework\API\Data\Validator\CompositeSortingValidatorInterface;

class ErrorSort implements CompositeSortingValidatorInterface
{
    public function apply($fields, $sortBy)
    {
        if (is_array($fields) && is_array($sortBy)) {
            if (count($fields) > 2 && (count($sortBy) !== 1 || count($sortBy) !== count($fields))) {
                $errorMessage = \sprintf('%s - Wrong number of arguments in %s', \date('Y-d-m H:i:s'), __METHOD__);
                throw new \LogicException($errorMessage);
            }
        }
    }
}