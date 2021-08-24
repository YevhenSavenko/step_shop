<?php

namespace Framework\ResourceModel\Collection\Validator\Sorting;

use Framework\API\Data\Validator\CompositeSortingValidatorInterface;

class AddSortByFieldAndArray implements CompositeSortingValidatorInterface
{

    public function apply($fields, $sortBy): array
    {
        $data = [];

        if(is_array($fields) && (!is_array($sortBy))){
            foreach ($fields as $field){
                $data[] = [$sortBy => $field];
            }
        }

        return $data;
    }

}
