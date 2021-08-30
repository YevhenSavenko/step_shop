<?php

namespace Framework\ResourceModel\Db;

use Framework\API\Data\Db\DbInterface;
use Framework\Model\AbstractModel;

abstract class AbstractDb extends Connection implements DbInterface
{
    protected $table_name;

    protected $id_column;

    protected $_columns = [];

    protected $_typeModel;

    public function __construct()
    {
        $this->_construct();
    }

    abstract public function _construct();

    public function _init($table_name, $id_column, $model)
    {
        $this->table_name = $table_name;
        $this->id_column = $id_column;
        $this->_typeModel = $model;
    }

    public function getColumns(): array
    {
        if (!$this->_columns) {
            $sql = "show columns from  $this->table_name;";

            $results = $this->query($sql);
            foreach ($results as $result) {
                array_push($this->_columns, $result['Field']);
            }
        }

        return $this->_columns;
    }

    public function load($id): AbstractModel
    {
        $obj = new $this->_typeModel;
        $sql = sprintf("select * from %s where %s = ? limit 1;", $this->table_name, $this->id_column);
        $result = $this->query($sql, array($id));

        if (empty($result)) {
            throw new \LogicException("An entity with id = {$id} does not exist");
        }

        return $obj->setData($result[0]);
    }

    public function save(AbstractModel $object): self
    {
        $sql = "insert into {$this->table_name} ";
        $fieldsName = [];
        $valuesFields = [];
        $params = [];

        foreach ($this->getColumns() as $key => $field) {
            if (isset($object->getData()[$field])) {
                $fieldsName[] = $field;
                $valuesFields[] = ":{$field}";
                $params[":{$field}"] = $object->getData()[$field];
            }
        }

        $sql .= sprintf(
            "(%s) values (%s);",
            implode(',', $fieldsName),
            implode(',', $valuesFields)
        );

        $this->query($sql, $params);

        return $this;
    }

    public function updateItem($values, $columns, $id)
    {
        $params = [];
        $sql = "update $this->table_name set ";

        foreach ($values as $key => $value) {
            foreach ($columns as $index => $column) {
                if ($key === $column) {
                    $sql .= "{$column} = :{$column},";
                    $params[":{$column}"] = $value;
                }
            }
        }

        $sql = trim($sql, ',') . " where {$this->id_column} = :id_where;";

        $params[':id_where'] = $id;

        $db = new DB();
        $db->query($sql, $params);

        return $this;
    }


    public function delete(AbstractModel $object)
    {

    }

    public function deleteEntity(DbModelInterface $model)
    {
        $dbh = $this->getConnection();
        $sql = sprintf(
            "DELETE FROM %s WHERE %s = ?;",
            $model->getTableName(),
            $model->getPrimaryKeyName()
        );

        $statement = $dbh->prepare($sql);

        $statement->execute([$model->getId()]);
    }

    public function getTableName(): string
    {
        return $this->table_name;
    }

    public function getPrimaryKeyName(): string
    {
        return $this->id_column;
    }
}