<?php

namespace Framework\ResourceModel\Collection\Validator;

use Framework\API\Data\Validator\CompositeSortingValidatorInterface;
use Framework\ResourceModel\Collection\Validator\Sorting\
{
    AddSortByArrays,
    AddSortByFieldAndArray,
    AddSortByFields,
    ErrorSort
};

class CompositeSortingValidator implements CompositeSortingValidatorInterface
{
    private $validators = [];

    public function __construct()
    {
        $this->validators[] = new AddSortByFields();
        $this->validators[] = new AddSortByFieldAndArray();
        $this->validators[] = new AddSortByArrays();
        $this->validators[] = new ErrorSort();
    }

    public function apply($fields, $sortBy)
    {
        $data = [];

        foreach ($this->validators as $validator) {
            if (!empty($data)) {
                return $data;
            }

            $data = $validator->apply($fields, $sortBy);
        }
    }
}