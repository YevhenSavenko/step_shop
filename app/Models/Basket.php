<?php

namespace Models;

use Core\DB;
use Core\Model;

/**
 * Class Menu
 */
class Basket extends Model
{
    function __construct()
    {
        $this->table_name = "products";
        $this->id_column = "id";
    }

    public function filter($ids)
    {
        $sqlСondition = '';
        $paramsQuery = [];

        if ($ids) {
            $lastKey = array_key_last($ids);
            $sqlСondition = " where {$this->id_column} in (";

            foreach ($ids as $key => $id) {
                $sqlСondition .= '?';

                if ($key !== $lastKey) {
                    $sqlСondition .= ',';
                }

                $paramsQuery[] = $id;
            }

            $sqlСondition .= ')';
        }

        $this->sql .= $sqlСondition;
        $this->params = $paramsQuery;

        return $this;
    }
}
