<?php

namespace Core;

/**
 * Class Model
 */
class Model implements DbModelInterface
{
    /**
     * @var
     */
    protected $table_name;
    /**
     * @var
     */
    protected $id_column;
    /**
     * @var array
     */
    protected $columns = [];
    /**
     * @var
     */
    protected $collection;
    /**
     * @var
     */
    protected $sql;
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @return $this
     */
    public function initCollection()
    {
        $columns = implode(',', $this->getColumns());
        $this->sql = "select $columns from " . $this->table_name;
        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        if (!$this->columns) {
            $db = new DB();
            $sql = "show columns from  $this->table_name;";

            $results = $db->query($sql);
            foreach ($results as $result) {
                array_push($this->columns, $result['Field']);
            }
        }

        return $this->columns;
    }


    /**
     * @param $params
     * @return $this
     */
    public function sort($params)
    {
        $sqlByOrderParams = [];

        foreach ($params as $field => $typeSort) {
            $sqlByOrderParams[] = "{$field} {$typeSort}";
        }

        if (count($sqlByOrderParams) > 0) {
            $this->sql = $this->sql . ' order by ' . implode(',', $sqlByOrderParams);
        }


        return $this;
    }

    /**
     * @param $params
     */
    public function filter($params)
    {
        $sqlСondition = '';
        $paramsQuery = [];

        if ($params) {
            $sqlСondition = ' where ';
            $lastKey = array_key_last($params);

            foreach ($params as $key => $vlaue) {
                $sqlСondition .= " {$key} = ?";

                if ($key !== $lastKey) {
                    $sqlСondition .= " and";
                }

                $paramsQuery[] = $vlaue;
            }
        }

        $this->sql .= $sqlСondition;
        $this->params = $paramsQuery;

        return $this;
    }


    /**
     * @return $this
     */
    public function getCollection()
    {
        $db = new DB();

        $this->sql .= ";";
        $this->collection = $db->query($this->sql, $this->params);

        return $this;
    }

    /**
     * @return mixed
     */
    public function select()
    {
        return $this->collection;
    }

    /**
     * @return null
     */
    public function selectFirst()
    {
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getItem($id)
    {
        $sql = "select * from $this->table_name where $this->id_column = ? limit 1;";
        $db = new DB();
        $params = array($id);
        $result = $db->query($sql, $params);

        if ($result) {
            return $result[0];
        } else {
            return 0;
        }
    }

    public function addItem($values, $columns)
    {
        $sql = "insert into $this->table_name ";
        $fieldsName = [];
        $valuesFields = [];
        $params = [];

        foreach ($values as $key => $value) {
            foreach ($columns as $index => $column) {
                if ($key === $column) {
                    $fieldsName[] = $column;
                    $valuesFields[] = ":{$key}";
                    $params[":{$key}"] = $value;
                }
            }
        }

        $sql .= '(' . implode(',',  $fieldsName) . ') values (' .  implode(',',  $valuesFields) . ');';

        $db = new DB();
        $db->query($sql, $params);

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

        $sql = trim($sql, ',') . " where {$this->id_column} = :id";

        $params[':id'] = $id;

        $db = new DB();
        $db->query($sql, $params);

        return $this;
    }

    public function deleteItem()
    {
        // $sql = "delete from $this->table_name where $key = :id";
        // $db = new DB();
        // $db->query($sql, [':id' => $id]);

        $db = new DB();
        $db->deleteEntity($this);

        return $this;
    }

    /**
     * @return array
     */
    public function getPostValues()
    {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            /*
            if ( isset($_POST[$column]) && $column !== $this->id_column ) {
                $values[$column] = $_POST[$column];
            }
             * 
             */
            $column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column) {
                $values[$column] = $column_value;
            }
        }

        return $values;
    }

    public function getMaxValue($field)
    {
        $sql = "select max($field) as max from {$this->table_name};";

        $db = new DB();
        $max = $db->query($sql)[0]['max'];

        return $max;
    }

    public function initStatus($status = '', $body = '')
    {
        if ($status && $body) {
            $_SESSION['alerts']['messages']['status'] = $status;
            $_SESSION['alerts']['messages']['body'] = $body;
        } else {
            unset($_SESSION['alerts']);
        }

        return $this;
    }

    public function getLastId()
    {
        $db = new DB();
        return $db->getLastId();
    }

    public function getTableName(): string
    {
        return $this->table_name;
    }

    public function getPrimaryKeyName(): string
    {
        return $this->id_column;
    }

    public function getId()
    {
        return filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
}
