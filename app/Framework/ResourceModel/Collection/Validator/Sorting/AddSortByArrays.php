<?php

namespace Framework\ResourceModel\Collection\Validator\Sorting;

use Framework\API\Data\Validator\CompositeSortingValidatorInterface;

class AddSortByArrays implements CompositeSortingValidatorInterface
{
    public function apply($fields, $sortBy): array
    {
        $data = [];

        if(is_array($fields) && is_array($sortBy)){
            if(count($fields) === count($sortBy)){
                foreach ($fields as $key => $field){
                    $data[] = [$sortBy[$key] => $field];
                }
            }
        }

        return $data;
    }
}
