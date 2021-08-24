<?php

namespace Framework\ResourceModel\Collection\Validator\Sorting;

use Framework\API\Data\Validator\CompositeSortingValidatorInterface;

class AddSortByFields implements CompositeSortingValidatorInterface
{
    public function apply($fields, $sortBy): array
    {
        $data = [];

        if(!is_array($fields) && !is_array($sortBy)){
            $data[] = [$sortBy => $fields];
        }

        return $data;
    }
}