<?php

namespace Models;

use Core\DB;
use Core\Model;

/**
 * Class Product
 */
class Product extends Model
{

    /**
     * Product constructor.
     */
    function __construct()
    {
        $this->table_name = "products";
        $this->id_column = "id";
    }

    public function validValues($data)
    {
        $data['sku'] = filter_var($data['sku'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['name'] = filter_var($data['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['qty'] = filter_var($data['qty'], FILTER_SANITIZE_NUMBER_INT);
        $data['price'] = filter_var($data['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        if ($data['price'] < 0) {
            $data['price'] = 0;
        }

        if ($data['qty'] < 0) {
            $data['qty'] = 0;
        }


        return $data;
    }
}
