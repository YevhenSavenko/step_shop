<?php

namespace Framework\ResourceModel\Collection;

use Framework\Model\AbstractModel;
use Framework\ResourceModel\Collection\Validator\CompositeSortingValidator;
use Framework\ResourceModel\Db\AbstractDb;
use Framework\ResourceModel\Db\Connection;

abstract class AbstractCollection extends Connection
{
    private $table_name;

    private $id_column;

    private $resource;

    private $query;

    private $collection;

    private $sortCompositeValidator;

    private $filters = [];

    private $paramsSql = [];

    private $sorting = [];

    public function __construct()
    {
        $this->_construct();
        $this->sortCompositeValidator = new CompositeSortingValidator();
        $this->getSelect();
    }

    abstract public function _construct();

    public function _init(string $resourceModel)
    {
        $resourceModel = new $resourceModel;
        $this->resource = $resourceModel;
        $this->table_name = $resourceModel->getTableName();
        $this->id_column = $resourceModel->getPrimaryKeyName();
    }

    public function getSelect(): array
    {
        if (count($this->collection)) {
            $this->collection = [];
        }

        $this->query = sprintf('SELECT %s FROM `%s`', $this->id_column, $this->table_name);
        $this->builderQuery()->initCollection();
        $ids = $this->query($this->query, $this->paramsSql);

        foreach ($ids as $value) {
            $this->collection[] = $this->resource->load($value[$this->id_column]);
        }

        return $this->collection;
    }

    /**
     * Deprecated
     */
    public function queryCollection(): self
    {
        if (null === $this->collection) {
            $ids = $this->query(sprintf(
                    'select %s from %s',
                    $this->id_column,
                    $this->table_name
                )
            );

            foreach ($ids as $value) {
                $this->collection[] = $this->resource->load($value[$this->id_column]);
            }
        }

        return $this;
    }

    public function groupUpData($field, $value, $operator)
    {
        $paramsFilter = [];
        foreach ($value as $productId => $qty) {
            $paramsFilter[] = $this->valueFilterCheck($field, $productId);
        }

        $paramsFilter = sprintf('(%s)', implode(',', $paramsFilter));

        $this->filters = array_merge(
            $this->filters,
            [sprintf('(`%s`.`%s` %s %s)', $this->table_name, $field, $operator, $paramsFilter)]
        );
    }

    public function addFieldToFilter($filterByField, $condition): self
    {
        $data = [];
        $count = 0;
        $arrayConditions = [
            'like' => 'LIKE',
            'eq' => '=',
            'neq' => '<>',
            'gt' => '>',
            'gteq' => '>=',
            'lt' => '<',
            'lteq' => '<=',
            'in' => 'IN'
        ];

        foreach ($condition as $operator => &$value){
            if(is_array($value)){
                foreach ($value as $operatorInside => &$valueInside){
                    if(is_array($valueInside)){
                        throw new \ErrorException(sprintf(
                            '%s - Wrong number of arguments in %s',
                            \date('Y-d-m H:i:s'),
                            __METHOD__)
                        );
                    }

                    $valueInside = $operatorInside === 'like' ? $valueInside = "%{$valueInside}%" : $valueInside;
                }
            }

            if (is_array($value) && $operator === 'in'){
                $this->groupUpData($filterByField, $value, $operator);
                return $this;
            }
        }

        unset($value);
        unset($valueInside);

        if (!is_array($condition)) {
            $condition = ['eq' => $condition];
        }

        foreach ($condition as $operator => $value) {
            foreach ($value as $operatorInside => $valueInside) {
                if (!isset($arrayConditions[$operatorInside])) {
                    $errorMessage = \sprintf('%s - Wrong SQL-operator in %s', \date('Y-d-m H:i:s'), __METHOD__);
                    throw new \ErrorException($errorMessage);
                    break 2;
                } else {
                    if (count($filterByField) !== count($condition)) {
                        $errorMessage = \sprintf('%s -  Wrong number of arguments in %s', \date('Y-d-m H:i:s'), __METHOD__);
                        throw new \ErrorException($errorMessage);
                        break 2;
                    }

                    $data[0][$count] = \sprintf(
                        '(`%s`.`%s` %s %s)',
                        $this->table_name,
                        $filterByField[$count],
                        $arrayConditions[$operatorInside],
                        $this->valueFilterCheck($filterByField[$count], $valueInside)
                    );
                }

                $count++;
            }

            if (!is_array($value)) {
                $data[] = \sprintf(
                    '(`%s`.`%s` %s %s)',
                    $this->table_name,
                    $filterByField,
                    $arrayConditions[$operator],
                    $this->valueFilterCheck($filterByField, $value)
                );
            }
        }

        $this->filters = \array_merge($this->filters, $data);
        return $this;
    }

    public function setSort($fields, $sortBy): self
    {
        $arraySort = ['asc' => 'ASC', 'desc' => 'DESC'];
        $data = [];

        if (\is_array($sortBy) && \count($sortBy) === 1) {
            $sortBy = $sortBy[0];
        }

        try {
            $data = $this->sortCompositeValidator->apply($fields, $sortBy);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        foreach ($data as $key => $value) {
            foreach ($value as $bySort => $field) {
                if (!isset($arraySort[$bySort])) {
                    $errorMessage = \sprintf('%s - Incorrect SQL sorting operator in %s', \date('Y-d-m H:i:s'), __METHOD__);
                    throw new \ErrorException($errorMessage);
                    break;
                }
                $this->sorting[] = \sprintf('`%s`.`%s` %s', $this->table_name, $field, $arraySort[$bySort]);
            }
        }

        return $this;
    }

    public function builderQuery(): self
    {
        if (count($this->filters)) {
            $this->builderWherePart();
        }

        if (count($this->sorting)) {
            $this->builderSortPart();
        }

        return $this;
    }

    public function builderWherePart()
    {
        $this->query .= ' WHERE';

        foreach ($this->filters as $key => $conditions) {
            if (\is_array($conditions)) {
                $this->query .= \sprintf(' %s ', \implode(' OR ', $conditions));
            } else {
                if (array_key_first($this->filters) === $key) {
                    $this->query .= \sprintf(' %s', $conditions);
                } else {
                    $this->query .= \sprintf(' AND %s', $conditions);
                }
            }
        }
    }

    public function builderSortPart()
    {
        $this->query .= ' ORDER BY';
        $lastKey = array_key_last($this->sorting);

        foreach ($this->sorting as $key => $conditions) {
            if ($lastKey !== $key) {
                $this->query .= \sprintf(' %s,', $conditions);
            } else {
                $this->query .= \sprintf(' %s', $conditions);
            }
        }
    }

    public function initCollection(): self
    {
        $this->query .= ';';

        return $this;
    }

    public function valueFilterCheck($nameField, $value): string
    {
        $flag = true;
        $count = 1;
        $paramsString = '';


        while ($flag) {
            $paramsString = \sprintf(':%s_%s', $nameField, $count);

            if (isset($this->paramsSql[$paramsString])) {
                $count++;
            } else {
                $this->paramsSql[$paramsString] = $value;
                $flag = false;
            }
        }

        return $paramsString;
    }

    public function getMaxValueByField($field)
    {
        $sql = "select max($field) as max from {$this->table_name};";
        return $this->query($sql)[0]['max'];
    }

    public function getLastId()
    {
        $sql = "select last_insert_id() as last";

        return $this->query($sql)[0]['last'];
    }


    public function getCollection()
    {
        return $this->collection;
    }

    public function selectFirst()
    {
        return $this->collection[0] ?? null;
    }
}