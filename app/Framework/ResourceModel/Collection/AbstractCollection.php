<?php

namespace Framework\ResourceModel\Collection;

use Framework\Model\AbstractModel;
use Framework\ResourceModel\Db\AbstractDb;
use Framework\ResourceModel\Db\Connection;

abstract class AbstractCollection extends Connection
{
    private $table_name;

    private $id_column;

    private $resource;

    protected $_collection;

    public function __construct()
    {
        $this->_construct();
    }

    abstract public function _construct();

    public function _init(string $resourceModel)
    {
        $resourceModel = new $resourceModel;
        $this->resource = $resourceModel;
        $this->table_name = $resourceModel->getTableName();
        $this->id_column = $resourceModel->getPrimaryKeyName();
    }

    public function queryCollection(): self
    {
        if (null === $this->_collection) {
            $ids = $this->query(sprintf(
                    'select %s from %s',
                    $this->id_column,
                    $this->table_name
                )
            );

            foreach ($ids as $value) {
                $this->_collection[] = $this->resource->load($value[$this->id_column]);
            }
        }

        return $this;
    }

    public function getCollection()
    {
        return $this->_collection;
    }

    public function selectFirst()
    {
        return $this->_collection[0] ?? null;
    }
}